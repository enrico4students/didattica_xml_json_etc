<?php
  // la cartella font si trova nella stessa directry dello script
  define('FPDF_FONTPATH','./font/');
  require('fpdf.php');
  $pdf = new FPDF();                  // istanzo un  oggetto 
  $pdf->AddPage();                    // apertura pagina    
  $pdf->SetTextColor(0);              // Impostazione colore
  $pdf->SetFont('Times','', 18);      // Impostazione font
  $pdf->SetX(25);   // posizione dal margine sinistro in pixel
  //  quattro funzioni diverse: Text(), Cell(), Write(), Multicell()
  $pdf->Text(5, 10,'Testo con Text()');
  $pdf->SetY(10);   
  $pdf->Cell(0, 5, 'Testo con Cell()');
  $pdf->Write(5, 'Testo con Write()');
  $pdf->MultiCell(0, 5,"\n".'Testo con '."\n".'MultiCell()', 0,'center');
  $pdf->Output();
?>

