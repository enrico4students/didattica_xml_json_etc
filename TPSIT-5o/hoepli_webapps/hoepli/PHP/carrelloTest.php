<?php
  // require file che contiene la classe 
  require_once("carrello.php");
  // istanza oggetto di classe Carrello
  $acquisti = new Carrello;
  // invocazione metodo aggiungi carrello per aggiungere alcuni prodotti
  echo "<HR>Aggiungo alcuni prodotti<BR>";
  $acquisti->aggiungi_carrello("tempera",5);
  $acquisti->aggiungi_carrello("pennello",15);
  $acquisti->aggiungi_carrello("tempera",3);
  $acquisti->aggiungi_carrello("pippo",999);
  $acquisti->stampa();
  echo "<HR>Cancello prodotto pippo<BR>";
  $acquisti->togli_carrello("pippo");
  $acquisti->stampa();
  echo "<HR>Modifico prodotto pennello<BR>";
  $acquisti->aggiorna("pennello",132);
  $acquisti->stampa();
?>

