import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;

public class ContaAccessi extends HttpServlet 
{
  int conta;
  public void init(ServletConfig config)
  {
    conta = 0;
  }
  public void doGet(HttpServletRequest req, HttpServletResponse res)
     throws IOException, ServletException
  {
    res.setContentType("text/html");
    PrintWriter out = res.getWriter();  // definizione dell'output
      
    
    
    
    out.println("<htlm><body>Volte :" + conta ++ +"</html></body>");
    out.close();
  }
}

