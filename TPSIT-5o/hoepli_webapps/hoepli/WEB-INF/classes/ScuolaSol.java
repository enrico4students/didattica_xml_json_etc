import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class ScuolaSol extends HttpServlet{
  private String citta, nomeScuola, colore, cognome, nome, titolo, saluti;

  // icone per visualizzare codice o ritornare al menu'
  private static final String ICONE = ""
    + "<a href=\"../scuolaSolCode.html\">"
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
    nome  = config.getInitParameter("nome");
    cognome = config.getInitParameter("cognome");
    titolo = config.getInitParameter("titolo");
    saluti = config.getInitParameter("saluti"); 
  }  

  protected void doGet(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException 
  {
    // i parametri nome e cognome vengono passati dal browser
    // String login = request.getParameter("login");
    // String psw = request.getParameter("psw");
    // prepara il writer 
    response.setContentType("text/html");
    PrintWriter out = response.getWriter();     // get writer
    // crea una pagina HTML e la invia al client 
    out.println("<html>");
    out.println("<head>");
    out.println("<title>"+titolo+"</title>");
    out.println("</head>");
    // contenuto della pagina html 
    out.println("<body>"+saluti+", questa e' la mia seconda servlet!</body>");
    out.println("<h3><font color="+colore+">"+nomeScuola+"</font></h3>");
    out.println("<h3>di "+citta+"</h3>");
    // parametri passati da input 
    // out.println("<h4>Login   :"+login+"</h3>");
    // out.println("<h4>Password:"+psw+"</h3>");
    // contenuto della pagina html 
    out.println("<body>"+saluti+", questa e' la mia seconda servlet!</body>");
    out.println("</html>");
    out.close();
    
  }

  
  protected void doPost(HttpServletRequest request, HttpServletResponse response)
      throws ServletException, IOException 
  {
    this.doGet(request,response);
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

