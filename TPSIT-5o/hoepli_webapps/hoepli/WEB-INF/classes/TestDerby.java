// solo connessione a .javaDB con driver derby
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.sql.*;   
public class TestDerby extends HttpServlet{
  private final String DRIVER     = "org.apache.derby.jdbc.EmbeddedDriver";     
  private final String protocollo = "jdbc:derby:";                             // connessione alla libreria
  private final String dbpath     = "tomcat/webapps/hoepli/esempioDB/";        // percorso assoluto 
  private final String dbName     = "esempiTPSIT3;memory=false";               // nome database 
  private final String user       = "";                                        // nome utente 
  private final String psw        = "";                                        // password   
  // riferimento al database  
  private final String URL_mioDB = protocollo + dbpath + dbName;
  // codice HTML per la creazione della pagina di risposta
  private static final String PAGE_TOP = ""
    + "<html>"
    + "<head>"
    + "<title> Test Servlet connessa con derby </title>"
    + "</head>"
    + "<body bgcolor=\"white\">"
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
    // carico il driver per la connessione al DB derby 
    try{
      Class.forName(DRIVER);
    }
    catch (ClassNotFoundException e1) {       // il driver non può essere caricato.
      out.println("Driver non trovato...");
      System.exit(1); 
    }
    out.println("<h4>Driver caricato correttamente!</h4>");
   
    // definisco un oggetto per la connessione e la creo   
    Connection connessione = null;
    try{                            // apro la connessione verso il database
      connessione = DriverManager.getConnection(URL_mioDB);
    }catch (Exception e){           // gestione dell'errore 
      out.println("Connessione al database non riuscita! ");
      System.exit(1); 
    } 
    out.println("<h4>Connessione al database "+URL_mioDB+" riuscita</h4>");
    out.println("<h5>-> protocollo utilizzato: "+protocollo+"</h5>");
    out.println("<h5>-> percorso del database: "+dbpath+"</h5>");
    out.println("<h5>-> nome del database    : "+dbName+"</h5>");
 
    try
    {
      // ottengo lo Statement per interagire con il database
      Statement statement = connessione.createStatement();
    }catch (Exception e){           // gestione dell'errore 
      out.println("statement non definito correttamente! ");
      System.exit(1); 
    } 
    out.println("<h4>Creato lo statement</h4>");
    out.println("<h5>-> si può procedere con la query</h5>");
 
    // definizione della query 
    // Step 3: definizione e esecuzione della query
    String query = "SELECT * FROM alunni";
    // ... 
   
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
    
   
    // chiusura pagina HTML 
    out.println(PAGE_BOTTOM);
    out.close();
  }
}
    