package controller;


import java.net.URL;
import java.util.ResourceBundle;

import org.json.JSONObject;

import util.DataFetcher;
import javafx.application.Platform;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.VBox;

public class HistoriqueController implements Initializable {

    ConfigController cc;
    GraphController gc;

    @FXML
    VBox mainVBox;


    /**
     * Ajoute les données données à l'hitorique et au graphique
     * @param data Données à écrire dans le GridPane : temps, co2, température, humidité
     */
    private void newData(JSONObject data){
        try {
            FXMLLoader dgLoader = new FXMLLoader(this.getClass().getResource("/view/DataGrid.fxml"));
            GridPane dgPane = dgLoader.load();
            DataGridController dgc = dgLoader.getController();
            dgc.set(data);
    
            Platform.runLater(new Runnable() {
                @Override
                public void run() {
                    mainVBox.getChildren().add(0, dgPane);
                    gc.addToSeries(data);
                }
            });
            
        } catch (Exception e) {
            e.printStackTrace();
        }
    }



    /**
     * Récupère les données et les affiche dans l'historique et dans le graphique
     */
    @Override
    public void initialize(URL location, ResourceBundle resources) {
        mainVBox.setSpacing(30);
        DataFetcher dataFetcher = new DataFetcher("data.json");
        Thread thread = new Thread(new Runnable() {
            @Override
            public void run() {
                while (true) {
                    System.out.println("Récupération des données !");
                    JSONObject data = dataFetcher.getData();

                    newData(data);
                    try {
                        Thread.sleep(15000);
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }
                }
            }
        });
        thread.start();
    }


    /**
     * Initialise les controlleurs de la classe
     * @param cc ConfigController
     * @param gc GraphController
     */
    public void init(ConfigController cc, GraphController gc) {
        this.cc = cc;
        this.gc = gc;
    }
}
