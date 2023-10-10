import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class Nominativo extends HttpServlet 
{
  public void doGet(HttpServletRequest request,HttpServletResponse response)
    throws IOException, ServletException
  {
    response.setContentType("text/html");
    PrintWriter output = response.getWriter();
    output.println("<html>");
    output.println("<head>");
    String title = "Lettura campi di input";
    output.println("<title>" + title + "</title>");
    output.println("</head>");
    output.println("<body bgcolor=\"white\">");
      
    // link per gestione menu' scelta esercizi 
    output.println("<a href=\"../nominativo.html\">");
    output.println("<img src=\"../images/code.gif\" height=24 " +
                 "width=24 align=right border=0 alt=\"view code\"></a>");
    output.println("<a href=\"../index.html\">");
    output.println("<img src=\"../images/return.gif\" height=24 " +
                 "width=24 align=right border=0 alt=\"return\"></a>");
      
    // inizio echo sullo schermo 
    output.println("<h3>" + title + "</h3>");
    output.println("Questa e' una pagina HTML generata da una servlet");
    String nome = request.getParameter("nome");
    String cognome = request.getParameter("cognome");
    if (nome != null || cognome != null) {
      output.println("nome&nbsp&nbsp&nbsp&nbsp&nbsp = " + (nome) + "<br>");
      output.println("cognome = " + (cognome));
    } else {
    }
    output.println("<P>");
    output.print("<form action=\"");
    output.print("Nominativo\" " );
    output.println("method=POST>");
    output.println("nome&nbsp&nbsp&nbsp&nbsp&nbsp =");
    output.println("<input type=text size=20 name=nome>");
    output.println("<br>");
    output.println("cognome =");
    output.println("<input type=text size=20 name=cognome>");
    output.println("<br>");
    output.println("<input type=submit>");
    output.println("</form>");
    output.println("</body>");
    output.println("</html>");
   }
    
  public void doPost(HttpServletRequest request,HttpServletResponse response)
    throws IOException, ServletException
  {
    doGet(request, response);
  }
}

