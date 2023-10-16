<?php
class Database
{
  // Attributi del database: credenziali
  private $host = "localhost";
  private $db_name = "mediateca";
  private $username = "paolo";
  private $password = "123";
  public $conn;

  // Funzione di connessione al database
  public function getConnection()
  {
    $this->conn = null;
	try{
	  $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
	  $this->conn->exec("set names utf8");
	}
	catch(PDOException $exception){
	  echo "Errore di connessione: " . $exception->getMessage();
	}
	return $this->conn;
  }
}
?>

