<?php
// echo "chiamato vittorie.php - ";
header('Content-Type: application/javascript;');

// connessione e selezione del database
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
  $query->execute(array('Brasile'));
  $risultato = $query->fetchAll(PDO::FETCH_ASSOC);
}

// This ID parameter is sent by our javascript client.
$id = $_GET['nomeNazionale'];
// Here's some data that we want to send via JSON.
// We'll include the $id parameter so that we
// can show that it has been passed in correctly.
// You can send whatever data you like.
$data = array("vittorie", $id);
// Send the data.
echo json_encode($data);


//------------ trasformo in vettore 
//$output = array();
//foreach ($risultato as $row) {
// $addtooutput["vittorie"] = $row["vittorie"];
// $output[] = $addtooutput;
//}

//array_walk($risultato, function(&$row) {
//    $row['size'] = formatSizeUnits($row["size"]);
// });

// codifica dei risultati
//echo json_encode($output);
//echo json_encode($risultato);
?>
