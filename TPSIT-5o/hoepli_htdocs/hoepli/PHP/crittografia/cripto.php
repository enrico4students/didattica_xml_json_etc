<?php 
//Richiamo il codice che coniene tutti i metodi e le classi necessari 
//per utilizzare Blowfish
require_once('blowfish.php');
//Definizione della classe
class Crittografia
{
   //Proprietà
   var $chiave;
   var $blowfish;
   //Costruttore della classe Crittografia
   //Riceve come argomento la chiave in chiaro
   function Crittografia($str)
   {
      $this->chiave = $str;
   }
   //Metodo che codifica la stringa originale
   function cifratura($str)
   {   
      $this->blowfish = new Horde_Cipher_blowfish;
      $encrypt = '';
      $mod = strlen($str) % 8;
      if ($mod > 0) 
      {
         $str.=str_repeat("\0",8-$mod);
      }
      foreach (str_split($str,8) as $chunk)
      {
         $encrypt .= $this->blowfish->encryptBlock($chunk, $this->getChiave());
      }
      return base64_encode($encrypt);
   }
   //Metodo che decodifica la stringa criptata
   function decifratura($str)
   {
      $this->blowfish = new Horde_Cipher_blowfish;
      $decrypt = '';
      $data = base64_decode($str);
      foreach (str_split( $data, 8 ) as $chunk)
      {
         $decrypt .= $this->blowfish->decryptBlock($chunk, $this->getChiave());
      }
      return trim($decrypt);
   }
   //Metodo che restituisce la chiave
   function getChiave()
   {
      return $this->chiave;
   }
}
?>
