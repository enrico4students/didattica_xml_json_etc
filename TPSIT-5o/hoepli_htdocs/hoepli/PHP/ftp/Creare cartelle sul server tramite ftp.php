<?php
/*******************************************************
Trovate questo e altri script su http://www.manuelmarangoni.it , descritti e commentati nei dettagli.

Autore: Manuel Marangoni
Data messa online dello script: 2 luglio 2012

Lo script mostra come creare una cartella sul server tramite ftp.
Gli unici parametri occorrenti sono quelli di connessione all'ftp del server (host, user e password)
*******************************************************/ 



// Crea una cartella con i permessi di scrittura e lettura
function ftp_creadir($dirname) {
    $dirname = "public_html/".$dirname; //percorso della cartella
    $host="localhost";
    $user="username";
    $pass="password";
    $conn_id=ftp_connect($host);
    $login_result=ftp_login($conn_id, $user, $pass);
    if((!$conn_id) or (!$login_result)){
        //testo di errore
    	die;
    }
    ftp_mkdir($conn_id, $dirname); //crea la cartella
    ftp_chmod($conn_id, 0666, $dirname); //setta i permessi di scrittura e di lettura per chiunque
    ftp_quit($conn_id); //chiude la connessione ftp
}



// La funzione ftp_chmod setta i permessi di un file o una cartella tramite ftp
// Nota: questa funzione è necessaria solo nelle versione precedenti al php5. In php5 esiste già la funzione ftp_chmod, per cui questa qua sotto nel caso andrebbe eliminata
// $ftpstream è lo stream di connessione; $chmod sono i permessi; $file è la cartella scelta
function ftp_chmod($ftpstream, $chmod, $file)  {
    $old=error_reporting(); //salva in una variabile gli eventuali errori
    error_reporting(0);
    $result=ftp_site($ftpstream, "CHMOD ".$chmod." ".$file);
    error_reporting($old);
    return $result;
}


ftp_creadir("immagini"); //crea la cartella "immagini" tramite ftp, con permessi di scrittura e lettura
?>