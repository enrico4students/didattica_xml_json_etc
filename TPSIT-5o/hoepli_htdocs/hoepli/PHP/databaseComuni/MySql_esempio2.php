<?php
session_start();
$conn = new mysqli("localhost", "root", "", "provephp");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Esercizio 2</title>
  </head>
  <body>
  <h3>Connessione a MySql: database provephp - tabelle comuni, provincie </h3>
    <h4>Seleziona una provincia: ti riporto i suoi comuni!</h4>
    <?php
    // scelta provincia 
    if (!(isset($_POST["selectProvincia"]))) {
      ?>
      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
      <select name="selectProvincia">
      <?php
         $queryString = "SELECT name, codice_provincia_istat FROM provincie ORDER BY name";
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
            <input type="hidden" name="selectProvincia" value="<?php echo $_POST["selectProvincia"]; ?>">
            <input type="submit" name="invio" value="Seleziona un comune">
          </form>
        <?php
        }
        else{ 
          echo"<h5> Comune selezionato: ";
          echo $_POST["selectComune"]."</h5>";
        }
    }
    ?>
  </body>
</html>