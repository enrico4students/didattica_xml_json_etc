//non è una servlet : solo una classe
import java.sql.*;
 
public class EsempioDB1 
{
  public static void main(String[] args) 
  {
    System.out.println("Programma Esempio1 => connessione a MySql->proveJava->amici");
     // carico il driver per la connessione al DB mysql
    // e' presente nella libreria mysql-connector-java-5.1.17-bin.jar
    String DRIVER = "com.mysql.jdbc.Driver";
    try                            // carico il driver
    {
      Class.forName(DRIVER);
    }catch (ClassNotFoundException e) 
    {                              // il driver non può essere caricato
      System.out.println("Driver non trovato...");
      e.printStackTrace();
      System.exit(1); 
    }

    // nome ed indirizzo del database
    String URL_mioDB = "jdbc:mysql://localhost:3306/proveJava";
    // definizione delle query 
    String query = "SELECT Cognome, Nome, Indirizzo, Citta FROM amici";
    // stabilisco la connessione 
    System.out.println("Connessione con: " + URL_mioDB);
    Connection connessione = null;
    try                            // apro la connesione verso il database
    {
      connessione = DriverManager.getConnection(URL_mioDB, "root", "");
    }
    catch (Exception e) 
    {                              // gestione dell'errore 
      System.out.println("Errore nella connessione: " + e);
      e.printStackTrace();
      System.exit(1);
    } 
          
    try  // creo uno Statement per interagire con il database
    {
     
      Statement statement = connessione.createStatement();
      // interrogo il DBMS mediante una query SQL
      ResultSet resultSet = statement.executeQuery(query);
      
      // Scorro e mostro i risultati.
      while (resultSet.next()) {
        String cognome = resultSet.getString(1);
        String nome = resultSet.getString(2);
        String indirizzo = resultSet.getString(3);
        String citta = resultSet.getString(4);
      
        System.out.println("Lette informazioni...");
        System.out.println("Cognome: " + cognome);
        System.out.println("Nome: " + nome);
        System.out.println("Indirizzo: " + indirizzo);
        System.out.println("Citta': " + citta);
        System.out.println();
      }
    } 
    catch (SQLException e) // gestione dell'errore 
    {
        System.out.println("Errore nella query SQL");
        e.printStackTrace();
    } 
    finally{
      if (connessione != null){
        try {
          connessione.close();                // chiusura connessione 
        } 
        catch (Exception e) 
        {                                     // gestione dell'errore
          System.out.println("Errore nella chiusura della conenssione");
        }
      }
    }
  }
}