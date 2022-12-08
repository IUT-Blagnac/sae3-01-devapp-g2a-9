import json

import paho.mqtt.client as mqtt
import os, signal

mqttserver = "chirpstack.iut-blagnac.fr"
mqttport = 1883

data_waiting = False
def get_data(mqtt, obj, msg):
    global jsonMsg
    jsonMsg = json.loads(msg.payload)
    co2 = jsonMsg["object"]["co2"]
    print("CO2 : ", co2)
    temperature = jsonMsg["object"]["temperature"]
    print("Temérature : ", temperature)
    humidity = jsonMsg["object"]["humidity"]
    print("Humidité : ", humidity)
    global data_waiting
    data_waiting = True

def ecriture(numero, frame):
    global data_waiting
    signal.alarm(5)
    try:
        if data_waiting:
            msg = json.dumps(jsonMsg["object"])
            print("écriture de :\n" + msg)
            fd = os.open("data.json", os.O_WRONLY|os.O_CREAT|os.O_TRUNC)
            os.write(fd, msg.encode())
            data_waiting = False
    except Exception as e:
        print(e)

print("En attente de données...")

signal.signal(signal.SIGALRM, ecriture)
signal.alarm(5)

client = mqtt.Client()
client.connect(mqttserver, mqttport, 600)

client.subscribe("application/1/device/+/event/up")

client.on_message = get_data

client.loop_forever()

