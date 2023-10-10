<HTML>
<BODY BGCOLOR="ffffcc">
<h3><font color="#FF0000" face="Arial, Helvetica, sans-serif">Scegli l'argomento a cui sei interessato </font></h3>
<FORM ACTION="scegliDBBean.html" METHOD="GET">
<jsp:useBean id="elenco" class="mieiBean.ScelteDB" />
<H4><font color="#0000FF"> 
  Scegli tra questi argomenti:
  <!-- dispongo nel Bean un list box come risutato del metodo getArgomenti della classe LibriDBBean -->
  <jsp:getProperty name="elenco" property="argomenti"/>
  <INPUT TYPE="submit" VALUE="Invia argomento">
</font></H4>
<p><strong>Nota</strong>: viene restituita una pagina <font color="#FF0000">scegliDBBean.html </font>con la scelta effettuata<font color="#FF0000"> </font></p>
</FORM>
</BODY>  
</HTML>   