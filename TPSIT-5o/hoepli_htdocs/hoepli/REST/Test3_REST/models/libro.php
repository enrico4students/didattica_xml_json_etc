<?php
class Libro
{
    private $conn;
    private $table_name = "libri";
    private $ISBN;
    private $Nome_Autore;
    private $Cognome_Autore;
    private $Titolo;
    private $Editore;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // CREAZIONE Libro
    public function create()
    {
        $query = "INSERT INTO ".$this->table_name." SET ISBN=:ISBN, Nome_Autore=:Nome_Autore, Cognome_Autore=:Cognome_Autore, Titolo=:Titolo, Editore=:Editore  ";
        $stmt = $this->conn->prepare($query);
        // legge i dati dall'HTML
        $this->ISBN = htmlspecialchars(strip_tags($this->ISBN));
        $this->Nome_Autore = htmlspecialchars(strip_tags($this->Nome_Autore));
        $this->Cognome_Autore = htmlspecialchars(strip_tags($this->Cognome_Autore));
        $this->Titolo = htmlspecialchars(strip_tags($this->Titolo));
        $this->Editore = htmlspecialchars(strip_tags($this->Editore));

        // binding
        $stmt->bindParam(":ISBN", $this->ISBN);
        $stmt->bindParam(":Nome_Autore", $this->Nome_Autore);
        $stmt->bindParam(":Cognome_Autore", $this->Cognome_Autore);
        $stmt->bindParam(":Titolo", $this->Titolo);
        $stmt->bindParam(":Editore", $this->Editore);
        // esegue la query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // LETTURA Libro
    public function read()
    {
        $query = "SELECT a.ISBN, a.Nome_Autore, a.Cognome_Autore, a.Titolo, a.Editore FROM ".$this->table_name." a ";
        $stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
    }

    // AGGIORNAMENTO Libro
    function update()
    {
        $query = "UPDATE ".$this->table_name." SET Titolo = :Titolo, Nome_Autore = :Nome_Autore, Cognome_Autore = :Cognome_Autore, Editore = :Editore WHERE ISBN = :ISBN";
        $stmt = $this->conn->prepare($query);

        $this->ISBN = htmlspecialchars(strip_tags($this->ISBN));
        $this->Nome_Autore = htmlspecialchars(strip_tags($this->Nome_Autore));
        $this->Cognome_Autore = htmlspecialchars(strip_tags($this->Cognome_Autore));
        $this->Titolo = htmlspecialchars(strip_tags($this->Titolo));
        $this->Editore = htmlspecialchars(strip_tags($this->Editore));

        // binding
        $stmt->bindParam(":ISBN", $this->ISBN);
        $stmt->bindParam(":Nome_Autore", $this->Nome_Autore);
        $stmt->bindParam(":Cognome_Autore", $this->Cognome_Autore);
        $stmt->bindParam(":Titolo", $this->Titolo);
        $stmt->bindParam(":Editore", $this->Editore);

        // execute the query
        if($stmt->execute())
        {
            return true;
        }
        return false;
    }

    // CANCELLAZIONE Libro
    public function delete()
    {
        $query = "DELETE FROM ".$this->table_name." WHERE ISBN = ?";
        $stmt = $this->conn->prepare($query);
        $this->ISBN = htmlspecialchars(strip_tags($this->ISBN));
        $stmt->bindParam(1, $this->ISBN);
        // execute query
        if($stmt->execute())
        {
            return true;
        }
        return false;
    }
    // metodi accessori getter e setter
    public function getISBN()
    {
        return $this->ISBN;
    }

    public function setISBN($value)
    {
        $this->ISBN = $value;
    }

    public function getNomeAutore()
    {
        return $this->Nome_Autore;
    }

    public function setNomeAutore($value)
    {
        $this->Nome_Autore = $value;
    }

    public function getCognomeAutore()
    {
        return $this->Cognome_Autore;
    }

    public function setCognomeAutore($value)
    {
        $this->Cognome_Autore = $value;
    }

    public function getTitolo()
    {
        return $this->Titolo;
    }

    public function setTitolo($value)
    {
        $this->Titolo = $value;
    }
    public function getEditore()
    {
        return $this->Editore;
    }

    public function setEditore($value)
    {
        $this->Editore = $value;
    }
}
?>
