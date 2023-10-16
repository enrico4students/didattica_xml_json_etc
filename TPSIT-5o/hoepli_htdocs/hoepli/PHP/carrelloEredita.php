<?php 
include "Carrello.php";
class MioCarrello extends Carrello
{
  //definizione di una nuova proprietà
  var $prezzi = array();
  // metodo aggiuntivo 
  function setPrezzo($a,$p){
    //ciclo di ricerca del prodotto
    for ($i = 0; $i < count($this->articoli); $i++){
      if ($this->articoli[$i] == $a)    // verifico se è presente nel carrello 
        $this->prezzi[$i] = $p;         // salvo la posizione
    }
  }
  //metodo di stampa a video dei prodotti (sovrascrive il precedente)  
  function stampa(){
    for ($i = 0; $i < count($this->articoli); $i++){
      echo "<B>Articoli:</B> " .$this->articoli[$i] ."<BR>";
      echo "<B>Quantita':</B> " .$this->quantita[$i] ."<BR>";
      echo "<B>Prezzo:</B> " .$this->prezzi[$i] ."<BR>";
    }
  }
}

//istanzio un nuovo oggetto della nuova classe derivata
$nuovo_c = new MioCarrello;
//aggiungo un articolo
$nuovo_c->aggiungi_carrello("Acquarello", 3);
//aggiungo il prezzo all’articolo Acquarello
$nuovo_c->setPrezzo("Acquarello", 12);
$nuovo_c->stampa();
?>


