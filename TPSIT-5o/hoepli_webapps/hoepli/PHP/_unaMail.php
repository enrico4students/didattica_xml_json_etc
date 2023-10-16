
<?php  
 
 //spedire la password per e-mail
 $cognomeok   = "Prova";
 $nomeok      = "paolo";
 $password    = "xxkk-provaMAil-xxkk";
 
 //------------------------------------------------------------------------------------ 
 $oggetto      = "Recupero dati iscrizione al sito rossi.it"; 
 $messaggio    = "Carissimo cliente: ".$cognomeok." ".$nomeok."\n"; 
 $messaggio   .= "ti allego la nuova password: ".$password."\n\n";
 $messaggio   .= "Puoi accedere dal seguente indirizzo: www.rossi.it/public/login.php\n";
 $messaggio   .= "Cordialmente\n\n";
 $messaggio   .= "Angelo Rossi\n";
  //--------------------------------------------------------------------------------------
 $newLine      = "\r\n"; 
 $nameto       = "a Paolo";  
 $destinatario = "paolo@asimas.it"; 
 $mittente     = "angelo<angelo@rossi.it>".$newLine;
 $namefrom     = "angelo"; 

 //mailPsw($destinatario, $oggetto, $messaggio, $mittente);
 $intestazioni = "From:mittente@hoepli.com \r\nReply To: mittente@hoepli.com";
 
 $x = mail($destinatario, $oggetto, $messaggio, $intestazioni);    // invio effettivo della mail

 echo "<HR>Mail inviata correttamente !<HR>";
 echo "<a href='".$_SERVER['PHP_SELF']."'>Torna allo script</A>";
?>
  