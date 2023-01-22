package controller;

import java.io.IOException;
/**
 * affichage des données lues des données lues des capteurs
 */
import java.net.URL;
import java.util.ResourceBundle;

import org.json.JSONObject;

import main.App;

import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.chart.CategoryAxis;
import javafx.scene.chart.LineChart;
import javafx.scene.chart.NumberAxis;
import javafx.scene.chart.XYChart;

public class GraphController implements Initializable {
    //Partie graph
    @FXML
    private LineChart<String, Integer> chartTemp;
    @FXML
    private CategoryAxis xAxisTemp;
    @FXML
    private NumberAxis yAxisTemp;
    @FXML
    private LineChart<String, Integer> chartHumidite;
    @FXML
    private CategoryAxis xAxisHumidite;
    @FXML
    private NumberAxis yAxisHumidite;
    @FXML
    private LineChart<String, Integer> chartCO2;
    @FXML
    private CategoryAxis xAxisCO2;
    @FXML
    private NumberAxis yAxisCO2;

    XYChart.Series<String,Integer> tempSeries;
    XYChart.Series<String,Integer> humSeries;
    XYChart.Series<String,Integer> co2Series;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        // Ajout des labels sur l'axe Y des graphs
        yAxisTemp.setLabel("Temp - °C");
        yAxisHumidite.setLabel("Hum - %");
        yAxisCO2.setLabel("CO2 - ppm");
        
        // Création des séries de données pour les graphes
        this.tempSeries = new XYChart.Series<String,Integer>();
        this.humSeries = new XYChart.Series<String,Integer>();
        this.co2Series = new XYChart.Series<String,Integer>();
        
        // Ajout des séries aux graphiques
        chartTemp.getData().add(tempSeries);
        chartHumidite.getData().add(humSeries);
        chartCO2.getData().add(co2Series);
    }
    
    // fonction permettant d'ajouter les donées de l'objet json aux séries de données
    public void addToSeries(JSONObject data){
        int temperature = data.getJSONArray("temperature").getInt(0); // Récupération de la température dans le json
        tempSeries.getData().add(new XYChart.Data<String,Integer>(data.getString("time"), temperature)); // Ajout de la température dans la série température
        
        int humidite = data.getJSONArray("humidity").getInt(0);
        humSeries.getData().add(new XYChart.Data<String,Integer>(data.getString("time"), humidite));
        
        int dioxyde = data.getJSONArray("co2").getInt(0);
        co2Series.getData().add(new XYChart.Data<String,Integer>(data.getString("time"), dioxyde));   
    }
    
}
