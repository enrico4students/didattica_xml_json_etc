// connessione a .mdb con driver ucanaccess - query parametrica
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.sql.*;
 
public class ServletDerby3 extends HttpServlet 
{
  private final String driver     = "org.apache.derby.jdbc.EmbeddedDriver";    // stand alone 
  private final String protocollo = "jdbc:derby:";                             // connessione alla libreria
  private final String dbpath     = "tomcat/webapps/hoepli/esempioDB/";        // percorso assoluto 
  private final String dbName     = "esempiTPSIT3;memory=false";               // nome database 
  
  String URL_mioDB = protocollo + dbpath + dbName;
  private final String user    = "";                                 // nome utente 
  private final String psw     = "";                                 // password  
  // riferimento al database: connessione ODBC
  // codice HTML per la creazione della pagina di risposta
  private static final String PAGE_TOP = ""
    + "<html>"
    + "<head>"
    + "<title> Servlet connessa a Java DB </title>"
    + "</head>"
    + "<body bgcolor=\"white\">"
    + "<h3>Contenuto tabella alunni del database esempiTPSIT3 - JavaDB</h3>"
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
    // crea una pagina HTML e la invia al client 
    PrintWriter out = response.getWriter();    
    out.println(PAGE_TOP);
    out.println(ICONE);
    // carico il driver per la connessione al DB Access
    try{
      Class.forName(driver);
    }catch (ClassNotFoundException e1)          // il driver è caricato
    {
      out.println("Driver non trovato...");
      System.exit(1); 
    }
       
    // definisco un oggetto per la connessione  
    Connection connessione = null;
    try{                                        // apro la connessione verso il database.
      connessione = DriverManager.getConnection(URL_mioDB);
    }catch (Exception e){                       // gestione dell'errore 
      System.out.println("Connessione al database non riuscita! ");
      System.exit(1); 
    } 
 
    String scelta1 = request.getParameter( "scelta1" );
    String scelta2 = request.getParameter( "scelta2" );
    out.println("<h4>Classe selezionata = " + scelta1 + scelta2+"</h4>");
    // definizione della query 
    String query = "SELECT * FROM alunni where (classe='" + scelta1 + "' AND sezione='" + scelta2  + "' )";
    out.println("<h4>Query eseguita = " + query +"</h4>");
  
    try{
      // ottengo lo Statement per interagire con il database
      Statement statement = connessione.createStatement();
      // interrogo il DBMS mediante una query SQL
      ResultSet rs = statement.executeQuery(query);
 
      // scorro e mostro i risultati.
      out.println("<pre>");
      out.println("<b>cognome"+"&#9;"+"nome"+"&#9;"+"classe"+"&#9;"+"sesso"+"&#9</b>");
      while (rs.next()) {
        int mat = rs.getInt("matricola");
        String cog = rs.getString("cognome");
        String nom = rs.getString("nome");
        int classe = rs.getInt("classe");     
        String sez = rs.getString("sezione");
        String sex = rs.getString("sesso");
        out.println(cog+"&#9;"+nom+"&#9;"+classe+sez+"&#9;"+sex+"&#9;");
      }
      out.println("</pre>");
    } 
    catch (SQLException e)            // gestione dell'errore 
    {
      out.println("Errore nella query : <br>");
      out.println(e);
      System.exit(1); 
    } 
    finally{
      if (connessione != null){
        try{
          connessione.close();
        }catch (Exception e)          // gestione dell'errore
        {
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