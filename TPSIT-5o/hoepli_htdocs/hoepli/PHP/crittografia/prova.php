<?php 
//Inclusione classe Crittografia presente nel file cripto.php
require_once 'cripto.php';
//Lettura campi POST dal form di index,html
$chiave = $_GET['chiave'];
$txt = $_GET['stringa'];
//Istanza di un oggetto $blowfish di classe Crittografia
$blowfish = new Crittografia($chiave);
//Invocazione metodo cifratura per ottenere il testo cifrato
$txt_cifrato = $blowfish->cifratura($txt);
//Stampa risultati 
echo "Testo cifrato:<BR>".$txt_cifrato."<BR><HR>";
echo "Testo decifrato:<BR>".$blowfish->decifratura($txt_cifrato)."";
?>