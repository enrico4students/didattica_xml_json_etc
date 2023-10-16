<?php
//Disabilito il blocco dello script 
set_time_limit(0); 
echo "<B>Esecuzione socket client invio file</B><HR>";
//Apro il file da inviare e controllo se esiste
if(!($file=@fopen("./dati/fileViaSocket.txt","r"))){
  echo "ERRORE DI APERTURA FILE<BR>";
  exit;
}
else
  echo "APERTURA FILE fileViaSocket.txt<BR>";

// definisco indirizzo IP e port TCP del server
$indirizzo='127.0.0.1';
$porta=10000;

// creo il socket con 3 parametri 
// famiglia del protocollo, tipo di comunicazione, protocollo per quel dominio
if(!($socket=@socket_create(AF_INET, SOCK_STREAM, SOL_TCP))){
  echo socket_strerror(socket_last_error($socket));
  exit;
}
// connessione al server e verifica errore eventuale
if(!($conn=@socket_connect($socket,$indirizzo,$porta))){
  echo socket_strerror(socket_last_error($socket));
  exit;
}

echo "CARICO IL FILE SUL SERVER<BR>";
// ciclo che carica il file sul server 1KB per volta
do{
  // verifico se il file è finito
  if(feof($file)){
      echo "INVIO COMPLETATO...<BR>";
      // invio al server di un messaggio speciale che indica la fine dell'invio
      socket_write($socket,"//FINEFILE//");
      //Necessario per uscire dal ciclo
      break;
   }
   // leggo 1024Byte dal file con controllo eventuale errore 
   if(!($blocco=@fread($file,1024))){
      echo socket_strerror(socket_last_error($socket));
      exit;
   }
   // scrivo sul socket quanto letto dal file con controllo errore 
   if(!(@socket_write($socket,$blocco,1024))){
      echo socket_strerror(socket_last_error($socket));
      exit;
   }
}while(true);

 // leggo dato restituito dal server per verifica corretto invio 
 if(!($ricevuto=@socket_read($socket,1024))){
    echo socket_strerror(socket_last_error($socket));
    exit;
 }
 echo "Messaggio dal server: ".$ricevuto."<BR>";
 fclose($file);
 socket_close($socket);
 echo "<HR>Termine comunicazione<BR>";
?>
