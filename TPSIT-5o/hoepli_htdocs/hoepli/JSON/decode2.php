<?php
// definizione dell'oggetto per il parsing
$mesi = '{"gennaio":1,"febbraio":2,"marzo":3,"aprile":4}';
echo "visualizza con la funzione var_dump() con opzione TRUE in modo da ottere un array associativo<p>"; 
var_dump(json_decode($mesi, true));
echo "<p>"; 

// lettura dello stream JSON
echo "<p>decodifica a visualizza tutto l'array :"; 
$arrayAss = json_decode($mesi, true);
print_r($arrayAss);

echo "<p>legge il singolo dato con chiave marzo :"; 
echo $arrayAss['marzo'];
?>

