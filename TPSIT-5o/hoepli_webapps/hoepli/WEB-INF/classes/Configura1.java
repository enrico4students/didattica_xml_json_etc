// legge due parametri di configurazione del file XML
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
 
public class Configura1 extends HttpServlet {
  private String titolo, saluti;

  public void init(ServletConfig config)
  throws ServletException
  {
    super.init(config);
    titolo = config.getInitParameter("titolo");
    saluti = config.getInitParameter("saluti");
  }  
 
  public void doGet(HttpServletRequest request, HttpServletResponse response)
  throws IOException, ServletException
  {
    // il parametro para1 viene passato dal browser accodato con ?para1=Paolo
    response.setContentType("text/html");
    PrintWriter out = response.getWriter();     // get writer
    // crea una pagina HTML e la invia al client 
    out.println("<html>");
    out.println("<head>");
    out.println("<title>"+titolo+"</title>");
    out.println("</head>");
    // icone per visualizzare codice o ritornare al menu'
    out.println("<a href=\"../configura1.html\">");
    out.println("<img src=\"../images/code.gif\" height=24 " +
                   "width=24 align=right border=0 alt=\"view code\"></a>");
    out.println("<a href=\"../index.html\">");
    out.println("<img src=\"../images/return.gif\" height=24 " +
                   "width=24 align=right border=0 alt=\"return\"></a>");
    // contenuto della pagina html 
    out.println("<body>"+saluti+", questa e' la mia seconda servlet!</body>");
    out.println("</html>");
  }
}
