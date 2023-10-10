<HTML>
<BODY>
<TITLE> Esempio di codice JSP </TITLE>
<!--  dichiarazioni            ----->
<%! 
 String utente = "Anna Maria";
 double[] prezzi = {11.5, 73.8, 121.5};
 double getTotale(){
  double totale = 0.0;
  for (int x = 0; x < prezzi.length; x++)
   totale += prezzi[x];
  return totale;
 }
%>
<!--  espressioni             ----->
<P>Gentile cliente <%=utente%>, oggi <%= new java.util.Date().toString()%></P>
<P>ha effettuato acquisti per Euro: <%=getTotale()%>.</P>
</HTML>
</BODY>





