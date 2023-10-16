import com.cryptware.jcnsapi.CNS;
import com.cryptware.jscapi.PCSCException;
import com.cryptware.jscapi.Reader;
import com.cryptware.jscapi.SmartCard;
import com.cryptware.jscapi.SmartCardException;
import com.cryptware.jscapi.SmartCardManager;
import java.security.cert.X509Certificate;

public class TesseraCNS {
    private Connection connect = null;
    private Statement statement = null;
    private ResultSet resultSet = null;

  public void  leggi(){
    try 
    {
      // Apre una connessione con lo smart card manager
      SmartCardManager scman = new SmartCardManager();
     
      // legge la lista dei lettori di smart card disponibili
      List<Reader> readerList = scman.getPluggedReaders();
     
     // Controlla che si sia almeno un lettore connesso
      if(readerList.size() == 0)
      {
         System.out.println("No readers found");
         return;                    
      }
            
      // prende il primo lettore tra quelli disponibili
      Reader reader = readerList.get(0);
    
      // attende che nel lettore venga inserita una smart card
      reader.WaitForSmartCardInserted();
          
      // apre una connessione con la smart card
      SmartCard card = reader.connect();
            
      // crea un’instanza di CNS
      CNS cns = new CNS(card);
    
      // Invia i comandi per leggere il contenuto 
      try 
      {
        byte[] cardId = cns.ReadIDCarta();    
        System.out.println("ID Carta: " + new String(cardId));
      }
      catch (SmartCardException e) 
      {
        e.printStackTrace();
      }             
       
      try
      {
         String[] datipersonali = cns.ReadDatiPersonali();    
         System.out.println("Nome, Cognome, Cod.Fis.: " +  
         datipersonali[CNS.Nome] + " " + 
         datipersonali[CNS.Cognome] + " " + 
         datipersonali[CNS.CodFis] );            
      }
      catch (SmartCardException e) 
      {
         e.printStackTrace();
      }            
            
      try 
      {
        X509Certificate certificate = cns.ReadCertificatoX509();
        System.out.println("Scadenza certificate: " + 
                             certificate.getNotBefore());
      }
      catch (CertificateException e) 
      {
          e.printStackTrace();
      }
      catch (SmartCardException e) 
      {
         e.printStackTrace();
      }
     }
    catch(PCSCException ex)
    {
      e.printStackTrace();
    }
  }
}



