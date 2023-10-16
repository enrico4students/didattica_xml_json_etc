<HTML>
<BODY>
<TITLE> Esempio di codice JSP </TITLE>
<!--  dichiarazioni            ----->
<%! 
 String utente = "Anna Maria";
 double totale = 1230.50;
%>
<!--  espressioni              ----->
<P><FONT COLOR="#0000FF"><h3>Gentile cliente <%=utente%></H3> </FONT>
oggi <%= new java.util.Date().toString() %> </P>
<P>ha effettuato acquisti per Euro: <%= totale %>:</P>
<!--  scriplet                 ----->
<% if (totale > 1000){ %>
<H3>puo' effettuare un pagamento rateizzato </H3>
<% } else { %>
<H3>devi pagare in una sola soluzione.</H3>
<% } %>
</HTML>
</BODY>




