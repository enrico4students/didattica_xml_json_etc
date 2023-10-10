<html>
<body>
<title> Primo codice JSP </title>
<%!               <!-- espressioni ->
String utente = “Anna Maria”;
double[] prezzi = {11.5, 73.8, 121.5};
double getTotal() {
  double total = 0.0;
  for (int x=0;x<prezzi.length; x++)
  total += prezzi[x];
return total;
}
%>
<p>Sig. <%=utente%>, oggi è il <%=new Date()%></p>
<p>l’ammontare del suo acquisto è: <%=getTotal()%> euro.</p>
%>


</body>
</html>


