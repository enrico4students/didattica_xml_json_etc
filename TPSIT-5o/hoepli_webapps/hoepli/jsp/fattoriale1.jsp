<%! public long fact (long x) {
if (x < 0) 
  return 0;                    // andrebbe segnalato l'errore 
if (x == 0) 
  return 1;
else 
  return x * fact(x-1);
}
%>

<% String xStr = request.getParameter("numero");
 try { long x = Long.parseLong(xStr); 
%>
<h3>Calcolo del fattoriale: <%= x %>! = <%= fact(x) %></h3> 
<%  } catch (NumberFormatException e) { %>
  Attenzione, il parametro <b>numero</b> deve essere specificato.
<%  } %>