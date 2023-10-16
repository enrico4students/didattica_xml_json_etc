#include <iostream>
#include <fstream>
using namespace std;
int main(){
  cout << "Content-Type: text/html" << endl;
  cout << endl;                   //indica la fine dell?header HTTP
  cout << "<HTML>" << endl;
  cout << "<HEAD>" << endl;
  cout << " <TITLE>Applicazioni CGI </TITLE>" << endl;
  cout << "</HEAD>" << endl;
  cout << "<BODY>" << endl;
  cout << " <H1>Benvenuto al corso di TPSIT-3 - classe 5</H1>" << endl;
  cout << " <HR>" << endl;
  // legge i dati nel file 
  ifstream file1("counter.txt");  // dichiaro la variabile per il file lettura
  int conta = 0;
  if (file1)
    file1 >> conta;
  file1.close();
  // aggiorna e scrive i dati nel file 
  conta++;
  ofstream file2("counter.txt");  // dichiaro la variabile per il file scrittura
  file2 << conta;
  file2.close();
  // visualizza il risultato 
  cout << "<H3>Sei l'utente numero: " << conta << "</H3>" << endl;
  cout << "</BODY>" << endl;
  cout << "</HTML>" << endl;
return 0;
} 

