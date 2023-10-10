// legge query string e due parametri di configurazione del file XML
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
 
public class Diretta1 extends HttpServlet {
  private String titolo, saluti;
  
  private static final String PAGE_BOTTOM = ""
    + "</body>"
    + "</html>"
  ;
  

  // icone per visualizzare codice o ritornare al menu'
  private static final String ICONE = ""
    + "<a href=\"../diretta1Code.html\">"
    + "<img src=\"../images/code.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"view code\"></a>"
    + "<a href=\"../index.html\">"
    + "<img src=\"../images/return.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"return\"></a>"
  ;
  
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
    String nomeUtente = request.getParameter("para1");
    PrintWriter out = response.getWriter();     // get writer
    // crea una pagina HTML e la invia al client 
    out.println("<html>");
    out.println("<head>");
    out.println("<title>"+titolo+"</title>");
    out.println("</head>");
    out.println("<body>");
    out.println("<h3>Parametro passato come queryString + due parametri letti da web.xml</h3>");
    // icone per visualizzare codice o ritornare al menu'
    out.println(ICONE);
    // contenuto della pagina HTML 
    out.println(saluti+" "+nomeUtente+"!");
    // chiusura pagina HTML 
    out.println(PAGE_BOTTOM);
  }
}
