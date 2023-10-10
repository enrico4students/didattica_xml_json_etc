<HTML>
<HEAD>
</HEAD>
<BODY BGCOLOR="ffffcc">
<H1><img src="images/logoeditore.gif" width="364" height="56"></H1>
<H2><font color="#FF0000" face="Arial, Helvetica, sans-serif">Benvenuto nella 
  nostra libreria</font></H2>
<HR>
<h3><font color="#0000FF">Ti suggerisco i seguenti libri di:
<% out.println( request.getParameter("argomentoScelto") );%>
</font></h3>

<h3><font color="#0000FF">Hai scelto come lingua:
<% out.println( request.getParameter("linguaScelta") );%>
</font></h3>
<HR>
<a href="scegliDBBeanMySql.jsp">Ritorna alla scelte</a></P><BR><BR>
<a href="../jsp/index.html">Ritorna al menù principale</a> 
</BODY>  
</HTML>   

