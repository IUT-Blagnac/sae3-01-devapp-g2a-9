package controller;

import java.io.IOException;

import main.App;

import javafx.fxml.FXML;

/**
 *Recuperation des valeurs exactes du script python et comparaison avec le seuil et historisation des données.
 */
public class ValeursController {

    @FXML
    private void switchToPrimary() throws IOException {
        App.setRoot("primary");
    }
}