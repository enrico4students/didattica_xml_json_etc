<?php
/* settaggio del tipo di docuemnto a text/javascript invece che text/html */
header("Content-type: text/javascript");
/* definiamo con php un array multidimensionale da ritornare a javascript  mediante ajax */
$risultato = array(
        "vittorie" => "4",  
        "sconfitte" => "1"
 );

echo json_encode($risultato);
?>
