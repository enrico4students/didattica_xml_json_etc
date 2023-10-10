<%@ page language="java" session="false" %>
<%@ include file="funzioni.jsp" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="IT">
<head>
<title>Oggetto response - Metodo sendRedirect</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #FF0000}
-->
</style>
</head>
<body>
<h2 align='center'>Oggetto <span class="style2">response</span></h2>
<p>Metodo <span class="style1">sendRedirect</span> per il reindirizzamento delle richieste</p>
<form method="post">
<fieldset>
<legend>Login Utente</legend>
<label for="userid">User ID : </label>
<input NAME="userid" type="text" value="admin"><br>
<label for="pwd">Password :</label>
<input NAME="pwd" type="password">
(suggerimento: 1234)<br/><br/>
<input type="submit" value="Invia dati">
</fieldset>
</form>
<%
String user =  (vuoto(request.getParameter("userid")));
String password =  (vuoto(request.getParameter("pwd")));
if (user.equals("admin") && password.equals("1234")){
 out.write(" => utente amministratore!");
 response.sendRedirect("registrato.jsp");
}
%>
</body>
</html>




