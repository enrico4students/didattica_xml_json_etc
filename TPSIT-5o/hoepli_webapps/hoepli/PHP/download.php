<?php
session_start();
//il prog ha un contatore di accessi...tramite file
//solo chi è registrato puo scaricare i file
//tt possono scaricare invece
//login e registrazione sn stati fatti usando i file
if ((isset($_GET["msg"]))){echo "<h3>".$_GET["msg"]."</h3>";}//fa vedere se presente un messaggio di errore

//  CONTATORE DI ACCESSI

  if (!(file_exists("contatore2.txt"))){  //se nn esiste il file lo creo
    $var=fopen("contatore2.txt","w+");
    fwrite($var, '1');//inizializzo il contatore
    fclose($var);
	}
  $var=fopen("contatore2.txt","r");
  $var2=file("contatore2.txt");
  $_SESSION["contator"]=$var2[0];//prendo come array
  $_SESSION["contator"]++;//inc il contatore
  $var=fopen("contatore2.txt","w+");
  fwrite($var, $_SESSION["contator"]);//aggiorno il file
  fclose($var);
  echo "<h1>".$_SESSION["contator"]."</h1>"; //stampo il contatore
//  CONTATORE DI ACCESSI


if (isset($_GET["query"])){//accede al modulo di iscrizione

 if ($_GET["query"]=="iscrizione"){//se si deve registrarsi
echo'
   <form action="download.php" method="post">
     <table>
	   <tr>
	     <td>
		   nome
		 <td>
	     <td>
		   <input type="text" name="nome">
		  <input type="hidden" name="reg" value="true">
		 <td>
	   </tr> 
	 </table>
   <input type="submit" value="registrati">
   </form>
';
}
elseif ($_GET["query"]=="accedi"){//se deve fare il login
 echo'
   <form action="#" method="GET">
     <table>
	   <tr>
	     <td>
		   nome
		 <td>
	     <td>
		   <input type="hidden" name="query" value="login">
		   <input type="text" name="nome">
		  <td>
	   </tr> 
	 </table>
   <input type="submit" value="accedi">
   </form>
 
';
 }
elseif ( $_GET["query"]=="login")//verifica se il nome inserito è presente dentro il file
{
  $trovato=false;
  $var=fopen("db.txt","r");//lo apre
  $var2=file("db.txt");
  $i=0;
  for($i=0; $i<count($var2); $i++)
  {
  if ($_GET["nome"]==$var2[$i])//se coincidono
  {
   	$_SESSION["loggat"]=1;//l'utente è loggato
	$trovato=true;
	header("location:download.php");//riaggiorno la pag
   }

  }
  
  if  ($trovato==false)// il nome inserito nn è stato trovato nel file
   {
    echo "TU nn sei registrato!!..<a href='download.php?query=iscrizione'>registrati!</a> oppure metti la psw giusta <a href='download.php?query=accedi'>accedi</a>";
   }
  fclose($var);
}
}
if (isset($_POST["query"])){// se è settata la variabile query---questa volta pero in POST  mentre prima in era in GET
if ($_POST["query"]=="carica") //se l'utente vuole caricare un file
{
//carica

$upload=$_FILES['uploadfile'];              // ha tt il file
$nome=$_FILES['uploadfile']['name'];        // ha l'indirizzo del file
$tmp=$_FILES['uploadfile']['tmp_name'];     // ha l'indirizzo temporaneo
# abbiamo veramente un file?
if ( $upload == "none" ) {
header("Location:download.php?msg=Non è stato inviato alcun file");
exit;
}
# lo copia in una nuova posizione
if (copy($tmp,"programmi/".$nome))
{
header("Location:download.php?msg=Caricamento file riuscito");
# cancella il file temporaneo
unlink($tmp);
} else {
header("Location:download.php?msg=Caricamento file fallito");
}

//carica
}

elseif($_POST["query"]=="download")//scaricare file
{
  $lista = dir("programmi");
//stampo tt i file dentro la cartella programmi


// Lista di tutti i file:
   while ($f = $lista->read()) 
   {
      if ($f!='.' && $f!='..')  echo "<a href='programmi/$f'>$f</a>\n";
}
echo "<br><br><a href='download.php'>torna</a>";
$lista->close();
} 
}
if (isset($_POST["reg"]) ){ //se viene confermata la domanda d'iscriz...
    if (file_exists("db.txt")){//se esiste il file con tt i nomi
	$var=fopen("db.txt","a+");
    fwrite($var, "\r\n".$_POST["nome"]); //   "\r\n" senrve per far andare a capo..questo serve perche così si possono usare gli array
    fclose($var);}
	else{//lo crea
	$var=fopen("db.txt","a+");//crea...lo potevo creare prima (con w+) ma in quel caso sarebbe andato a capo e poi scritto
    fwrite($var, $_POST["nome"]);
    fclose($var);
	}
	$_SESSION["loggat"]=1; //login automatico
	header("Location:download.php?msg=Ti sei connesso ".$_POST["nome"]);
}

if (isset($_SESSION["loggat"]) && ((!(isset($_GET["query"])) && !(isset($_POST["query"]))))){//se l'insegnante è già loggato accede

echo'

     <table>
	   <tr>
	     <td>
		   download programmi materie 
		   <form action="#" method="post">
		     <input type="hidden" name="query" value="download">
			 <input type="submit" value="scarica">
			</form>
		 <td>

	   </tr> 
	 <tr>
	     <td>
           upload programmi materie             
		   <form name="foto" action="download.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="query" value="carica">
			 <label for="allegato">file <style="color: #F00; font-weight: bold;">*</span>:</label> 
             <input type="file" name="uploadfile" id="allegato" size="40" /><br />
			
             <input type="submit" name="invia" value="Carica il file" />
            </form>
		 <td>
	   </tr> 
	 </table>
';
}
elseif (!(isset($_SESSION["loggat"])) && ((!(isset($_GET["query"])) && !(isset($_POST["query"]))))){
//se nn è loggato e nn ha fatto nessuna richiesta...per es se l'utente esce e rientra
$_SESSION["loggato"]=1;
echo'
     <table>
	   <tr>
	     <td>
		   download programmi materie 
		   <form action="#" method="post">
		     <input type="hidden" name="query" value="download">
			 <input type="submit" value="scarica">
			</form>
		 <td>
	   </tr> 
	 <tr>
	     <td>
		   <a href="download.php?query=accedi">accedi</a> oppure <a href="download.php?query=iscrizione">registrati</a> per caricare sul server un programma scolastico di una materia
		 <td>
	   </tr> 
	 </table>
';
}
?>