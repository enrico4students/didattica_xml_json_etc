    // connessioen a .mdb con driver ucanaccess - query con due parametri 
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.sql.*;
     
public class JDBC1 extends HttpServlet 
{
  private final String protocol= "jdbc:ucanaccess://";     // connessione alla libreria     
  private final String mdbpath = "tomcat/webapps/hoepli/esempioDB/"; // percorso relativo 
  private final String mdbName = "proveJava.mdb;memory=false";       // nome database  
  private final String user    = "";                                 // nome utente 
  private final String psw     = "";                                 // password  
  // riferimento al database: connessione ODBC
  private final String URL_mioDB = protocol + mdbpath + mdbName;
  // definizione del driver per la connessione al DB Access
  private final String DRIVER = "net.ucanaccess.jdbc.UcanaccessDriver";
  
  private static final String PAGE_TOP = ""
    + "<html>"
    + "<head>"
    + "<title>Servlet connessa a database MDB </title>"
    + "</head>"
    + "<body>"
    + "<body bgcolor=\"white\">"
    + "<h3>Contenuto tabella Amici del database MDB</h3>"
  ;
 
  private static final String PAGE_BOTTOM = ""
  //  + "<br><br>Clicca per richiamare la servlet <br>" 
  //  + "<input type=submit value=richiama_la_servlet>"
  //  + "</form>"
    + "</body>"
    + "</html>"
  ;

  // icone per visualizzare codice o ritornare al menu'
  private static final String ICONE = ""
    + "<a href=\"../mdb4Code.html\">"
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
    
    // carico il driver per la connessione al DB Access
    try{
      Class.forName(DRIVER);
    }catch (ClassNotFoundException e1){
      // il driver non può essere caricato.
      out.println("Driver non trovato...");
      System.exit(1); 
    }
    catch (Exception exc) {
      out.println(exc);
      out.println("Non si sa ma qui si ferma ");
    }
     
    // crea una pagina HTML e la invia al client 
    out.println(PAGE_TOP);
    out.println(ICONE);
    // definizione della query 
    String campo = request.getParameter("campo");
    String eta = request.getParameter("eta");
    String query = "SELECT "+campo +" FROM amici WHERE eta < " + eta; 
   
    out.println(query);
   
    // stabilisco la connessione 
    Connection connessione = null;
    try
    {
      // apro la connesione verso il database.
      connessione = DriverManager.getConnection(URL_mioDB);
      // ottengo lo Statement per interagire con il database
      Statement statement = connessione.createStatement();
      // interrogo il DBMS mediante una query SQL
      ResultSet resultSet = statement.executeQuery(query);
     
      // Scorro e mostro i risultati.
      out.println("<pre>");
      out.println("<B> "+campo+" di quelli che hanno meno di "+ eta +" anni sono:</B><BR>\n"); 
      while (resultSet.next()){
        //     String cognome = resultSet.getString(campo);
        out.println(resultSet.getString(campo));
      }
      out.println("</pre");
    } 
    catch (SQLException e)   // gestione dell'errore 
    {
      out.println("Errore nella connessione : <br>");
      out.println(e);
      System.exit(1); 
    } 
    finally{
      if (connessione != null){
        try{
          connessione.close();
        } 
        catch (Exception e) 
        {
          // gestione dell'errore
          out.println("Errore nella chiusura connessione :<br>");
          out.println(e);
        }
      }
    }
     
    // chiusura pagina HTML 
    out.println(PAGE_BOTTOM);

    out.close();
  }
}
    
