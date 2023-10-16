<?php
/*******************
Trovate questo e altri script su http://www.manuelmarangoni.it , descritti e commentati nei dettagli.
ESEMPIO DI USO DELLA PROGRAMMAZIONE A OGGETTI IN PHP
Nell'esempio si crea una semplice anagrafica legata a una persona
- In questo file si trova il form
- Nel file "persona.php", qui inclusa, si trova la classe che estrae l'anagrafica di una persona
*******************/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Php - Esempio di programmazione a oggetti</title>
</head>

<body>

<?php
$fine=false; 
//flag di controllo: diventa true se l'invio è andato a buon fine (e quindi impedisce al form di mostrarsi)

//controllo dei dati e stampa dell'anagrafica
if(isset($_POST['invio'])){
  include("persona.php");
  $persona=new Persona(); //$persona è detto "oggetto" o "istanza di classe"
  if($persona->controllaTutto()){
    echo "<br /><br />Stato: ".Persona::STATO."<br />";
    echo "Regione: ".Persona::$regione."<br />";
    echo $persona->elementi['nome']."<br />";
    echo $persona->elementi['anno']."<br />";
    echo $persona->elementi['email'];
    $fine=true;
  }
}

//form di partenza
if(!$fine){
?>
<form action="" method="post" style="margin-top:30px;">
  <div class="riga">
    <div class="left">Nome:</div>
    <div class="right"><input type="text" name="nome" value="<?php if(isset($_POST['nome'])) echo $_POST['nome'];?>" /></div>
  </div>

  <div class="riga">
    <div class="left">Anno di nascita:</div>
    <div class="right"><input type="text" name="anno" value="<?php if(isset($_POST['anno'])) echo $_POST['anno'];?>" /></div>
  </div>

  <div class="riga">
    <div class="left">Email:</div>
    <div class="right"><input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" /></div>
  </div>

  <div class="riga">
    <div class="left"></div>
    <div class="right"><input type="submit" value="Invia" name="invio" /></div>
  </div>
</form>

<?php
}?>

</body>

</html>