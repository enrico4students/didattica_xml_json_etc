<?php
  // Access-Control-Allow-Headers
  include_once '../config/header.php';
  include_once '../config/database.php';
  include_once '../modelli/disco.php';

  $database = new Database();           // creiamo un nuovo oggetto database 
  $db = $database->getConnection();     // ci colleghiamo al nostro database
  $disco = new Disco($db);              // creiamo un nuovo oggetto disco

  $stmt = $disco->read();               // esecuzione della query 
  $tanti = $stmt->rowCount();
  if ( $tanti > 0 ){                    // se vengono trovati libri nel database
    $arr_dischi = array();              // creazione di un array di dischi
    $arr_dischi["records"] = array();
    while ($row = $stmt->fetch (PDO::FETCH_ASSOC)){
      extract($row);
      $item_disco = array (
        "NRcatalogo" => $NRcatalogo,
        "Genere" => $Genere,
        "Interprete" => $Interprete,
        "Titolo" => $Titolo,
        "Etichetta" => $Etichetta
      );
      array_push($arr_dischi["records"], $item_disco);
    }
    echo json_encode($arr_dischi); 
  }
  else{
    echo json_encode( array ( "message" => "Nessun disco trovato." ));
  }
?>
