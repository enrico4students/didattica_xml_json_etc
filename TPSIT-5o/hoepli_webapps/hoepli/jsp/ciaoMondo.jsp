<HTML><BODY>
<% String visitor = request.getParameter("nome");
if (visitor == null) visitor = "Mondo"; %>
Ciao, <%= visitor %>!
</BODY></HTML>

