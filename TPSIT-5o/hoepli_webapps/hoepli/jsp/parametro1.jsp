<HTML>
<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {
	color: #FF0000;
	font-style: italic;
}
.style3 {color: #FF00FF}
-->
</style>
<BODY>
<% 
String citta = request.getParameter("scelta");
if (citta == null) 
  citta = "posto sconosciuto"; 
%>
Vivi a <%= citta %>! 
<HR>
<span class="style2">Informazioni sulla richiesta HTTP</span>
<BR>Metodo richiesto = <span class="style1"><span class="style3">request</span>.getMethod()</span> :      <%= request.getMethod() %>    
<BR>URI              = <span class="style1"><span class="style3">request</span>.getRequestURI()</span> : <%= request.getRequestURI() %> 
<BR>Protocollo       = <span class="style1"><span class="style3">request</span>.getProtocol()</span> :   <%= request.getProtocol() %> 
<BR>QueryString      = <span class="style1"><span class="style3">request</span>.getQueryString()</span> :   <%= request.getQueryString() %> 
</BODY>
</HTML>


