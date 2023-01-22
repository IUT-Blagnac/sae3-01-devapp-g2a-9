package controller;

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

    public void set(String time, String temp, String hum, String co2) {
        timeLabel.setText(time);
    }
}
