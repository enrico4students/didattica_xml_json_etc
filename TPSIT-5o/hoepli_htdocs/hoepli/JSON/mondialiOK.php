<?php
/* settaggio del tipo di documento a text/javascript invece che text/html */
header("Content-type: text/javascript");
// dati del server 
$host = "localhost";
$database = "provajson";
// credenziali per l'autenticazione
$utente = "utente";
$password = "password";
// creazione dell'oggetto PDO
$connessione = "mysql:host=".$host.";dbname=".$database;
$istanza = new PDO($connessione, $utente, $password);
// definizione dell'array da parsare
$risultato = array();
// popolamento dell'array tramite query
if(isset($_GET['nomeNazionale'])) {
  $SQL= "SELECT vittorie FROM Vincitori WHERE nazionale = ? ORDER BY vittorie";
  $query = $istanza->prepare($SQL);
  $query->execute(array($_GET['nomeNazionale']));
  $risultato = $query->fetchAll(PDO::FETCH_ASSOC);
}
else
{
  $SQL= "SELECT vittorie FROM Vincitori ORDER BY vittorie";
  $risultato = array(1,2,3);

}	
echo json_encode($risultato);
?>
