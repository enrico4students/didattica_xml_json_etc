<?php  
 function mailPsw($destinatario, $oggetto, $messaggio, $mittente)
 {
  require_once '../lib/lib/swift_required.php';
  // Create the Transport
  //  $transport = Swift_SmtpTransport::newInstance('81.29.148.137', 25)
   $transport = Swift_SmtpTransport::newInstance('127.0.0.1', 25)
  ->setUsername('angelo@rossi.it')
  ->setPassword('12345')
  ;
  // Create the Mailer using your created Transport
  $mailer = Swift_Mailer::newInstance($transport);
  // Create a message
  $message = Swift_Message::newInstance($oggetto)
  ->setFrom(array('angelo@rossi.it' => 'Angelo Rossi'))
  ->setTo(array($destinatario => 'Paolo'))
  ->setBody($messaggio)
  ;
  // Send the message
  $result = $mailer->send($message);
 }
 
 //spedire la password per e-mail
 $cognomeok	  = "Prova";
 $nomeok	    = "paolo";
 $password	  = "xxkk-provaMAil-xxkk";
 
 //------------------------------------------------------------------------------------ 
 $oggetto      = "Recupero dati iscrizione al sito rossi.it"; 
 $messaggio    = "Carissimo cliente :".$cognomeok." ".$nomeok."\n"; 
 $messaggio   .= "ti allego la nuova password: ".$password."\n\n";
 $messaggio   .= "Puoi accedere dal seguente indirizzo: www.rossi.it/public/login.php\n";
 $messaggio   .= "Cordialmente\n\n";
 $messaggio   .= "Angelo Aredi\n";
  
 //--------------------------------------------------------------------------------------
 $newLine 	   = "\r\n"; 
 $nameto 	     = "a Paolo";  
 $destinatario = "paolo@asimas.it"; 
 $mittente   	 = "angelo<angelo@rossi.it>".$newLine;
 $namefrom 	   = "angelo"; 
 mailPsw($destinatario, $oggetto, $messaggio, $mittente);
 echo 'ok';
?>
  