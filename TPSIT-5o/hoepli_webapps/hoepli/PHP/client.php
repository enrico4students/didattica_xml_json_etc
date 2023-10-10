<?php
//Disabilito il blocco dello script 
set_time_limit(0); 
echo "<B>Esecuzione socket client</B><HR>";
//Apro il file da inviare e controllo se esiste
if(!($file=@fopen("./programmi/PIPPO.TXT","r"))){
  echo "ERRORE DI APERTURA FILE<BR>";
  exit;
}
else
  echo "APERTURA FILE pippo.txt<BR>";

//Definizione indirizzo IP e port TCP del server
$indirizzo='127.0.0.1';
$porta=10000;
//Definizione Array associativo con tali informazioni
$server=array('indirizzoIP'=>$indirizzo,'port'=>$porta);
//Creo il socket con 3 parametri 
//famiglia del protocollo, tipo di comunicazione, protocollo per quel dominio
if(!($socket=@socket_create(AF_INET, SOCK_STREAM, SOL_TCP))){
  echo socket_strerror(socket_last_error($socket));
  exit;
}

//Connessione al server e verifica errore eventuale
if(!($conn=@socket_connect($socket,$server['indirizzoIP'],$server['port']))){
  //Stampa codice errore
  echo socket_strerror(socket_last_error($socket));
  exit;
}
echo "CARICO IL FILE SUL SERVER<BR>";
//Ciclo che carica il file ./programmi/PIPPO.TXT sul server 1KB per volta
do{
  //Verifico se il file è finito
  if(feof($file)){
      echo "INVIO COMPLETATO...<BR><BR>";
      //Invio al server di un messaggio speciale che indica la fine dell'invio
      socket_write($socket,"//FINEFILE//");
      //Necessario per uscire dal ciclo
      break;
   }
   //Leggo 1024Byte dal file con controllo eventuale errore 
   if(!($blocco=@fread($file,1024))){
      echo socket_strerror(socket_last_error($socket));
      exit;
   }
   //Scrivo sul socket quanto letto dal file con controllo errore 
   if(!(@socket_write($socket,$blocco,1024))){
      echo socket_strerror(socket_last_error($socket));
      exit;
   }
   //Leggo dato restituito dal server per verifica corretto invio 
   if(!($ricevuto=@socket_read($socket,1024))){
      echo socket_strerror(socket_last_error($socket));
      exit;
   }
   echo "<BR>Messaggio dal server: ".$ricevuto."<BR>";
}while(true);
echo "Termine INVIO<BR>";
fclose($file);
socket_close($socket);
?>
