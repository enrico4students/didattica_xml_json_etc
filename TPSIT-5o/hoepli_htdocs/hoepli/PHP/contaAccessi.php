<?php
  $nomefile = "dati/accessi.txt";           // file dove si memorizza il totale accessi
  if (file_exists($nomefile)){              // verifica dell'esistenza del file
    $idfile = fopen($nomefile, "r+");       // se esiste gia viene aperto in lettura
    // se non si riesce ad aprirlo viene creato un messaggio di errore
    if (!$idfile) 
      die ($msg = "il file &nomefile non ?stato aperto <BR>");
    // se il file viene aperto si leggono dieci caratteri e messi in $conta_accessi
    $conta_accessi = (int)fread($idfile, 10);     // il casting da stringa in intero
    fclose($idfile);                              // chiusura file
  }
  else { 
    // se il file non esiste viene creato e aperto contemporaneamente
    $idfile = fopen($nomefile, "w+");      
    if (!$idfile) 
      die ($msg = "il file &nomefile non e' stato aperto<BR>"); 
    // se il file viene aperto correttamente 
    $conta_accessi = 0;                     // si inizializza la variabile conta_accessi
    fclose($idfile);                        // chiusura del file
  } 
  
  $conta_accessi++;                         // incremento contatore di accessi  
  $idfile = fopen($nomefile, "w+");         // apertura del file in scrittura     
  if (!$idfile) 
    die ($msg = "il file &nomefile non e' stato aperto<BR>"); 
  // se il file aperto correttamente si scrive nel file del contatore di accessi
  fwrite($idfile, $conta_accessi);  
  fclose($idfile);                          // chiusura file
  echo($conta_accessi);                     // visualizza il contatore accessi  
  echo ('<p><a href=index.html><img src=../images/return.gif  width=41 height=30 align=right border=0></a></font></p>');
 ?>



 

