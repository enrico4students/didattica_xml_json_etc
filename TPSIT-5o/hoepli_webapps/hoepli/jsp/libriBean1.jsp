<HTML>
<HEAD>
</HEAD>
<BODY BGCOLOR="ffffcc">
<jsp:useBean id="libri" class="mieiBean.LibriBean" />
<H1><img src="images/logoeditore.gif" width="364" height="56"></H1>
<H2><font color="#FF0000" face="Arial, Helvetica, sans-serif">Benvenuto nella 
  nostra libreria</font></H2>
<HR>
<H2><font color="#0000FF">Ti suggerisco i seguenti libri di:
<% out.println( request.getParameter("scelta") );%>
</font></H2>
<!-- setto nel Bean la variabile categoria con la scelta dell'utente -->
   <jsp:setProperty name="libri" property="categoria" 
   value= "<%= request.getParameter(\"scelta\") %>" />
<!-- ricevo dal Bean la stringa di risposta -->
   <jsp:getProperty name="libri" property="elenco"/>
<HR>
</BODY>  
</HTML>   

