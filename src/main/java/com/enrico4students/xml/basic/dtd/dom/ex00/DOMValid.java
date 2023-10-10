/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.enrico4students.xml.basic.dtd.dom.ex00;

/**
 *
 * @author enric
 */
import com.enrico4students.xml.basic.dtd.sax.ex00.ValidHandler;
import java.io.*;
import javax.xml.parsers.*;
import org.w3c.dom.*;
import org.xml.sax.helpers.*;
import org.xml.sax.SAXException;
import org.xml.sax.SAXParseException;

public class DOMValid {

  public static void main(String[] args) {
    
    if (args.length != 1 && false) {
      System.err.println("Usage: java DOMValid document.xml");
      System.exit(1);
    }
    // name of the XML document to parse
    String filename;
    // filename = args[0];
    filename = "D:\\00_data\\08_dev\\didattica\\teach_xml\\TPSIT-5o\\hoepli_htdocs\\hoepli\\xml\\articolo.xml";

    DocumentBuilderFactory factory = null;
    // create a parser factory instance 
    try {
      factory = DocumentBuilderFactory.newInstance();
    } catch (FactoryConfigurationError fce) {
      // The implementation is not available or cannot be instantiated
      System.err.println(fce.getMessage());
      System.exit(1);
    }
    // set validation against the DTD linked in the XML document
    factory.setValidating(true);
    DocumentBuilder parser = null;
    // use the factory to create a parser instance
    try {
      parser = factory.newDocumentBuilder();
    } catch (ParserConfigurationException pce) {
      // a parser cannot be created which satisfies the requested configuration
      System.err.println(pce.getMessage());
      System.exit(1);
    }
    // register an error handler with the parser
    parser.setErrorHandler(new ValidHandler());
    // parse the document
    Document document = null;
    try {
      document = parser.parse(new File(filename));
    } catch (SAXException se) {
      // do nothing since an error handler has been installed
    } catch (IOException ioe) {
      // Some IO error occurred
      System.err.println(ioe.getMessage());
      System.exit(1);
    }
    
    System.out.println("The document is valid.");

  }
  
}