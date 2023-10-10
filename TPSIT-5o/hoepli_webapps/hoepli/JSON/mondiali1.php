<?php
/* settaggio del tipo di documento a text/javascript invece che text/html */
header("Content-type: text/javascript");
// credenziali per l'autenticazione
//$utente = "root";         // utente di default 
//$password = "";
$utente = "prova";          // definito dall' amministratore DB
$password = "password";
$database = "provajson";

// definizione dell'array da parsare
$risultato = array();
$db = new mysqli("localhost", $utente, $password, $database);

// prova a connettersi al database 
if (mysqli_connect_errno()) {
  printf("Connessione non effettuata: %s\n", mysqli_connect_error());
  exit();
}

// carico dati delle vittorio nel list box 
$SQL= "SELECT vittorie FROM vincitori ";

// predisposizione della query MySqli
if(isset($_GET['nomeNazionale'])) {
  //$SQL= "SELECT * FROM vincitori";
  $SQL= "SELECT * FROM vincitori WHERE nazionale ='".$_GET['nomeNazionale']."'";
  echo $SQL;
  if ($res = $db->query($SQL)){  // esecuzione query
    foreach( $res as $riga ) {   // estrae i record restituiti da query
      $risultato = array("vittorie" => $riga["vittorie"]);
      //------------------------------------------------------------------ 
      // $riga è un array associativo con chiave il nome della nazionale 
      // $risultato = Array($riga["nazionale"]
      //                           =>Array("vittorie" => $riga["vittorie"], 
      //                                    "partite" => $riga["partite"]
      //                                  ) 
      //                    ); 
      //-----------------------------------------------------------------
    }
  }
  else
    echo 'nome nazionale non selezionato';
}

$db->close();
echo json_encode($risultato);
?>
