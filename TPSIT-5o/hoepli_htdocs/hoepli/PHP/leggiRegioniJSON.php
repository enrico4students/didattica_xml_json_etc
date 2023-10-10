<!DOCTYPE html>
<html lang="it">
<head>
<title>Lettura file JSON</title>
</head>
<body>
<h2>Lettura file formato JSON</h2>
<?php
  $nomefile = "../JSON/dati/regioni.json";   // nome del file dove sono memorizzati i dati 
  if (file_exists($nomefile)){               // verifica dell'esistenza del file
    $idfile = fopen($nomefile, "r+");        // se esiste viene aperto in lettura
    // se non si riesce ad aprirlo viene creato un messaggio di errore
    if (!$idfile) 
      die ($msg = "il file &nomefile non e'stato aperto <BR>");
    // se il file viene aperto si leggono 100 caratteri e messi in $regioni
    $regioni = fread($idfile, 100);          // leggo tutti i caratteri 
    fclose($idfile);                         // chiusura file
  }
  else{ 
    // se il file non esiste viene creato messaggio errore 
    die ($msg = "il file  $nomefile non e' presente <BR>"); 
  } 
  // visualizzazione dei dati e loro analisi
  echo ("<p> Lettura file  $nomefile OK </p>");
  echo ("<h4><p>a) visualizzazione come file di testo:</p></h4>");
  echo ($regioni);
  // lo trasformiamo in un oggetto 
  $oggetto = json_decode($regioni);
  echo "<h4><p>b) visualizzazione con la funzione var_dump()</p></h4>"; 
  var_dump($oggetto);
  echo "<p><p>"; 
  // analisi oggetto 
  echo "<h4><p>c) analisi dell'oggetto: legge il singolo dato con chiave Veneto :</h4>"; 
  echo $oggetto->{'Veneto'};
  echo "</p>"; 
 ?>

<?php
  echo ('<p><a href=index.html><img src=../images/return.gif  width=41 height=30 align=right border=0></a></font></p>');
 ?>