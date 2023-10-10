import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.sql.*;
public class EsempioDB2 extends HttpServlet 
{
  public void doGet(HttpServletRequest request, HttpServletResponse response)
  throws IOException, ServletException
  {
    response.setContentType("text/html");         
    PrintWriter out = response.getWriter();    
 
    // carico il driver per la connessione al DB MYSql
    String DRIVER = "com.mysql.jdbc.Driver";
    try   // carico il driver
    {
       Class.forName(DRIVER);
    } catch (ClassNotFoundException e1)    // il driver non può essere caricato
    {
      out.println("Driver non trovato...");
      System.exit(1); 
    }
    // riferimento al database: connessione ODBC
    String URL_mioDB = "jdbc:mysql://localhost:3306/proveJava";
   
    out.println("Connessione con: "+URL_mioDB);
    // definizione delle query 
    String query = "SELECT Cognome, Nome, Indirizzo, Citta FROM Amici";
    // stabilisco la connessione 
    Connection connessione = null;
    try
    {
      // apro la connessione verso il database
      connessione = DriverManager.getConnection(URL_mioDB, "root", "");
      // ottengo lo Statement per interagire con il database
      Statement statement = connessione.createStatement();
      // interrogo il DBMS mediante una query SQL
      ResultSet resultSet = statement.executeQuery(query);
      
      // scorro e mostro i risultati.
      out.println("<pre>");
      out.println("<b>cognome"+"&#9;"+"nome"+"&#9;"+"indirizzo"+"&#9;"+"citta</b>");
      while (resultSet.next()) {
        String cognome = resultSet.getString(1);
        String nome = resultSet.getString(2);
        String indirizzo = resultSet.getString(3);
        String citta = resultSet.getString(4);
        out.println(cognome+"&#9;"+nome+"&#9;"+indirizzo+"&#9;"+citta);
      }
    } 
    catch (SQLException e) 
    {
      // gestione dell'errore 
    } 
    finally{
      if (connessione != null){
        try {
          connessione.close();
        } 
        catch (Exception e) 
        {
        // gestione dell'errore
        }
      }
    }
    // chiusura pagina HTML 
    out.println("</body>");
    out.println("</html>");
  }
}