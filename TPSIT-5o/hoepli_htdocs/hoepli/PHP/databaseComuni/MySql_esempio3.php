<?php
session_start();
$conn = new mysqli("localhost", "root", "", "provephp");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Esercizio 3</title>
  </head>
  <body>
    <h3>Connessione a MySql: database provephp - tabelle regioni, comuni, provincie </h3>
    <h4>Seleziona una regione/provincia/comune: ti riporto le coordinate !</h4>
 
    <?php
    // scelta regione 
    if (!(isset($_POST["selectRegione"]))){
    ?>
      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <select name="selectRegione">
        <?php
          $result = $conn->query("SELECT name, codice_regione_istat FROM regioni ORDER BY name");
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            ?>
            <option value="<?php echo $row["codice_regione_istat"]; ?>"><?php echo $row["name"]; ?></option>
            <?php
            }
          }
        ?>
        </select>
        <input type="submit" name="invio" value="Carica provincie">
      </form>      
    <?php
    }  // fine scelta regione 
    ?>

    <!-- trova il nome della regione -->   
    <?php
    if (isset($_POST["selectRegione"])){
      $idRegione = $_POST["selectRegione"];
      // individua nome regione partendo dall'id ------------------------------------------
      $queryString = "SELECT name FROM regioni WHERE codice_regione_istat='$idRegione'";
      $result = $conn->query($queryString);
      if ($result = $conn->query($queryString)){
        while($row = $result->fetch_array()){
          $_SESSION['regione'] = $row['name'];
        }
      }
      //--------------------------------------------------------------------------------------
    ?>
    <h5> Regione selezionata: 
    <?php echo $_SESSION['regione']."</h5>"; 

    // scelta provincia dopo la scelta della regione  -->   
    if (!(isset($_POST["selectProvincia"]))) {
      ?>
      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
      <select name="selectProvincia">
      <?php
         $queryString = ("SELECT name, codice_provincia_istat FROM provincie WHERE codice_regione_istat='$idRegione' ORDER BY name");
         $result = $conn->query($queryString);
         if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {
         ?>
         <option value="<?php echo $row["codice_provincia_istat"]; ?>"><?php echo $row["name"]; ?></option>
         <?php
         }
       }
      ?>
      </select>
       <input type="hidden" name="selectRegione" value="<?php echo $_POST["selectRegione"]; ?>">
       <input type="submit" name="invio" value="Carica comuni">
      </form>
      <?php
      }
      ?>
      <!-- scelta comune -->
      <div>
      <?php
      if (isset($_POST["selectProvincia"])) {
        $idProvincia = $_POST["selectProvincia"];
        // individua nome provincia partendo dall'id ------------------------------------------
        $queryString = "SELECT name FROM provincie WHERE codice_provincia_istat='$idProvincia'";
        if ($result = $conn->query($queryString)){
          while($row = $result->fetch_array()){
            $_SESSION['citta'] = $row['name'];
         }
        }
        //--------------------------------------------------------------------------------------
        ?>
        <h5> Provincia selezionata: 
        <?php echo $_SESSION['citta']."</h5>"; 
        if (!(isset($_POST["selectComune"]))) {
        ?>
          <!-- seleziona il comune--> 
          <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
          <select name="selectComune">
            <?php
              $idProvincia = $_POST["selectProvincia"];
              $queryString = "SELECT name FROM provephp.comuni WHERE codice_provincia_istat='$idProvincia' ORDER BY name";
              $result = $conn->query($queryString);
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                ?>
                  <option value="<?php echo $row["name"]; ?>"><?php echo $row["name"]; ?></option>
                <?php
                }
              }
            ?>
            </select>
            <input type="hidden" name="selectRegione" value="<?php echo $_POST["selectRegione"]; ?>">
            <input type="hidden" name="selectProvincia" value="<?php echo $_POST["selectProvincia"]; ?>">
            <input type="submit" name="invio" value="Seleziona un comune">
          </form>
        <?php
        }
        else{ 
          $comuneSelezionato =  $_POST["selectComune"];
          echo"<h5> Comune selezionato: ";
          echo $_POST["selectComune"]."</h5>";
 
          $comuneSelezionato = str_replace("'", "\'", $comuneSelezionato);
          $query = "SELECT lat, lng FROM comuni WHERE name='$comuneSelezionato'";
          $result = $conn->query($query);
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
           ?>
             Latitudine: <?php echo $row["lat"]; ?>, longitudine: <?php echo $row["lng"]; ?>
           <?php
           }
          } 
        }   
       }
     } 
   ?>
    </div>
  </body>
</html>
