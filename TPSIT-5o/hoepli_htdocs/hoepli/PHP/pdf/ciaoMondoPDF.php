<?php
  require('fpdf.php');
  $pdf = new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 18);
  $pdf->Cell(50,12,'Ciao Mondo!');
  $pdf->Output();
?>

