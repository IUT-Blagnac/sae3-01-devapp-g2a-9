package model;

import org.json.JSONObject;

import java.io.FileNotFoundException;
import java.io.FileReader;

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
    public double[] getData() {
        double[] data = new double[3];
        try {
            this.jsonData = new JSONObject(new FileReader(filename));
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        }
        data[0] = this.jsonData.getDouble("co2");
        data[1] = this.jsonData.getDouble("temperature");
        data[2] = this.jsonData.getDouble("humidity");
        return data;
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