// connessione a .javaDB con driver derby
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.sql.*;
     
public class ServletDerby1 extends HttpServlet 
{
 
  private final String DRIVER     = "org.apache.derby.jdbc.EmbeddedDriver";    // stand alone 
  private final String protocollo = "jdbc:derby:";                             // connessione alla libreria
  private final String dbpath     = "tomcat/webapps/hoepli/esempioDB/";        // percorso assoluto 
  private final String dbName     = "esempiTPSIT3;memory=false";               // nome database 
  private final String user       = "";                                        // nome utente 
  private final String psw        = "";                                        // password   
  
  // riferimento al database  
  private final String URL_mioDB = protocollo + dbpath + dbName;
  // definizione del driver per la connessione al DB Access
   
  // codice HTML per la creazione della pagina di risposta
  private static final String PAGE_TOP = ""
    + "<html>"
    + "<head>"
    + "<title> Servlet connessa a Java DB </title>"
    + "</head>"
    + "<body bgcolor=\"white\">"
    + "<h3>Contenuto tabella amici del database esempiTPSIT3 JavaDB</h3>"
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
    + "<a href=\"../sd1Code.html\">"
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
 
     // Step 3: definizione e esecuzione della query
    String query = "SELECT * FROM alunni";
    try{
      // ottengo lo Statement per interagire con il database
      Statement statement = connessione.createStatement();
    }catch (Exception e){           // gestione dell'errore 
      out.println("statement definito correttamente! ");
      System.exit(1); 
    } 
  
    try{ // esecuzione della query
      // interrogo il DBMS mediante una query SQL
      Statement statement= connessione.createStatement();
      ResultSet rs = statement.executeQuery(query);
      // scorro il resultSet e mostro i risultati
      out.println("<pre>");
      out.println("<b>Mat."+"&#9;"+"cognome"+"&#9;"+"nome"+"&#9;"+"classe"+"&#9;"+"sesso</b>");
      while (rs.next()) {
        int mat = rs.getInt(1);
        String cog = rs.getString("cognome");
        String nom = rs.getString(3);
        int classe = rs.getInt("classe");     
        String sez = rs.getString("sezione");
        String sex = rs.getString("sesso");
        out.println(mat+"&#9;"+cog+"&#9;"+nom+"&#9;"+classe+sez+"&#9;"+sex);
      }
      out.println("</pre>");
    }
    catch (SQLException e){ // gestione dell'errore
      out.println("===  > Errore nella query SQL");
      e.printStackTrace(); 
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
    
