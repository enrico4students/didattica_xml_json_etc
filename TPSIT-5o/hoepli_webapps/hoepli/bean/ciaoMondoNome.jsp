<HTML>
<HEAD>
</HEAD>
<title>JSP e Bean</title> 
<BODY BGCOLOR="ffffcc">
<jsp:useBean id="saluto" class="mieiBean.CiaoMondoNome"/>
<H2>Esempio di Bean & parametro in ingresso </H2>
<HR>
<CENTER>
<H3>Saluto: 
<jsp:getProperty name="saluto" property="testo"/>
</H3>
</CENTER>
<HR>
</BODY>
</HTML>




