<?php
ob_end_clean();  // svuota il buffer di output 
echo "<B>Esecuzione socket server</B><HR>";
// disabilito il blocco dello script  
set_time_limit(0);
// apro il file da creare in scrittura
if(!($file=@fopen("./programmi/PIPPO.TXT_ricevuto","w"))){
  echo "Errore di apertura file.<BR>";
  exit;
}
else
  echo "Ho aperto il file dove scrivere quello che invierà il client<BR>";

// creo il socket con 3 parametri :
// famiglia del protocollo, tipo di comunicazione, protocollo per quel dominio
if(!($socket=@socket_create(AF_INET, SOCK_STREAM, SOL_TCP))){
  echo socket_strerror(socket_last_error($socket));
  exit;
}
// configurare socket, timeout in lettura o scrittura e riutilizzo indirizzo
if(!(@socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR,1))){
  echo socket_strerror(socket_last_error($socket));
  exit;
}

// definizione indirizzo IP e porta TCP del server
$indirizzo = '127.0.0.1';
$porta = 10000;
// associo l'IP address e il port al socket
if(!(@socket_bind($socket,$indirizzo,$porta))){ 
  echo socket_strerror(socket_last_error($socket));
  exit;
}
echo "CREO IL SOCKET<BR>";

// il server è in listening (ascolto) sul socket
if(!(@socket_listen($socket))){ 
  echo socket_strerror(socket_last_error($socket));
  exit;
}
echo "SONO IN ASCOLTO SU PORT 10000<BR>";

// ciclo infinito di attesa della richiesta di connessione di un client
// termina quando incontrerà la stringa di fine invio
while(true){
  // controllo che arrivi una richiesta del client (funzione bloccante)
  if(!($client=@socket_accept($socket))){ 
    echo socket_strerror(socket_last_error($socket));
    exit;
  }
  // get_peername restituisce l'indirizzo del client che si è connesso
  if(!(@socket_getpeername($client,$ind))){ 
    echo socket_strerror(socket_last_error($socket));
    exit;
  }
  echo "SI E' CONNESSO IL CLIENT:".$ind."<BR>";
  echo "HO RICEVUTO IL FILE<BR>";
  // leggo dal socket 1024 Byte
  if(!($ricevo=@socket_read($client, 1024, PHP_BINARY_READ))){
    echo socket_strerror(socket_last_error($socket));
    exit;
  }
  // ciclo di lettura dal socket e scrittura nel file 
  // termina quando riceve messaggio di fine trasmissione 
  do{
    // scrivo nel file i 1024 byte ricevuti dal socket
    if(!(@fwrite($file,$ricevo,1024))){
      echo socket_strerror(socket_last_error($socket));
      exit;
    }
    // restituzione messaggio di conferma al client
    if(!(@socket_write($client,"FILE RICEVUTO CORRETTAMENTE!"))){
      echo socket_strerror(socket_last_error($socket));
      exit;
    }
    // necessaria lettura socket successivo
    if( !($rcv=@socket_read($client, 1024, PHP_BINARY_READ))){
      echo socket_strerror(socket_last_error($socket));
      exit;
    }
  } while($ricevo!="//FINEFILE//");
  echo "CONNESSIONE EFFETTUATA";
  socket_close($client);
  break;
}
// chiusura socket e file
fclose($file);
socket_close($socket); 
?>

