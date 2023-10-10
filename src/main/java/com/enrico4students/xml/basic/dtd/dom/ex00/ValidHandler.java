/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.enrico4students.xml.basic.dtd.dom.ex00;

/**
 *
 * @author enric
 */
import com.enrico4students.xml.basic.dtd.sax.ex00.*;
import org.xml.sax.helpers.DefaultHandler;
import org.xml.sax.SAXException;
import org.xml.sax.SAXParseException;

/* Extends DefaultHandler with error handler methods to catch 
warnings and validation errors */
public class ValidHandler extends DefaultHandler {
    
  public String relativeSystemID(String id) {
    
    if (id != null) {
      int index = id.lastIndexOf('/');
      if (index != -1) {
        id = id.substring(index + 1);
      }
    }
    return id;
  }
  
  public void printError(String type, SAXParseException spe) {
    
    System.err.print("[" + type + "] ");
    System.err.print(relativeSystemID(spe.getSystemId()));
    System.err.print(":" + spe.getLineNumber() + 
                     ":" + spe.getColumnNumber() + 
                     ": " + spe.getMessage());
    System.err.println();
    System.err.flush();
  }
  
  // A warning message. The program continues.
  @Override
  public void warning(SAXParseException spe) throws SAXException {
    printError("warning", spe);
  }

  // A validation error. The program decides to exit.
  @Override
  public void error(SAXParseException spe) throws SAXException {
    printError("error", spe);
    System.exit(1);
  }
  
  // A well-formedness error. The program must exit.
  @Override
  public void fatalError(SAXParseException spe) throws SAXException {
    printError("fatal error", spe);
    System.exit(1);
  }
}