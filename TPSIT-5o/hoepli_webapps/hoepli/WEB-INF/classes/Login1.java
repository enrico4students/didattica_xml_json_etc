import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class Login1 extends HttpServlet
{
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
  
  // icone per visualizzare codice o ritornare al menu'
  private static final String ICONE = ""
    + "<a href=\"../login1Code.html\">"
    + "<img src=\"../images/code.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"view code\"></a>"
    + "<a href=\"../index.html\">"
    + "<img src=\"../images/return.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"return\"></a>"
  ;
  
  protected void doGet(HttpServletRequest request, HttpServletResponse response)
      throws ServletException, IOException 
  {
    String para1 = request.getParameter("para1");
    String titolo = request.getParameter("titolo");
    String login = request.getParameter("login");
    String psw = request.getParameter("psw");
    // prepara il writer 
    response.setContentType("text/html");
    PrintWriter out = response.getWriter();
    // genera codice html
    out.println(PAGE_TOP);
    out.println(ICONE);
    out.println("<h2>Pagina  :"+para1+"</h2>");
    out.println("<h3>Titolo  :"+titolo+"</h3>");
    out.println("<h4>Login   :"+login+"</h4>");
    out.println("<h4>Password:"+psw+"</h4>");
    out.println(PAGE_BOTTOM);
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
// La parte centrale, invece, Ã¨ generata dinamicamente e gestita dal metodo doGet() della Servlet.

