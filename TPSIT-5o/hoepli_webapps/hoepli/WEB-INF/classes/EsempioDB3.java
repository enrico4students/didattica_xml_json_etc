import java.sql.*;
 
public class EsempioDB3 
{
  public static void main(String[] args) 
  {
    // parametri per la connessione al database access
    String protocollo = "";
    String URL_mioDB = "";
    protocollo = "jdbc:ucanaccess://";                             // connessione alla libreria      
    URL_mioDB  = "proveJava.mdb";    // ho messo il db assieme alla aclasse  =>funzione
    URL_mioDB = "/xampp/tomcat/webapps/hoepli/esempioDB/proveJava.mdb"; // assoluto :==> funziona
    URL_mioDB = "../../esempioDB/proveJava.mdb"; // path relativo dalla classe =>funziona 
    //URL_mioDB = "localhost:3306/hoepli/esempioDB/proveJava.mdb";  // non funziona 
           
    URL_mioDB = protocollo + URL_mioDB;              
    System.out.println("Connessione con: " + URL_mioDB);
    System.out.println("Programma Esempio DB3 => connessione a access->proveJava->amici");
  
    // stabilisco la connessione 
    String utente = "";
    String psw    = "";
    Connection connessione = null;
    try                                      // apro la connessione verso il database
    {
      connessione = DriverManager.getConnection(URL_mioDB, utente, psw);
    } 
    catch (SQLException e)                 // gestione dell'errore 
    {
      System.out.println("Errore nella connessione");
      e.printStackTrace();
      System.exit(2); 
    } 

    // definizione della query 
    String query = "SELECT Cognome, Nome, Indirizzo, Citta FROM Amici";
    try                                      // esecuzione della query
    {
      Statement statement = connessione.createStatement();
      // interrogo il DBMS mediante una query SQL
      ResultSet resultSet = statement.executeQuery(query);
      // scorro il resultSet e mostro i risultati
      while (resultSet.next()){
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
    catch (SQLException e)                   // gestione dell'errore 
    {
      System.out.println("Errore nella query SQL");
      e.printStackTrace();
   } 
    finally{
      if (connessione != null){
        try {
          connessione.close();               // chiusura connessione 
        } 
        catch (Exception e) 
        {                                    // gestione dell'errore
          System.out.println("Errore nella chiusura della connessione");
          e.printStackTrace();
        }
      }
    }
  }
}