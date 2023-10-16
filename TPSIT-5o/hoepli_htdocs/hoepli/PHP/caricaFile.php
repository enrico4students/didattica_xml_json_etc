<?php 
if (!isset($_POST['invia'])){      //verifica campo - tecnica POSTBACK  
  //viene mostrato il form
  echo "<FORM ACTION='".$_SERVER['PHP_SELF']."' ENCTYPE='multipart/form-data' METHOD='post'>";
  echo "<INPUT TYPE='file' NAME='file_caricato'>";
  echo "<INPUT TYPE='submit' value='Upload file' NAME='invia'>";
  echo "</FORM>";
}
else{
  //metto il tipo, il percorso completo e il nome del file in 3 variabili di comodo
  $tipo=$_FILES['file_caricato']['type'];
  $nome=$_FILES['file_caricato']['name'];
  $nome_tmp=$_FILES['file_caricato']['tmp_name'];
  //verifico il tipo di file, se si tratta di un'immagine (jpg, gif o png)
  if (($tipo=="image/jpeg")||($tipo=="image/gif")||($tipo=="image/png")){
      // il file verrà caricato dal client al server nel percorso specificato 
    move_uploaded_file($nome_tmp,"C:/WWW/$nome");
    echo "il file è stato caricato correttamente!";
  } 
  else{   // se tipo file non consentito 
    echo "File con estensione non consentita";
  }
}



 echo ('<p><a href=index.html><img src=../images/return.gif  width=41 height=30 align=right border=0></a></font></p>');

?>