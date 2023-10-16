<?php
// definizione MIME per JSON
header('Content-type: application/json');
// leggiamoil parametro passato 
$id = $_GET['id'];
// creiamo un array e lo ritorniamo al chiamante
$data = array("ciao", $id);
// Send the data.
echo json_encode($data);
?>
