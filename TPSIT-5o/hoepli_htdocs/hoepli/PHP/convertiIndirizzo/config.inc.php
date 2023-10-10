<?php
/******************
Parametri di configurazione del database
******************/
$db_host="localhost";
$db_user="root";
$db_password="";
$database1="provephp";

$db = new mysqli("localhost", "root", "", "provephp");
    // effettuo il tentativo di connessione al database 
    if (mysqli_connect_errno()) {
      echo("Connessione non effettuata: ".mysqli_connect_error()."<BR>");
      exit();
  }
/* $db = mysqli_connect($db_host, $db_user, "",$db_password);
if ($db == FALSE)
	die ("Errore nella connessione db1. Verificare i parametri nel file config.inc.php");
mysqli_select_db($database1, $db)
	or die ("Errore nella selezione del database1. Verificare i parametri nel file config.inc.php");
*/
?>