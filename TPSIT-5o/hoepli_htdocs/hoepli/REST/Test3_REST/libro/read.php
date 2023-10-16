<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../config/database.php';
include_once '../models/libro.php';

$database = new Database();           // creiamo un nuovo oggetto database 
$db = $database->getConnection();     // ci colleghiamo al nostro database
$libro = new Libro($db);              // creiamo un nuovo oggetto libro

$stmt = $libro->read();               // esecuzione della query 
$num = $stmt->rowCount();
if ( $num > 0 ){                      // se vengono trovati libri nel database
  $libri_arr = array();               // creazione di un array di libri
  $libri_arr["records"] = array();
  while ($row = $stmt->fetch (PDO::FETCH_ASSOC)){
    extract($row);
    $libro_item = array (
      "ISBN" => $ISBN,
      "Nome_Autore" => $Nome_Autore,
      "Cognome_Autore" => $Cognome_Autore,
      "Titolo" => $Titolo,
      "Editore" => $Editore
    );
    array_push($libri_arr["records"], $libro_item);
  }
  echo json_encode($libri_arr);
}
else{
  echo json_encode( array ( "message" => "Nessun Libro Trovato." ));
}
?>
