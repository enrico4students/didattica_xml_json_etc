#include <iostream>
#include <string>
#include <stdlib.h>             // getenv 
using namespace std;
int main(){
  string parametro;
  if (!cin.eof())
    cin >> parametro;           // legge la prima riga dei dati di ingresso
	cout << "Content-Type: text/html" << endl;
  cout << endl;
  cout << "<HTML>" << endl;
  cout << "<HEAD>" << endl;
  cout << " <TITLE>Corso di TPSIT - classe V </TITLE>" << endl;
  cout << "</HEAD>" << endl;
  cout << "<BODY>" << endl;
  cout << " <H1>QUERY_STRING: " << getenv("QUERY_STRING") << "</H1>" << endl;
  cout << " <H1>Standard Input: " << parametro << "</H1>" << endl;
  cout << "</BODY>" << endl;
  cout << "</HTML>" << endl;
  cout << endl;
  
  cout << endl;
  cout << endl;
  
  
  
  
char nome1[] ="paolo";   // vettore di caratteri stringa
char nome[] ={"paolo"};  // altra forma per l’inizializzazione
int mioData[] ={11,6,1960}; // vettore di interi
cout<< nome;  // se char visualizza il contenuto
cout<< mioData;  // se int visualizza l’indirizzo di memoria

return 0;
}


