/// da fare 
<HTML>
<BODY BGCOLOR="ffffcc"><h3>Connessione a database Access </h3>
<h3><font color="#FF0000" face="Arial, Helvetica, sans-serif">Scegli l'argomento di tuo interesse </font></h3>
<FORM ACTION="scegliDBBean.jsp" METHOD="GET">
<jsp:useBean id="elenco" class="mieiBean.ScelteDBAccess" />
<H4><font color="#0000FF"> 
  Scegli tra questi argomenti:
  <!-- dispongo nel Bean un combobox come risultato del metodo getArgomenti della classe ScelteDBAccess -->
  <jsp:getProperty name="elenco" property="argomenti"/>
  <INPUT TYPE="submit" VALUE="Invia argomento">
</font></H4>
<p><strong>Nota</strong>: viene restituita una pagina <font color="#FF0000">scegliDBBean.jsp </font>con la scelta effettuata<font color="#FF0000"> </font></p>
</FORM></BODY> 
</HTML>   
