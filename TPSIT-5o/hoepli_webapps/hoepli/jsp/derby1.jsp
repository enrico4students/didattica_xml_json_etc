<HTML>
<BODY><TITLE>JSP e database Derby</TITLE></BODY>
<H2>JSP e database Derby </H2>
<%@ page import="java.sql.*" %>
<TABLE BORDER="1">
<%
  // carico il driver per la connessione al DB MySQL
  String DRIVER = "org.apache.derby.jdbc.EmbeddedDriver";
  String protocollo = "jdbc:derby:";                         // connessione alla libreria
  String dbpath     = "tomcat/webapps/hoepli/esempioDB/";    // percorso assoluto 
  String dbName     = "esempiTPSIT3;memory=false";           // nome database 
  String user       = "";                                    // nome utente 
  String psw        = "";                                    // password   
  String URL_mioDB = protocollo + dbpath + dbName;           // riferimento completo al database  
  // definizione della query 
  String  query = "SELECT * FROM alunni";
 
  try{
    Class.forName(DRIVER);
  } 
  catch (ClassNotFoundException e) {
    System.err.println("Driver non trovato" + e);
  } 

  Connection connessione = null;
  try{                                                 // apro la connessione verso il database
    connessione = DriverManager.getConnection(URL_mioDB, user, psw);
  } 
  catch (Exception e){
    System.err.println("Errore nella connessione col database: " + e);
  } 

  try{                                                 // esecuzione della query
    Statement statement= connessione.createStatement();
    ResultSet rs = statement.executeQuery(query);  
    out.println("<pre>");
    out.println("<b>Mat."+"&#9;"+"cognome"+"&#9;"+"nome"+"&#9;"+"classe"+"&#9;"+"sesso</b>");
    while (rs.next()) {                                // scorro il resultSet e mostro i risultati
      int mat = rs.getInt(1);
      String cog = rs.getString("cognome");
      String nom = rs.getString(3);
      int classe = rs.getInt("classe");     
      String sez = rs.getString("sezione");
      String sex = rs.getString("sesso");
      out.println(mat+"&#9;"+cog+"&#9;"+nom+"&#9;"+classe+sez+"&#9;"+sex);
    }
    out.println("</pre>");
  }
  catch (Exception e){
    System.err.println(e);
  } 
  try{                                                 // chiusura connessione  
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


