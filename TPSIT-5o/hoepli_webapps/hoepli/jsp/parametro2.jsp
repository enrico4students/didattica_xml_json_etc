<HTML>
<% 
 String bgColor = request.getParameter("scelta");
 boolean coloreScelto;
 if(bgColor != null){             // analisi del parametro
   coloreScelto = true;
 }else{
   coloreScelto = false;
   bgColor = "WHITE";
 }
%>
<BODY BGCOLOR="<%= bgColor %>">   <!-- setto colore di sfondo-->
<H2>Colore come parametro</H2><B>
<%
 if(coloreScelto){                // visualizzo la scelta fatta
   out.println("Hai scelto un bel colore: " + bgColor + ".");
 }else{
   out.println("Colore sfondo non scelto, WHITE di default.");
 }
%>
</B></BODY>
</HTML>


