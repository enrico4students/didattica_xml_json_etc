<HTML>
<HEAD>
</HEAD>
<title>JSP e Bean - capodanno</title> 
<BODY BGCOLOR="ffffcc">
<jsp:useBean id="testo" class="mieiBean.Stagioni"/>
<jsp:useBean id="giorni" class="mieiBean.Stagioni"/>

<H2>Esempio di Bean: giorni a capodanno </H2>
<HR>
<CENTER>
<H3>Siamo in 
<jsp:getProperty name="testo" property="testo"/>
<H3>Per capodanno mancano 
<jsp:getProperty name="giorni" property="giorni"/>
giorni

</H3>
</CENTER>
<HR>
</BODY>
</HTML>




