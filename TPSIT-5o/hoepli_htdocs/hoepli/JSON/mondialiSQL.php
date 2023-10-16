<?php
/* settaggio del tipo di documento a text/javascript invece che text/html */
header("Content-type: text/javascript");
// dati del server 
$host = "localhost";
$database = "provajson";
// credenziali per l'autenticazione
$utente = "root";
$password = "";
// creazione dell'oggetto PDO
$connessione = "mysql:host=".$host.";dbname=".$database;
$istanza = new PDO($connessione, $utente, $password);
$SQL= "SELECT vittorie FROM Vincitori WHERE nazionale = ? ORDER BY vittorie";
// definizione dell'array da parsare
$risultato = array();
// popolamento dell'array tramite query
if(isset($_GET['nomeNazionale'])) {
  $query = $istanza->prepare($SQL);
  $query->execute(array($_GET['nomeNazionale']));
  $risultato = $query->fetchAll(PDO::FETCH_ASSOC);
}
echo json_encode($risultato);
?>
