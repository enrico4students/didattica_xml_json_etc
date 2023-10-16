<?php
	$mysqli = new mysqli("localhost", "root", "", "provephp");

	//check connection
	if (mysqli_connect_errno())
	{
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
        <h4>Seleziona un comune: ti dico in che provincia si trova!</h4>
<?php	
	if(isset($_POST['sub']))
	{
		$comune =  $_POST['comune'];
		$query="SELECT codice_provincia_istat FROM comuni WHERE name = '".$comune."'";
		if ($result = $mysqli->query(query))
		{
			$codice = "";
			while($row = $result->fetch_array())
			{
				//echo $row['name'] . " <br>";
				$codice = $row['codice_provincia_istat'];
			}			
			//close result set
			$result->close();			
			$query="SELECT name FROM provincie WHERE codice_provincia_istat = '".$codice."'";
			if($result = $mysqli->query($qyery))
			{
				echo "<div>";
				echo "Il comune ".$comune." appartiene alla Provincia di:";
     			while($row = $result->fetch_array())
				{
					echo $row['name'];
				}
			}
			else
			{
			}
		}
		else
		{
			echo "impossibile effettuare la query<br>";
			echo "Errore: ".$mysqli->error;
		}
	}
	else
	{
    if ($result = $mysqli->query("SELECT * FROM comuni ORDER BY name"))
	  {
			echo "<form action='MySqlesempio1.php' method='POST'>
			<select name = 'comune'>";
			while($row = $result->fetch_array())
			{
				//echo $row['name'] . " <br>";
				echo "<option value = '{$row['name']}'";
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
       
        </div>
    </body>
</html>