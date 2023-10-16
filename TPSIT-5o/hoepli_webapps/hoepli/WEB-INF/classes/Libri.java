import java.util.*;
public class Libri{
  public String titolo;   // per comodità li mettiamo public
  public String autore;
  public String editore;
  public String categoria;
  public Libri (String a1,String a2,String a3,String a4){
    titolo = a1;
    autore = a2;
    editore = a3;
    categoria = a4;  
  }
  // metodi getter e setter 
  public void setCategoria(String categoria){
    this.categoria = categoria;
  }
  public String getCategoria(){
    return categoria;
  }
  public void setEditore(String editore){
    this.editore = editore;
  }
  public String getEditore(){
    return editore;
  }
}
