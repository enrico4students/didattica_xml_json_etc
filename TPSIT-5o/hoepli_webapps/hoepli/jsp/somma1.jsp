<%@ page contentType="text/html" %>
<%@ taglib prefix="c" url="http://java.sun.com/jstl/core" %>

<html>
<head><title>JSP è facile</title></head>
<body>
<h1>JSP è facile come ...</h1>
<%-- Calcola la somma di 1 + 2 + 3 dinamicamente --%>
1 + 2 + 3 = <c:out value="${1 + 2 + 3}" />
</body>
</html>
 
