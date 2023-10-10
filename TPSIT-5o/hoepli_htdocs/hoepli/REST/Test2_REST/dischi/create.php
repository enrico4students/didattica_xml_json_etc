<?php
  // Access-Control-Allow-Headers
  include_once '../config/header.php';
  include_once '../config/database.php';
  include_once '../modelli/disco.php';
  
  $database = new Database();                             // creiamo un nuovo oggetto database
  $db = $database->getConnection();                       // ci colleghiamo al nostro database
  $disco = new Disco($db);                                // creiamo un nuovo oggetto disco
  $data = json_decode(file_get_contents("php://input"));  // decodifichiamo il dato JSON ricevuto 

  if(!empty($data->NRcatalogo) && !empty($data->Titolo) && !empty($data->Genere) && !empty($data->Interprete) && !empty($data->Etichetta))
  {
    $disco->setNRcatalogo($data->NRcatalogo);
    $disco->setTitolo($data->Titolo);
    $disco->setGenere($data->Genere);
    $disco->setInterprete($data->Interprete);
    $disco->setEtichetta($data->Etichetta);
    $result = $disco->create();
    if($result){                               // 201 Creazione completa       
      http_response_code(201);
      echo json_encode(array("message" => "Disco creato correttamente."));
    }
    else {                                     // 503 Servizio non disponibile        
      http_response_code(503);
      echo json_encode(array("message" => "Impossibile creare il disco."));
    } 
  }
  else{                                        // 400 Bad request
    http_response_code(400);
    echo json_encode(array("message" => "Impossibile creare il disco, i dati sono incompleti."));
  }
?>

