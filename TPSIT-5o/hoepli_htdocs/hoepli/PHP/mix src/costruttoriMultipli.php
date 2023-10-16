<?php
 
class MyTime
{
  private $timestamp;
 
  public function __construct()
  {
    if (0 === func_num_args()) {                  // costruttore senza parametri
      $this->timestamp = time();
      } else if (1 === func_num_args()) {
        if (is_numeric(func_get_arg(0))) {        // costruttore con il timestamp
          $this->timestamp = func_get_arg(0);
        } else {                                  // costruttore con mese, giorno e anno
          $date = new DateTime(func_get_arg(0));
          $this->timestamp = $date->getTimestamp();
        }
      } else if (3 === func_num_args()) {         // costruttore con giorno, mese e anno
        $this->timestamp = mktime(0, 0, 0, func_get_arg(1), func_get_arg(0), func_get_arg(2));
    }
 
    if (null === $this->timestamp) {              // gestione errori per costruttore non supportato
      echo ('Parametri non supportati per il costruttore');
    }
  }
 
  /**
   *  Metodi che eseguono azioni
  */
  public  function fromString($string)
  {
    $date = new DateTime($string);
    $this->$timestamp = $date->getTimestamp();
    return $time;
  }
 
  public static function now()
  {
    $time->timestamp = time();
    return $time;
  }
    
  public function get()
  {
    return $this->timestamp;
  }

}
 
$data1 = new MyTime();             // timestamp impostato al momento corrente
echo 'Data corrente 1:      ', $data1->get(),'<BR>';
sleep(2);
$data1 = new MyTime();             // timestamp impostato al momento corrente
echo 'Data corrente 1:      ', $data1->get(),'<BR>';

$data2 = new MyTime(1577487600);   // timestamp impostato al 28 dicembre 2019
echo 'Data corrente 2:      ', $data2->get(),'<BR>';
$data3 = new MyTime('12/28/2019'); // timestamp impostato al 28 dicembre 2019
echo 'Data corrente 3:      ', $data3->get(),'<BR>';
$data4 = new MyTime(28, 12, 2019);   // timestamp impostato al 28 dicembre 2019
echo 'Data corrente 4:      ', $data4->get(),'<BR>';
sleep(1);
$data5 = new MyTime(9, 3);         // errore