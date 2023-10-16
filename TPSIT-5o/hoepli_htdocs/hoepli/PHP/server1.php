<?php
// non terminare/uscire mentre attende una connessione 
error_reporting(E_ALL);  
// disabilito il blocco dello script 
set_time_limit(0); 
// abilita lo scarico dell'output
ob_implicit_flush();

echo "<h2>Server - connessione TCP/IP </h2><HR>\n";
// creo il socket con 3 parametri:
// famiglia del protocollo, tipo di comunicazione, protocollo   
if(!($socket=@socket_create(AF_INET, SOCK_STREAM, SOL_TCP))){
  echo socket_strerror(socket_last_error($socket));
  exit;
}
echo "a) socket creato<BR>";
// configuro socket, timeout in lettura o scrittura e riutilizzo indirizzo
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
echo "b) in attesa di un client<BR>";
// inizio ascolto sulla connessione
if(!(@socket_listen($socket)) ){
  echo socket_strerror(socket_last_error($socket));
  exit;
}

// accetta la richiesta di connessione client e crea un apposito socket
$socketOK = socket_accept($socket) 
  or die("fallito inizializzazione attesa connessione con client \n");
echo "c) effettuata connessione al client <BR>";

// lettura input inviato dal client 
$ricevuto = socket_read($socketOK, 1024) 
  or die("errore in lettura sul socket di input\n");
echo "d) messaggio ricevuto dal client : ".$ricevuto."<BR>";

// elaborazione del testo ricevuto
$ricevuto = trim($ricevuto);
$dainviare =strtoupper($ricevuto) . "\n";  // trasforma in maiuscola 

// inoltro risposta al client
echo "e) risposta al client <BR>";
if(!(@socket_write($socketOK, $dainviare, strlen ($dainviare)))){ 
  echo socket_strerror(socket_last_error($socket));
  exit;
}

// chiusura dei sockets
echo "f) chiusura socket <BR>";
socket_close($socketOK);
socket_close($socket);
echo "<HR>Termine operazioni del server<BR>";
?>


