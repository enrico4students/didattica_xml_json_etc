package mieiBean;
import java.io.*;
import java.util.*;
import java.sql.*;

public class ScelteDBMySql implements java.io.Serializable 
{
  private String categoria, argomento, lingua;
  private final String url         = "jdbc:mysql://";
  private final String serverName  = "localhost";
  private final String portNumber  = ":3306/";
  private final String databaseName= "provejava";
  private final String userName    = "root";
  private final String password    = "";
  // riferimento al database: connessione Mysql
  private final String URL_mioDB = url + serverName + portNumber + databaseName;
  // definizione del driver per la connessione al DB MySQL
  private final String DRIVER = "com.mysql.jdbc.Driver"; 
  
  public ScelteDBMySql  (){
    inizializza();
  }
  private void inizializza(){
     lingua ="italiano";
    // carico il driver 
    try{
      Class.forName(DRIVER);
    } 
     catch (ClassNotFoundException e) {
      System.err.println("Driver non trovato" + e);
    } 
  }

  // metodi getter e setter 
  public void setCategoria(String categoria){
    this.categoria = categoria;
  }
  public String getCategoria(){
    return categoria;
  }

   public void setLingua(String lingua){
    this.lingua = lingua;
  }
  public String getLingua(){
    return lingua;
  }

  public void setArgomento(String argomento){
    this.argomento = argomento;
  }
  public String getArgomento(){
    return argomento;
  }
   
  public String getLingue(){
    String elenco = "";
    String opzione = "";
    // definizione della query 
    String query = "SELECT lingua FROM lingue";
    // stabilisco la connessione 
    Connection connessione = null;
    try{
      // apro la connesione verso il database.
      connessione = DriverManager.getConnection(URL_mioDB,userName,password);
      // ottengo lo Statement per interagire con il database
      Statement statement = connessione.createStatement();
      // interrogo il DBMS mediante una query SQL
      ResultSet resultSet = statement.executeQuery(query);
      // scorro e mostro i risultati
      elenco="<select name=\"linguaScelta\">";
      while (resultSet.next()){
        String lingua = resultSet.getString(1);
        opzione = "<option value = \"" + lingua + "\">"+lingua+"</option>";
        elenco = elenco + opzione;
      }
      elenco = elenco +"</select>";
      System.out.println(elenco);
    } 
    catch (SQLException e)   // gestione dell'errore 
    {
      System.out.println("Errore nella connessione : <br>");
      System.out.println(e);
      System.exit(1); 
    } 
    finally{
      if (connessione != null){
        try{
          connessione.close();
        } 
        catch (Exception e)    // gestione dell'errore
        {
          System.out.println("Errore nella chiusura connessione :<br>");
          System.out.println(e);
        }
      }
    }
    return elenco;
  }

  
  public String getArgomenti(){
    String elenco = "";
    String opzione = "";
    // definizione della query 
    String query = "SELECT argomento FROM argomenti";
    // if ("inglese".equals(lingua))
    // stabilisco la connessione 
    Connection connessione = null;
    try{
      // apro la connesione verso il database.
      connessione = DriverManager.getConnection(URL_mioDB,userName,password);
      // ottengo lo Statement per interagire con il database
      Statement statement = connessione.createStatement();
      // interrogo il DBMS mediante una query SQL
      ResultSet resultSet = statement.executeQuery(query);
      // scorro e creo la stringa HTML che genera il combobox 
      elenco="<select name=\"argomentoScelto\">";
      while (resultSet.next()){
        String argomento = resultSet.getString(1);
        opzione = "<option value = \"" + argomento + "\">"+argomento+"</option>";
        elenco = elenco + opzione;
      }
      elenco = elenco +"</select>";
      System.out.println(elenco);
    } 
    catch (SQLException e)   // gestione dell'errore 
    {
      System.out.println("Errore nella connessione : <br>");
      System.out.println(e);
      System.exit(1); 
    } 
    finally{
      if (connessione != null){
        try{
          connessione.close();
        } 
        catch (Exception e)    // gestione dell'errore
        {
          System.out.println("Errore nella chiusura connessione :<br>");
          System.out.println(e);
        }
      }
    }
    return elenco;
  }
}
  