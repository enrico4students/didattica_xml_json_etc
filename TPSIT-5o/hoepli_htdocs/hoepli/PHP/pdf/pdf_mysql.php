<?php
function intestaPagina($numero){
  $numero = $numero + 1;   // numero di pagina 
  // ------------------------------------------------------------
  // ... da scrivere 
  // ------------------------------------------------------------
   return $numero;
 }

require('fpdf.php');
// connessione al database inserendo come parametri
$db = new mysqli("localhost", "root", "", "provephp");
// tentativo di di connessione al database 
if (mysqli_connect_errno()) {
  printf("Connessione non effettuata: %s\n", mysqli_connect_error());
  exit();
}
$query = "SELECT * FROM Carrello";    // predisposizione della query
if ($res = $db->query($query)) {      // esecuzione query
  printf("  - la select ha individuato %d righe.\n", $res->num_rows);
}
ob_end_clean();  // svuota il buffer di output 

// parametri configurazione pagina
$nrpagina = 0;   // numero di pagina 
$max = 25;       // massimo numero di righe per pagina
$y = 0;          // inizio pagina 
$i = 0;          // contatore righe
$y_inizio = 15;  // definisco la posizione iniziale y della prima riga
$h = 6;          // definisco l'altezza delle righe in pixel
$l1 = 10;        // larghezza colonna 1 
$l2 = 40;        // larghezza colonna 2 
$l3 = 60;        // larghezza colonna 3 
$l4 = 20;        // larghezza colonna 4 
$l5 = 20;        // larghezza colonna 5 

// -------------------------------------------------------------------
$pdf = new FPDF();                //
$pdf->SetFont('Arial','B',12);    // settaggio del font
$pdf->SetAutoPageBreak(false);    // disabilito fine pagina automatico
// -------------------------------------------------------------------
$pdf->AddPage();
// stampa dei titoli delle colonne
$pdf->SetFillColor(232,232,232);  // colore riempimento titolo 
$pdf->Text(25, 10,'Articoli presenti nel tuo carrello:');
$pdf->SetY($y_inizio);            // posizione dall'alto in pixel
$pdf->SetX(25);                   // posizione dal margine sinistro in pixel
// inserisco titoli nelle celle della prima riga
// parametri (larghezza,altezza,titolo,direzione,bordo,allineamento,sfondo)
$pdf->Cell($l1,$h,'ID',1,0,'L',1);
$pdf->Cell($l2,$h,'Nome',1,0,'L',1);
$pdf->Cell($l3,$h,'Descrizione',1,0,'L',1);
$pdf->Cell($l4,$h,'Quantita',1,0,'C',1);
$pdf->Cell($l5,$h,'Prezzo',1,0,'C',1);

$pdf->SetFillColor(255,255,255);  // colore riempimento bianco
$y = $y_inizio;     // inizio pagina 
$y = $y + $h;       // ci spostiamo in basso di una riga
$i = 0;             // contatore righe

// ------------------------------------------------------------
// $nrpagina = intestaPagina($nrpagina);
// ------------------------------------------------------------

foreach( $res as $row ) {        // ciclo per estrarre i record 
  if ($i == $max){               // controllo per il salto pagina 
    // $nrpagina = intestaPagina($nrpagina);
   }
  //salvataggio campi letti dal database
  $id = $row['ID'];
  $nome = $row['Nome'];
  $descr = $row['Descrizione'];
  $quanti = $row['Quantita'];
  $prezzo = $row['Prezzo'];
 
  $pdf->SetY($y);   // settaggio riga a nuova riga
  $pdf->SetX(25);   // settaggio colonna

   //Stampa riga con i campi letti dal database
  $pdf->Cell($l1, $h, $id, 1,0,'L',1);
  $pdf->Cell($l2, $h, $nome, 1,0,'L',1);
  $pdf->Cell($l3, $h, $descr, 1,0,'L',1);
  $pdf->Cell($l4, $h, $quanti, 1,0,'C',1);
  $pdf->Cell($l5, $h, $prezzo, 1,0,'R',1);
  
  $y = $y + $h;     // vado a riga successiva
  $i = $i + 1;      // incremento contatore di righe
}

 
// chiudo connessione al database
$res->close();
$db->close();
// invio file pdf al client
 $pdf->Output();
?>


