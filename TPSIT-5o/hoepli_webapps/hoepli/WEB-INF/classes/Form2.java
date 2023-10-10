// legge due parametri da una form HTML - metodo POST
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.util.*;
 
public class Form2 extends HttpServlet {
  private String titolo, saluti;

  public void doGet(HttpServletRequest request, HttpServletResponse response)
  throws IOException, ServletException
  {
    // i parametri nome e cognome vengono passati dal browser
    response.setContentType("text/html");
    PrintWriter out = response.getWriter();     // get writer
    
    String nome = request.getParameter("nome");
    String cognome = request.getParameter("cognome");
    
    // crea una pagina HTML e la invia al client 
    out.println("<html>");
    out.println("<head>");
    out.println("<title> Passaggio parametri da una form HTML - POST </title>");
    out.println("</head>");
   
   // icone per visualizzare codice o ritornare al menu'
    out.println("<a href=\"../Form1.html\">");
    out.println("<img src=\"../images/code.gif\" height=24 " +
                   "width=24 align=right border=0 alt=\"view code\"></a>");
    out.println("<a href=\"../index.html\">");
    out.println("<img src=\"../images/return.gif\" height=24 " +
                   "width=24 align=right border=0 alt=\"return\"></a>");
    
    // contenuto della pagina html 
    out.println("<body>");
    out.println("Ciao "+nome+" "+cognome+"!</p>");
    out.println("<b>La data di oggi e': " + new java.util.Date()+ "</b></p>");
    out.println("</body>");
  
    out.println("</html>");
  }
  public void doPost(HttpServletRequest request,HttpServletResponse response)
  throws IOException, ServletException
  {
    doGet(request, response);
  }

}
