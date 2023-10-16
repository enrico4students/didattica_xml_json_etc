<%@ page language="java" session="false" %>
<%@ include file="funzioni.jsp" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="IT">
<head>
<title>Inclusione di file</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #FF0000}
-->
</style>
</head>
<body>
<h2 align='center' class="style1">Inclusione di file con codice JSP</h2>
<p>La pagina invia i parametri a se stessa trasformati 
in formato compatibile per <span class="style2">SQL<a href="index.html"><img src="images/return.gif" width="24" height="24" align="right" border="0" /></a></span></p>
<form method="post">
<fieldset>
<legend><strong>Inserisci i dati</strong></legend>
<label for="nome"></label>
<br>
<label for="cognome"><strong>Cognome</strong>:</label>
<input type="text" id="cognome" name="cognome">
<label for="label"> <strong>Nome</strong>:</label>
<input type="text" id="nome2" name="nome" />
<p>
  <input type="submit" value="Invia dati " name="invia">
</p>
</fieldset>
</form>
<%
out.write("Risultato: ");
if (request.getParameter("invia")!=null){
 out.write(" => cognome :");
 out.write(vuoto(apici(request.getParameter("cognome"))));
 out.write(" => nome :");
 out.write(vuoto(apici(request.getParameter("nome"))));
}
%>
</body>
</html>
