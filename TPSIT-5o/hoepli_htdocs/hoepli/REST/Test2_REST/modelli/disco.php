<?php
  class Disco
  {
    private $conn;
    private $table_name = "dischi";
    private $NRcatalogo;
    private $Genere;
    private $Interprete;
    private $Titolo;
    private $Etichetta;

    public function __construct($db){
      $this->conn = $db;
    }
    // CREAZIONE Libro
    public function create(){
      $query = "INSERT INTO ".$this->table_name." SET NRcatalogo=:NRcatalogo, Genere=:Genere, Interprete=:Interprete, Titolo=:Titolo, Etichetta=:Etichetta  ";
      $stmt = $this->conn->prepare($query);
      // legge i dati dall'HTML
      $this->NRcatalogo = htmlspecialchars(strip_tags($this->NRcatalogo));
      $this->Genere = htmlspecialchars(strip_tags($this->Genere));
      $this->Interprete = htmlspecialchars(strip_tags($this->Interprete));
      $this->Titolo = htmlspecialchars(strip_tags($this->Titolo));
      $this->Etichetta = htmlspecialchars(strip_tags($this->Etichetta));
      // binding
      $stmt->bindParam(":NRcatalogo", $this->NRcatalogo);
      $stmt->bindParam(":Genere", $this->Genere);
      $stmt->bindParam(":Interprete", $this->Interprete);
      $stmt->bindParam(":Titolo", $this->Titolo);
      $stmt->bindParam(":Etichetta", $this->Etichetta);
      // esegue la query
      if($stmt->execute()){
        return true;
      }
      return false;
    }
    // LETTURA Libro
    public function read(){
      $query = "SELECT a.NRcatalogo, a.Genere, a.Interprete, a.Titolo, a.Etichetta FROM ".$this->table_name." a ";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
	  return $stmt;
    }
    // AGGIORNAMENTO Libro
    function update(){
      $query = "UPDATE ".$this->table_name." SET Titolo = :Titolo, Genere = :Genere, Interprete = :Interprete, Etichetta = :Etichetta WHERE NRcatalogo = :NRcatalogo";
      $stmt = $this->conn->prepare($query);

      $this->NRcatalogo = htmlspecialchars(strip_tags($this->NRcatalogo));
      $this->Genere = htmlspecialchars(strip_tags($this->Genere));
      $this->Interprete = htmlspecialchars(strip_tags($this->Interprete));
      $this->Titolo = htmlspecialchars(strip_tags($this->Titolo));
      $this->Etichetta = htmlspecialchars(strip_tags($this->Etichetta));

      // binding
      $stmt->bindParam(":NRcatalogo", $this->NRcatalogo);
      $stmt->bindParam(":Genere", $this->Genere);
      $stmt->bindParam(":Interprete", $this->Interprete);
      $stmt->bindParam(":Titolo", $this->Titolo);
      $stmt->bindParam(":Etichetta", $this->Etichetta);

      // execute the query
      if($stmt->execute()){
        return true;
      }
      return false;
    }
    // CANCELLAZIONE Libro
    public function delete(){
      $query = "DELETE FROM ".$this->table_name." WHERE NRcatalogo = ?";
      $stmt = $this->conn->prepare($query);
      $this->NRcatalogo = htmlspecialchars(strip_tags($this->NRcatalogo));
      $stmt->bindParam(1, $this->NRcatalogo);
      // execute query
      if($stmt->execute()){
        return true;
      }
      return false;
    }
    // metodi accessori getter e setter
    public function getNRcatalogo(){
      return $this->NRcatalogo;
    }
    public function setNRcatalogo($value){
      $this->NRcatalogo = $value;
    }

    public function getGenere(){
      return $this->Genere;
    }
    public function setGenere($value){
      $this->Genere = $value;
    }

    public function getInterprete(){
      return $this->Interprete;
    }
    public function setInterprete($value){
      $this->Interprete = $value;
    }

    public function getTitolo(){
      return $this->Titolo;
    }
    public function setTitolo($value){
      $this->Titolo = $value;
    }

    public function getEtichetta(){
      return $this->Etichetta;
    }

    public function setEtichetta($value){
      $this->Etichetta = $value;
    }
  }
?>
