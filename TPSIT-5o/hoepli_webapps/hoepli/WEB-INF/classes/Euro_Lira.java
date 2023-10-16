import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.text.DecimalFormat;

public class Euro_Lira extends HttpServlet
{
  private static final DecimalFormat FMT = new DecimalFormat("#0.00");
    
  private static final String PAGE_TOP = ""
    + "<html>"
    + "<head>"
    + "<title>Tabella di conversione da Euro a Lira</title>"
    + "</head>"
    + "<body>"
    + "<h3>Tabella di conversione da Euro a Lira</h3>"
    + "<table>"
    + "<tr>"
    + "<th>Euro</th>"
    + "<th>Lira</th>"
    + "</tr>"
  ;

  private static final String PAGE_BOTTOM = ""
    + "</table>"
    + "</body>"
    + "</html>"
  ;
  
  // icone per visualizzare codice o ritornare al menu'
  private static final String ICONE = ""
    + "<a href=\"../Euro_Lira.html\">"
    + "<img src=\"../images/code.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"view code\"></a>"
    + "<a href=\"../index.html\">"
    + "<img src=\"../images/return.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"return\"></a>"
  ;
   
  protected void doGet(HttpServletRequest request, HttpServletResponse response)
      throws ServletException, IOException 
  {
    response.setContentType("text/html");
    PrintWriter out = response.getWriter();
    out.println(PAGE_TOP);
    out.println(ICONE);
    for(double euro = 10; euro <= 30; euro += 2.0)
    {
      Double lira = (euro * 1936.27);
      out.println("<tr>");
      out.println("<td>" + FMT.format(euro) + "</td>");
      out.println("<td>" + FMT.format(lira) + "</td>");
      out.println("</tr>");
    }
    out.println(PAGE_BOTTOM);
  }

  
  protected void doPost(HttpServletRequest request, HttpServletResponse response)
      throws ServletException, IOException 
  {
    this.doGet(request,response);
  }      
  
  public String getServletInfo()
  {
    return super.getServletInfo();
  }
}

// Abbiamo suddiviso la pagina HTML generata dalla servlet in 3 parti: La parte superiore (TOP), 
// la parte inferiore (BOTTOM) ed infine, quella centrale.
// Le prime due sono rappresentate da stringhe statiche, definite come costanti (PAGE_TOP, PAGE_BOTTOM).
// La parte centrale, invece, è generata dinamicamente e gestita dal metodo doGet() della Servlet.
// Si noti come, per comodità, sia stato fatto l’override anche del metodo doPost(),
// il cui codice si preoccupa semplicemente di inoltrare la richiesta al metodo doGet().

