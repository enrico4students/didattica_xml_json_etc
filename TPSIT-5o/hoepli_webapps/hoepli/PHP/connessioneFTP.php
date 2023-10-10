<?php
// tecnica PostBack per verificare se è primo accesso
if (isset($_POST['send_file'])){ 
  // se è secondo accesso vengono letti i campi ricevuti dal Form
  $ftp_server = $_POST['ftp_server']; 
  $porta = $_POST['port'];
  $username = $_POST['username']; 
  $password = $_POST['password']; 
  // verifica se i campi sono stati tutti compilati e validazione server
  if ($ftp_server != 'ftp server' && $ftp_server != ''){ 
    // validazione nome utente
    if ($username != 'username' && $username != ''){ 
      // validazione password
      if ($password != 'password' && $password != ''){ 
        // validazione nome del file da caricare
        if (is_uploaded_file($_FILES['file']['tmp_name'])){ 
     	    // se tutto ok lettura nome del file con percorso completo
          $file = $_FILES['file']['tmp_name']; 
	        // lettura nome del file senza percorso
          $new_file = $_FILES['file']['name']; 
          // connessione via FTP 
	        $conn = ftp_connect($ftp_server, $porta) or die ('Impossibile connettersi al server.'); 
          // login sul server
          ftp_login($conn, $username, $password) or die('Username o password errati.'); 
          // modalità passiva 
          ftp_pasv($conn, true); 
          // upload del file 
          $invia = ftp_put($conn, $new_file, $file, FTP_BINARY); 
          // esito dell'upload 
          echo (!$invia) ? 'Upload fallito' : 'Upload completato<br>'; 
          // chiusura della connessione 
          ftp_close($conn); 
        }else{ 
          echo "<font color=red><b>Inserire file</font><br>"; 
	      } 
      }else{ 
        echo "<font color=red><b>Inserire password</font><br>"; 
      } 
    }else{ 
      echo "<font color=red><b>Inserire username</font><br>"; 
    } 
  }else{ 
    echo "<font color=red><b>Inserire server ftp</font><br>"; 
  } 
} 
?> 
<FORM ENCTYPE="multipart/form-data" NAME="modulo_ftp ACTION="<?php echo $_SERVER['PHP_SELF'];?>" METHOD="POST"> 
<TABLE WIDTH=30%><TR><TD>Server FTP<TD>
<INPUT TYPE="text" NAME="ftp_server" VALUE="ftp server"/> 
<TR><TD>Porta<TD>
<INPUT TYPE="text" NAME="port" VALUE="21"/> 
<TR><TD>User Name<TD>
<INPUT TYPE="text" NAME="username" VALUE="username"/> 
<TR><TD>Password<TD>
<INPUT TYPE="password" NAME="password" VALUE="password"/>
<TR><TD>File da caricare<TD>
<INPUT TYPE="file" NAME="file"/> 
<TR><TD>
<INPUT TYPE="submit" NAME="send_file" VALUE="Carica file"/> 
</TABLE>
</FORM>

