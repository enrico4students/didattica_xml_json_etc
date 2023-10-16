<%@ page language="java" %>
<%! Cookie mioCookie = null;                // oggetto classe Cookie %>   
<%! int indice = 0; %>
<%! Cookie[] cookiesUtente; %>
<style type="text/css">
<!--
.style1 {color: #006600}
-->
</style>

<p>Sto leggendo i cookies presenti ... <br>
<% cookiesUtente = request.getCookies(); 
 while(indice < cookiesUtente.length){      // scorre tutti i cookie  
   if((cookiesUtente[indice].getName()).equals("provacookie"))
     break;                                 // trovato il mio cookie
   else 
     indice++;                              // non trovato prosegue
 }
 if (indice < cookiesUtente.length)         // se trovato prima della fine
   mioCookie = cookiesUtente[indice] ;      // allora era quello che cercavo    
 else 
   mioCookie = null;                        // altrimenti non è presente 
 if (mioCookie != null){ 
   out.println("Cookie con valore provacookie contiene : "+ mioCookie.getValue()); 
 }else
   out.println("Cookie di valore provacookie non settato" );  
%>
<br>
Clicca per scrivere il cookie <span class="style1">"provacookie"</span> <a href="cookieScrivi.jsp">scrivi un cookie </a>

 
