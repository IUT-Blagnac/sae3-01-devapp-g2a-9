package controller;

import java.io.IOException;
import java.lang.reflect.InvocationTargetException;
import main.App;

import javafx.fxml.FXML;

public class SecondaryController {

    @FXML
    private void switchToPrimary() throws IOException {
        App.setRoot("primary");
    }
}