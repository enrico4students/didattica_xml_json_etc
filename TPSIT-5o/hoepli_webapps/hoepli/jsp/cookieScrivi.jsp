<%@ page language = "java" %>
<%! Cookie mioCookie = new Cookie("provacookie","paolo"); %>
<%
  mioCookie.setMaxAge(3600);       // permanenza del cookie in secondi
  mioCookie.setSecure(false);      // trasmesso anche con protocolli non sicuri come HTTP
  response.addCookie(mioCookie);
%>
Ho scritto un cookies di nome provacookie.. <a href="cookieLeggi.jsp">guardalo!</a>


