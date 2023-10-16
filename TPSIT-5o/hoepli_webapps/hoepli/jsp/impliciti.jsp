<%@ page import="java.util.*"%>

<%@ page info="Oggetto page: richiamo dell'attributo info" %>

<%@ page isErrorPage="true" %>
<h1>Attenzione!</h1>
E’ stato rilevato il seguente errore:<br/>
<b><%= exception %></b><br/>
<%
exception.printStackTrace(out);
%>
<%response.setDateHeader("Expires", 0);
response.setHeader("Pragma", "no-cache");
if (request.getProtocol().equals("HTTP/1.1"))
{
response.setHeader("Cache-Control", "no-cache");
}
%>
<% UserLogin userData = new UserLogin(name, password);
session.setAttribute("login", userData);
%>
<% UserLogin userData=(UserLogin)session.getAttribute("login");
if (userData.isGroupMember("admin")) {
session.setMaxInactiveInterval(60*60*8);
} else {
session.setMaxInactiveInterval(60*15);
}
%>

<HTML>
<BODY>
<HR>
<EM>Utilizzo di oggetti impliciti</EM>
<p>Page info:
<%=page.getServletInfo()%>
</p>
<%Integer x = newInteger(1); %>
<%if(session.isNew())
session.putValue("contatore", x);
else {
x=(Integer)session.getValue("contatore");
if(x ==null)
session.putValue("contatore", newInteger(1));
else
session.putValue("contatore", newInteger(x.intValue()+1));
}
%>
<p>Numero di accessi: <%= x.intValue() %> </p>

</BODY>
</HTML>


