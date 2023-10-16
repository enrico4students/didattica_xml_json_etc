package mieiBean;
import java.util.*;
public class Stagioni implements java.io.Serializable 
{ 
  private String testo;
  private int giorni = 0;
  public Stagioni() {
    testo = " ";
    giorni=0;
  }
  
  public String getTesto() {
    GregorianCalendar dataAttuale=new GregorianCalendar();
    int ore = dataAttuale.get(GregorianCalendar.HOUR_OF_DAY);
    int anno = dataAttuale.get(GregorianCalendar.YEAR);
    int mese = dataAttuale.get(GregorianCalendar.MONTH) + 1; 
    int giorno = dataAttuale.get(GregorianCalendar.DATE);
    int minuti = dataAttuale.get(GregorianCalendar.MINUTE);
    int secondi = dataAttuale.get(GregorianCalendar.SECOND);
    if ( mese < 3 ) {
      testo = "inverno ";
    } else if ( mese < 6 )  {
      testo = "primavera!";
    } else if ( mese < 9 )  {
      testo = "estate!";
    } else {
      testo = "autunno";
    }
    testo = testo +" (da completare dallo studente !)";
    return testo;
  }
   public int getGiorni() {
    GregorianCalendar dataAttuale=new GregorianCalendar();
    int ore = dataAttuale.get(GregorianCalendar.HOUR_OF_DAY);
    int anno = dataAttuale.get(GregorianCalendar.YEAR);
    int mese = dataAttuale.get(GregorianCalendar.MONTH) + 1; 
    int giorno = dataAttuale.get(GregorianCalendar.DATE);
    int minuti = dataAttuale.get(GregorianCalendar.MINUTE);
    int secondi = dataAttuale.get(GregorianCalendar.SECOND);
    giorni = 365;
    return giorni;
  }

}
