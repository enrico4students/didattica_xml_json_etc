// Using sessions.
import javax.servlet.*;
import javax.servlet.http.*;
import java.io.*;
public class Sessioni3 extends HttpServlet
{
  private final static String names[] ={"Pascal", "C", "Java", "Visual Basic", "Python" };
  private final static String isbn[] = {"P:978-88-203-48229","C:978-88-203-48243","J:978-88-203-48236","VB:978-88-203-34727","Y::978-88-203-xxxx"};
 
  private static final String PAGE_TOP1 = ""
   + "<html>"
   + "<head>"
   + "<title> Servler e Sessioni </title>"
   + "</head>"
   + "<body>"
   + "<H2><P> Prima parte: doPost() </P></H2>"  
  ;

  private static final String PAGE_TOP2 = ""
    + "<html>"
    + "<head>"
    + "<title> Servler e Sessioni </title>"
    + "</head>"
    + "<body>"
    +"<H2><P>Seconda parte: doGet()</P></H2>"  
  ;
  
  private static final String PAGE_BOTTOM = ""
    + "<br><br>Clicca per richiamare la se la sessione è stata creata <br>" 
    + "<input type=submit value=richiama_la_servlet>"
    + "</form>"
    + "</body>"
    + "</html>"
  ;

  // icone per visualizzare codice o ritornare al menu'
  private static final String ICONE = ""
    + "<a href=\"../sessioni3Code.html\">"
    + "<img src=\"../images/code.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"view code\"></a>"
    + "<a href=\"../index.html\">"
    + "<img src=\"../images/return.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"return\"></a>"
  ;     

  private String getISBN( String lang ){
    for ( int i = 0; i < names.length; ++i )
      if ( lang.equals( names[ i ] ) )
        return isbn[ i ];
    return "";                              // no matching string found
  }

  public void doPost(HttpServletRequest request,HttpServletResponse response )
  throws ServletException, IOException 
  {
    PrintWriter output;
    String linguaggio = request.getParameter( "linguaggio" );
    HttpSession session = request.getSession( true );

    // setto le variabili di sessione 
    session.setAttribute( linguaggio, getISBN( linguaggio ) );
    session.setAttribute( "Sessioni3.scelta", linguaggio );
     
    response.setContentType( "text/html" );
    output = response.getWriter();
    // invio pagina HTML al client 
    output.println(PAGE_TOP1);
    // icone per visualizzare codice o ritornare al menu'
    output.println(ICONE);
    // prova per inserire il bottone
    output.println("<P>");
    output.print("<form action=\"");
    output.print("Sessioni3\" " );
    output.println("method=GET>");
    output.println( "<P>" );
    output.println( linguaggio );
    output.println( " è un buon linguaggio di programmazione!</P></P>" );
    output.println( " forse posso consigliarti un libro ...      </P>" );

    output.println("<br>");
    output.println("<input type=submit>");
    output.println("</form>");
    output.println( "</BODY></HTML>" );
    output.close(); 
  }

  public void doGet( HttpServletRequest request, HttpServletResponse response )
  throws ServletException, IOException 
  {
    PrintWriter output;
    HttpSession session = request.getSession( false ); 
    java.util.Enumeration valueNames;
    if ( session != null )
      valueNames = session.getAttributeNames();
    else
      valueNames = null;
 
    response.setContentType( "text/html" );
    output = response.getWriter();
    // invio pagina HTML al client 
    output.println(PAGE_TOP2);
    // icone per visualizzare codice o ritornare al menu'
    output.println(ICONE);  
    output.println( "<H1>Sessioni: seconda parte doGet() </H1>" );
  
    if ( valueNames != null && valueNames.hasMoreElements() ) 
    {
      output.println( "<H2>Libro consigliato : </H2>" );
      for ( ; valueNames.hasMoreElements(); ) {
        String name = (String) valueNames.nextElement();
      //  output.println("name corrente : "+ name  + "<BR>");
        String value = (String)  getISBN( name);        // preleva il corrispondente codice ISBN
        output.println("Linguaggio "+ name + " : la casa editrice Hoepli ha il volume " + "ISBN#: " + value + "<BR>" );
      }
      output.println("<BR>Per verificare il funzionamento delle sessioni devi scegliere un altro linguaggio" );
    }
    else {
      output.println( "<H1>Nessuna raccomandazione</H1>" );
      output.println( "Non hai selezionato un linguaggio e non posso consigliarti un libro" );
    }
    output.println( "</BODY></HTML>" );
    output.close(); // close stream
  }
}
 