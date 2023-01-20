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

import org.json.simple.*;

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

    @Override
    public void initialize(URL location, ResourceBundle resources) {

    }

    @FXML
    private void actionSubmit() {
        submitButton.setOnAction(e -> ecriture());
    }

    @FXML
    private void actionCheckCapteur() {


    }

    @FXML
    private void actionCheckSeuilSelect() {

    }

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

    public JSONObject ecriture() {
        JSONObject obj = new JSONObject();
        double palierDefault = null;

        //if check temperature
        if (checkBTemp.isSelected()) {

            // recuperer valeur curseur temperature
            if (palierTemp.isSelected()) {
                double palExactTemp = sliderTemp.getValue();
            }
        }
        //if check humidite
        if (checkBHum.isSelected()) {
            //recuperer valeur curseur humidite
            if (palierHum.isSelected()) {
                double palExactHum = sliderHum.getValue();
            }
        }

        //if check CO2
        if (checkBCO2.isSelected()) {
            //recuperer valeur curseur C02
            if (palierCO2.isSelected()) {
                double palExactCO2 = sliderCO2.getValue();
            }
        }

        //ecriture en dico dans le json
        obj.put();

        return obj;
    }





}

