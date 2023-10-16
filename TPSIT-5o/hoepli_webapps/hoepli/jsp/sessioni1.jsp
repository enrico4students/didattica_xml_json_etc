<%
  String nome = request.getParameter( "nomeUtente" );
  session.setAttribute( "ilNome", nome );
%>
<HTML>
<BODY>
questa pagina ha preso il parametro <b>nomeUtente</b> e lo ha settato come var di sessione <b>ilNome </b><br><br>
<A HREF="sessioni2.jsp">Continua chiamando sessioni2.jsp </A>
</BODY>
</HTML>

