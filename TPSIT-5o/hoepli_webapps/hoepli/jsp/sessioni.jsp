<%! Integer x = new Integer(0); %>
<%
 if(session.isNew())                                 // se non c'e' una sessione la crea 
 {
  //Integer x = new Integer(1); 
  session.putValue("contatore", x);                  // mette x nella sessione
 }
 else 
 {
  x=(Integer)session.getValue("contatore");          // legge il valore dalla sessione
  if(x == null)                                      // se x non è presente 
    session.putValue("contatore", new Integer(1));   // lo inserisce con valore 1
  else                                               // altrimenti lo incrementa e lo salva
    session.putValue("contatore", new Integer(x.intValue() + 1));
 }
%>
<HTML>
<BODY>
<P>Numero di accessi: <%= x.intValue() %> </P>
<P><a href="sessioni.jsp">richiama la JSP</a></P>
</BODY>
</HTML>

