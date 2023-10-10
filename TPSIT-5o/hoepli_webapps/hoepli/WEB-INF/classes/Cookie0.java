import java.io.*;   
import javax.servlet.*; 
import javax.servlet.http.*;

public class Cookie0 extends HttpServlet{
    
  private static final String RICARICA = ""
    + "<a href=\"servlet/cookie0\">"
    + "<img src=\"../images/code.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"view code\"></a>"
   ;
   
  private static final String PAGE_BOTTOM = ""
    + "<br><br>Clicca per richiamare la servlet <br>" 
    + "<input type=submit value=richiama_la_servlet>"
    + "</form>"
    + "</body>"
    + "</html>"
  ;
  
   private static final String ICONE = ""
    + "<a href=\"../cookie0Code.html\">"
    + "<img src=\"../images/code.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"view code\"></a>"
    + "<a href=\"../index.html\">"
    + "<img src=\"../images/return.gif\" height=24 " 
    + "width=24 align=right border=0 alt=\"return\"></a>"
  ;
  
  public void doGet(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException{
    // setto due cookies 
    Cookie mioCookie = null;                       // definisco un cookie
    mioCookie = new Cookie("colore", "blue");      // creo l'oggetto e lo inizializzo
    response.addCookie(mioCookie);
   
   // mioCookie.setComment("colore di sfondo");      // commento
   // mioCookie.setDomain (".hoepli.com");           // dominio
   // mioCookie.setPath ("/");                       // percorso
   // mioCookie.setMaxAge(900);                      // durata in secondi (15 minuti)
 
    mioCookie = new Cookie("font", "Courier");
    response.addCookie(mioCookie);
    
    response.setContentType("text/html");
    PrintWriter out = response.getWriter();
    out.println(("<HTML><HEAD><TITLE>Impostazione Cookie</TITLE></HEAD>" +
                 "<BODY><H1 >Impostazione Cookie</H1>"+
                 "Imposto due cookie - carica 2 volte la pagina per vederli</BODY></HTML>"));
    out.println(RICARICA);
    
    //leggo i cookies 
    out.println(("<HTML><HEAD><TITLE>Lettura Cookie</TITLE></HEAD>"+
                "<BODY><H1>Lettura Cookie</H1>"+
                "<form action=\" Cookie0\" method=GET>"+
                 "<TABLE>\n"+
                 "<TR>\n"+
                 "<TH>Nome</TH><TH>Valore</TH>"));
   
    Cookie[] cookies = request.getCookies();
    for(int i = 0; i < cookies.length; i++)
      out.println("<TR><TD>" + cookies[i].getName()+"</TD><TD>" + cookies[i].getValue()+"</TD></TR>\n");
  
    out.println( PAGE_BOTTOM );
 
  }
}