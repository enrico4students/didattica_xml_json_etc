<HTML>
<HEAD><TITLE>sezione scelta da sezioni.html</TITLE></HEAD>
<BODY>
<H2 ALIGN="CENTER">Sezione selezionata</H2>

<% 
 String scelta = request.getParameter("categoria");
 if (scelta == null) 
   scelta = "categoria non selezionata"; 
%>

<% if (scelta.equals("politica")){  
%>
 <TABLE style="width:200px">
  <tr><td style="text-align:center">Prima sezione POLITICA </td></tr>
 </TABLE>
<% 
 } 
 else if  (scelta.equals("sport")){  
%>
 <TABLE style="width:200px">
  <tr><td style="text-align:center">Seconda sezione SPORT </td></tr>
 </TABLE>
<% 
 } 
 else if  (scelta.equals("salute")){  
%>
 <TABLE style="width:200px">
  <tr><td style="text-align:center">Terza sezione SALUTE </td></tr>
 </TABLE>
<% 
 } 
  else if  (scelta.equals("economia")){  
%>
 <TABLE style="width:200px">
  <tr><td style="text-align:center">Quarta sezione ECONOMIA </td></tr>
 </TABLE>
<% 
 } 
 else if  (scelta.equals("spettacolo")){  
%>
 <TABLE style="width:200px">
  <tr><td style="text-align:center">Quinta sezione SPETTACOLO </td></tr>
 </TABLE>
<% 
 } 
%>

</BODY>
</HTML>

