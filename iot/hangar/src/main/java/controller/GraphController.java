package controller;

import java.io.IOException;
/**
 * affichage des données lues des données lues des capteurs
 */

import main.App;

import javafx.fxml.FXML;

public class GraphController {

    @FXML
    private void switchToSecondary() throws IOException {
        App.setRoot("secondary");;
    }
}