package controller;

import java.io.IOException;
/**
 * affichage des données lues des données lues des capteurs
 */
import java.net.URL;
import java.util.ResourceBundle;

import org.json.JSONObject;

import main.App;

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



    private void newData(JSONObject data){
        try {
            FXMLLoader dgLoader = new FXMLLoader(this.getClass().getResource("/view/DataGrid.fxml"));
            GridPane dgPane = dgLoader.load();
            DataGridController gc = dgLoader.getController();
    
            gc.set(null, null, null, null);
    
            mainVBox.getChildren().add(dgPane);
            
        } catch (Exception e) {
            e.printStackTrace();
        }
    }



    @Override
    public void initialize(URL location, ResourceBundle resources) {
        newData(null);
        
    }



    public void init(ConfigController cc, GraphController gc) {
        this.cc = cc;
        this.gc = gc;
    }
}
