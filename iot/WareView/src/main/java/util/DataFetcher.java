package util;

import org.json.JSONObject;
import org.json.simple.parser.JSONParser;

import java.io.FileReader;
import java.time.LocalDateTime;
import java.util.Random;

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
            Object obj = new JSONParser().parse(new FileReader(this.filename));
            this.jsonData = new JSONObject(obj.toString());
        } catch (Exception e) {
            e.printStackTrace();
            System.out.println("No data.json found, randomized data");
            Random random = new Random();
            this.jsonData = new JSONObject("{\"co2\": ["+random.nextInt(100)+", "+random.nextBoolean()+"], \"humidity\": ["+random.nextInt(100)+", "+random.nextBoolean()+"], \"temperature\": ["+random.nextInt(100)+", "+random.nextBoolean()+"]}");

        }
        LocalDateTime now = LocalDateTime.now();
        this.jsonData.put("time", now.getHour()+":"+now.getMinute()+":"+now.getSecond());
        System.out.println(this.jsonData.toString());
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