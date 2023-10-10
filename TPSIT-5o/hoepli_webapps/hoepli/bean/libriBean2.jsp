<HTML>
<HEAD></HEAD>
<BODY BGCOLOR="ffffcc">
<jsp:useBean id="libri" class="mieiBean.LibriBean" />
<H1><img src="images/logoeditore.gif" width="364" height="56"></H1>
<h2><font color="#FF0000" face="Arial, Helvetica, sans-serif">Benvenuto nella 
  nostra libreria - diretto </font></h2>
<HR>
<H2><font color="#0000FF">Ti suggerisco i seguenti libri di:
<% out.println( request.getParameter("scelta") );%>
scritti in 
<% out.println( request.getParameter("lingua") );%>
</font></H2>

<!-- setto nel Bean la variabile categoria con la scelta dell'utente -->
<jsp:setProperty name="libri" property="categoria" param="scelta" />
<jsp:setProperty name="libri" property="lingua" />

<!-- ricevo dal Bean la stringa di risposta -->
<jsp:getProperty name="libri" property="elenco"/>
<HR></BODY>
</HTML>
