package controller;

import java.io.IOException;

import main.App;

import javafx.fxml.FXML;

import org.json.JSONObject;
import java.io.FileReader;

/**
 * Objet récuperant les données d'un fichier donné, de manière périodique à intervalle donnée.
 */
public class ValeursController {
    private double co2;
    private double humidity;
    private double temperature;

    private double interval;
    private String filename;


    @FXML
    private void switchToPrimary() throws IOException {
        App.setRoot("primary");
    }

    
    /**
     * @param interval Durée d'attente entre la récuperation des données
     * @param filename Nom et/ou chemin du fichier dont on souhaite extraire les données
     */
    public ValeursController(long interval, String filename) {
        this.interval = interval;
        this.filename = filename;

        // Crée un thread afin de ne pas vérouiller le programme
        Thread thread = new Thread(new Runnable() {
            @Override
            public void run() {
                while (true) {
                    try {
                        // Récupère et stocke les valeurs
                        JSONObject jsonData = new JSONObject(new FileReader(filename));
                        co2 = jsonData.getDouble("co2");
                        humidity = jsonData.getDouble("humidity");
                        temperature = jsonData.getDouble("temperature");
                        
                        Thread.sleep(interval);
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                }
            }
        });
        thread.start();
    }

    /**
     * @return La donnée de concentration en Co2 stockée dans le fichier
     */
    public double getCo2() {
        return co2;
    }

    /**
     * @return La donnée de pourcentage d'humidité stockée dans le fichier
     */
    public double getHumidity() {
        return humidity;
    }

    /**
     * @return La donnée de température stockée dans le fichier
     */
    public double getTemperature() {
        return temperature;
    }

    /**
     * @param filename Nom et/ou chemin du fichier dont on souhaite extraire les données
     */
    public void setFilename(String filename) {
        this.filename = filename;
    }

    /**
     * @return Nom et/ou chemin du fichier dont on souhaite extraire les données
     */
    public String getFilename() {
        return filename;
    }

    /**
     * @param interval Durée d'attente entre la récuperation des données
     */
    public void setInterval(double interval) {
        this.interval = interval;
    }

    /**
     * @return Durée d'attente entre la récuperation des données
     */
    public double getInterval() {
        return interval;
    }
}