// MySQL definito con XAMP 
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.sql.*;
 
public class ServletDB2 extends HttpServlet 
{
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
  //  String URL_mioDB = "jdbc:mysql://localhost:3305/provejava";
  
  private static final String PAGE_TOP = ""
    + "<html>"
    + "<head>"
    + "<title> Servlet connessa a DB MySQL </title>"
    + "</head>"
    + "<body bgcolor=\"white\">"
    + "<h3>Contenuto tabella amici del database MySQL provejava</h3>"
  ;
   
  private static final String PAGE_BOTTOM = ""
   // + "<br><br>Clicca per richiamare la pagina " 
   // + "<input type=submit value=richiama_la_servlet>"
    + "</form>"
    + "</body>"
    + "</html>"
  ;
  
  // icone per visualizzare codice o ritornare al menu'
  private static final String ICONE = ""
    + "<a href=\"../DB2Code.html\">"
    + "<img src=\"../images/code.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"view code\"></a>"
    + "<a href=\"../index.html\">"
    + "<img src=\"../images/return.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"return\"></a>"
  ;     
    
  public void doGet(HttpServletRequest request, HttpServletResponse response)
  throws IOException, ServletException
  {
    response.setContentType("text/html");         
    PrintWriter out = response.getWriter();    
    // crea una pagina HTML e la invia al client 
    out.println(PAGE_TOP);
    out.println(ICONE);
    try 
    {
      // carico il driver
      Class.forName(DRIVER);
    } 
    catch (ClassNotFoundException e1) 
    {
      // il driver non può essere caricato.
      out.println("Driver non trovato...");
      System.exit(1); 
    }
  
    // definizione della query 
    String query = "SELECT Cognome, Nome, Indirizzo, Citta FROM amici";
    // stabilisco la connessione 
    Connection connessione = null;
    try
    {
      // apro la connesione verso il database.
      connessione = DriverManager.getConnection(URL_mioDB,userName,password);
      // ottengo lo Statement per interagire con il database
      Statement statement = connessione.createStatement();
      // interrogo il DBMS mediante una query SQL
      ResultSet resultSet = statement.executeQuery(query);
  
      // scorro e mostro i risultati.
      out.println("<pre>");
      out.println("<b>cognome"+"&#9;"+"nome"+"&#9;"+"indirizzo"+"&#9;"+"citta</b>");
      while (resultSet.next()) 
      {
        String cognome = resultSet.getString(1);
        String nome = resultSet.getString(2);
        String indirizzo = resultSet.getString(3);
        String citta = resultSet.getString(4);
        out.println(cognome+"&#9;"+nome+"&#9;"+indirizzo+"&#9;"+citta);
      }
      out.println("</pre>");
    } 
    catch (SQLException e) 
    {
      // gestione dell'errore
      out.println("Errore nella connessione : <br>");
      out.println(e);
      System.exit(1); 
    } 
    finally{
      if (connessione != null){
        try{
          connessione.close();
        } 
        catch (Exception e)    // gestione dell'errore
        {
          out.println("Errore nella chiusura connessione :<br>");
          out.println(e);
        }
      }
    }
     // chiusura pagina HTML 
     out.println(PAGE_BOTTOM);
  }
}

