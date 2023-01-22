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

    //initialisation du début position
    @Override
    public void initialize(URL location, ResourceBundle resources) {
        // bind checkbox palier to checkbox data
        bindCheckBox(checkBTemp, palierTemp, sliderTemp, seuilExactTemp);
        bindCheckBox(checkBCO2, palierCO2, sliderCO2, seuilExactCO2);
        bindCheckBox(checkBHum, palierHum, sliderHum, seuilExactHum);
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


}

