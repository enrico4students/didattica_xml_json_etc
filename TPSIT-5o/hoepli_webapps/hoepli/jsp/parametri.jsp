 
<html><head><title>...</title></head><body>
<%@ page import='java.util.*' %>
<h2> Parametri in ingresso: </h2><ul>
<%
Enumeration e = request.getParameterNames();
while (e.hasMoreElements()) {
String p = (String)e.nextElement();
out.println("<li>" + p + " = " +
request.getParameter(p));
}
%>
</ul></body></html>
 