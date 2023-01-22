package controller;

import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.control.CheckBox;
import javafx.scene.control.Label;
import javafx.scene.control.Slider;
import javafx.scene.layout.GridPane;
import java.net.URL;
import java.util.ResourceBundle;

import javafx.scene.chart.LineChart;
import javafx.scene.chart.CategoryAxis;
import javafx.scene.chart.NumberAxis;
import javafx.scene.chart.XYChart;

import org.json.simple.*;
import org.json.JSONObject;

import javafx.fxml.Initializable;

/**
 * Ce controller va écrire le fichier de config.json (creation) qui va servir au python pour savoir quelles données récupérer puis à l'affichage des données en javaFX
 */


public class  ConfigController implements Initializable {

    @FXML
    private Label seuilExactTemp;
    @FXML
    private Label seuilExactHum;
    @FXML
    private Label seuilExactCO2;
    @FXML
    private Button submitButton;
    @FXML
    private CheckBox checkBTemp;
    @FXML
    private CheckBox checkBHum;
    @FXML
    private CheckBox checkBCO2;
    @FXML
    private Slider sliderTemp;
    @FXML
    private Slider sliderHum;
    @FXML
    private Slider sliderCO2;
    @FXML
    private CheckBox palierTemp;
    @FXML
    private CheckBox palierCO2;
    @FXML
    private CheckBox palierHum;

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

    //initialisation du début position
    @Override
    public void initialize(URL location, ResourceBundle resources) {
        // bind checkbox palier to checkbox data
        bindCheckBox(checkBTemp, palierTemp, sliderTemp, seuilExactTemp);
        bindCheckBox(checkBCO2, palierCO2, sliderCO2, seuilExactCO2);
        bindCheckBox(checkBHum, palierHum, sliderHum, seuilExactHum);
        
        // Ajout des labels sur l'axe Y des graphs
        yAxisTemp.setLabel("Temp - °C");
        yAxisHumidite.setLabel("Hum - %");
        yAxisCO2.setLabel("CO2 - ppm");

        // Création des séries de données pour les graphes
        XYChart.Series<String,Integer> tempSeries = new XYChart.Series<String,Integer>();
        XYChart.Series<String,Integer> humSeries = new XYChart.Series<String,Integer>();
        XYChart.Series<String,Integer> co2Series = new XYChart.Series<String,Integer>();

        // Ajout des données récupérées depuis le json dans les séries de données
        Integer iterateur = 1; // Variable permettant de définir la position de la données sur l'axe X des graphes
        JSONObject data = new JSONObject("{\"co2\": [436, false], \"humidity\": [31, true], \"temperature\": [16, false]}"); // La data est convertie d'une string a un objet json
        addToSeries(data, iterateur, tempSeries, humSeries, co2Series); // ajout des données aux séries de données
        iterateur += 1;
        data = new JSONObject("{\"co2\": [536, false], \"humidity\": [41, true], \"temperature\": [20, false]}");
        addToSeries(data, iterateur, tempSeries, humSeries, co2Series);
        iterateur += 1;
        data = new JSONObject("{\"co2\": [636, false], \"humidity\": [51, true], \"temperature\": [20, false]}");
        addToSeries(data, iterateur, tempSeries, humSeries, co2Series);
        iterateur += 1;
        data = new JSONObject("{\"co2\": [536, false], \"humidity\": [61, true], \"temperature\": [22, false]}");
        addToSeries(data, iterateur, tempSeries, humSeries, co2Series);
        iterateur += 1;
        data = new JSONObject("{\"co2\": [736, false], \"humidity\": [61, true], \"temperature\": [19, false]}");
        addToSeries(data, iterateur, tempSeries, humSeries, co2Series);
        iterateur += 1;

        // Ajout des séries aux graphiques
        chartTemp.getData().add(tempSeries);
        chartHumidite.getData().add(humSeries);
        chartCO2.getData().add(co2Series);
    }
    
    private void bindCheckBox(CheckBox checkB, CheckBox palier, Slider slider, Label seuilExact) {
        palier.disableProperty().bind(checkB.selectedProperty().not());
        slider.disableProperty().bind(palier.selectedProperty().not());
        seuilExact.disableProperty().bind(palier.selectedProperty().not());
        palier.visibleProperty().bind(checkB.selectedProperty());
        slider.visibleProperty().bind(checkB.selectedProperty());
        seuilExact.visibleProperty().bind(checkB.selectedProperty());
    }
    
    //lorsque le bouton submit est cliqué appeller ecriture
    @FXML
    private void actionSubmit() {
        submitButton.setOnAction(e -> ecriture());
    }

    //lorsque un des capteurs est sélectionné (choix du palier ou choix défaut)
    @FXML
    private void actionCheckCapteur() {
        // if (checkBTemp.isSelected()) {
        //     palierTemp.setDisable(false);
        // } else if (checkBHum.isSelected()) {
        //     checkBHum.setDisable(false);
        // } else if (checkBCO2.isSelected()) {
        //     checkBCO2.setDisable(false);
        // }

    }

    //actions lorsque le choix du seuil est sélectionné
    @FXML
    private void actionCheckSeuilSelect() {

    }

    //lorsque le slide est déplacé
    @FXML
    private void actionSlideTemp() {
        sliderTemp.setMin(0);
        sliderTemp.setMax(100);
        sliderTemp.setValue(40);

        sliderTemp.valueProperty().addListener((ov, old_val, new_val) -> {
            int value = (int) Math.round(new_val.doubleValue());
            sliderTemp.setValue(value);
            System.out.println(value);
            seuilExactTemp.setText(Integer.toString(value));
        });
    }

    @FXML
    private void actionSlideHum() {
        sliderHum.setMin(-50);
        sliderHum.setMax(70);
        sliderHum.setValue(40);
    }

    @FXML
    private void actionSlideC02() {
        sliderCO2.setMin(0);
        sliderCO2.setMax(5000);
        sliderCO2.setValue(40);
    }

    //ecriture du fichier json
    public JSONObject ecriture() {
        JSONObject obj = new JSONObject();
        Double palExactTemp; //un objet qu'on traite comme un type primitif pour pouvoir le mettre en null
        Double palExactHum;
        Double palExactCO2;

        //if check temperature
        if (checkBTemp.isSelected()) {

            // recuperer valeur curseur temperature
            if (palierTemp.isSelected()) {
                palExactTemp = sliderTemp.getValue();
            } else {
                palExactTemp = null;
            }


        }
        //if check humidite
        if (checkBHum.isSelected()) {
            //recuperer valeur curseur humidite
            if (palierHum.isSelected()) {
                palExactHum = sliderHum.getValue();
            } else {
                palExactHum = null;
            }
        }

        //if check CO2
        if (checkBCO2.isSelected()) {
            //recuperer valeur curseur C02
            if (palierCO2.isSelected()) {
                palExactCO2 = sliderCO2.getValue();
            } else {
                palExactCO2 = null;
            }


        }
        return obj;
    }

    // fonction permettant d'ajouter les donées de l'objet json aux séries de données
    public void addToSeries(JSONObject data, Integer iterateur, XYChart.Series<String,Integer> tempSeries, XYChart.Series<String,Integer> humSeries, XYChart.Series<String,Integer> co2Series){
        int temperature = data.getJSONArray("temperature").getInt(0); // Récupération de la température dans le json
        tempSeries.getData().add(new XYChart.Data<String,Integer>(iterateur.toString(),temperature)); // Ajout de la température dans la série température

        int humidite = data.getJSONArray("humidity").getInt(0);
        humSeries.getData().add(new XYChart.Data<String,Integer>(iterateur.toString(),humidite));

        int dioxyde = data.getJSONArray("co2").getInt(0);
        co2Series.getData().add(new XYChart.Data<String,Integer>(iterateur.toString(),dioxyde));
    }





}

