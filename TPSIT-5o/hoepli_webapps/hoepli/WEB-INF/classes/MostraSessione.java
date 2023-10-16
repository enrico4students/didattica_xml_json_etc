import java.io.*; 
import javax.servlet.*; 
import javax.servlet.http.*;
import java.net.*;
import java.util.*;

public class MostraSessione extends HttpServlet {
    
    private static final String PAGE_TOP = ""
    + "<html>"
    + "<head>"
    + "<title> Servler e Sessioni </title>"
    + "</head>"
    + "<body>"
    + "<form>"
   ;
  private static final String PAGE_BOTTOM = ""
    + "<br><br>Clicca per richiamare la pagina " 
    + "<input type=submit value=richiama_la_servlet>"
    + "</form>"
    + "</body>"
    + "</html>"
  ;
  
  // icone per visualizzare codice o ritornare al menu'
  private static final String ICONE = ""
    + "<a href=\"../mostraSessioneCode.html\">"
    + "<img src=\"../images/code.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"view code\"></a>"
    + "<a href=\"../index.html\">"
    + "<img src=\"../images/return.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"return\"></a>"
  ;     
  
  public void doGet(HttpServletRequest request, HttpServletResponse response)
  throws ServletException, IOException 
  {
    response.setContentType("text/html");
    PrintWriter out = response.getWriter();
   
    HttpSession sessione = request.getSession(true);
    String intestazione;
    Integer contaAccessi = (Integer)sessione.getAttribute("contaAccessi");
    if (contaAccessi == null) 
    {
      contaAccessi = new Integer(0);
      intestazione = "Benvenuto, nuovo utente";
    } else {
      intestazione = "Bentornato, vecchio amico";
      contaAccessi = new Integer(contaAccessi.intValue() + 1);
    }
    sessione.setAttribute("contaAccessi", contaAccessi); 
    // creazione pagina HTML
    out.println(PAGE_TOP);
    out.println(ICONE);
    out.println(("<H1 ALIGN=\"CENTER\">" + intestazione + "</H1>\n" +
                "<H2>Informazione sulla tua sessione:</H2>\n" +
                "<TABLE BORDER=1 ALIGN=\"CENTER\">\n" +
                "<TR BGCOLOR=\"#FFAD00\">\n" +
                "<TH>Informazione <TH>Valore\n" +
                "<TR>\n" +"  <TD>ID\n" +"  <TD>" + sessione.getId() + "\n" +
                "<TR>\n" +"  <TD>Ora creazione \n" +
                "  <TD>" + new Date(sessione.getCreationTime()) + "\n" +
                "<TR>\n" +"  <TD>Ora ultimo accesso\n" +
                "  <TD>" + new Date(sessione.getLastAccessedTime()) + "\n" +
                "<TR>\n" +"  <TD>Numero di accessi precedenti\n" +
                "  <TD>" + contaAccessi + "\n" + "</TABLE>\n"));
    out.println(PAGE_BOTTOM);
   }
}

