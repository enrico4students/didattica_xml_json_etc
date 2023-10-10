package mieiBean;

import java.util.*;
public class CiaoMondoNome implements java.io.Serializable 
{ 
  private String testo;
  public CiaoMondoNome() {
    testo = "Ciao Mondo ";
  }
  public CiaoMondoNome(String nome) {
    testo = "Ciao, "+ nome;
  }
  
  public String getTesto() {

    return testo;
  }
}
