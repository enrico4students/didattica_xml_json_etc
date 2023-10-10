<HTML>
<BODY><TITLE>JSP e database MySQL</TITLE></BODY>
<H2>JSP e database MySQL</H2>
<%@ page import="java.sql.*" %>
<TABLE BORDER="1">
<%
 // carico il driver per la connessione al DB MySQL
 String DRIVER = "com.mysql.jdbc.Driver";
 // riferimento al database: connessione MySQL
 String URL_mioDB = "jdbc:mysql://localhost:3306/proveJava";                             //3306 di default
 // definizione della query 
 String query = "SELECT Cognome, Nome, Indirizzo, Citta FROM Amici";
  
 try{
   Class.forName(DRIVER);
 } 
 catch (ClassNotFoundException e) {
   System.err.println("Driver non trovato" + e);
 } 

 Connection connessione = null;
 try{                            // apro la connesione verso il database
   connessione = DriverManager.getConnection(URL_mioDB,"root","");
 } 
 catch (Exception e){
   System.err.println("Errore nella connessione col database: " + e);
 } 

 try{
  // ottengo lo Statement per interagire con il database
  Statement statement = connessione.createStatement();
  // interrogo il DBMS mediante una query SQL
  ResultSet resultSet = statement.executeQuery(query);
  // scorro e mostro i risultati
  out.println("<PRE>");
  out.println("<B>cognome"+"&#9;"+"nome"+"&#9;"+"indirizzo"+"&#9;"+"citta</B><BR>");
  while (resultSet.next()) {
   String cognome = resultSet.getString(1);
   String nome = resultSet.getString(2);
   String indirizzo = resultSet.getString(3);
   String citta = resultSet.getString(4);
   out.println( cognome+"&#9;"+nome+"&#9;"+indirizzo+"&#9;"+citta);
  }
  out.println("</PRE>");
 } 
 catch (Exception e){
  System.err.println(e);
 } 
 try{                           // chiusura connessione  
   connessione.close();
 } 
 catch (Exception e) {
   System.err.println(e);
 }
 out.close();                   // chiusura oggetto di output 
%>
</TABLE>
</BODY>
</HTML>
