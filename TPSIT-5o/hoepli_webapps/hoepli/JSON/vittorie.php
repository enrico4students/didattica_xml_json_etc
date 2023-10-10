<?php
/* settaggio del tipo di docuemnto a text/javascript invece che text/html */
header("Content-type: text/javascript");

$connessione = "mysql:host=localhost;dbname=provajson";
// credenziali per l'autenticazione
$utente = "utente";
$password = "password";
// creazione dell'oggetto PDO
$istanza = new PDO($connessione, $utente, $password);
// definizione dell'array da parsare
$risultato = array();


// popolamento dell'array tramite query
if(isset($_GET['nomeNazionale'])) {
  $query = $istanza->prepare("SELECT vittorie FROM Vincitori WHERE nazionali = ? ORDER BY vittorie");
  $query->execute(array($_GET['nomeNazionale']));
  $risultato = $query->fetchAll(PDO::FETCH_ASSOC);
}
else
{
  $query = $istanza->prepare("SELECT vittorie FROM Vincitori WHERE nazionali = ? ORDER BY vittorie");
  $query->execute(array('Italia'));
  $risultato = $query->fetchAll(PDO::FETCH_ASSOC);
}


echo json_encode($risultato);
?>
