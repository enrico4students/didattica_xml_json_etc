<?php
function leggiDirectory($dir){
  $fileTrovati= array();
  // apro la cartella che deve essere letta
  $aperturaPercorso = opendir($dir);
  // scorro tutti i file presenti nella cartella e li inserisco nell'array
  while ($file = readdir($aperturaPercorso)){
    if(is_file($dir.$file)){
      array_push($fileTrovati,$file);
    }
  }
  // chiudo la cartella che ho letto
  $aperturaPercorso = closedir($aperturaPercorso);
  // ritorno l'array con tutti i file
  return $fileTrovati;
} 

// scelta operazione da eseguire: tecnica PostBack  
if (!isset($_POST['invia'])){
  // viene mostrato il form
  echo "<FORM ACTION='".$_SERVER['PHP_SELF']."' ENCTYPE='multipart/form-data' METHOD='post'>";
  echo "<B>Caricamento di una immagine nella cartella c:\www\</B><br><br>";
  echo "<INPUT TYPE='file' NAME='file_caricato'>";
  echo "<INPUT TYPE='submit' value='Upload file' NAME='invia'>";
  echo "</FORM>";
}
else{
  //trasferisco il tipo, il percorso completo e il nome del file in 3 variabili di comodo
  $percorso ="C:/www/";
  $f=$_FILES['file_caricato']['type'];
  $nome=$_FILES['file_caricato']['name'];
  $nome_tmp=$_FILES['file_caricato']['tmp_name'];
  //verifico il tipo di file, se si tratta di un'immagine (jpg, gif o png)
  if (($f=="image/jpeg")||($f=="image/gif")||($f=="image/png"))   {
    // con move_uploaded_file il file viene caricato dal client al server 
    // nel percorso specificato come secondo parametro
    move_uploaded_file($nome_tmp,$percorso.$nome);
  } 
  else{ 
    // se tipo file non consentito
    echo "Estensione non consentita";
  }
  // leggo i file presenti nella directory
  $fileContenuti = leggiDirectory($percorso);
  // stampa direttamente il contenuto dell'array
  echo "<strong>contenuto dell'array \$fileContenuti</strong><br>";
  print_r($fileContenuti);
  echo "<br><br><strong>\nFile presenti nella directory: {$percorso} </strong><br><ul>";
  // "cicla" tutti gli elementi dell'array, li visualzza e crea un link 
  foreach ($fileContenuti as $file) {
    echo "<li><a href={$percorso}{$file}>{$file}</a>";
  }
  echo "</ul>\n";
?>

<?php
 echo ('<p><a href=index.html><img src=../images/return.gif  width=41 height=30 align=right border=0></a></font></p>');
}
?>

 

