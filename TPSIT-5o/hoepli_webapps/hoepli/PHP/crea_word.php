<?php
if (isset($_POST['nomefile'])) {
  $filename=$_POST['nomefile'];                    //Nome del file
  header("Content-Type: application/msword");
  header ("Content-Disposition: inline; filename=$filename.doc");
  ?>
  <HTML><BODY><P>Tavola pitagorica</P><TABLE>
  <?php
  //Ciclo in cui genero il codice HTML da inserire nel file Word
  for ($i = 1; $i <= 5; $i++){
    echo "<TR>";
    for ($j = 1; $j < 11; $j++){
      $a = $i * $j;
      echo "<TD>$a</TD>";
    }
    echo "</TR>";
  }
  ?>
  </TABLE></BODY></HTML>
  <?php
}
else{       //Mostro il form
  echo "
  <B>Genero un tabellina pitagorica 10 x 5 in un foglio word</B><BR><BR>
  <FORM name='form' METHOD='post' ACTION='".$_SERVER['PHP_SELF']."'>
  <B>Nome file Word da creare</B><INPUT TYPE='text' NAME='nomefile'>.doc<BR>
  <INPUT TYPE='submit' VALUE='Crea file'>
  </FORM></BODY></HTML>";
}
?>