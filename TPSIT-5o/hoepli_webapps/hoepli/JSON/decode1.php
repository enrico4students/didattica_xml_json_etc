<?php
// definizione dell'oggetto per il parsing
$mesi = '{"gennaio":1,"febbraio":2,"marzo":3,"aprile":4}';
var_dump(json_decode($mesi));
echo "<p>"; 
// lettura dello stream JSON
$oggetto = json_decode($mesi);
echo $oggetto->{'aprile'};
?>


