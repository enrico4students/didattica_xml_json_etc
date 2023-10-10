import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Statement;

public class DerbyTest {
    private Connection connect = null;
    private Statement statement = null;
    private ResultSet resultSet = null;

    public DerbyTest() throws Exception {
      try {
        /**  
          String driver           = "org.apache.derby.jdbc.EmbeddedDriver";     // stand alone
          String percorso         = "..//archivioDB//";    // path a partire dalla stessa directory classe
          String nomeDB           = "esempiTPSIT3";
          String URL_mioDB        = percorso + nomeDB;
          String protocollo       = "jdbc:derby:";         // nome della libreria + relativo
          Connection connessione  = null;                  // oggetto per la connessione
          URL_mioDB  = protocollo + URL_mioDB ;
        */
            Class.forName("org.apache.derby.jdbc.EmbeddedDriver").newInstance();
         //   connect = DriverManager.getConnection("jdbc:derby://localhost/c:/temp/db/FAQ/db");
            String dbPath = "tomcat/webapps/hoepli/esempioDB/";       // percorso assoluto
            String dbName = "esempiTPSIT3;memory=false";              // nome database 
    
 
            connect = DriverManager.getConnection("jdbc:derby:"+ dbPath + dbName);
            PreparedStatement statement = connect.prepareStatement("SELECT * from alunni");
             System.out.print("Archivio :"+dbName+ " su Apache percorso :" + dbPath +"\n");
         
            resultSet = statement.executeQuery();
            while (resultSet.next()) {
                String cognome = resultSet.getString("cognome");
                String nome = resultSet.getString("nome");
                System.out.print("cognome: " + cognome);
                System.out.println("\t " + nome);
            }
        } catch (Exception e) {
            throw e;
        } finally {
            close();
        }

    }

    private void close() {
        try {
            if (resultSet != null) {
                resultSet.close();
            }
            if (statement != null) {
                statement.close();
            }
            if (connect != null) {
                connect.close();
            }
        } catch (Exception e) {

        }
    }

    public static void main(String[] args) throws Exception {
        DerbyTest dao = new DerbyTest();
    }

}