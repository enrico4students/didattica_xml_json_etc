//database direttmente modificato da NetBeans10
import java.sql.*;

public class CreaDerby {
  public static void main(String[] args) throws Exception {
    String driver       = "org.apache.derby.jdbc.EmbeddedDriver";    // stand alone 
    String protocollo   = "jdbc:derby:";                             // connessione alla libreria
    String dbpath       = "tomcat/webapps/hoepli/esempioDB/";        // percorso assoluto 
    java.sql.Connection con = null;
    String miaQuery;
    // Step 1: caricamento e registrazione Derby driver class
    System.out.println("Registrazione del driver: " + protocollo); 
    try {
      Class.forName(driver);
    }
    catch(ClassNotFoundException excep) {
      System.out.println("====> Errore: problemi nel caricamento del driver " + driver);
      excep.printStackTrace();
      System.exit(1);
    }
    // Step 2: connessione al database DB o sua creazione      
    try {
      con = DriverManager.getConnection("jdbc:derby:provaDB");
     } 
     catch (java.sql.SQLException sqle) {
      con = DriverManager.getConnection("jdbc:derby:provaDB;create=true");
      miaQuery = "CREATE TABLE UTENTI (userID INT NOT NULL, mail VARCHAR(100),password VARCHAR(20))";
      con.createStatement().executeUpdate(miaQuery);
    }
    // Step 3: inserimento dati     
    miaQuery = "INSERT INTO UTENTI (userID,mail,password) VALUES(?,?,?)";
    PreparedStatement stm = con.prepareStatement(miaQuery);
    stm.setInt(1, 1);
    stm.setString(2, "ciro@vesuvio.org");
    stm.setString(3, "c1@OM@mm@");
    stm.executeUpdate();
    // Step 4: visualizzazione dati presenti nel database       
    miaQuery = "select * from UTENTI";
    ResultSet rs = con.createStatement().executeQuery(miaQuery);
    while (rs.next()) {
      System.out.println( " id:" + rs.getInt(1)+"   e-mail: " + rs.getString(2));
    }
    try {                          // è una versione embedded: va chiusa quando l'applicazione termina
      DriverManager.getConnection("jdbc:derby:provaDB;shutdown=true");
    } catch (SQLException se) {    // stato = 08006 chiusura OK, altrimenti si è verificato un errore
      if (!se.getSQLState().equals("08006")) {
        throw se;
      }
    }
  }
}
   
     