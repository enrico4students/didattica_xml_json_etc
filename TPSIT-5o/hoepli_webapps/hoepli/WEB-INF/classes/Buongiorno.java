/* Esercitazione1 - servlet con integrato iperlink   */
import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
 
public class Buongiorno extends HttpServlet{
  public String getServletInfo(){
    return "Prima Server, versione 1.0 - con link per il ritorno";
  }
    
  public void doGet(HttpServletRequest request, HttpServletResponse response)
        throws IOException, ServletException{
    response.setContentType("text/html");          // content type
    PrintWriter output = response.getWriter();     // get writer
    // crea una pagina HTML e la invia al client 
    output.println("<html>");
    output.println("<head>");
    // icone per visualizzare codice o ritornare al menu'
    output.println("<a href=\"../BuongiornoCode.html\">");
    output.println("<img src=\"../images/code.gif\" height=24 " +
       "width=24 align=right border=0 alt=\"view code\"></a>");
    output.println("<a href=\"../index.html\">");
    output.println("<img src=\"../images/return.gif\" height=24 " +
       "width=24 align=right border=0 alt=\"return\"></a>");
    output.println("<title>Esempio di servlet con formattazione testo</title>");
    output.println("</head>");
    output.println("<body bgcolor=\"white\">");
    output.println("<h1>Buongiorno, questa è una servlet con testo formattato ... ");
    output.println("<h4>contiene anche due link link per ritorno al menu' ==>");
    output.println("</body>");
    output.println("</html>");
  }
}

