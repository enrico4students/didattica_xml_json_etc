<html>
<head>
<title> Riempimento combobox da array</title>
</head>
<body>
<H3 align=left>A) pagina iniziale con pulsante </h3>
<form action="" method=get>
<input type=submit name="cmdriempi" value= "riempi il combobox">
</form>
<?php
 echo ('<p><a href=index.html><img src=../images/return.gif  width=41 height=30 align=right border=0></a></font></p>');
 echo '<form action="" method="POST">';
 // acquisizione dati dal form html con GET
 if (isset($_GET["cmdriempi"]))
 {
  $vettoreJSON ='{"pizza":5,"spaghetti":6,"lasagne":7,"pizzoccheri":10}';
  $piatti = json_decode($vettoreJSON,true) ;   //true indica che viene traformato in array associativo 
  $nomiPiatti= array_keys($piatti);

  // riempimento di un combobox
  echo '<H3 align=left>B) ecco il combobox </h3>';
  echo '<select name="cmbscegli">';
  for ($k=0;$k<count($nomiPiatti);$k++){
    echo '<option >'.$nomiPiatti[$k].'</option>';
  }
  echo '</select>';
  echo '<input type="submit" value="Invia">';
  // acquisizione dati dal form html con POST 
  if (isset($_POST["cmbscegli"])){
    echo '<H3 align=left>C) ecco cosa ho scelto </h3>';
    $piatto=$_POST["cmbscegli"];
    echo 'oggi si mangia '.$piatto;
   echo ('<p><a href=riempiCombobox.php><img src=../images/frecciaSu.png  width=41 height=30 align=left border=0></a></font></p>');
 }
}
?>
 