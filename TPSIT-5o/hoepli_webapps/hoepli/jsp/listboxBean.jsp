<HTML>
<HEAD>
</HEAD>
<BODY BGCOLOR="ffffcc">
<jsp:useBean id="libri" class="mieiBean.LibriBeanDB" />
<H1><img src="images/logoeditore.gif" width="364" height="56"></H1>
<H3><font color="#FF0000" face="Arial, Helvetica, sans-serif">Scegli l'argomento  e la lingua dei libri desiderati </font></H3>
<HR>
<H4> <font color="#0000FF"> Scegli tra questi argomenti:
      <!-- setto nel Bean la variabile categoria con la scelta dell'utente -->
      <jsp:getProperty name="libri" property="argomenti"/>    
<p>Scegli tra queste lingue:
  <!-- setto nel Bean la variabile categoria con la scelta dell'utente -->
  <jsp:getProperty name="libri" property="lingue"/>
  
</font>
  </H4>
</p>
<HR>
</BODY>  
</HTML>   

