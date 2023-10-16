<?php
 // Access-Control-Allow-Headers
  include_once '../config/header.php';
  include_once '../config/database.php';
  include_once '../modelli/disco.php';

  $database = new Database();                             // creiamo un nuovo oggetto database
  $db = $database->getConnection();                       // ci colleghiamo al nostro database
  $disco = new Disco($db);                                // creiamo un nuovo oggetto disco
  $data = json_decode(file_get_contents("php://input"));  // decodifichiamo il dato JSON ricevuto 
  
  $disco->setNRcatalogo($data->NRcatalogo);               
  $result = $disco->delete();
  if($result){
    http_response_code(200);
    echo json_encode(array("risposta" => "Il disco e' stato eliminato"));
  }
  else{       //503 Servizio non disponibile
    http_response_code(503);
    echo json_encode(array("risposta" => "Impossibile eliminare il disco."));
  }
?>
