package model;

import org.json.JSONObject;

import java.io.FileNotFoundException;
import java.io.FileReader;
import java.time.LocalDateTime;

/**
 * Objet récuperant les données d'un fichier donné, de manière périodique à intervalle donnée.
 */
public class DataFetcher {
    private JSONObject jsonData;
    private String filename;
    
    /**
     * @param filename Nom et/ou chemin du fichier dont on souhaite extraire les données
     */
    public DataFetcher(String filename) {
        this.filename = filename;
    }

    /**
     * @return Les données de concentration en co2, de température et d'humidité stockées dans le fichier
     */
    public JSONObject getData() {
        try {
            this.jsonData = new JSONObject(new FileReader(filename));
        } catch (FileNotFoundException e) {
            e.printStackTrace();
            // this.jsonData = new JSONObject("{\"co2\": [536, false], \"humidity\": [41, true], \"temperature\": [20, false]}");
            // this.jsonData = new JSONObject("{\"co2\": [636, false], \"humidity\": [51, true], \"temperature\": [20, false]}");
            // this.jsonData = new JSONObject("{\"co2\": [536, false], \"humidity\": [61, true], \"temperature\": [22, false]}");
            this.jsonData = new JSONObject("{\"co2\": [-1, false], \"humidity\": [-1, true], \"temperature\": [-1, true]}");

        }
        LocalDateTime now = LocalDateTime.now();
        this.jsonData.put("time", now.getHour()+":"+now.getMinute()+":"+now.getSecond());
        return jsonData;
    }

    /**
     * @param filename Nom et/ou chemin du fichier dont on souhaite extraire les données
     */
    public void setFilename(String filename) {
        this.filename = filename;
    }

    /**
     * @return Nom et/ou chemin du fichier dont on souhaite extraire les données
     */
    public String getFilename() {
        return filename;
    }
}