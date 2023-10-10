// connessione a .mdb con driver ucanaccess - query parametrica MDB
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.sql.*;
 
public class ServletDerby4 extends HttpServlet 
{
  private final String DRIVER     = "org.apache.derby.jdbc.EmbeddedDriver";    // stand alone 
  private final String protocollo = "jdbc:derby:";                             // connessione alla libreria
  private final String dbpath     = "tomcat/webapps/hoepli/esempioDB/";        // percorso assoluto 
  private final String dbName     = "esempiTPSIT3;memory=false";               // nome database 
  private final String user    = "";                                           // nome utente 
  private final String psw     = "";                                           // password  
  // riferimento al database: connessione ODBC
  private final String URL_mioDB = protocollo + dbpath + dbName;
  // definizione del driver per la connessione al DB Access
   
  // codice HTML per la creazione della pagina di risposta
  private static final String PAGE_TOP = ""
    + "<html>"
    + "<head>"
    + "<title> Servlet connessa a Java DB </title>"
    + "</head>"
    + "<body bgcolor=\"white\">"
    + "<h3>Contenuto tabella amici del database sempiTPSIT3 - JavaDB</h3>"
  ;
   
  private static final String PAGE_BOTTOM = ""
   // + "<br><br>Clicca per richiamare la pagina " 
   // + "<input type=submit value=richiama_la_servlet>"
   // + "</form>"
    + "</body>"
    + "</html>"
  ;
  
  // icone per visualizzare codice o ritornare al menu'
  private static final String ICONE = ""
    + "<a href=\"../sd3Code.html\">"
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
    String scelta = request.getParameter( "scelta" );
    try 
    {
     // carico il driver
      Class.forName(DRIVER);
    } catch (ClassNotFoundException e1) 
    {
     // il driver non può essere caricato.
      out.println("Driver non trovato...");
      System.exit(1); 
    }
    out.println("<h4>Città scelta = "+scelta+"</h4>");
    out.println("<b>Query effettuata:</b>");
    // definizione   delle query 
    String query = "SELECT * FROM alunni where citta='"+scelta+"'";
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
      ResultSet rs = statement.executeQuery(query);
  
      // scorro e mostro i risultati.
      out.println("<pre>");
      out.println("<b>cognome"+"&#9;"+"nome"+"&#9;"+"classe"+"&#9;"+"sesso"+"&#9;"+"citta </b>");
      while (rs.next()) {
        int mat = rs.getInt("matricola");
        String cog = rs.getString("cognome");
        String nom = rs.getString("nome");
        int classe = rs.getInt("classe");     
        String sez = rs.getString("sezione");
        String sex = rs.getString("sesso");
        String citta = rs.getString("citta");

        out.println(cog+"&#9;"+nom+"&#9;"+classe+sez+"&#9;"+sex+"&#9;"+citta);
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
        try {
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
    out.println("</body>");
    out.println("</html>");
    out.close();
  }
}