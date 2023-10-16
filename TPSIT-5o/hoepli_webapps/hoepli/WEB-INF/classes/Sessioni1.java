// servlet che utilizza le sessioni - contatore di accessi 
import javax.servlet.*;
import javax.servlet.http.*;
import java.io.*;
import java.util.Date;
public class Sessioni1 extends HttpServlet {
    
   private static final String PAGE_TOP = ""
    + "<html>"
    + "<head>"
    + "<title> Servlet e Sessioni </title>"
    + "</head>"
    + "<body>"
    + "<H2><P>Contatore degli accessi </P></H2>"
  ;

  private static final String PAGE_BOTTOM = ""
    + "<br><br>Clicca per richiamare la servlet <br>" 
    + "<input type=submit value=richiama_la_servlet>"
    + "</form>"
    + "</body>"
    + "</html>"
  ;

  // icone per visualizzare codice o ritornare al menu'
  private static final String ICONE = ""
    + "<a href=\"../sessioni1Code.html\">"
    + "<img src=\"../images/code.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"view code\"></a>"
    + "<a href=\"../index.html\">"
    + "<img src=\"../images/return.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"return\"></a>"
  ;     

  public void doGet(HttpServletRequest request,HttpServletResponse response )
  throws ServletException, IOException 
  {
    PrintWriter output;
    // crea una sessione se questa non esiste 
    HttpSession sessione = request.getSession();
    // recupera e setta il valore del contatore 
    Integer tanti = (Integer) sessione.getAttribute("Sessioni1.mioContatore");

    // creazione pagina HTML 
    response.setContentType( "text/html" );
    output = response.getWriter();
    output.println( PAGE_TOP );
    // icone per visualizzare codice o ritornare al menu'
    output.println( ICONE );
     // pagina HTML con una form per postback 
    output.println("<P>");
    output.print("<form action=\" Sessioni1\" method=GET>");
    // alla fine il nuovo valore viene salvato
    if (tanti ==null)                            // se non esiste
    {
      tanti = new Integer(1);                    // ne crea uno nuovo
      output.println("E' la prima volta che viene eseguita la servlet</P>" );
    }
    else                                         // altrimenti
    {
      tanti = new Integer(tanti.intValue()+1);   // lo incrementa
      output.print("La servlet e' stata eseguita nr. volte :  " );
      output.println(tanti);
    }
    sessione.setAttribute("Sessioni1.mioContatore", tanti);

    output.println( PAGE_BOTTOM );
  
    output.close();  
  }
}
 
