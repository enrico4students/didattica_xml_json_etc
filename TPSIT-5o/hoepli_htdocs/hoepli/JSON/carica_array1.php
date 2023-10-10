<?php
/* settaggio del tipo di docuemnto a text/javascript invece che text/html */
header("Content-type: text/javascript");
/* definiamo con php un array multidimensionale da ritornare a javascript  mediante ajax */
$risultato = array(
        "vittorie" => "4",  
        array(
               "nome" => "Paolo",
               "cognome" => "Camagni",
               "anni" => "34",
               "email" => "paolo@camagni.it",
			   "vittorie" => "2"
        ),
        array(
               "nome" => "Riccardo",
               "cognome" => "Nikolassy",
               "anni" => "33",
               "email" => "riky@niko.it",
			   "vittorie" => "1"
        )
);
/* encode con json produce la seguente stringa: 
[{"nome":"Paolo","cognome":"Camagni","anni":"34","email":"paolo@camagni.it"},
{"nome":"Riccardo","cognome":"Nikolassy","anni":"33","email":"riky@niko.it"}]
*/
echo json_encode($risultato);
?>
