<?php
//definizione funzione che riceve come parametri le righe da creare
function disegnaTabella($righe,$colonne)
{ 
   echo "<TABLE WIDTH=30% BORDER=1>";
   for($r=0;$r<$righe;$r++)
   {
      echo "<TR>";
      for($c=0;$c<$colonne;$c++)
         echo "<TD>&nbsp;";	
   }	 
   echo "</TABLE>";	 
}
?>