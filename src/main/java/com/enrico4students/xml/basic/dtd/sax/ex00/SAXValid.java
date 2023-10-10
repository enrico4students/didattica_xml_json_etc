/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.enrico4students.xml.basic.dtd.sax.ex00;

/**
 *
 * @author enric
 */
import java.io.*;
import org.xml.sax.*;
import org.xml.sax.helpers.*;
import javax.xml.parsers.*;

public class SAXValid {
  
  public static void main(String[] args) {
    
    if (args.length != 1 && false) {
      System.err.println("Usage: java SAXValid document.xml");
      System.exit(1);
    }
    // name of the XML document to parse
    String filename = null;
    // filename = args[0];
    filename = "D:\\00_data\\08_dev\\didattica\\teach_xml\\TPSIT-5o\\hoepli_htdocs\\hoepli\\xml\\articolo.xml";
    SAXParserFactory factory = null;
    // create a parser factory instance 
    try {
      factory = SAXParserFactory.newInstance();
    } catch (FactoryConfigurationError fce) {
      // The implementation is not available or cannot be instantiated
      System.err.println(fce.getMessage());
      System.exit(1);
    }
    // set validation against the DTD linked in the XML document
    factory.setValidating(true);
    SAXParser parser = null;
    // use the factory to create a parser instance
    try {
      parser = factory.newSAXParser();
    } catch (ParserConfigurationException pce) {
      // a parser cannot be created which satisfies the requested configuration
      System.err.println(pce.getMessage());
      System.exit(1);
    }
    catch (SAXException se) {
      // SAX general error
      System.err.println(se.getMessage());
      System.exit(1);
    }
    // create a default handler (error handler)
    ValidHandler handler = new ValidHandler();
    // register the handler, parse and validate the document
    try {
      parser.parse(new File(filename), handler);
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