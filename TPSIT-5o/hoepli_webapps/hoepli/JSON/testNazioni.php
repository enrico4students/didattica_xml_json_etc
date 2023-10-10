<?php
// definizione MIME per JSON
header('Content-type: application/json');
// leggiamoil parametro passato 
$id = $_GET['nomeNazionale'];
// creiamo un array e lo ritorniamo al chiamante
$data = array("vittorie", $id);
// Send the data.
echo json_encode($data);
?>
