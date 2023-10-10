<?php                       // spedisce una password casuale ad un cliente per email 
 function passwordCasuale($lunghezza){
   $setCaratteri ="ABCDEFGHKLMNPQRSTUVWXYZabcdefghkmnpqrstuvwxyz23456789";
   $password = "";
   for($i = 0; $i < $lunghezza; $i++){
     $password = $password.substr($setCaratteri,rand(0,strlen($setCaratteri)-1),1);
   }
   return $password;
 }
 // costanti e parametri 
 $pswLunga     = 6;                      // lunghezza della password da generare
 $acapo        = "\n"; 
 $saltaRiga    = "\n\n"; 
 // intestazioni e dati mittente
 $mittente     = "angelo<angelo@rossi.it>".$saltaRiga;
 $intestazioni = "From:".$mittente;  
 // dati destinatario 
 $cognomeok    = "Verdi";
 $nomeok       = "Paolo";
 $destinatario = "paolo@istruzione.it"; 
 $destinatario = "root@localhost"; 
 // dati messaggio  
 $password     = passwordCasuale($pswLunga);
 $oggetto      = "Recupero dati iscrizione al sito rossi.it "; 
 $messaggio    = "Carissimo cliente: ".$cognomeok." ".$nomeok.$acapo; 
 $messaggio   .= "ti allego la nuova password: ".$password.$saltaRiga ;
 $messaggio   .= "Puoi accedere dal seguente indirizzo: www.rossi.it/login.php".$acapo;
 $messaggio   .= "Cordialmente".$saltaRiga."Angelo Rossi".$acapo;
 //--------------------------------------------------------------------------------
 echo "<HR>Programma di generazione password.<HR>";
 $x = mail($destinatario, $oggetto, $messaggio, $intestazioni); // invio della mail
 if ($x == 1){
   echo "<HR>Mail inviata correttamente !<HR>";
 }
 else{
   echo "<HR>Errore nell'invio della mail! !<HR>";
 }

echo "<a href='".$_SERVER['PHP_SELF']."'>Torna allo script</A>"; 
echo "<HR><a href='../index.html'>Torna al'indice</A>"; 
?>
 