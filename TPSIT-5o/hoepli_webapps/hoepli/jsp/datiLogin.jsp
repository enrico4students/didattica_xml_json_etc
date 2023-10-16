<%@ page language="java" %>
<html>
<head>
<title>Accesso ad un Database Access</title>
<style type="text/css">
<!--
.style1 {
	color: #0000FF;
	font-weight: bold;
}
.style2 {color: #FF0000}
.style3 {font-family: "Courier New", Courier, mono}
-->
</style>
</head>
<body>
<h3 class="style2">Dati presenti in un database di Access </h3>
<form method="post" action="CTRLogin.jsp">
<fieldset>
<legend><span class="style1">Login utente</span></legend>
<label for="nome">  ID. utente :</label>
<input name="userID" type="text" id="userID" size="20" maxlength="6">
<br/>
<label for="pwd">Password</label>
<label for="pwd">: </label>
<input name="pwd" type="password" id="pwd" size="20" maxlength="10">
<br/><br/>
<input type="submit" value="Login" name="invia">
</fieldset>
</form>
</body>
</html>



