<?php
 
  $nomefile = "accessi.txt";          // nome de file da aprire
  $idfile = fopen($nomefile, "r+");   // tentativo di apertura file 
  if (!$idfile) die ($msg = "il file &nomefile non è stato aperto <BR>");


    // se il file viene aperto si leggono dieci caratteri e messi in $conta_accessi
    $conta_accessi = (int)fread($idfile, 10);     // il casting da stringa in intero
    fclose($idfile);                              // chiusura file
  }
  

mail($destinatario, $oggetto, $testo);

mail($destinatario, $oggetto, $testo) or die ("spedizione non avvenuta");

$destinatario ='amico@mail.it';
$oggetto      ='Testing di mail()';
$testo        ='Ciao come stai?\nprova di invio mail!\nSaluti!';
$mittente     ='io@mail.it';
mail($destinatario, $oggetto, $testo, "$from\r\nX-Priority: 1 (Highest)");

mail($destinatario, $oggetto, $testo, "From: io@mail.it\r\n"
."Reply-To: io@mail.it\\r\n"
."X-Mailer: PHP/".phpversion());



$testo = "<html><head>
<title>Messaggio ai lettori</title>
</head><body>
Caro lettore, cosa ne pensi di questo libro? Saluti, Mario Rossi.
</body></html>";
$dest="indirizzo_1@email.com";
$oggetto ="Feedback";
// impostare intestazione Content type
$header = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
$header .= "From: MarioRossi <mariorossi@hoepli.it>\r\n";
$header .= "Cc: indirizzo_2@email.com \r\n";
$header .= "Bcc: indirizzo_3@email.com \r\n";
mail($dest, $oggetto, $testo, $header);

[mail function]
; For Win32 only.
SMTP = localhost
; For Win32 only.
sendmail_from = me@localhost.com
; For Unix only. You may supply arguments as well (default: 'sendmail -t -i').
;sendmail_path =


socket_accept 		 // Accetta una connessione su un socket
socket_bind 		 // Bind di un nome ad un socket
socket_clear_error	 // Azzera gli errori di un socket, oppure l'ultimo codice d'errore
socket_close		 // Chiude una risorsa di tipo socket
socket_connect		 // Inizia una connessione su un socket
socket_create_listen // Apre un socket per accettare connessioni su una porta
socket_create_pair	 // Crea una coppia di socket e li memorizza in una matrice
socket_create		 // Crea un socket (punto terminale di una comunicazione).
socket_get_option	 // Ottiene le opzioni per un socket
socket_getpeername	 // Interroga il lato remoto di un dato socket per ottenere o la
				     // combinazione host/porta od un percorso Unix, in base al tipo di socket
socket_getsockname	 // Interroga il lato locale di un dato socket e restituisce o la
				     // combinazione host/porta oppure un percorso Unix in base al tipo di socket 
socket_last_error	 // Restituisce l'ultimo errore su un socket.
socket_listen		 // Attende una richiesta di connessione su un socket
socket_read			 // Legge fino ad un massimo di byte predefiniti da un socket
socket_recv			 // Riceve i dati da un socket collegato
socket_recvfrom		 // Riceve i dati da un socket, che sia connesso o meno
socket_select	 	 // Esegue la system call select() su un set di socket con un dato timeout
socket_send			 // Invia i dati ad un socket collegato
socket_sendto		 // Invia un messaggio ad un socket, a prescindere che sia connesso o meno
socket_set_block	 // Sets blocking mode on a socket resource
socket_set_nonblock	 // Attiva la modalità "nonblocking" per il descrittore di file fd
socket_set_option	 // Valorizza le opzioni per un socket
socket_shutdown		 // Chiude un socket in ricezione, in invio o in entrambi i sensi
socket_strerror		 // Restituisce una stringa con la descrizione dell'errore.
socket_write		 // Scrive su un socket.

?>
