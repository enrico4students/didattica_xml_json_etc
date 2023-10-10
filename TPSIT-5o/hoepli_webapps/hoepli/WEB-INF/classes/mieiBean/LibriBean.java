package mieiBean;
import java.util.*;
public class LibriBean implements java.io.Serializable 
{
  private String informatica, linguaggi, poesie;
  private String informatica2, linguaggi2, poesie2;
  private String categoria, lingua;
  
  public LibriBean(){
    inizializza();
  }

  private void inizializza(){
    informatica = "Algoritmi 1 ISBN XXX-YY1 <br> Tecnologie Informatiche ISBN XXX-YY2<br> Tecnologie e progettazione ISBN XXX-YY3<br>";
    linguaggi = "Il linguaggio C ISBN XXX-ZZ1 <br> Java per tutti ISBN XXX-ZZ2 <br> Programmiamo in VB ISBN XXX-ZZ3";
    poesie = "Poesie d'amore e di disperazione ISBN XXX-ZZ1 <br> Vita nuova ISBN XXX-ZZ2 <br> Poesie di Eliot ISBN XXX-ZZ3";
    informatica2 = "THE ALGORITHM DESIGN MANUAL by Steve Skiena ISBN XXX-YY1 <br> Algorithms in Java, Robert Sedgewick ISBN XXX-YY3<br>";
    linguaggi2 = "C language ISBN XXX-ZZ1 <br> JSP language ISBN XXX-ZZ2 <br> Programming in VB ISBN XXX-ZZ3";
    poesie2 = "Eliot ISBN XXX-ZZ3<br>The beat book ISBN XXX-Z2Z3";
  }

  // metodi getter e setter 
  public void setCategoria(String categoria){
    this.categoria = categoria;
  }
  public String getCategoria(){
    return categoria;
  }

   public void setLingua(String lingua){
    this.lingua = lingua;
  }
  public String getLingua(){
    return lingua;
  }

  public String getElenco(){
    String msg = "Nessuna categoria scelta";
    if ("informatica".equals(categoria)){
      if ("inglese".equals(lingua))
        msg = informatica2;
      else  
        msg = informatica;
      
    }
    else if ("linguaggi".equals(categoria)){
      if ("inglese".equals(lingua))
        msg = linguaggi2;
      else  
        msg = linguaggi;
    }
    else if ("poesie".equals(categoria)){
      if ("inglese".equals(lingua))
        msg = poesie2;
      else  
        msg = poesie;
    }
    return msg;
  }
}

      