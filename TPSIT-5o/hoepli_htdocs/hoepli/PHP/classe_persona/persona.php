<?php
/**********************
CLASSI
All'interno di una classe le variabili sono chiamate "propriet�" e le funzioni sono chiamate "metodi".
StampaErrori � la classe "madre". La classe Persona � la sottoclasse che estende le funzionalit� di StampaErrori (cio� pu� usare i suoi metodi e propriet� pubblici).
Facciamo un esempio del procedimento per il campo "nome":
- una volta inviato dal form, il valore del campo viene immagazzinato nella variabile $nome
- viene chiamato il metodo "controllaTutto" della classe Persona
- attraverso il metodo controllaTutto, viene chiamato il metodo "controllaNome"
1) se il nome non ha errori, semplicemente il suo valore viene immagazzinato nell'array $elementi, per essere poi stampato a video
2) se il nome ha errori, viene chiamato il metodo "segnalaErrore" della classe StampaErrori; qua si prender� l'elemento dell'array $errore_array che avr� il campo "nome" e assegnar� il valore a lui associato ('Il nome non deve essere vuoto ecc.') alla variabile $errore_mess, adibita alla stampa degli errori
**********************/

//Classe adibita alla stampa degli errori, nel caso ci siano
//per convenzione il nome di una classe inizia con la lettera maiuscola
//questa classe, da sola, non fa niente: infatti sar� la classe Persona a richiamare ed eseguire i suoi metodi
class StampaErrori{
	
	//rendo pubbliche le propriet� (variabili) che saranno usate nella classe
	public $nome;
	public $anno;
	public $email;
	private $errore_mess=""; //se questa propriet� rimane vuota, allora i campi non avranno errori
		
	//array che conterr� l'errore da stampare per ogni elemento del form
	public $errore_array = array(
		"nome" => "Il nome non deve essere vuoto e deve essere composto da caratteri alfanumerici.",
		"anno" => "L'anno di nascita deve essere superiore al 1900",
		"email" => "L'e-mail deve essere scritta correttamente nella forma: 'nome@sito.estensione'"
	);
	
	public $elementi=array(); // array che contiene gli elementi esatti, da stampare a video


	//metodo costruttore, condiviso dalla sottoclasse Persona
	//i valori dei post, per default, vengono associati a queste propriet� della classe
	public function __construct() {
		$this->nome = $_POST['nome'];
		$this->anno = $_POST['anno'];
		$this->email = $_POST['email'];
	}
	
	//metodo che immagazzina nella variabile $errore_mess l'errore del campo che � stato passato come parametro
	//il metodo � protected: le sue propriet� non sono accessibili al di fuori della classe e delle classi che la ereditano
	protected function segnalaErrore($campo){
		if($this->errore_array[$campo])
			$this->errore_mess.=$this->errore_array[$campo]."<br />";
	}
	
	//metodo che stampa gli errori (se la variabile $errore_mess non � vuota), oppure segnala che il form � corretto
	protected function stampaErr(){
		if($this->errore_mess!=""){
			echo $this->errore_mess;
			return false;
		}else{
			echo "L'invio del form e' andato a buon fine";
			return true;
		}
	}
}


//Classe che controlla la correttezza dei dati passati dal form
//estende la classe StampaErrori: questo significa che pu� accedere ai suoi metodi (o propriet�) pubblici
class Persona extends StampaErrori{
	
	//Costante; per convenzione il nome di una costante si scrive tutto in maiuscolo; le costanti non possono mai cambiare il loro valore
	//� un dato di classe e non di istanza, quindi non si pu� richiamare con $this
	//la si richiama nella stessa classe usando "self::nome_costante" (vedi file index.php) e fuori dalla classe usando "nome_classe::nome_costante"
	const STATO="Italia";
	
	//Propriet� statica. Funziona come le costanti (richiamate con self), ma il suo valore pu� essere cambiato
	public static $regione="Sicilia";

	
	//metodo di partenza: richiama tutti i metodi di controllo del form pi� sotto e, infine, stampa il risultato richiamando il metodo stampaErr
	public function controllaTutto() {
		$this->controllaNome();
		$this->controllaAnno();
		$this->controllaEmail();
		return $this->stampaErr();
	}
	
	//controlla il campo "nome"
	public function controllaNome(){
		if($this->nome!="" and is_string($this->nome)){
			//il campo "nome" non ha errori: il suo valore � immagazzinato nell'array $elementi['nome']
			$this->elementi['nome']="Nome: ".$this->nome;
		}else{
			//il campo "nome" ha degli errori: viene passato il nome del campo al metodo "segnalaErrore" della classe StampaErrori
			//che si occuper� di stampare l'errore
			$this->segnalaErrore('nome');
		}
	}
	
	//controlla il campo "anno"
	public function controllaAnno(){
		if($this->anno>=1900){
			$this->elementi['anno']="Anno di nascita: ".$this->anno;
		}else{
			$this->segnalaErrore('anno');
		}
	}
	
	//controlla il campo "email"
	public function controllaEmail(){
		if(is_string($this->email) and preg_match('/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $this->email)){
			$this->elementi['email']="Email: ".$this->email;
		}else{
			$this->segnalaErrore('email');
		}
	}

}

?>