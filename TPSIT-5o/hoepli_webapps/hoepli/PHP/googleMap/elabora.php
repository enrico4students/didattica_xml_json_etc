<?php
// ricevo il campo GET con il nome della città dalla pagina precedente
$q = $_GET["stringa"];
$citta = "";   // stringa che verrà restituita con i nomi delle località
if (strlen($q) > 0){                // presenta parola 
  $db = new mysqli("localhost", "root", "", "provephp");
  if (mysqli_connect_errno()) {     // verifico l'avvenuta connessione 
    printf("Connessione non effettuata: %s\n", mysqli_connect_error());
    exit();
  }
  $query = "SELECT Name,lat,lng FROM comuni WHERE Name like '".$q."%';";
  if ($res = $db->query($query)) {      // esecuzione query
    printf("- la select ha individuato %d alternative:"."<BR>", $res->num_rows);
  }
  foreach( $res as $riga ) {  // ciclo che estrae i record restituiti da SQL
    $citta.=$riga["Name"].",".$riga["lat"].",".$riga["lng"]."<BR>";
  }
  $db->close();               // chiusura connessione
}
if (strlen($citta) == 0){     // controllo se esiste un risultato 
  echo "nessun nome trovato!";
}
else{
  echo $citta;
}
?>

