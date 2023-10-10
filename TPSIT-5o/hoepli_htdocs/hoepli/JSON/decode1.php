<?php
// definizione dell'oggetto per il parsing
$mesi = '{"gennaio":1,"febbraio":2,"marzo":3,"aprile":4}';
echo "visualizza con la funzione var_dump()<p>"; 
var_dump(json_decode($mesi));
echo "<p>"; 

// lettura dello stream JSON
echo "<p>legge il singolo dato con chiave aprile :"; 
$oggetto = json_decode($mesi);
echo $oggetto->{'aprile'};
?>


