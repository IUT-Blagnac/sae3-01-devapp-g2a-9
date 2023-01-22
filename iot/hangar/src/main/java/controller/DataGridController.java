package controller;

import org.json.JSONObject;

import javafx.fxml.FXML;
import javafx.scene.control.Label;

public class DataGridController {

    @FXML
    Label timeLabel;
    @FXML
    Label tempLabel;
    @FXML
    Label humLabel;
    @FXML
    Label co2Label;

    public void set(JSONObject data) {
        timeLabel.setText(data.getString("time"));
        tempLabel.setText(String.valueOf(data.getJSONArray("temperature").getDouble(0)));
        if (data.getJSONArray("temperature").getBoolean(1)) {
            tempLabel.setStyle("-fx-background-color: red;");
        } else {
            tempLabel.setStyle("");
        }
        humLabel.setText(String.valueOf(data.getJSONArray("humidity").getDouble(0)));
        if (data.getJSONArray("humidity").getBoolean(1)) {
            humLabel.setStyle("-fx-background-color: red;");
        } else {
            humLabel.setStyle("");
        }
        co2Label.setText(String.valueOf(data.getJSONArray("co2").getDouble(0)));
        if (data.getJSONArray("co2").getBoolean(1)) {
            co2Label.setStyle("-fx-background-color: red;");
        } else {
            co2Label.setStyle("");
        }
    }
}
