<?php
/**********************
CLASSI
All'interno di una classe le variabili sono chiamate "proprietà " e le funzioni sono chiamate "metodi".
StampaErrori è la classe "madre". La classe Persona è la sottoclasse che estende le funzionalità di StampaErrori (cioè può usare i suoi metodi e proprietà pubblici).
Facciamo un esempio del procedimento per il campo "nome":
- una volta inviato dal form, il valore del campo viene immagazzinato nella variabile $nome
- viene chiamato il metodo "controllaTutto" della classe Persona
- attraverso il metodo controllaTutto, viene chiamato il metodo "controllaNome"
1) se il nome non ha errori, semplicemente il suo valore viene immagazzinato nell'array $elementi, per essere poi stampato a video
2) se il nome ha errori, viene chiamato il metodo "segnalaErrore" della classe StampaErrori; qua si prenderà l'elemento dell'array $errore_array che avrà il campo "nome" e assegnarà il valore a lui associato ('Il nome non deve essere vuoto ecc.') alla variabile $errore_mess, adibita alla stampa degli errori
**********************/

//Classe adibita alla stampa degli errori, nel caso ci siano
//per convenzione il nome di una classe inizia con la lettera maiuscola
//questa classe, da sola, non fa niente: infatti sarà la classe Persona a richiamare ed eseguire i suoi metodi
class StampaErrori{
	
	//rendo pubbliche le proprietà (variabili) che saranno usate nella classe
	public $nome;
	public $anno;
	public $email;
	private $errore_mess=""; //se questa proprietà rimane vuota, allora i campi non avranno errori
		
	//array che conterrà l'errore da stampare per ogni elemento del form
	public $errore_array = array(
		"nome" => "Il nome non deve essere vuoto e deve essere composto da caratteri alfanumerici.",
		"anno" => "L'anno di nascita deve essere superiore al 1900",
		"email" => "L'e-mail deve essere scritta correttamente nella forma: 'nome@sito.estensione'"
	);
	
	public $elementi=array(); // array che contiene gli elementi esatti, da stampare a video


	//metodo costruttore, condiviso dalla sottoclasse Persona
	//i valori dei post, per default, vengono associati a queste proprietà della classe
	public function __construct() {
		$this->nome = $_POST['nome'];
		$this->anno = $_POST['anno'];
		$this->email = $_POST['email'];
	}
	
	//metodo che immagazzina nella variabile $errore_mess l'errore del campo che è stato passato come parametro
	//il metodo è protected: le sue proprietà non sono accessibili al di fuori della classe e delle classi che la ereditano
	protected function segnalaErrore($campo){
		if($this->errore_array[$campo])
			$this->errore_mess.=$this->errore_array[$campo]."<br />";
	}
	
	//metodo che stampa gli errori (se la variabile $errore_mess non è vuota), oppure segnala che il form è corretto
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
//estende la classe StampaErrori: questo significa che può accedere ai suoi metodi (o proprietà) pubblici
class Persona extends StampaErrori{
	
	//Costante; per convenzione il nome di una costante si scrive tutto in maiuscolo; le costanti non possono mai cambiare il loro valore
	//è un dato di classe e non di istanza, quindi non si può richiamare con $this
	//la si richiama nella stessa classe usando "self::nome_costante" (vedi file index.php) e fuori dalla classe usando "nome_classe::nome_costante"
	const STATO="Italia";
	
	//Proprietà statica. Funziona come le costanti (richiamate con self), ma il suo valore puù essere cambiato
	public static $regione="Sicilia";

	
	//metodo di partenza: richiama tutti i metodi di controllo del form più sotto e, infine, stampa il risultato richiamando il metodo stampaErr
	public function controllaTutto() {
		$this->controllaNome();
		$this->controllaAnno();
		$this->controllaEmail();
		return $this->stampaErr();
	}
	
	//controlla il campo "nome"
	public function controllaNome(){
		if($this->nome!="" and is_string($this->nome)){
			//il campo "nome" non ha errori: il suo valore è immagazzinato nell'array $elementi['nome']
			$this->elementi['nome']="Nome: ".$this->nome;
		}else{
			//il campo "nome" ha degli errori: viene passato il nome del campo al metodo "segnalaErrore" della classe StampaErrori
			//che si occuperà di stampare l'errore
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