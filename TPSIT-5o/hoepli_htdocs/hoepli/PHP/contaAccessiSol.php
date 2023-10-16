<?php
//nome de file utilizzato nello script per memorizzare il totale accessi
$nomefile ="dati/accessi.txt";
//Verifica dell'esistenza del file con la funzione file_exists()
if (file_exists($nomefile))
{ 
   //se esiste gia viene aperto in lettura
   $idfile=fopen($nomefile,"r+");      
   //se non si riesce ad prirlo viene creato un messaggio di errore
   if (!$idfile) die ($msg="il file &nomefile non è stato aperto<BR>");
      //se il file viene aperto correttamente 
      //vengono letti i primi dieci caratteri e memorizzati nella variabile $conta_accessi
      //il casting è d'obbligo per trasformare la stringa in intero
      $conta_accessi = (int) fread($idfile,10);
   //chiusura file
   fclose($idfile); 
}
else
{ 
   //se il file non esiste viene aperto e creato contestualmente
   $idfile=fopen($nomefile,"w+");      
   if (!$idfile) die ($msg="il file &nomefile non è stato aperto<BR>"); 
      //se il file viene aperto correttamente viene inizializzata la variabile conta_accessi
      $conta_accessi = 0;
   //chiusura del file
   fclose($idfile);  
} 
//incremento del contatore di accessi (conta_accessi)
$conta_accessi++;
//apertura del file in scrittura e lettura distruttiva
$idfile=fopen($nomefile,"w+");      
if (!$idfile) die ($msg="il file &nomefile non è stato aperto<BR>"); 
   //se file aperto correttamente 
   //scrittura nel file del contatore di accessi
   fwrite($idfile,$conta_accessi);  
//chiusura file
fclose($idfile);
//visualizzazione contatore accessi  

//funzione che elimina eventuali spazi vuoti ai lati della stringa
chop($conta_accessi);
//calcola numero cifre (al max 8)
$nb_digits = max(strlen($conta_accessi),8);
//tolgo gli zeri in eccesso
$conta_accessi = substr("0000000000".$conta_accessi, -$nb_digits);
//suddivisione della stringa in un array cifra per cifra
$cifre = preg_split("//",$conta_accessi);
//ciclo di lettura dell'array ottenuto
$risultato="";
for($i=0;$i<=$nb_digits;$i++) 
{
   //se cifra diversa da null viene visualizzato l'immagine gif relativa
   if ($cifre[$i]!="") 
   {
   $risultato=$risultato."<IMG SRC='./cifre/".$cifre[$i].".gif'>";
}
}
echo "".$risultato; 


echo ('<p><a href=index.html><img src=../images/return.gif  width=41 height=30 align=right border=0></a></font></p>');

?>