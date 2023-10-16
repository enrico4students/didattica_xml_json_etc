<%@ page language="java" session="false" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="IT">
<head>
<title>Esempio di direttiva include</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="stili.css">
</head>
<body>
<%@ include file="header.html" %>
<div id="corpo">
<%@ include file="menu.html" %>
<div id="main">
<div class="box">
<h3>Home page del corso TPSIT - lezione su JSP</h3>
<strong>Esempio di inclusione di file HTML</strong></div>
</div>
</div>
</body>
</html>