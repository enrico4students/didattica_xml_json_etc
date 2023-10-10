/* Secondo esempio di Servlet:  Esempio4.java  */
/* Viene creata una pagina HTML che riceve una POST*/ 

import javax.servlet.*;
import javax.servlet.http.*;
import java.text.*;
import java.io.*;

public class Esempio4 extends HttpServlet 
{
  public void doGet (HttpServletRequest request,HttpServletResponse response )
  throws ServletException, IOException
  {
    // lettura della risposta
    String scelta = request.getParameter( "piatto" );
  
    // invio ringraziamenti all'utente
    response.setContentType( "text/html" ); // content type
    PrintWriter responseOutput = response.getWriter();
    StringBuffer buffer = new StringBuffer();
    buffer.append( "<html>\n" );
    buffer.append( "<title>Sondaggio gastronomico</title>\n" );

    // link per gestione menu' scelta esercizi 
    buffer.append("<a href=\"../Esempio4.html\">");
    buffer.append("<img src=\"../images/code.gif\" height=24 " +
                  "width=24 align=right border=0 alt=\"view code\"></a>");
    buffer.append("<a href=\"../index.html\">");
    buffer.append("<img src=\"../images/return.gif\" height=24 " +
                  "width=24 align=right border=0 alt=\"return\"></a>");
   
    // visualizza sullo schermo la risposta 
    buffer.append( "<h3>Sondaggio gastronomico </h3><br>" );
    buffer.append( "Grazie per aver partecipato al nostro sondaggio.<br>" );
    buffer.append( "Hai selezionato come piatto preferito <b>:"+scelta +"</b<br>" );
    buffer.append( "</html>" );
    
    responseOutput.println( buffer.toString() );
    responseOutput.close();
  }
  public void doPost(HttpServletRequest request,HttpServletResponse response)
  throws IOException, ServletException
  {
    doGet(request, response);
  }

 }
 