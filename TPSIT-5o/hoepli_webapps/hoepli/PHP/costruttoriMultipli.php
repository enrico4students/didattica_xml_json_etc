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
        } else {                                  // costruttore con giorno, mese e anno
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

}
 
$data1 = new MyTime();             // timestamp impostato al momento corrente
$data2 = new MyTime(1457524800);   // timestamp impostato al 9 marzo 2016
$data3 = new MyTime('03/09/2016'); // timestamp impostato al 9 marzo 2016
$data4 = new MyTime(9, 3, 2016);   // timestamp impostato al 9 marzo 2016
$data5 = new MyTime(9, 3);         // errore