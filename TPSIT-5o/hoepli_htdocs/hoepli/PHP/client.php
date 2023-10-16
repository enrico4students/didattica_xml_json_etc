<?php
// non terminare/uscire mentre attende una connessione 
error_reporting(E_ALL);  
// disabilito il blocco dello script 
set_time_limit(0); 
// abilita lo scarico dell'output
ob_implicit_flush();

echo "<B>Esecuzione socket client</B><HR>";
// apro il file da inviare e controllo se esiste
if(!($file=@fopen("./programmi/DA_INVIARE.TXT","r"))){
  echo "ERRORE DI APERTURA FILE<BR>";
  exit;
}

echo "<BR>a) apertura file DA_INVIARE.TXT";
// definizione indirizzo IP e port TCP del server
$indirizzo = '127.0.0.1';
$porta = 10000;
// definizione Array associativo con tali informazioni
$server=array('indirizzoIP'=>$indirizzo,'port'=>$porta);

// creo il socket con 3 parametri 
// famiglia del protocollo, tipo di comunicazione, protocollo per quel dominio
if(!($socket=@socket_create(AF_INET, SOCK_STREAM, SOL_TCP))){
  echo socket_strerror(socket_last_error($socket));
  exit;
}

echo "<BR>b) attesa connessione al server indirizzo:$indirizzo porta:$porta";
// connessione al server e verifica errore eventuale
if(!($conn=@socket_connect($socket,$server['indirizzoIP'],$server['port']))){
  // stampa codice errore
  echo socket_strerror(socket_last_error($socket));
  exit;
}

echo "<BR>c) carico il file sul server:";
// ciclo che carica il file ./programmi/DA_INVIARE.TXT sul server 1KB per volta
do{
  // leggo 1024Byte dal file con controllo eventuale errore 
  if(!($blocco=@fread($file,1024))){
    echo socket_strerror(socket_last_error($socket));
    echo "<BR>1 ";
    exit;
  }
  else {
    // scrivo sul socket quanto letto dal file con controllo errore 
    if(!(@socket_write($socket,$blocco,1024))){
      echo socket_strerror(socket_last_error($socket));
      echo "<BR>2 ";
      exit;
    }
  }

}while(!feof($file));

echo "<BR>d) invio completato...";
// invio al server di un messaggio speciale che indica la fine dell'invio
socket_write($socket,"//FINEFILE//");

$ricevuto="?";
// leggo dato restituito dal server per verifica corretto invio 
if(!($ricevuto=@socket_read($socket,1024))){
  echo socket_strerror(socket_last_error($socket));
}
echo "<BR>e Messaggio dal server: ".$ricevuto;
  
echo "<BR>f) chiusura socket<BR>";
fclose($file);
socket_close($socket);
echo "<HR>Termine operazioni del client di INVIO FILE<BR>";
?>
