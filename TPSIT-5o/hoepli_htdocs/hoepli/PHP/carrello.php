<?php
class Carrello
{
  // definizione dei membri articoli e quantita' come array
  var $articoli = array();
  var $quantita = array();   

/*
  // metodo costruttore con due parametri 
  function Carrello($p1, $p2){
    $this-> aggiungi_carrello($p1, $p2);
  } 
*/

public function __construct() // costruttore stile php 5-7   
  {
    echo "costruttore Carrello stile php 5-7:";
    if (0 === func_num_args()) {               // costruttore senza parametri
      echo " -> senza parametri <br>";
    } else if (2=== func_num_args()) {         // costruttore con 2 parametri
      echo " -> con 2 parametri <br>";
      $this->aggiungi_carrello (func_get_arg(0), func_get_arg(1));
    }
  }

  // metodo che aggiunge $n articoli di tipo $a al carrello
  function aggiungi_carrello($a, $q){
    //ottengo la lunghezza dell'array
    $position = count($this->articoli);
    $trovato = 0;
    //ciclo di ricerca elemento nell'array
    for ($i = 0; $i < count($this->articoli); $i++){                              
      if ($this->articoli[$i] == $a) // ctr se il prodotto e' presente nel carrello
	      $trovato = 1;
    }
    if ($trovato == 1)               // se il prodotto e' presente aggiorno quantita'
      $this->aggiorna($a,$q);
    else{                            // altrimenti aggiungo il prodotto al carrello
      $this->articoli[$position] = $a;
      $this->quantita[$position] = $q;
    }
  }
  
  // metodo che elimina l'articolo di nome $a
  function togli_carrello($a){  
    // variabile utilizzata per cercare posizione elemento: settata a non trovato (-1)
    $posizione = -1;
    // ciclo di ricerca elemento nell'array
    for ($i = 0; $i < count($this->articoli); $i++){                                  
      if ($this->articoli[$i] == $a)  // ctr se il prodotto e' presente nel carrello
	      $posizione = $i;              // se trovato salvo la posizione
    }
    if ($posizione != -1){            // se trovato procedo a toglierlo  
      $cont = 0;
	    // copia negli array temporanei gli elementi eccetto quello da cancellare
      for ($i = 0; $i < count($this->articoli); $i++){
        if ($this->articoli[$i] != $a){
          $app_ar[$cont] = $this->articoli[$i];
          $app_qt[$cont] = $this->quantita[$i];
          $cont++;
	      }
      }
	    // elimino i "vecchi" array
      unset($this->articoli);
      unset($this->quantita);
	    // rimetto i valori dagli array temporanei agli array articoli e quantita'
      for ($i = 0; $i < count($app_ar); $i++){
        $this->articoli[$i] = $app_ar[$i];
        $this->quantita[$i] = $app_qt[$i];
      }
    }
    else echo "Prodotto non trovato!<BR>";
  }

  // metodo che aggiorna l'array 
  function aggiorna($n,$q){
    $position = -1;
    for ($i = 0; $i < count($this->articoli); $i++){
      // prelevo la posizione del prodotto nell'array
      if ($this->articoli[$i] == $n) 
	      $posizione = $i;
    }
    // aggiorno le informazioni del prodotto
    if ($posizione == -1) 
      echo "Prodotto non trovato!<BR>";
    else
      $this->quantita[$posizione] = $q;
   }
  
  // metodo di stampa a video dei prodotti   
  function stampa(){
    for ($i = 0; $i < count($this->articoli); $i++){
      echo "<B>Articoli:</B> " .$this->articoli[$i] ."<BR>";
      echo "<B>Quantita':</B> " .$this->quantita[$i] ."<BR>";
    }
  }


  
}  // fine definizione classe 

// istanza creata con il costruttore al quale vengono passati due parametri
// $carrello = new Carrello("Cornice", 3);
?>


