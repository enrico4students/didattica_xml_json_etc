<?php
  echo ('<p><a href=index.html><img src=../images/return.gif  width=41 height=30 align=right border=0></a></font></p>');
  $nomefile = "dati/regioni.json";             // nome de file dove sono memorizzati i dati 
  if (file_exists($nomefile))                  // verifica dell'esistenza del file
  { 
    $idfile = fopen($nomefile, "r+");          // se esiste gia viene aperto in lettura
    // se non si riesce ad aprirlo viene creato un messaggio di errore
    if (!$idfile) die ($msg = "il file &nomefile non è stato aperto <BR>");
    // se il file viene aperto si leggono dieci caratteri e messi in $conta_accessi
    $regioni = fread($idfile,500);             // leggo tutti i caratteri 
    fclose($idfile);                           // chiusura file
  }
  else
  { 
    // se il file non esiste viene creato nessaggio errore 
    die ($msg = "il file  $nomefile non e' presente <BR>"); 
  } 
  
  echo ("a) file JSON letto: ");
  echo ($regioni);
 
  // lettura dello stream JSON  gestito come un oggetto
  echo "<p>b) trasformato in un oggetto <p>"; 
  $oggetto = json_decode($regioni);
  echo "<p>c) lettura del singolo dato con chiave Lombardia: "; 
  echo $oggetto->{'Lombardia'};

  // trasformazione in un array 
  echo "<p><p>d) trasformato in un array associativo: "; 
  $arrayRegioni = json_decode($regioni,true) ;   //true indica che viene traformato in array associativo 
  print_r($arrayRegioni); 

  echo "<p><p>e) scomposizione in due 2 vettori e loro visualizzazione";
  $nomiRegioni = array_keys($arrayRegioni);
  $nrProvince = array_values($arrayRegioni);
  echo "<p> nomi: "; 
  print_r ($nomiRegioni);
  echo "<p> NUM : "; 
  print_r ($nrProvince);

  echo "<p>f) lettura dei singoli dati: ci sono " . count($nomiRegioni) . " regioni";
  for ($x=0; $x<count($nomiRegioni); $x++) 
    echo "<br>  ".$nomiRegioni[$x]. ': province  :'.  $arrayRegioni[$nomiRegioni[$x]] ;
  echo "<p>"; 

  // caricamento nel combo-box  
  echo "<p>g) carico in un combo box: ";
  echo '<select name="comboRegioni">';
  for ($x=0; $x<count($nomiRegioni); $x++) 
  {
   echo "<option>".$nomiRegioni[$x]."</option>";
  }
  echo "</select>";

?>
