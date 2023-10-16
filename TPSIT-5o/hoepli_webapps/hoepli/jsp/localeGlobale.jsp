<!--  dichiarazione globale                   ----->
<%!
  int contatoreGlobale = 0;
%>
<HTML>
<BODY BGCOLOR="ffffcc">
<TITLE> Esempio di variabili JSP </TITLE>
<H4><FONT COLOR="#FF0000">Variabile globale e locale </FONT></H4>
<HR>
Contatore globale -> si incrementa: <%= ++contatoreGlobale %> 
<!--  servlet: dichiarazione locale            ----->
<%
  int contatoreLocale = 0;
%>
<P>Contatore locale -> non viene incrementato: <%= ++contatoreLocale %> </P>
<HR>
<a href="localeGlobale.jsp">Ricarica la pagina</a></P>
</BODY>
</HTML>
 
 
