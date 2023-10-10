import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class ScuolaAccessi extends HttpServlet{
  private String citta, nomeScuola, colore;

  private static final String PAGE_TOP = ""
    + "<html>"
    + "<head>"
    + "<title>Servlet conferma accesso</title>"
    + "</head>"
    + "<body>"
    + "<h1>Parametri inseriti per accedere all'area riservata </h1>"
   ;

  private static final String PAGE_BOTTOM = ""
    + "</body>"
    + "</html>"
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
    String login = request.getParameter("login");
    String psw = request.getParameter("psw");
    
    // i parametri nome e cognome vengono passati dal browser
    String nome = request.getParameter("nome");
    String cognome = request.getParameter("cognome");
   
    // prepara il writer 
    response.setContentType("text/html");
    PrintWriter out = response.getWriter();
    // genera codice html;
    out.println(PAGE_TOP);
    out.println("<h3><font color="+colore+">"+nomeScuola+"</font></h3>");
    out.println("<h3>di "+citta+"</h3>");
    out.println("<h4>Login   :"+login+"</h3>");
    out.println("<h4>Password:"+psw+"</h3>");
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

