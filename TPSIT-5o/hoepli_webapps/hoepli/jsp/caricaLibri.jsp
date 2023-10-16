<HTML>
<HEAD>
<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
</HEAD>
<BODY BGCOLOR="ffffcc">
<H1><img src="images/logoeditore.gif" width="364" height="56"></H1>
<H2><font color="#FF0000" face="Arial, Helvetica, sans-serif">Benvenuto nella nostra libreria</font></H2>
<HR>
<jsp:useBean id="libri" class="mieiBean.LibriBeanDB" />
<H3><span class="style1">Ti suggerisco i seguenti libri di</span><font color="#0000FF">:
  <% out.println( request.getParameter("argomentoScelto") );%>
</font><span class="style1">scritti in</span><font color="#0000FF">
  <% out.println( request.getParameter("linguaScelta") );%>
</font></H3>
  
  <!-- setto nel Bean la variabile argomento con la scelta dell'utente -->
  <jsp:setProperty name="libri" property="argomento"  
                                value= "<%= request.getParameter(\"argomentoScelto\") %>" />
  <!-- setto nel Bean la variabile lingua con la scelta dell'utente -->
  <jsp:setProperty name="libri" property="lingua" 
                                value= "<%= request.getParameter(\"linguaScelta\") %>" />
  
  <!-- ricevo dal Bean la stringa di risposta con l'elenco dei libri -->
  <jsp:getProperty name="libri" property="elenco"/>
<HR>
<a href="libriDBBean.jsp">ritorna alla pagina di scelta</a><b> . </b>
<a href="../jsp/index.html">ritorna al menù principale</a> 
</BODY>  
</HTML>   

