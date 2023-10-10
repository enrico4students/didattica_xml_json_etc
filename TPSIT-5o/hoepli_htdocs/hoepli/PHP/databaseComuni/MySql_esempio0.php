<?php
	$con = new mysqli("localhost", "root", "", "provephp");
	//check connection
	if (mysqli_connect_errno()){
		printf("fallimento nella connessione: %s\n", mysqli_connect_error());
		exit();
  }

  // definizione stringa contenente comando SQL
  $sql = "SELECT ID, nome_utente, indirizzo, citta, cap, provincia FROM utenti";
  // esecuzione query che restituisce $ris
  $ris = $con->query($sql) or die ("query fallita!");
  
  // verifica la presenza di almeno una tupla risultato
  if ($ris->num_rows > 0) {
    // genero tabella di visualizzazione
    echo "<TABLE><TR><TH>ID utente<TH>Nome utente<TH>indirizzo<TH>citta<TH>cap<TH>provincia</TR>";
    // ciclo foreach legge gli elementi del resultset $ris
    foreach($ris as $riga){
      echo "<TR><TD>".$riga["ID"];
      echo "<TD>".$riga["nome_utente"];
      echo "<TD>".$riga["indirizzo"];
      echo "<TD>".$riga["citta"];
      echo "<TD>".$riga["cap"];
      echo "<TD>".$riga["provincia"];
    }
  }
  else
    echo "Nessun utente presente in archivio";
  //rilascio connessione
  $con->close();
?>



