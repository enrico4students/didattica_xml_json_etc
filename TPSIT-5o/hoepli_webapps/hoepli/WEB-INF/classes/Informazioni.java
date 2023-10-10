import javax.servlet.*;
import javax.servlet.http.*;
import java.io.*;
import java.text.*;
public class Informazioni extends HttpServlet
{
  public void doGet(HttpServletRequest request, HttpServletResponse response)
  throws IOException, ServletException
  {
    response.setContentType("text/html");           
    PrintWriter out = response.getWriter();         

    out.println("<html>");
    out.println("<body>");
    out.println("<head>");
    out.println("<title>Esempio di richiesta informazioni</title>");
    out.println("</head>");

    out.println("<h3>Informazioni sul sistema client-server</h3>");
    out.println("Porta del server   : " +request.getServerPort()+"<BR>");
    out.println("Carattere encoding : " +request.getCharacterEncoding()+"<BR>");
    out.println("Metodo : " + request.getMethod()+"<BR>");
    out.println("Indirizzo della richiesta : " + request.getRequestURI()+"<BR>");
    out.println("Informazioni sul percorso : " + request.getPathInfo()+"<BR>");
    out.println("Protocollo : " + request.getProtocol()+"<BR>");
    out.println("Nome host remoto     : " + request.getRemoteHost()+"<BR>");
    out.println("Indirizzo host remoto: " + request.getRemoteAddr()+"<BR>");
 
    out.println("</body>");
    out.println("</html>");
  }
 
}
