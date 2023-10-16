<?php
	$mysqli = new mysqli("localhost", "root", "", "provephp");
	//check connection
	if (mysqli_connect_errno())	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <title>Esempio1 </title>
  </head>
    <body>
      <h3>Connessione a MySql: database provephp - tabelle comuni, provincie </h3>
      <h4>Seleziona un comune: ne viene individuata la provincia</h4>
<?php	
	if(isset($_POST['sub'])){
		$comune =  $_POST['comune'];
		$query="SELECT codice_provincia_istat FROM comuni WHERE name = '".$comune."'";
		if ($result = $mysqli->query($query)){
			$codice = "";
			while($row = $result->fetch_array()){
				$codice = $row['codice_provincia_istat'];
			}			
			$result->close();			 			//chiusura del result set
      // a partire dal codice seleziona il nome della provincia 
			$query = "SELECT name FROM provincie WHERE codice_provincia_istat = '".$codice."'";
			if($result = $mysqli->query($query)){
				echo "<div>Il comune ".$comune." si trova in Provincia di:";
     		while($row = $result->fetch_array()){
					echo $row['name'];
				}
			}
			//rilascio connessione
			$result->close();		           	// chiusura del result set
      $mysqli->close();	              // chiusura della connessione
		}
		else{
			echo "impossibile effettuare la query! <br> Errore: ".$mysqli->error;
		}
	}
	else{
		// scelta comune: form che richiama PostBack  
  	$query = "SELECT * FROM comuni ORDER BY name";
    if ($result = $mysqli->query($query)) {
			echo "<form action='MySql_esempio1.php' method='POST'>
			<select name = 'comune'>";
			while($row = $result->fetch_array()){
				echo "<option value = '{$row['name']}'>{$row['name']}</option>";
			}
			echo "</select><input type='submit' name='sub'/></form>";
			$result->close();		           	//chiusura del result set
		}
		else{
			echo "impossibile effettuare la query<br> Errore: ".$mysqli->error;
		}
 	  //rilascio connessione
    $mysqli->close();
	}
  ?>    
    </div>
  </body>
</html>

