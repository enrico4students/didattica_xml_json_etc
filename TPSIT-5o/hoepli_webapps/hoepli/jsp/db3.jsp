<HTML>
<BODY>
<TITLE>JDBC e database ODBC</TITLE>
</BODY>
<H1>JDBC e database ODBC - solo java 7 </H1>
<%@ page import="java.sql.*" %>
<TABLE BORDER="1">
<%
// stringhe di inzializzazione driver e ODBC  
String DRIVER = "sun.jdbc.odbc.JdbcOdbcDriver";
String URL_mioDB = "jdbc:odbc:proveJava";
// definizione   delle query 
String query = "SELECT Cognome, Nome, Indirizzo, Citta FROM Amici";
  
try{
 Class.forName(DRIVER);
} 
catch (ClassNotFoundException e) {
 System.err.println("Driver non trovato" + e);
} 

Connection connessione = null;
try
{
 // apro la connesione verso il database.
 connessione = DriverManager.getConnection(URL_mioDB);
 // ottengo lo Statement per interagire con il database
 Statement statement = connessione.createStatement();
 // interrogo il DBMS mediante una query SQL
 ResultSet resultSet = statement.executeQuery(query);

 // Scorro e mostro i risultati.
 out.println("<PRE>");
 out.println("<B>cognome"+"&#9;"+"nome"+"&#9;"+"indirizzo"+"&#9;"+"citta</B>");
 while (resultSet.next()) {
  String cognome = resultSet.getString(1);
  String nome = resultSet.getString(2);
  String indirizzo = resultSet.getString(3);
  String citta = resultSet.getString(4);
  out.println("<BR>" + cognome+"&#9;"+nome+"&#9;"+indirizzo+"&#9;"+citta);
 }
 out.println("</PRE");
} 
catch (SQLException e) 
{
 // gestione dell'errore 
 System.err.println(e);
} 
// chiusura coneessione 
try
{
  connessione.close();
} catch (SQLException e) {
// gestione dell'errore 
  System.err.println(e);
}
%>
</TABLE>
</BODY>
</HTML>