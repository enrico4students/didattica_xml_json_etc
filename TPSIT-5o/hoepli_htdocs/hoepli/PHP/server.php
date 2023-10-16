<?php
// svuota il buffer di output 
ob_end_clean();  
echo "<B>Esecuzione socket server</B><HR>";
if (!extension_loaded('sockets')) {
    die('Non risulta caricata lestensione per i sockets.');
}

// setto il timeout disabilitando il blocco dello script  
set_time_limit(0);

/* abilita lo scarico dell'output così si è in grado di vedere cosa passa
 * non appena arrivano i dati al server. */
ob_implicit_flush();

// apro il file da creare in scrittura
if(!($file=@fopen("./programmi/DA_INVIARE.TXT_ricevuto","w"))){
  echo "Errore di apertura file.<BR>";
  exit;
}
else
  echo "Ho aperto il file dove scrivere quello che invierà il client<BR>";

// creo il socket con 3 parametri :
// famiglia del protocollo, tipo di comunicazione, protocollo per quel dominio
if(!($socket=socket_create(AF_INET, SOCK_STREAM, SOL_TCP))){
  echo socket_strerror(socket_last_error($socket));
  exit;
}
echo "<BR>a) socket creato";

// configurare socket, timeout in lettura o scrittura e riutilizzo indirizzo
if(!(socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR,1))){
  echo socket_strerror(socket_last_error($socket));
  exit;
}

// definizione indirizzo IP e porta TCP del server
$indirizzo = '127.0.0.1';
$porta = 10000;
// associo l'IP address e il port al socket
if(!(socket_bind($socket,$indirizzo,$porta))){ 
  echo socket_strerror(socket_last_error($socket));
  exit;
}
echo "<BR>b) creo il socket";

// il server è in listening (ascolto) sul socket
if(!(socket_listen($socket))){ 
  echo socket_strerror(socket_last_error($socket));
  exit;
}
echo "<BR>c) sono in ascolto su 1000";

// ciclo infinito di attesa della richiesta di connessione di un client
// termina quando incontrerà la stringa di fine invio
while(true){
  // controllo che arrivi una richiesta del client (funzione bloccante)
  if(!($client=socket_accept($socket))){ 
    echo socket_strerror(socket_last_error($socket));
    exit;
  }
  // get_peername restituisce l'indirizzo del client che si è connesso
  if(!(socket_getpeername($client,$ind))){ 
    echo socket_strerror(socket_last_error($socket));
    exit;
  }
}
  echo "<BR>d) si e' connesso il client:".$ind;
  do{
  // leggo dal socket 1024 Byte
  if(!($ricevo=socket_read($client, 1024, PHP_BINARY_READ))){
    echo socket_strerror(socket_last_error($socket));
    exit;
  }
  echo "<BR>e) inizio ricezione del file: ";
  // ciclo di lettura dal socket e scrittura nel file 
  // termina quando riceve messaggio di fine trasmissione 
    // scrivo nel file i 1024 byte ricevuti dal socket
    if(!(fwrite($file,$ricevo,1024))){
      echo socket_strerror(socket_last_error($socket));
    }
    else{
      // restituzione messaggio di conferma al client
      if(!(socket_write($client,"FILE RICEVUTO CORRETTAMENTE!"))){
        echo socket_strerror(socket_last_error($socket));
      }
      // necessaria lettura socket successivo
      if( !($rcv=socket_read($client, 1024, PHP_BINARY_READ))){
        echo socket_strerror(socket_last_error($socket));
      }
    }
  } while($ricevo!="//FINEFILE//");
  echo "<BR>f) chiusura connessione!" ;
  socket_close($client);
//  break;
//}
echo "<BR>g) chiusura socket<BR>";
// chiusura socket e file
fclose($file);
socket_close($socket); 
echo "<HR>Termine operazioni del server<BR>";
?>

