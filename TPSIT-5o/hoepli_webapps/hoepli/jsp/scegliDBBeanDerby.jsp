<HTML>
<BODY BGCOLOR="ffffcc">
<h3>Connessione a database Derby </h3>
<h3><font color="#FF0000" face="Arial, Helvetica, sans-serif">Configura le tue preferenze</font></h3>
<FORM ACTION="caricaLibri2.jsp" METHOD="GET">
<jsp:useBean id="elenco" class="mieiBean.ScelteDBDerby" />
<H4><font color="#0000FF"> 
  Scegli tra questi argomenti:
  <!-- dispongo nel Bean un list box come risultato del metodo getArgomenti della classe ScelteDBDerby -->
  <jsp:getProperty name="elenco" property="argomenti"/>
   in lingua :
  <!-- dispongo nel Bean un list box come risultato del metodo getArgomenti della classe ScelteDBDerby -->
  <jsp:getProperty name="elenco" property="lingue"/>
  dell'editore:
  <!-- dispongo nel Bean un list box come risultato del metodo getEditori della classe ScelteDBDerby -->
  <jsp:getProperty name="elenco" property="editori"/>
  </font></H4>
<H4><font color="#0000FF">
  <INPUT TYPE="submit" VALUE="Invia scelte">
</font></H4>
<p><strong>Nota</strong>: viene restituita una pagina <font color="#FF0000">caricaLibri2.jsp</font> dove vengono visualizzate  la scelte effettuate<font color="#FF0000"></font></p>
</FORM> 