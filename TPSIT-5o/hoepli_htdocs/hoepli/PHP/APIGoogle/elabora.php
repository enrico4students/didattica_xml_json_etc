<?php
// ricevo il campo GET con inizio del nome della citta'
$q = $_GET["stringa"];
$citta = "";                             // per mettere l'elenco nomi delle localita'
if (strlen($q) > 0){                     // se e' presente una testo  
  //genero un array che contiene i nomi
  $db = new mysqli("localhost", "root", "", "provephp");
  if (mysqli_connect_errno()) {          // verifico l'avvenuta connessione 
    printf("Connessione non effettuata: %s\n", mysqli_connect_error());
    exit();
  }

  // stringa di interrogazione 
  $query ="SELECT name,lat,lng FROM comuni WHERE name like '".$q."%' ORDER BY name;";
  if ($res = $db->query($query)) {       // esecuzione query
    printf("- la select ha individuato %d alternative:"."<BR>", $res->num_rows);
  }
 
  if ($res->num_rows > 0){               // se presente almeno un comune 
    printf("(comune,latitudine,longitudine)<BR><BR>");
    foreach( $res as $riga ) {           // ciclo che estrae i record restituiti da SQL
      $citta.=$riga["name"].",".$riga["lat"].",".$riga["lng"]."<BR>";
    }
  }
  $db->close();                          // chiusura connessione
}

if (strlen($citta) == 0){                // controllo se esiste un risultato 
  echo "nessun nome trovato!";
}
else{
  echo $citta;
}
?>

