<?php
function una_mail($destinatario, $oggetto, $messaggio){
  require_once '../lib/lib/swift_required.php';
  // creo una istanza di  Transport
  $transport = Swift_SmtpTransport::newInstance('81.29.148.137', 25)
   ->setUsername('angelo@aredi.it')
   ->setPassword('12345')
  ;
  // creo una istanza di mailer utilizzando come parametro transport
  $mailer = Swift_Mailer::newInstance($transport);
  // Ccreoun oggeto di tipo messaggio 
  $message = Swift_Message::newInstance($oggetto)
   ->setFrom(array('angelo@aredi.it' => 'Angelo Aredi'))
   ->setTo(array($destinatario => $destinatario))
   ->setBody($messaggio)
  ;
  // invio il messaggio 
  $result = $mailer->send($message);
}

function Invia_mail($ID_cliente, $new_ogg, $new_msg, $tutti){
  // chiamato da:
  //              circolare.php
  //              clienti1_modifica.php
  //differenza tra singolo o tutti
  if ($ID_cliente>0)
    $SQL='SELECT * FROM Clienti WHERE ID_cliente ='.$ID_cliente.';';
  else
    $SQL='SELECT * FROM Clienti ;';
  include '../public/connettiDB.php';
  $msg = "<p><H4> ... attendi: sto inviando le mail!</H4></p>";
  echo $msg;
  $rs->Open($SQL, $cn);
  $conta = 0;
  while (!$rs->EOF)  {
    $nomail =$rs->fields['invia_mail']->value; 
    if (($rs->fields['invia_mail']->value=="S") or ($tutti==1)){
      $conta++;
      //------------------------------------------------------------------------- 
      $cognomeok    = $rs->fields['cognome']->value;
      $nomeok	    = $rs->fields['nome']->value;
      $destinatario = $rs->fields['email']->value;
      //------------------------------------------------------------------------- 
      $oggetto      = $new_ogg;
      $messaggio    = "Carissimo cliente :".$cognomeok." ".$nomeok."\n"; 
      $messaggio   .= $new_msg."\n\n";
      $messaggio   .= "Cordialmente\n\n";
      $messaggio   .= "Angelo Aredi\n";
      $newLine      = "\r\n"; 
      $mittente    = "angelo<angelo@aredi.it>".$newLine;
      //echo $messaggio;
      //=========================================================================
       una_mail($destinatario, $oggetto, $messaggio);
      //=========================================================================
      // echo $destinatario."<br>";
      // echo $messaggio."<br>";
    }
    $rs->MoveNext();
  }
  //Chiusura connessioni
  $rs->Close();
  $cn->Close();
  if (($nomail =='N') AND ($conta==0))
   $msg = "<p><H4>Il cliente non e' configurato per ricevere mail!</H4></p>";
  else
    if ($conta == 1)
      $msg = "<p><H4>Ho inviato una mail a ".$cognomeok." ".$nomeok."</H4></p>";
    else 
      $msg = "<p><H4>Ho inviato $conta mail ai tuoi clienti!</H4></p>";
  //---------------------------------------------------------------------------
  $_SESSION['msg'] = $msg;
  return $conta;
}
?>