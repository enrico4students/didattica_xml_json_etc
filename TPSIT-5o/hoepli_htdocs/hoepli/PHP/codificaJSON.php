
<?php
  function scriviFile($nomefile, $dati){
    $fp = fopen($nomefile, 'w');
    fwrite($fp, json_encode($dati));
    fclose($fp);
  } 
?>

<!DOCTYPE html>
<html lang="it">
<head>
<title>Esempio di codifica JSON</title>
</head>
<body>
<h2>Esempio di codifica JSON</h2>
<?php
  // prima modalita' di realizzazione file JSON
  echo "<h4><p>a) visualizzo un array convertito in JSON:<br></h4>"; 
  $linguaggi = array("PHP", "Java", "JS", "HTML", "Python", "VisualBasic");
  $datiJSON = json_encode($linguaggi); 
  echo $datiJSON;
  echo "<br>"; 
  // scrittura del file 
  $nomefile = "../JSON/dati/linguaggi1.json";   // nome file destinazione
  scriviFile($nomefile,$datiJSON);
 
  // seconda modalita' di realizzazione file JSON
  echo "<h4><p>b) visualizzo un oggetto convertito in JSON:<br></h4>"; 
  class dati {
    public $java = "JAVA";
    public $php  = "PHP";
    public $cpp = "C++";
    public $js = "Javascript";
    public $VB = "VisualBasic";  
    public $data = "";
  }
  $linguaggi = new dati();                      // creazione di un oggetto
  $linguaggi->data = new DateTime();            // modifica di un attributo    
  $datiJSON = json_encode($linguaggi); 
  echo $datiJSON;
  echo "<br>"; 
  // scrittura del file 
  $nomefile = "../JSON/dati/linguaggi2.json";   // nome file destinazione
  scriviFile($nomefile,$datiJSON);
 

  // terza modalita' di realizzazione file JSON
  echo "<h4><p>c) visualizzo una tabella di un database MySql convertita in JSON:<br></h4>";
  $user = 'root';
  $password = '';
  $db = 'provephp';
  $host = 'localhost';
  $port = 3306;
  $conn = new PDO("mysql:host=$host; dbname=$db; port=$port", $user, $password);
  $datiMysql = [];
  $stmt = $conn->query("SELECT * FROM amici");
  $numrec = $stmt->rowCount();                       // conta i record letti 
  echo "<h4> - sono stati letti $numrec record  </h4>";
  while($riga = $stmt->fetch(PDO::FETCH_ASSOC)){
    $datiMysql[] = $riga;
  }
  $datiJSON = json_encode($datiMysql); 
  echo $datiJSON;
  // scrittura del file 
  $nomefile = "../JSON/dati/amici1.json";   // nome file destinazione
  scriviFile($nomefile,$datiJSON);
?>

<?php
  echo ('<p><a href=index.html><img src=../images/return.gif  width=41 height=30 align=right border=0></a></font></p>');
 ?>
</body>
</html>


