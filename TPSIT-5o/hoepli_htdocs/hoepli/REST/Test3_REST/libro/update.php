<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../models/libro.php';

$database = new Database();
$db = $database->getConnection();
$libro = new Libro($db);
$data = json_decode(file_get_contents("php://input"));

$libro->setISBN($data->ISBN);
$libro->setTitolo($data->Titolo);
$libro->setNomeAutore($data->Nome_Autore);
$libro->setCognomeAutore($data->Cognome_Autore);
$libro->setEditore($data->Editore);

if($libro->update()){
  http_response_code(200);
  echo json_encode(array("risposta" => "Libro aggiornato"));
}
else{
  //503 Servizio non disponibile
  http_response_code(503);
  echo json_encode(array("risposta" => "Impossibile aggiornare il libro"));
}
?>

