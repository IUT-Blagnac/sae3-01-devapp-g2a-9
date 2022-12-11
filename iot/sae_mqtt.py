import json

import paho.mqtt.client as mqtt
import os, signal

mqttserver = "chirpstack.iut-blagnac.fr"
mqttport = 1883

f = os.open('./config.json', os.O_RDONLY)
config_raw = os.read(f, 1024)
config = json.loads(config_raw)

data_waiting = False

def get_data(mqtt, obj, msg):
    print('data')
    global jsonMsg
    jsonMsg = json.loads(msg.payload)
    for data in config['data']:
        value = jsonMsg["object"][data]
        print(f"{data}: {value}")
    global data_waiting
    data_waiting = True

def ecriture(numero, frame):
    global data_waiting
    signal.alarm(30)
    try:
        if data_waiting:
            msg = json.dumps(jsonMsg["object"])
            print("écriture de :\n" + msg)
            fd = os.open(config['filename'], os.O_WRONLY|os.O_CREAT|os.O_TRUNC)
            os.write(fd, msg.encode())
            data_waiting = False
    except Exception as e:
        print(e)

print("En attente de données...")

signal.signal(signal.SIGALRM, ecriture)
signal.alarm(10)

client = mqtt.Client()
client.connect(mqttserver, mqttport, 600)

client.subscribe("application/1/device/+/event/up")

client.on_message = get_data

client.loop_forever()

