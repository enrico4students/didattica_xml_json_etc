import java.io.IOException;
import java.io.PrintWriter;
import java.util.ResourceBundle;


import javax.servlet.ServletException;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
 
public class Cookie2 extends HttpServlet {

public void doGet (HttpServletRequest req, HttpServletResponse res) 
throws IOException, ServletException 
{
  res.setContentType ("text/html");
  PrintWriter out = res.getWriter();
  out.println ("<html>"); out.println ("<head>");
  out.println ("<title>Colore Preferito</title>");
  out.println ("</head>"); out.println ("<body>");
  Cookie[] cookies = req.getCookies();
  if (cookies != null) {
    for (int i = 0; i < cookies.length; i++) {
      if (cookies[i].getName().equals ("Colore")) {
        String pref = cookies[i].getValue();
        out.println ("<p>Colore preferito: "+pref+"</p>");
      }
    }
  }
  else 
  {
  out.println ("<p>Inserisci il tuo colore preferito</p>");
  out.println ("<form name=\"input\" action=\"colorepreferito\"" +"method=\"post\">");
  out.println ("<input type=\"text\" name=\"col\">");
  out.println ("<input type=\"submit\" value=\"Invia!\"></form>");
}
out.println ("</body>"); out.println ("</html>");
}

public void doPost (HttpServletRequest req, HttpServletResponse res)
throws IOException, ServletException {
  String pref = req.getParameter("col");
  Cookie ck = new Cookie("colore", pref);
  res.addCookie(ck);
  res.setContentType ("text/html");
  PrintWriter out = res.getWriter();
  out.println ("<html>"); out.println ("<head>");
  out.println ("<title>Colore preferito</title>");
  out.println ("</head>"); out.println ("<body>");
  out.println ("<p>Adesso ricarica la pagina<p>");
  out.println ("</body>"); out.println ("<html>"); 
 }
}
 // end class
