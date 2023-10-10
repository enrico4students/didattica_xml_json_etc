<?php
/* settaggio del tipo di documento a text/javascript invece che text/html */
header("Content-type: text/javascript");

$connessione = "mysql:host=localhost;dbname=provajson";
// credenziali per l'autenticazione
$utente = "utente";
$password = "password";

// creazione dell'oggetto PDO
$istanza = new PDO($connessione, $utente, $password) or die("non va");
if (isset($istanza)) echo "FUNZICA!";
// definizione dell'array da parsare
$risultato = array();

$SQL= "SELECT vittorie FROM Vincitori WHERE nazionali = ? ORDER BY vittorie";

// popolamento dell'array tramite query
if(isset($_GET['nomeNazionale'])) {
  $query = $istanza->prepare($SQL);
  $query->execute(array($_GET['nomeNazionale']));
  $risultato = $query->fetchAll(PDO::FETCH_ASSOC);
}
else{
  /* definiamo con php un array multidimensionale da ritornare a javascript  mediante ajax */
  $risultato = array(
    "vittorie" => "0",  
    "sconfitte" => "0"
  );
}

echo json_encode($risultato);
?>
