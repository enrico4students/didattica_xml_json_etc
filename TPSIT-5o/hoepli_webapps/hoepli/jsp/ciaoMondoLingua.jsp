
<html>
<head>
<title>Hello world in JSP</title>
</head>
<body>
<% String lingua = request.getHeader("Accept-Language");
if (lingua != null && lang.startsWith("it")) { %>
<h3> Ciao <font color="#0000FF">mondo</font> ! </h3>
<% } else { %>
<h3> Hello <font color="#FF0000">World</font> ! </h3>
<% } %>
</body>
</html>