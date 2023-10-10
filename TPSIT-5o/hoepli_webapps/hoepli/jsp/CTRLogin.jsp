<%@ page language="java" import="java.sql.*" %>
<%@ include file="funzioni.jsp" %>
<html>
<head><title>Database</title>
<style type="text/css">
<!--
.style1 {color: #0000FF}
-->
</style>
</head>
<body>
<h3 class="style1"><img src="images/logoeditore.gif" width="364" height="56"></h3>
<h3 class="style1">Accesso Utenti registrati in Access </h3>
<% 
  String userID=request.getParameter("userID");
  String pwd=request.getParameter("pwd");
  // stringhe di inzializzazione driver    
  String DRIVER = "net.ucanaccess.jdbc.UcanaccessDriver";
  // riferimento al database: connessione diretta
  String protocollo = "jdbc:ucanaccess://";               // connessione alla libreria     
  String mdbpath    = "tomcat/webapps/hoepli/esempioDB/"; // percorso relativo 
  String mdbName    = "proveJava.mdb;memory=false";       // nome database  
    // riferimento al database  
  String URL_mioDB = protocollo + mdbpath + mdbName;

  try{
   Class.forName(DRIVER);
  } 
  catch (ClassNotFoundException e) {
    System.err.println("Driver non trovato" + e);
  } 
  Connection connessione = null;
  try{     // apro la connesione verso il database.
    connessione = DriverManager.getConnection(URL_mioDB);
  } 
  catch (Exception e){
    System.err.println("Errore nella connessione col database: " + e);
  } 
  // ottengo lo Statement per interagire con il database
  Statement stmt = connessione.createStatement();
 
  // interrogo il DBMS mediante una query SQL
  String sql="SELECT * FROM utente WHERE UserID=" + apici(userID) + " AND password=" + apici(pwd);
  ResultSet rs = stmt.executeQuery(sql);
  if (rs.next()){
    //visualizza dati utente
    out.write("User ID : "+rs.getString("userID")+"<br/>");
    out.write("Cognome : "+rs.getString("cognome")+"<br/>");
    out.write("Nome : "+rs.getString("nome")+"<br/>");
    out.write("Indirizzo: "+rs.getString("tipovia")+" "+rs.getString("indirizzo")+" "+rs.getString("numcivico")+"<br/>");
    out.write("Indirizzo: "+rs.getString("cap")+" "+rs.getString("citta")+" "+rs.getString("prov")+"<br/>");
    out.write("E-mail : "+vuoto(rs.getString("email"))+"<br/>");
    out.write("Telefono : "+vuoto(rs.getString("telefono"))+"<br/>");
    out.write("Cellulare: "+vuoto(rs.getString("cellulare"))+"<br/>");
  }
  else{
    out.write("Utente non trovato <br/> Ripetere la procedura di login");
  }
  stmt.close();
  connessione.close();
%>
<br/><br/><a href="datiLogin.jsp" title="Torna indietro">Indietro</a><BR><BR>
<a href="../jsp/index.html">ritorna al menù principale</a> 
</body></html>


