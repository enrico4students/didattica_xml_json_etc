<?php
/*******************************************************
Trovate questo e altri script su http://www.manuelmarangoni.it , descritti e commentati nei dettagli.

Autore: Manuel Marangoni
Data messa online dello script: 30 ottobre 2011

Lo script contiene quattro funzioni per controllare l'esattezza dei campi passati da un form (esempio minimale). La risposta sarà un valore booleano: true se il campo è stato passato correttamente, false in caso contrario.
Per la precisione, i campi controllati sono:
- codice fiscale
- partita iva
- email
- prezzo (o un qualsiasi campo che deve essere di tipo float)

AGGIORNAMENTI
6 marzo 2012: all'interno del calcolo del codice fiscale sostituita la funzione ereg(), deprecata dalla versione php 5.3, con la funzione preg_match().
*******************************************************/


/** Esempio di chiamata delle funzioni una volta sottoscritto il form **/
if( isset($_POST['invia']) and codiceFiscale($_POST['cod_fisc']) and controllaPIVA($_POST['p_iva']) and prezzo_inserimento($_POST['prezzo']) and email_inserimento($_POST['email']) )
	//inserimento nel database (o invio per email dei dati)
else
	//errore

?>

<!-- form di base -->
<form method="post" action="" name="form">

	<input type="text" name="cod_fisc" value="" maxlength="16" />
    
   	 <input type="text" name="p_iva" value="" maxlength="11" />
    
    	<input type="text" name="prezzo" value="" />
    
    	<input type="text" name="email" value="" />
    
	<input type="submit" name="invia" value="Invia form" />

</form>




<?php
/** controllo del codice fiscale **/
function codiceFiscale($cf){
    
	if($cf=='')
		return false;
    
	if(strlen($cf)!= 16)
		return false;
		
    $cf=strtoupper($cf);
    if(!preg_match("/[A-Z0-9]+$/", $cf))
		return false;

	$s = 0;
    
	for($i=1; $i<=13; $i+=2){
		$c=$cf[$i];
		if('0'<=$c and $c<='9')
			$s+=ord($c)-ord('0');
		else
			$s+=ord($c)-ord('A');
    }
	
    for($i=0; $i<=14; $i+=2){
		$c=$cf[$i];
		switch($c){
			case '0':  $s += 1;  break;
			case '1':  $s += 0;  break;
			case '2':  $s += 5;  break;
			case '3':  $s += 7;  break;
			case '4':  $s += 9;  break;
			case '5':  $s += 13;  break;
			case '6':  $s += 15;  break;
			case '7':  $s += 17;  break;
			case '8':  $s += 19;  break;
			case '9':  $s += 21;  break;
			case 'A':  $s += 1;  break;
			case 'B':  $s += 0;  break;
			case 'C':  $s += 5;  break;
			case 'D':  $s += 7;  break;
			case 'E':  $s += 9;  break;
			case 'F':  $s += 13;  break;
			case 'G':  $s += 15;  break;
			case 'H':  $s += 17;  break;
			case 'I':  $s += 19;  break;
			case 'J':  $s += 21;  break;
			case 'K':  $s += 2;  break;
			case 'L':  $s += 4;  break;
			case 'M':  $s += 18;  break;
			case 'N':  $s += 20;  break;
			case 'O':  $s += 11;  break;
			case 'P':  $s += 3;  break;
			case 'Q':  $s += 6;  break;
			case 'R':  $s += 8;  break;
			case 'S':  $s += 12;  break;
			case 'T':  $s += 14;  break;
			case 'U':  $s += 16;  break;
			case 'V':  $s += 10;  break;
			case 'W':  $s += 22;  break;
			case 'X':  $s += 25;  break;
			case 'Y':  $s += 24;  break;
			case 'Z':  $s += 23;  break;
		}
    }
	
    if( chr($s%26+ord('A'))!=$cf[15] )
		return false;
		
    return true;
}


/** controllo della partita iva **/
function controllaPIVA($variabile){
	
	if($variabile=='') 
		return false;
	
	//la p.iva deve essere lunga 11 caratteri
	if(strlen($variabile)!=11)
		return false;
	
	//la p.iva deve avere solo cifre
	if(!ereg("^[0-9]+$", $variabile))
		return false;
		
	$primo=0;
	for($i=0; $i<=9; $i+=2)
		$primo+= ord($variabile[$i])-ord('0');
	for($i=1; $i<=9; $i+=2 ){
		$secondo=2*( ord($variabile[$i])-ord('0') );
		if($secondo>9)
			$secondo=$secondo-9;
		$primo+=$secondo;
	}
	if( (10-$primo%10)%10 != ord($variabile[10])-ord('0') )
		return false;
	
	return true;
	
}



/** controllo dell'email **/
function email_inserimento($variabile){
	
	// se la stringa è vuota sicuramente non è una mail
	if(trim($variabile)=="")
		return false;

	// controllo che ci sia una sola @ nella stringa
	$num_at=count(explode( '@', $variabile ))-1;
	if($num_at != 1)
		return false;

	// controllo la presenza di ulteriori caratteri "pericolosi":
	if(strpos($variabile, ';') || strpos($variabile, ',') || strpos($variabile, ' '))
		return false;
	
	if(preg_match('/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $variabile))
		return true;
	else
		return false;
		
}




/** controllo del prezzo **/
//Formatta l'inserimento del prezzo, dopo aver sostituito l'eventuale virgola con il punto
function prezzo_inserimento($variabile){
	$variabile=str_replace(",", ".", $variabile);
	$variabile=(float)$variabile;
	return $variabile;
}

?>