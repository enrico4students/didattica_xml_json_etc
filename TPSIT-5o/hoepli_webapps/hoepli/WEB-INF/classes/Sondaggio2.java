/* Esempio di Servlet con parametri da HTML   */
/* Viene creata una pagina HTML che riceve una POST*/ 

import javax.servlet.*;
import javax.servlet.http.*;
import java.text.*;
import java.io.*;

public class Sondaggio2 extends HttpServlet 
{
  private String nomePiatto[] ={ "pizza", "spaghetti", "pastina", "lasagne", "banana" };

  public void doGet (HttpServletRequest request,HttpServletResponse response )
  throws ServletException, IOException
  {
     int piatti[] = null, total = 0;
     File f = new File( "sondaggio.dat" );
     if ( f.exists() ) 
     {
       // Determine # of survey responses so far
       try 
       {
         ObjectInputStream input = new ObjectInputStream(
         new FileInputStream( f ) );
         piatti = (int []) input.readObject();
         input.close(); // close stream
         for ( int i = 0; i < piatti.length; ++i )
           total += piatti[ i ];
        }
       catch( ClassNotFoundException cnfe ) 
       {
         cnfe.printStackTrace();
       }
      }
      else
        piatti = new int[ 5 ];
   
    // read current survey response
    String value = request.getParameter( "piatto" );
    ++total; // update total of all responses
    // determine which was selected and update its total
    for ( int i = 0; i < nomePiatto.length; ++i )
      if ( value.equals( nomePiatto[ i ] ) )
        ++piatti[ i ];
   
     // write updated totals out to disk
    ObjectOutputStream output = new ObjectOutputStream(
    new FileOutputStream( f ) );
    output.writeObject( piatti );
    output.flush();
    output.close();

    // Calculate percentages
    double percentages[] = new double[ piatti.length ];
    for ( int i = 0; i < percentages.length; ++i )
      percentages[ i ] = 100.0 * piatti[ i ] / total;

    // send a thank you message to client
    response.setContentType( "text/html" ); // content type
    PrintWriter responseOutput = response.getWriter();
    StringBuffer buf = new StringBuffer();
    buf.append( "<html>\n" );
    buf.append( "<title>Grazie!</title>\n" );

    
    // link per gestione menu' scelta esercizi 
    buf.append("<a href=\"../sondaggio2.html\">");
    buf.append("<img src=\"../images/code.gif\" height=24 " +
                  "width=24 align=right border=0 alt=\"view code\"></a>");
    buf.append("<a href=\"../index.html\">");
    buf.append("<img src=\"../images/return.gif\" height=24 " +
                  "width=24 align=right border=0 alt=\"return\"></a>");
   
    buf.append( "<b>Grazie per aver partecipato al nostro sondaggio.</b><br>\n" );
    buf.append( "Hai selezionato come piatto preferito:"+value +" \n" );
    buf.append( "<BR>Risultati:\n<PRE>" );
    DecimalFormat twoDigits = new DecimalFormat( "#0.00" );
    
    for ( int i = 0; i < percentages.length; ++i ) 
    {
      //  buf.append( "<BR>" );
      buf.append( nomePiatto[ i ] );
      buf.append( ": " );
      buf.append( twoDigits.format( percentages[ i ] ) );
      buf.append( "% risposte: " );
      buf.append( piatti[ i ] );
      buf.append( "\n" );
    }
    buf.append( "\n <b>Totale risposte: " );
    buf.append( total );
    buf.append( "</b></PRE>\n</html>" );
    responseOutput.println( buf.toString() );
    responseOutput.close();
  }
   public void doPost(HttpServletRequest request,HttpServletResponse response)
    throws IOException, ServletException
  {
    doGet(request, response);
  }

 }