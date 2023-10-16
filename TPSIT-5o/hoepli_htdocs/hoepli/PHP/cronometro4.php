<?php              
class Cronometro 
{
  var $inizio, $fine;
  public function Cronometro()
  {
    echo " -> si esegue costruttore stile old <br>";
    $this->azzera();
  }

  function azzera(){
    return $this->inizio = $this->fine = 0;
  }
  function vai(){
    $this->inizio += time() - $this->fine;
    return $this->fine;
  }
  function parziale(){
    return time() - $this->inizio;
  }
  function fermati(){
    return $this->fine = time() - $this->inizio;
  } 
}

//istanza di una classe Cronometro
$chrono = new Cronometro;
echo 'Vai:      ', $chrono->vai(),'<BR>';
sleep(2);
echo 'parziale: ', $chrono->parziale(),'<BR>';
sleep(2);
echo 'fermati:  ', $chrono->fermati(),'<BR>';
echo 'azzera:   ', $chrono->azzera(),'<BR>';
echo 'Vai:      ', $chrono->vai(),'<BR>';
sleep(1);
echo 'parziale: ', $chrono->parziale(),'<BR>';
sleep(2);
echo 'fermati:  ', $chrono->fermati(),'<BR>';

?>
