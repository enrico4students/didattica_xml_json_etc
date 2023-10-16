<%! public long fact (long x) {
if (x == 0) 
  return 1;
else 
  return x * fact(x-1);
}
%>
<HTML>
<HEAD><TITLE>Fattoriale ricorsivo</TITLE></HEAD>
<BODY>
<H2 ALIGN="CENTER">Fattoriale ricorsivo con ciclo FOR</H2>
<TABLE ALIGN="CENTER" BORDER="1">
<TR>
  <TD><I>n</I></TD>
  <TD><I>n</I>!</TD>
</TR>         <!-- intestazione tabella  -->
<!-- nella istruzione Java si alternano tag HTML per comporre la riga a schermo -->
<% for (long x = 0l; x <= 10l; ++x) { %>             <!-- per tutte le righe    -->     
  <TR><TD><%= x %></TD><TD><%= fact(x) %></TD></TR>  <!-- genera un valore      -->
<% } %>
</TABLE>
</BODY>
</HTML>

