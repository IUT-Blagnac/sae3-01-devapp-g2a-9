package controller;

import java.io.IOException;
import java.net.URL;
import java.util.ResourceBundle;

import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.control.ScrollPane;
import javafx.scene.control.SplitPane;
import javafx.scene.layout.AnchorPane;
import javafx.scene.layout.VBox;

public class MainFrameController implements Initializable {

    @FXML
    SplitPane mainPane;

    @Override
    public void initialize(URL location, ResourceBundle resources) {
        try {
            FXMLLoader configLoader = new FXMLLoader(this.getClass().getResource("/view/Config.fxml"));
            AnchorPane configPane = configLoader.load();
            ConfigController cc = configLoader.getController();
            
            FXMLLoader graphLoader = new FXMLLoader(this.getClass().getResource("/view/Graph.fxml"));
            ScrollPane graphPane = graphLoader.load();
            GraphController gc = graphLoader.getController();
            
            FXMLLoader histLoader = new FXMLLoader(this.getClass().getResource("/view/Historique.fxml"));
            VBox histPane = histLoader.load();
            HistoriqueController hc = histLoader.getController();
            
            // cc.init(gc, hc);
            // gc.init(cc, hc);
            hc.init(cc, gc);
    
            mainPane.getItems().addAll(configPane, graphPane, histPane);
            
        } catch (Exception e) {
            System.out.println(e);
            e.printStackTrace();
        }
    }
    
}
