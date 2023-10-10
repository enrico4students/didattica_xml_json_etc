<?php
class Atleta {
 public $nome = "";
 public $nazione = "";
 public $sport = "";
 public $dataNascita = "";
}
$e = new Atleta();
$e->nome = "Pele";
$e->nazione = "Brasile";
$e->sport = "calcio";
$e->dataNascita = date('m-d-Y h:i:s a', strtotime("23-10-1940 12:10:03"));
echo json_encode($e);
?>

