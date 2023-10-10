<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Cambiavalute</title>
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
            Valuta di conversione:
            <select name="valuta">
                <option value="USD">Dollaro statunitense</option>
                <option value="CHF">Franco svizzero</option>
                <option value="GBP">Sterlina britannica</option>
            </select><br><br>
            <input type="submit" name="submit" value="Invia">
        </form>
        <?php
        }
        ?>
    </body>
</html>
