import json

import paho.mqtt.client as mqtt
import os, signal

mqttserver = "chirpstack.iut-blagnac.fr"
mqttport = 1883

def get_data(mqtt, obj, msg):
    global jsonMsg
    jsonMsg = json.loads(msg.payload)
    co2 = jsonMsg["object"]["co2"]
    print("CO2 : ", co2)
    temperature = jsonMsg["object"]["temperature"]
    print("Temérature : ",temperature)
    humidity = jsonMsg["object"]["humidity"]
    print("Humidité : ",humidity)

def ecriture(numero, frame):
    fd = os.open("data.json", os.O_WRONLY|os.O_CREAT|os.O_TRUNC)
    os.write(fd, bytes(jsonMsg["object"]))
    print("écriture de : ", jsonMsg["object"])
    signal.alarm(30)


print("En attente de données...")

signal.signal(signal.SIGALRM, ecriture)
signal.alarm(10)

client = mqtt.Client()
client.connect(mqttserver, mqttport, 600)

client.subscribe("application/1/device/+/event/up")

client.on_message = get_data

client.loop_forever()

