import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
  
public class EsempioBuffer extends HttpServlet{
  public void doGet(HttpServletRequest request, HttpServletResponse response)
  throws IOException, ServletException  {
    response.setContentType("text/html");          // content type
    PrintWriter output = response.getWriter();     // get writer
    // crea una pagina HTML e la invia al client 
    StringBuffer buffer = new StringBuffer();
    buffer.append( "<HTML><HEAD><TITLE>\n" );
    buffer.append( "Secondo esempio di servlet\n" );
    buffer.append( "</TITLE></HEAD><BODY bgcolor=\"white\">\n" );
    buffer.append("<h1>Buongiorno, questa è la seconda servlet!</h1>");
    buffer.append( "</BODY></HTML>" );
    output.println( buffer.toString() );
    output.close(); // chiusura del PrintWriter stream
  }
}

/* Secondo esempio di Servlet:  EsempioBuffer.java          */
/* Viene creata una semplice pagina HTML in un buffer  */ 
