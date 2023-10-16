<?php
  // require file che contiene la classe 
  require_once("carrello.php");
  // istanza oggetto di classe Carrello
  $acquisti = new Carrello;
  // invocazione metodo aggiungi_carrello con diversi prodotti
  echo "<HR>Aggiungo alcuni prodotti<BR>";
  $acquisti->aggiungi_carrello("tempera",5);
  $acquisti->aggiungi_carrello("pennello",15);
  $acquisti->aggiungi_carrello("tempera",3);
  $acquisti->aggiungi_carrello("fogliA4",999);
  $acquisti->stampa();
  echo "<HR>Cancello prodotto fogliA4<BR>";
  $acquisti->togli_carrello("fogliA4");
  $acquisti->stampa();
  echo "<HR>Modifico prodotto pennello<BR>";
  $acquisti->aggiorna("pennello",132);
  $acquisti->stampa();

  // creazione con costruttore
  echo "<HR>Creo nuovo carrello <BR>";
  $acquisti1 = new Carrello("tempera",5);
  $acquisti1->stampa();

?>

