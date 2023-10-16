import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
 
public class Scuola extends HttpServlet{
  private String citta, nomeScuola, colore;

  private static final String PAGE_TOP = ""
    + "<html>"
    + "<head>"
    + "<title>Parametri letti da web.xml</title>"
    + "</head>"
    + "<body>"
    + "<h2>Parametri di personalizzazione della servlet </h2>"
   ;

  private static final String PAGE_BOTTOM = ""
    + "</body>"
    + "</html>"
  ;

  // icone per visualizzare codice o ritornare al menu'
  private static final String ICONE = ""
    + "<a href=\"../scuolaCode.html\">"
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
    citta = config.getInitParameter("citta");
    nomeScuola = config.getInitParameter("nomeScuola");
    colore = config.getInitParameter("colore");
  }  

  protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException 
   {
    // prepara il writer 
    response.setContentType("text/html");
    PrintWriter out = response.getWriter();
    // genera codice html;
    out.println(PAGE_TOP);
    out.println(ICONE);
    out.println("<h3><font color=" + colore + ">" + nomeScuola + "</font></h3>");
    out.println("<h3> di "+ citta +"</h3>");
    out.println(PAGE_BOTTOM);
    out.close();
  }
  
  protected void doGet(HttpServletRequest request, HttpServletResponse response)
      throws ServletException, IOException 
  {
    this.doPost(request,response);
  }      
  
  public String getServletInfo()
  {
    return "Login Servlet.";
  }
}

// Abbiamo suddiviso la pagina HTML generata dalla servlet in 3 parti: La parte superiore (TOP), 
// la parte inferiore (BOTTOM) ed infine, quella centrale.
// Le prime due sono rappresentate da stringhe statiche, definite come costanti (PAGE_TOP, PAGE_BOTTOM).
// La parte centrale, invece, è generata dinamicamente e gestita dal metodo doGet() della Servlet.

