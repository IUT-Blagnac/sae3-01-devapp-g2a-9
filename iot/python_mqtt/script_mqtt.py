import json
import sys

import paho.mqtt.client as mqtt
import os, signal

# Port et server initialisé pour se connecter au réseau LoRa de l'IUT
mqttserver = "chirpstack.iut-blagnac.fr"
mqttport = 1883

data_waiting = False
output = {}

def load_config():
    global config
    # le fichier config.json sera donné par le programme java
    f = os.open(sys.path[0]+'/config.json', os.O_RDONLY) #ouverture d'un fichier .json en lecture
    config_raw = os.read(f, 1024) #nous allons lire 1024 bytes du fichier f.json
    config = json.loads(config_raw) #json est un format utilisé pour stocker et echanger des données il prend en paramètre un tableau de bytes cette fonction retourne un objet python
    os.close(f)

def get_data(mqtt, obj, msg):
    print('data') #affichage pour informer l'utilisateur
    load_config() #relecture du fichier de configuration
    global jsonMsg #creation d'une variable globale
    jsonMsg = json.loads(msg.payload) #recuperation de tout ce qui est envoyé par les capteurs en un format lisible par python
    for data in jsonMsg['object']:
        if data in config['data']:
            # tuple (valeur, True/False selon si le seuil configuré a été dépassé ou non)
            output[data] = (jsonMsg["object"][data], jsonMsg["object"][data] > config['data'][data] if config['data'][data] != None else False)
    global data_waiting #reinitialiser la variable pour que la modification soit effective en dehors de la fonction
    data_waiting = True #changement de la variable globale data_waiting depuis la fonction

def ecriture(numero, frame):
    global data_waiting
    signal.alarm(30) #la fonction sera rappelée dans 30 secondes
    try:
        if data_waiting: #si le boolean global data_waiting est True
            msg = json.dumps(output)
            print("écriture de :\n" + msg)
            fd = os.open(sys.path[0]+config['filename'], os.O_WRONLY|os.O_CREAT|os.O_TRUNC) # crée ou ouvre le fichier d'ecriture des données
            os.write(fd, msg.encode()) # encode en UTF-8 par defaut
            os.close(fd)
            data_waiting = False
    except Exception as e: #leve une exception si l'écriture du fichier est impossible
        print(e)

signal.signal(signal.SIGALRM, ecriture) #va rediriger le signal d'alarme vers la fonction ecriture
signal.alarm(10) # va lancer une seule alarme 10 sec après le lancement du programme

client = mqtt.Client()
client.connect(mqttserver, mqttport, 600)

client.subscribe("application/1/device/+/event/up") #on en fait un seul appel pour s'abonner aux topics (lien) présents dans la liste devices

client.on_message = get_data #chaque message reçu appelera la fonction get_data()

print("En attente de données...") #affichage pour informer l'utilisateur

client.loop_forever() #boucle tant que l'on ne stoppe pas le programme de force

