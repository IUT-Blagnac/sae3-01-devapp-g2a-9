package controller;

import java.io.FileWriter;
import java.io.IOException;
import java.net.URL;
import java.util.ResourceBundle;

import org.json.JSONObject;

import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.control.CheckBox;
import javafx.scene.control.Label;
import javafx.scene.control.Slider;

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
    private Label submitLabel;
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


        submitLabel.setText("");
    }

    /**
     * Allows the checkbox "palier" to appear and binds it to its slider
     * @param checkB
     * @param palier
     * @param slider
     * @param seuilExact
     */
    private void bindCheckBox(CheckBox checkB, CheckBox palier, Slider slider, Label seuilExact) {
        palier.disableProperty().bind(checkB.selectedProperty().not());
        slider.disableProperty().bind(palier.selectedProperty().not());
        seuilExact.disableProperty().bind(palier.selectedProperty().not());
        palier.visibleProperty().bind(checkB.selectedProperty());
        slider.visibleProperty().bind(checkB.selectedProperty());
        seuilExact.visibleProperty().bind(checkB.selectedProperty());
    }

    /**
     * Calls the "ecriture()" function when the button "Enregistrer" is pressed
     */
    @FXML
    private void actionSubmit() {
        ecriture();
        submitLabel.setText("Enregistré !");
    }

    /**
     * Allows you to set the slider when "palierTemp" is selected
     */
    @FXML
    private void actionSlideTemp() {
        if (checkBTemp.isSelected()) {

            if (palierTemp.isSelected()) {

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
        }
    }

    /**
     * Allows you to set the slider when "palierHum" is selected
     */
    @FXML
    private void actionSlideHum() {
        if (checkBHum.isSelected()) {

            if (palierHum.isSelected()) {
                sliderHum.setMin(0);
                sliderHum.setMax(100);
                sliderHum.setValue(40);

                sliderHum.valueProperty().addListener((ov, old_val, new_val) -> {
                    int value = (int) Math.round(new_val.doubleValue());
                    sliderHum.setValue(value);
                    System.out.println(value);
                    seuilExactHum.setText(Integer.toString(value));
                });
            }
        }
    }

    /**
     * Allows you to set the slider when "palierCO2" is selected
     */
    @FXML
    private void actionSlideCO2() {
        if (checkBCO2.isSelected()) {

            if (palierCO2.isSelected()) {
                sliderCO2.setMin(0);
                sliderCO2.setMax(5000);
                sliderCO2.setValue(40);

                sliderCO2.valueProperty().addListener((ov, old_val, new_val) -> {
                    int value = (int) Math.round(new_val.doubleValue());
                    sliderCO2.setValue(value);
                    System.out.println(value);
                    seuilExactCO2.setText(Integer.toString(value));
                });
            }
        }
    }

    /**
     * Writes the JSON file with the threshold chosen with the sliders (or with no threshold)
     */
    public void ecriture() {
        JSONObject obj = new JSONObject();
        JSONObject objIn = new JSONObject();

        Double palExactTemp; //un objet qu'on traite comme un type primitif pour pouvoir le mettre en null
        Double palExactHum;
        Double palExactCO2;


        //if check temperature
        if (checkBTemp.isSelected()) {
            // recuperer valeur curseur temperature
            if (palierTemp.isSelected()) {
                palExactTemp = sliderTemp.getValue();
                objIn.put("temperature", palExactTemp);
            } else {
                objIn.put("temperature", JSONObject.NULL);
            }

        }

        //if check humidite
        if (checkBHum.isSelected()) {
            //recuperer valeur curseur humidite
            if (palierHum.isSelected()) {
                palExactHum = sliderHum.getValue();
                objIn.put("humidity", palExactHum);
            } else {
                objIn.put("humidity", JSONObject.NULL);
            }

        }

        //if check CO2
        if (checkBCO2.isSelected()) {
            //recuperer valeur curseur C02
            if (palierCO2.isSelected()) {
                palExactCO2 = sliderCO2.getValue();
                objIn.put("co2", palExactCO2);
            } else {
                objIn.put("co2", JSONObject.NULL);
            }

        }

        //syntaxe et structure du document à ecrire
        obj.put("filename", "config.json");
        obj.put("data", objIn);

        //ecriture file
        try (FileWriter file = new FileWriter("config.json")) {
            file.write(obj.toString());
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}

