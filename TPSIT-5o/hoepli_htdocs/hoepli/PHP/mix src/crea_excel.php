<?php
//Tecnica postback per rientare nella stessa pagina
if (isset($_POST['nomefile'])) {
   $filename = $_POST['nomefile'];       // nome del file
   header ("Content-Type: application/vnd.ms-excel");
   header ("Content-Disposition: inline; filename=$filename.xls");
   ?>
   <HTML><BODY><TABLE>
   <?php
   //Ciclo in cui genero il codice HTML da inserire nel file Excel
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
else{            // mostro il form che richiede il nome
   echo "
   <B>Genero un tabellina pitagorica 10 x 5 in un foglio excel</B><BR><BR>
   <FORM name='form' METHOD='post' ACTION='".$_SERVER['PHP_SELF']."'>
   <B>Nome file Excel da creare </B><INPUT TYPE='text' NAME='nomefile'>.xls<BR>
   <INPUT TYPE='submit' VALUE='Crea file'>
   </FORM></BODY></HTML>";
}
?>

