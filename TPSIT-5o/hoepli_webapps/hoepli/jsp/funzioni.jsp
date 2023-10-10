<%!
//la stringa viene racchiusa tra singoli apici e apici raddoppiati in caso di occorrenza all’interno del testo
public String apici(String campo){
campo="'"+ campo.replaceAll("'","''") + "'";
return campo;
}
public String vuoto(Object oggetto){
if (oggetto == null) return "";
return oggetto.toString();
}
%>