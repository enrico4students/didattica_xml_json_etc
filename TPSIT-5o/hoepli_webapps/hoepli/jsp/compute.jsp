 
<jsp:useBean class="beans.mybean" id="beanId">
<jsp:setProperty name="beanId" property="*"/>
</jsp:useBean>
<html>
<head>
<title>Pagina elaborazione dati</title>
</head>
<body>
Nome inserito:
<jsp:getProperty name="beanId" property="nome"/> <br>
Cognome inserito:
<jsp:getProperty name="beanId" property="cognome"/> <br>
</body>
</html>