<?php
  // salvo campo GET letto dalla pagina precedente
  $q = $_GET["stringa"];
  $risposta = "";
  //genero un array che contiene i nomi
  if (strlen($q) > 0){
    // creo un oggetto con i parametri della connessione 
    $mysql = new mysqli("localhost", "root", "", "provephp");
    // effettuo il tentativo di connessione al database 
    if (mysqli_connect_errno()) {
      echo("Connessione non effettuata: ".mysqli_connect_error()."<BR>");
      exit();
    }
    $query ="SELECT name,lat,lng FROM comuni WHERE name like '".$q."%' ORDER BY name;";
    if ($res = $mysql->query($query)) {      // esecuzione query
      echo("La select ha individuato ".$res->num_rows." comuni.<BR>");
      echo("(comune,latitudine,longitudine)<BR><BR>");
    }
    if ($res->num_rows > 0){      // se presente almeno un comune 
      foreach( $res as $riga ) {  // per estrarre i record restituiti da query
        // $riga è un array associativo con chiave il nome del campo
        $risposta .= $riga["name"].",".$riga["lat"].",".$riga["lng"]."<BR>";
      }
    }
    $mysql->close();
  }
  // verifico se $risposta è vuota restituisco stringa "Nessun nome trovato"
  if ($risposta == ""){
    echo("Nessun nome trovato");
  }
  else{                           // assegnazione stringa di risposta
    echo $risposta;
  }
?>
