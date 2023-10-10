import java.sql.*;

public class EsempioDerbyLocale {
  public static void main(String[] args)  {
    String driver       = "org.apache.derby.jdbc.EmbeddedDriver";       // stand alone 
    String protocollo   = "jdbc:derby:";                                // connessione alla libreria
    String dbpath       = "tomcat/webapps/hoepli/esempioDB/";           // percorso assoluto 
    //dbpath = "//localhost:1527/hoepli/esempioDB/";                    // non connette
    String dbName       = "esempiTPSIT3;memory=false";                  // nome database 
    
    // parametri per la connessione al database Java DB 
    String URL_mioDB = protocollo + dbpath + dbName;
    // parametri per la sicurezza accesso al database
    String utente = ""; // schema
    String psw = "";
  
    // Step 1: caricamento e registrazione Oracle JDBC driver class
    System.out.println("Registrazione del driver: " + protocollo); 
    try {
      Class.forName(driver);
    }
    catch(ClassNotFoundException excep) {
    System.out.println("====> Errore: problemi nel caricamento del driver " + driver);
    excep.printStackTrace();
    System.exit(1);
    }
   
    // Step 2: connessione al database DB
    Connection connessione = null;               // oggetto per la connessione
    System.out.println("Connessione con: " + URL_mioDB);
    try{ // apro la connessione verso il database
    connessione = DriverManager.getConnection(URL_mioDB, utente, psw);
    }
    catch (SQLException excep){ // gestione dell'errore 
    System.out.println("====> Errore nella definizione del driver");
    excep.printStackTrace(); 
    System.exit(2); 
   } 
   
  // Step 3: definizione e esecuzione della query
   String query = "SELECT * FROM alunni";
  try{ // esecuzione della query
  // interrogo il DBMS mediante una query SQL
  Statement statement= connessione.createStatement();
  // interrogo il DBMS mediante una query SQL
  ResultSet rs = statement.executeQuery(query);
  // scorro il resultSet e mostro i risultati
  while (rs.next()) {
   int mat = rs.getInt(1);
   String cog = rs.getString("cognome");
   String nom = rs.getString(3);
   int classe = rs.getInt("classe");     
   String sex = rs.getString("sesso");
 
   System.out.print("matricola: " + mat); 
   System.out.print("\talunno: " + cog+" "  +nom);
   System.out.print("\tclasse: " + classe+ rs.getString("sezione"))  ;
   System.out.print("\tsex: " + sex);      

   System.out.print("\n");
   }
   }
    catch (SQLException excep){ // gestione dell'errore
   System.out.println("===  > Errore nella query SQL");
   excep.printStackTrace(); 
   }   
 
   // Step 4: chiusura della connessione
     finally{
    if (connessione != null){
    try {
    connessione.close(); // chiusura connessione
     }
    catch (Exception excep){ // gestione dell'errore
    System.out.println("Errore nella chiusura della connessione");
    excep.printStackTrace();
   } 
   }
  }
 }
}

