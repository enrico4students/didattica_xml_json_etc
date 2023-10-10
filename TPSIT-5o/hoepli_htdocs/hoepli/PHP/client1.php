<?php
// non terminare/uscire mentre attende una connessione 
error_reporting(E_ALL);  
// disabilito il blocco dello script 
set_time_limit(0); 
// abilita lo scarico dell'output
ob_implicit_flush();

echo "<h2>Client - connessione TCP/IP </h2><HR>\n";
// settaggio variabili client
$host = '127.0.0.1';
$porta = 10000;
$testo = "testo scambiato client-server";
echo "messaggio per il Server :".$testo."<BR>";

// creazione del socket
echo "a) socket creato<BR>";
$socket = socket_create(AF_INET, SOCK_STREAM, 0) 
  or die("socket non creato\n");
// connettiti al server: associo l'IP address e il port al socket
echo "b) connessione con socket del server <BR>";
if(!(@socket_connect($socket, $host, $porta))){ 
  echo socket_strerror(socket_last_error($socket));
  exit;
}

// invia stringa al server
echo "c) attesa risposta del server <BR>";
if(!(@socket_write($socket, $testo, strlen($testo)))){ 
  echo socket_strerror(socket_last_error($socket));
  exit;
}
echo "d) lettura risposta del server <BR>";
if(!($risposta =@socket_read ($socket, 1024))){ 
  echo socket_strerror(socket_last_error($socket));
  exit;
}
echo "e) risposta del server :".$risposta."<BR>";

//chiudi socket
echo "f) chiusura socket <BR>";
socket_close($socket); 
echo "<HR>Termine operazioni del client<BR>";
?>
