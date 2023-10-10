<?php
/* settaggio del tipo di documento a text/javascript invece che text/html */
header("Content-type: text/javascript");

printf("azzo di budda ");

//$connessione = "mysql:host=localhost;dbname=provajson";
// credenziali per l'autenticazione
$utente   = "root";
$password = "";
$database = "provajson";

// creazione dell'oggetto PDO
// $istanza = new PDO($connessione, $utente, $password);
// definizione dell'array da parsare
// $risultato = array();

$db = new mysqli("localhost", $utente, $password, $database);
// prova a connettersi al database 
if (mysqli_connect_errno()) {
  printf("Connessione non effettuata: %s\n", mysqli_connect_error());
  exit();
}
 
// predisposizione della query
$query = "SELECT vittorie FROM Vincitori WHERE nazionali = ? ORDER BY vittorie";    
//if(isset($_GET['nomeNazionale'])) {
if ($res = $db->query($query)) {      // esecuzione query
   printf("  - la select ha individuato %d righe.\n", $res->num_rows);
   printf($_GET['nomeNazionale']);
}

// popolamento dell'array tramite query
//if(isset($_GET['nomeNazionale'])) {
//  $queryRes = $db->prepare($query);
//  $queryRes->execute(array($_GET['nomeNazionale']));
//  $risultato = $queryRes->fetchAll(PDO::FETCH_ASSOC);

$res->close();
$db->close();
echo json_encode($risultato);
?>