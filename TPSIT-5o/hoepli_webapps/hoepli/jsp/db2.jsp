<HTML>
<BODY><TITLE>JSP, UCanAccess e database MDB</TITLE></BODY>
<H1>JDBC e database MDB</H1>
<%@ page import="java.sql.*" %>
<TABLE BORDER="1">
<%
 // stringhe di inzializzazione driver    
 String DRIVER = "net.ucanaccess.jdbc.UcanaccessDriver";
 // riferimento al database: connessione diretta   
 String protocollo = "jdbc:ucanaccess://";            // connessione alla libreria     
 String mdbpath = "tomcat/webapps/hoepli/esempioDB/"; // percorso relativo 
 String mdbName = "proveJava.mdb;memory=false";       // nome database  
 // riferimento al database  
 String URL_mioDB = protocollo + mdbpath + mdbName;
 // definizione della query 
 String query = "SELECT Cognome, Nome, Indirizzo, Citta FROM Amici";
  
 try{
   Class.forName(DRIVER);
 } 
 catch (ClassNotFoundException e) {
   System.err.println("Driver non trovato" + e);
 } 
 // apro la connesione verso il database
 Connection connessione = null;
 try{
   connessione = DriverManager.getConnection(URL_mioDB);
 } 
 catch (Exception e){
   System.err.println(e);
 } 
 // interrogazione del database
 try{
   // ottengo lo Statement per interagire con il database
   Statement statement = connessione.createStatement();
   // interrogo il DBMS mediante una query SQL
   ResultSet resultSet = statement.executeQuery(query); 
   // Scorro il resulSet e mostro i risultati
   out.println("<PRE>");
   out.println("<B>cognome"+"&#9;"+"nome"+"&#9;"+"indirizzo"+"&#9;"+"citta</B>");
   while (resultSet.next()) {
     String cognome = resultSet.getString(1);
     String nome = resultSet.getString(2);
     String indirizzo = resultSet.getString(3);
     String citta = resultSet.getString(4);
     out.println(cognome+"&#9;"+nome+"&#9;"+indirizzo+"&#9;"+citta);
   }
   out.println("</PRE");
 } 
 catch (SQLException e){    // visualizzazione dell'errore 
   out.println("Errore nella esecuzione della query:<br>"+query);
   out.println(e);
 } 
 try{                       // chiusura connessione 
   connessione.close();
 } 
 catch (SQLException e){    // gestione dell'errore 
   out.println(e);
 }
 out.close();
%>
</TABLE>
</BODY>
</HTML>