<?php
// tecnica postback per rientare nella stessa pagina
if (isset($_POST['messaggio']) && isset($_POST['oggetto'])){  // seconda volta 
  //accesso dopo inserimento dati - connessione a MySQL  
  $db = new mysqli("localhost", "root", "", "provephp");
  // prova a connettersi al database 
  if (mysqli_connect_errno()) {
    printf("Connessione non effettuata: %s\n", mysqli_connect_error());
    exit();
  }
  $query = "SELECT * FROM Indirizzi";    // predisposizione della query
  if ($res = $db->query($query)) {      // esecuzione query
    printf("  - la select ha individuato %d righe.\n", $res->num_rows);
  }
  // per cambiare il database si può utilizzare  $db->select_db("provejava");

  // ritorna il nome current default database */
   if ($res = $db->query("SELECT DATABASE()")) {
     $row = $res->fetch_row();
     printf("Il database di default è: %s\n", $row[0]);
     $res->close();
  }

  // scrittura intestazione
  $intestazioni = "From:mittente@hoepli.com \r\nReply To:mittente@hoepli.com";
  $i = 0;                            // contatore di mail inviate
  $oggetto = $_POST['oggetto'];      // lettura oggetto e testo messaggio da  POST 
  $messaggio = $_POST['messaggio'];
  foreach( $res as $row ) {          // ciclo che estrae i record restituiti da SQL
    $dest = $row['Email'];           // $dest contiene l'email del destinatario
    $i++;
    $x = mail($dest, $oggetto, $messaggio, $intestazioni);    // invio  della mail
  }
  echo "<HR>Sono state inviate $i email<HR>";
  echo "<a href='".$_SERVER['PHP_SELF']."'>Torna allo script</A>";
  $res->close();
  $db->close();
}
else{                                    // mostro il form
  echo "
  <FORM name='form' method='post' actio n='".$_SERVER['PHP_SELF']."'>
  <B>OGGETTO</B><INPUT TYPE='text' NAME='oggetto'><BR>
  <TEXTAREA NAME='messaggio' cols='70' rows='5'></TEXTAREA><BR>
  <INPUT TYPE='submit' VALUE='Invia Email ai clienti'>
  </FORM></BODY></HTML>";
}
?>

