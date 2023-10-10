// funziona: per modificare i dati nel javaDB

// connessione a .mdb con driver ucanaccess - query parametrica
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.sql.*;
 
public class ServletDerby5 extends HttpServlet 
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
    + "<font color=\"#339900\">"
    + "<body bgcolor=\"white\">"
    + "<h3>Modifica del contenuto della tabella alunni del database esempiTPSIT3 - JavaDB</h3>"
    + "</font>"
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
    + "<a href=\"../dafare.html\">"
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
    Connection conn = null;
    try{                                        // apro la connessione verso il database.
      conn = DriverManager.getConnection(URL_mioDB);
    }catch (Exception e){                       // gestione dell'errore 
      out.println("Connessione al database non riuscita! ");
      System.exit(1); 
    } 
 
    String scelta1 = request.getParameter("scelta1");
    String dato1 = request.getParameter("dato1");
    String dato2 = request.getParameter("dato2");
    out.println("<h5>Dati selezionati ");
    out.println("<font color=\"#FF0000\">");
    out.println(" matricola ="+dato1 );
    out.println("</font>");
    out.println(" nuovo valore campo ");
    out.println("<font color=\"#FF0000\">");
    out.println(scelta1 +"="+ dato2+"</h5>");
    out.println("</font>");
  
    // Step 3a: definizione e esecuzione della query di update
    String query="";
    //String query =  "update alunni set ? = ? where matricola = ?";  impossibile :(
    try{                             // esecuzione della query
      //preparedStmt.setString (1, scelta1);
      if(scelta1.equals("cognome"))
        query = "update alunni set cognome = ? where matricola = ?";
      if(scelta1.equals("nome"))
        query = "update alunni set nome = ? where matricola = ?";
      if(scelta1.equals("classe"))
        query = "update alunni set classe = ? where matricola = ?";
      if(scelta1.equals("sezione"))
        query = "update alunni set sezione = ? where matricola = ?";
      if(scelta1.equals("sesso"))
        query = "update alunni set sesso = ? where matricola = ?";
 
      PreparedStatement preparedStmt = conn.prepareStatement(query);
    
      preparedStmt.setString (1, dato2);
      preparedStmt.setInt(2, Integer.valueOf(dato1));

      out.println("<h5>Query eseguita = ");
      out.println("<font color=\"#0000FF\">");
      out.println(query +"</h5>");
      out.println("</font>");// execute the java prepareStatement
      preparedStmt.executeUpdate();
      out.println("<h5>Eseguito correttamente update! </h5>\n ");
      preparedStmt.close();
    }
     catch (SQLException excep){      // gestione dell'errore
      out.println("\n=== > Errore nella query SQL di update");
      out.println(query);
      excep.printStackTrace();
    }
   
    // Step 3b: definizione e esecuzione della query di visualizzazione
    Statement statement = null;
    ResultSet rs = null;
    try{ // esecuzione della query
      statement = conn.createStatement();
      // interrogo il DBMS mediante una query SQL
      query = "SELECT * FROM alunni";
      rs = statement.executeQuery(query);
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
      out.println("\n===  > Errore nella query SQL di visualizzazione");
      e.printStackTrace(); 
    }     
 
    // Step 4: chiusura della connessione
    finally{
      try {
         if (rs != null) {
             rs.close();
         }
         if (statement != null) {
             statement.close();
         }
         if (conn != null) {
             conn.close();
         }
        System.out.println("Chiusa la connessione al database!");
      }
      catch (Exception excep){                                    // gestione dell'errore
        System.out.println("Errore nella chiusura della connessione");
        excep.printStackTrace();
      }
    }
  }
}