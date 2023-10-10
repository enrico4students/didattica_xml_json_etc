<HTML>
<BODY BGCOLOR="ffffcc">
<h3>Connessione a database MySql </h3>
<h3><font color="#FF0000" face="Arial, Helvetica, sans-serif">Configura le tue preferenze</font></h3>
<FORM ACTION="scegliDBBean2.jsp" METHOD="GET">
<jsp:useBean id="elenco" class="mieiBean.ScelteDBMySql" />
<H4><font color="#0000FF"> 
  Scegli tra questi argomenti:
  <!-- dispongo nel Bean un list box come risultato del metodo getArgomenti della classe ScelteDBMySql -->
  <jsp:getProperty name="elenco" property="argomenti"/>
   in lingua :
  <!-- dispongo nel Bean un list box come risultato del metodo getArgomenti della classe ScelteDBMySql -->
  <jsp:getProperty name="elenco" property="lingue"/>
  </font></H4>
<H4><font color="#0000FF">
  <INPUT TYPE="submit" VALUE="Invia scelte">
</font></H4>
<p><strong>Nota</strong>: viene restituita una pagina <font color="#FF0000">scegliDBBean2.jsp </font>dove vengono visualizzate  la scelte effettuate<font color="#FF0000"></font></p>
</FORM>
</BODY>  
</HTML>   