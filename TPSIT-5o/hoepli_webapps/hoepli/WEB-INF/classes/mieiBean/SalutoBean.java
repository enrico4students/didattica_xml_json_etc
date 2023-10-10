//package info;
import java.util.*;
public class SalutoBean{
  private String risposta;
  public SalutoBean() {
    risposta = " ";
  }
  
  public String getTesto() {
    //   Date clock = new Date();
    Calendar calendar = Calendar.getInstance();
    // calendar.setTime(yourdate);
    int hours = calendar.get(Calendar.HOUR_OF_DAY);
    int minutes = calendar.get(Calendar.MINUTE);
    int seconds = calendar.get(Calendar.SECOND);
    if ( hours < 12 ) {
      risposta = "Buongiorno!";
    } else if ( hours < 17 ) {
      risposta = "Buon pomeriggio!";
    } else {
      risposta = "Buona sera!";
    }
    return risposta;
  }
}