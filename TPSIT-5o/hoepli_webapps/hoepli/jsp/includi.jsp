<HTML>
<BODY>
<TITLE>JSP con direttiva include </TITLE>
<!--  dichiarazioni            ----->
<%! 
String utente = "Anna Maria Grazia";
%>
<!--  direttiva include       ----->
<%@ include file = "intestazione.html"%>
<!--  espressioni             ----->
<P>Gentile cliente <%=utente %></P>
<P>La ringraziamo per aver visitato il nostro catalogo.</P>
</HTML>
</BODY>




