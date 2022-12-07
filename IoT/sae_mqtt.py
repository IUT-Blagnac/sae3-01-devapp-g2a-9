import json

import paho.mqtt.client as mqtt

mqttserver = "chirpstack.iut-blagnac.fr"
mqttport = 1883

def get_data(mqtt, obj, msg):
    jsonMsg = json.loads(msg.payload)
    co2 = jsonMsg["object"]["co2"]
    print("CO2 : ", co2)
    temperature = jsonMsg["object"]["temperature"]
    print("Temérature : ",temperature)
    humidity = jsonMsg["object"]["humidity"]
    print("Humidité : ",humidity)

    dictionary = {
        "temperature": humidity,
        "co2": co2,
        "humidity": humidity,
    }

    with open("data.json", "w") as outfile:
        json.dump(dictionary, outfile)


print("En attente de données...")

client = mqtt.Client()
client.connect(mqttserver, mqttport, 600)

client.subscribe("application/1/device/+/event/up")

client.on_message = get_data

client.loop_forever()

