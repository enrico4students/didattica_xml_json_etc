<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Cambiavalute</title>
        <style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
	font-size: 24px;
}
-->
        </style>
</head>
    <body>
    <?php
        if (isset($_POST["valuta"])) {
            $apiURL = "https://tassidicambio.bancaditalia.it/terzevalute-wf-web/rest/v1.0/latestRates";
            // Opzioni HTTP (ad esempio, il formato dei dati)
            $options = [
                "http" => [
                    "method" => "GET",
                    "header" => "Content-Type: application/x-www-form-urlencoded \r\n".
                                "Accept: application/json \r\n" // Richiedi i dati in formato JSON
                ]
            ];
            // Crea il contesto dell'header e ricevi la risposta
            $context = stream_context_create($options);
            $response = file_get_contents($apiURL, false, $context);

            // Decodifica la risposta in formato JSON
            $json = json_decode($response, true);
            $latestRates = $json["latestRates"];

      echo "<b> esercitazione da completare a cura dello studente! </b><br><br>";
       // Mostra il tasso di cambio della valuta richiesta
            foreach ($latestRates as $rate) {
                if ($rate["isoCode"] == $_POST["valuta"]) {
                    echo "1 Euro = ".$rate["eurRate"]." ".$rate["currency"]."<br><br>";
                }
            }
        }
        else {
        ?>
    <form action="" method="post">
            <p><span class="style1">Ufficio cambi </span><br>
          Andamento delle valuta
            <select name="valuta">
              <option value="USD">Dollaro statunitense</option>
              <option value="CHF">Franco svizzero</option>
              <option value="GBP">Sterlina britannica</option>
            </select>
</p>
            <p>Periodo desiderato: </p>
            <table width="342" border="1">
              <tr>
                <th width="160" scope="col"><p>Data iniziale</p>
                <p>
                  <input type="date" name="data" value="">
                </p></th>
                <th width="160" scope="col"><p>Data finale</p>
                <p>
                  <input type="date" name="data2" value="">
                </p></th>
              </tr>
            </table>
<p>          <label>
              <input name="radiobutton" type="radio" value="radiobutton">
giornaliero<br>
<input name="radiobutton" type="radio" value="radiobutton"> 
settimanale
<br>
<input name="radiobutton" type="radio" value="radiobutton">
</label> 
mensile<br>
              <br>
              <input type="submit" name="submit" value="Invia">
      </p>
    </form>
        <?php
        }
        ?>
    </body>
</html>
