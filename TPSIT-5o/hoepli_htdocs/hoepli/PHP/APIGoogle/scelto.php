<?php
$percorso = realpath("../db/comuni.mdb"); 
$sc="DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=".$percorso.";";
$cn = new COM("ADODB.Connection") or die("Non va ADO");
$rs = new COM("ADODB.Recordset");
$cn->Open($sc);

if (isset($_GET['quale']))
{
	$quale=$_GET['quale'];
}else{
	$quale=1;
}


if ($quale==1)
	{
		$rs->Open("SELECT * FROM Regioni", $cn);
		echo "<div id=reg>";
		echo "<SELECT id='reg' onchange='province(this)'>";
		echo "<option>Seleziona</option>";
		while (!$rs->eof) 
		{		
			$s = $rs->fields['codice_regione']->value;
      		echo "<option value=".$s.">".$rs->fields['nome']->value."</option>";
			$rs->movenext();
		}
		echo "</SELECT>";
		echo "</div>";
		echo "<div id=prov>";
		echo "</div>";
		$cn->close();
	}
	if ($quale==2)
	{
		$rs->Open("SELECT * FROM Province", $cn);
		$in=$_GET["stringa"];

		$in=explode("/", $in);

		echo "<SELECT id='provsel' onchange='comuni(this)'>";
		echo "<option >Seleziona</option>";
		while (!$rs->eof) 
		{
			if (($rs->fields['codice_regione']->value)==$in[0])
			{
				$s = $rs->fields['codice_provincia_istat']->value;
      			echo "<option value=".$s.">".$rs->fields['nome']->value."</option>";
			}
			$rs->movenext();
		}
		echo "</SELECT>";
		echo "<div id=comuni>";
		echo "</div>";
		$cn->close();
	}
	if ($quale==3)
	{

		$rs->Open("SELECT * FROM Comuni", $cn);

		$in=$_GET["stringa"];
		$in=explode("/", $in);

		echo "<SELECT id='com' onchange='creaMarker(this)'>";
		echo "<option>Seleziona</option>";

		while (!$rs->eof) 
		{
			if (($rs->fields['codice_provincia_istat']->value)==$in[0])
			{
				$s = $rs->fields['codice_provincia_istat']->value."/".$rs->fields['lat']->value."/".$rs->fields['lng']->value;
      			echo "<option value=".$s.">".$rs->fields['nome']->value."</option>";
			}
			$rs->movenext();
		}
		echo "</SELECT>";
		echo "<br>";
		echo "<b>Inserisci distanza in metri:</b>";
		echo "<br>";
		echo "<input id='dist' type='text'>";
		echo "<input id='Scansiona' type='button' value='scansiona' onclick='trovaluoghi()'>";
		echo "<div id=risultatitext>";
		echo "</div>";
$cn->close();
	}


?>