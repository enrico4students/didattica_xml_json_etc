
<html>
<head>
<title>Hello world in JSP</title>
</head>
<body>
<% String visitor = request.getParameter("nome");
if (visitor == null) visitor = "Mondo"; %>
<% String idioma = request.getParameter("lingua");
if (idioma  == null) idioma = "en";
if (idioma.equals("it")) { %>
<h3> Ciao <font color="#0000FF"><%= visitor %></font> ! </h3>
<% } else { %>
<h3> Hello <font color="#FF0000"><%= visitor %></font> ! </h3>
<% } %>
</body>
</html>