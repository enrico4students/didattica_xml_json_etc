<?php
// Access-Control-Allow-Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/libro.php';
$database = new Database();
$db = $database->getConnection();
$libro = new Libro($db);
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->ISBN) && !empty($data->Titolo) && !empty($data->Nome_Autore) && !empty($data->Cognome_Autore) && !empty($data->Editore))
{
  $libro->setISBN($data->ISBN);
  $libro->setTitolo($data->Titolo);
  $libro->setNomeAutore($data->Nome_Autore);
  $libro->setCognomeAutore($data->Cognome_Autore);
  $libro->setEditore($data->Editore);

  $result = $libro->create();
  if($result){     // 201 Creazione completa       
    http_response_code(201);
    echo json_encode(array("message" => "Libro creato correttamente."));
  }
  else {            // 503 Servizio non disponibile        
    http_response_code(503);
    echo json_encode(array("message" => "Impossibile creare il libro."));
  }
}
else{                 // 400 Bad request
  http_response_code(400);
  echo json_encode(array("message" => "Impossibile creare il libro, i dati sono incompleti."));
}
?>

