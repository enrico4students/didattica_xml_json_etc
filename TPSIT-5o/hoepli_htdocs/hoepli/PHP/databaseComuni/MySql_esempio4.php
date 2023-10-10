<?php
session_start();
$conn = new mysqli("localhost", "root", "", "provephp");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Esercizio 4</title>
  </head>
  <body>
    <h3>Connessione a MySql: database provephp - tabelle regioni, comuni </h3>
    <h4>Selezione multipla comuni: organizza per regione!</h4>
  
<?php
  $i = 0;
  $k = 0;
  //check connection
  if (mysqli_connect_errno()){
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }
  if(isset($_POST['sub'])){
    $comune =  $_POST['comune'];
   	$arrRegioni = array();
    $arrLink = array();
    for($i = 0; $i < count($comune); $i++){
      if ($result = $conn->query("SELECT codice_provincia_istat FROM comuni WHERE slug ='".$comune[$i]."'"))
      {
 	    $row = $result->fetch_array();
        $codice_prov = $row['codice_provincia_istat'];
        $result->close();
        if ($result = $conn->query("SELECT codice_regione_istat FROM provincie WHERE codice_provincia_istat='".$codice_prov."'"))
        {
          $row = $result->fetch_array();
          $codice_reg = $row['codice_regione_istat'];
          $result->close();
          if ($result = $conn->query("SELECT name FROM regioni WHERE codice_regione_istat = '".$codice_reg."'"))
          {
            $row = $result->fetch_array();
            $nome = $row['name'];
            // aggiorna elenco delle regioni e link ai comuni
            if(!in_array($nome, $arrRegioni))
            {
              array_push($arrRegioni, $nome);
              array_push($arrLink, count($arrRegioni) - 1);
            }
            else
              array_push($arrLink, array_search($nome, $arrRegioni));
          }
          else{}
        }
        else{}
      }
      else{}
    } // fine for
     //----------------------------------------------------------------------   
    sort($arrRegioni);
    for($i = 0; $i < count($arrRegioni); $i++)
    {
      echo $arrRegioni[$i].": ";
      $n=0;
      for($k = 0; $k < count($arrLink); $k++)
      {
        if($arrLink[$k] == $i){
          if ($n > 0)
            echo ", ";
          $n++;
          //  sostituire slug con nome 
          if ($result = $conn->query("SELECT name FROM comuni WHERE slug ='".$comune[$k]."'"))
            $row = $result->fetch_array();
          //sanifica la parole - ma non funziona con le accentate della tabella comuni !
          $cerca = array("à","è","é","ì","ò","ù","'","?");  
          $sostituisci = array("a","e","e","i","o","u","_","");
          $row['name'] = str_replace($cerca, $sostituisci, $row['name']);
          echo $row['name'];
        }
      }
      echo "<br>";
    }
  }
  else
  {
    //if ($result = $conn->query("SELECT name, slug FROM comuni "))
    if ($result = $conn->query("SELECT name, slug FROM comuni ORDER BY name"))
    {
      echo "<form action='MySql_esempio4.php' method='POST'>
      <select name = 'comune[]' size='20'  multiple>";
      while($row = $result->fetch_array())
      {
        echo "<option value = '{$row['slug']}' ";
        echo ">{$row['name']}</option>";
      }
      echo "</select>
      <input type='submit' name='sub'/>
      </form>";
      //close result set
      $result->close();
    }
    else
    {
      echo "impossibile effettuare la query<br>";
      echo "Errore: ".$mysqli->error;
    }
  }
?>