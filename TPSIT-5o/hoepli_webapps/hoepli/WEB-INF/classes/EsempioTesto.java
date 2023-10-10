import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
 
public class EsempioTesto extends HttpServlet {    
  public void doGet(HttpServletRequest request, HttpServletResponse response)
       throws IOException, ServletException{
    response.setContentType("text/html");          // content type
    PrintWriter output = response.getWriter();     // get writer
    // crea una pagina HTML e la invia al client 
    output.println("<html>");
    output.println("<head>");
    output.println("<title>Esempio di servlet </title>");
    output.println("</head>");
    output.println("<body bgcolor=\"white\">");
    output.println("<h1>Buongiorno, questa e'la servlet diretta!</h1>");
    output.println("</body>");
    output.println("</html>");
  }
}

/* Terzo esempio di Servlet:  EsempioTesto.java  */
/* Viene creata una semplice pagina HTML che viene inviata come risposta al client*/ 
