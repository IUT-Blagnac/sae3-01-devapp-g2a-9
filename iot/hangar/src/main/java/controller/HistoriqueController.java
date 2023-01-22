package controller;

import java.io.IOException;
/**
 * affichage des données lues des données lues des capteurs
 */
import java.net.URL;
import java.time.LocalDateTime;
import java.util.Random;
import java.util.ResourceBundle;

import org.json.JSONObject;

import main.App;
import util.DataFetcher;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.control.Label;
import javafx.scene.control.ScrollPane;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.VBox;

public class HistoriqueController implements Initializable {

    ConfigController cc;
    GraphController gc;

    @FXML
    VBox mainVBox;


    /**
     * Ajoute un GridPane avec les dernières données ajoutées au graphique
     * @param data Données à écrire dans le GridPane : co2, température, humidité
     */
    private void newData(JSONObject data){
        try {
            FXMLLoader dgLoader = new FXMLLoader(this.getClass().getResource("/view/DataGrid.fxml"));
            GridPane dgPane = dgLoader.load();
            DataGridController gc = dgLoader.getController();
    
            gc.set(data);
            Platform.runLater(new Runnable() {
                @Override
                public void run() {
                    mainVBox.getChildren().add(0, dgPane);
                }
            });
            
        } catch (Exception e) {
            e.printStackTrace();
        }
    }



    @Override
    public void initialize(URL location, ResourceBundle resources) {
        mainVBox.setSpacing(30);
        DataFetcher dataFetcher = new DataFetcher("data.json");
        newData(dataFetcher.getData());
        Thread thread = new Thread(new Runnable() {
            @Override
            public void run() {
                while (true) {
                    System.out.println("Récupération des données !");
                    JSONObject data = dataFetcher.getData();

                    newData(data);
                    try {
                        Thread.sleep(3000);
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }
                }
            }
        });
        thread.start();
    }



    public void init(ConfigController cc, GraphController gc) {
        this.cc = cc;
        this.gc = gc;
    }
}
