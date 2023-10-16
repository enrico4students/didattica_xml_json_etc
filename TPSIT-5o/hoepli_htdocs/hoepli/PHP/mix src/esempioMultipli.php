<?php
class Frutta 
{ 
    function __construct() {        // costruttore multivalore 
        $arg = func_get_args();     // elenco argomenti
        $num = func_num_args();     // numero di argomenti 
        if (method_exists($this,$f='__construct'.$num)) { 
            call_user_func_array(array($this,$f),$arg); 
        } 
    } 
    
    function __construct1($a1){ 
        echo('<br>Chiamato costruttore con un parametro: '.$a1.PHP_EOL); 
    } 
    
    function __construct2($a1,$a2){ 
        echo('<br>Chiamato costruttore con due parametri: '.$a1.','.$a2.PHP_EOL); 
    } 
    
    function __construct3($a1,$a2,$a3){ 
        echo('<br>Chiamato costruttore con tre parametri: '.$a1.','.$a2.','.$a3.PHP_EOL); 
    } 
} 
$oggetto1 = new Frutta('banana'); 
$oggetto2 = new Frutta('banana','mela'); 
$oggetto3 = new Frutta('banana','mela','pesca'); 
?>
