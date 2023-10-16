<HTML>
<BODY BGCOLOR="ffffcc">
<H1><img src="images/logoeditore.gif" width="364" height="56"></H1>
<H3><font color="#FF0000" face="Arial, Helvetica, sans-serif">Scegli l'argomento e la lingua dei libri desiderati </font></H3>
<FORM ACTION="caricaLibri2.jsp" METHOD="GET">
<jsp:useBean id="libri" class="mieiBean.LibriBeanDB" />
<HR>
<H4><font color="#0000FF"> 
  Scegli tra questi argomenti:
  <!-- dispongo nel Bean un list box come risutato del metodo getArgomenti della classe LibriDBBean -->
  <jsp:getProperty name="libri" property="argomenti"/>    
  <P>
  Scegli tra queste lingue:
  <!-- dispongo nel Bean un list box come risutato del metodo getLingue della classe LibriDBBean -->
  <jsp:getProperty name="libri" property="lingue"/>
</font></H4>
</p>
<HR>
<font color="#FF0000" face="Arial, Helvetica, sans-serif">ricerca nel database</font>
<INPUT TYPE="submit" VALUE="Submit">
<p><strong>Nota</strong>: viene restituita una pagina <font color="#FF0000">HTML</font> 
   generata da <font color="#FF0000">caricaLibri2.jsp</font></p>
<HR>
</FORM>
</BODY>  
</HTML>   