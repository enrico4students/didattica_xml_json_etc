// connessione a .mdb con driver ucanaccess
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.sql.*;
     
public class ServletDB1 extends HttpServlet 
{
  private final String protocollo = "jdbc:ucanaccess://";               // connessione alla libreria     
  private final String mdbpath = "tomcat/webapps/hoepli/esempioDB/";    // percorso relativo 
  private final String mdbName = "proveJava.mdb;memory=false";          // nome database  
  private final String user    = "";                                    // nome utente 
  private final String psw     = "";                                    // password  
  // riferimento al database  
  private final String URL_mioDB = protocollo + mdbpath + mdbName;
  // definizione del driver per la connessione al DB Access
  private final String DRIVER = "net.ucanaccess.jdbc.UcanaccessDriver";
  
  // codice HTML per la creazione della pagina di risposta
  private static final String PAGE_TOP = ""
    + "<html>"
    + "<head>"
    + "<title> Servlet connessa a DB Access </title>"
    + "</head>"
    + "<body bgcolor=\"white\">"
    + "<h3>Contenuto tabella amici del database proveJava.mdb</h3>"
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
    + "<a href=\"../mdb1Code.html\">"
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
    // carico il driver per la connessione al DB Access -> solo per le servlet 
    try 
    {
      Class.forName(DRIVER);
    }catch (ClassNotFoundException e1) 
    {
     // il driver non può essere caricato.
      out.println("Driver non trovato...");
      System.exit(1); 
    }
   
    // definisco un oggetto per la connessione e la creo   
    Connection connessione = null;
    try{                            // apro la connessione verso il database
      connessione = DriverManager.getConnection(URL_mioDB);
    }catch (Exception e){           // gestione dell'errore 
      out.println("Connessione al database non riuscita! ");
      System.exit(1); 
    } 
 
       
    // definizione della query 
    String query = "SELECT Cognome, Nome, Indirizzo, Citta FROM alunni";
    try
    {
      // ottengo lo Statement per interagire con il database
      Statement statement = connessione.createStatement();
      // interrogo il DBMS mediante una query SQL
      ResultSet resultSet = statement.executeQuery(query);
     
      // scorro e mostro i risultati
      out.println("<pre>");
      out.println("<b>cognome"+"&#9;"+"nome"+"&#9;"+"indirizzo"+"&#9;"+"citta</b>");
      while (resultSet.next()) {
        String cognome = resultSet.getString(1);
        String nome = resultSet.getString(2);
        String indirizzo = resultSet.getString(3);
        String citta = resultSet.getString(4);
        out.println(cognome+"&#9;"+nome+"&#9;"+indirizzo+"&#9;"+citta);
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
    
