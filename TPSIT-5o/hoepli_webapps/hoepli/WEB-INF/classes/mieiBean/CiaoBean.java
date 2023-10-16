package mieiBean;
import java.util.*;
public class CiaoBean implements java.io.Serializable 
{ 
  private String testo;
  public CiaoBean() {
    testo = " ";
  }
  
  public String getTesto() {
    GregorianCalendar dataAttuale=new GregorianCalendar();
    int ore = dataAttuale.get(GregorianCalendar.HOUR_OF_DAY);
    int anno = dataAttuale.get(GregorianCalendar.YEAR);
    int mese = dataAttuale.get(GregorianCalendar.MONTH) + 1; 
    int giorno = dataAttuale.get(GregorianCalendar.DATE);
    int minuti = dataAttuale.get(GregorianCalendar.MINUTE);
    int secondi = dataAttuale.get(GregorianCalendar.SECOND);
    if ( ore < 12 ) {
      testo = "Buongiorno: e' mattina!";
    } else if ( ore < 17 ) {
      testo = "Buon pomeriggio!";
    } else {
      testo = "Buona sera !";
    }
    return testo;
  }
}
