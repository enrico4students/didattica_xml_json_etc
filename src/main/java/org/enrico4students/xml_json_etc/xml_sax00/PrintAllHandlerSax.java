/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package org.enrico4students.xml_json_etc.xml_sax00;

/**
 *
 * @author enric
 */
import org.xml.sax.Attributes;
import org.xml.sax.SAXException;
import org.xml.sax.helpers.DefaultHandler;

public class PrintAllHandlerSax extends DefaultHandler {

    public PrintAllHandlerSax() {
        level = 0;
    }

    int level;
    String pad = "";
    private StringBuilder currentValue = new StringBuilder();

    @Override
    public void startDocument() {
        System.out.println("Start Document");
    }

    @Override
    public void endDocument() {
        System.out.println("End Document");
    }

    @Override
    public void startElement(
            String uri,
            String localName,
            String qName,
            Attributes attributes) {

        level++;
        pad = new String(new char[level]).replace("\0", "  ");
        // reset the tag value
        currentValue.setLength(0);

        System.out.printf(pad+"Start Element : %s%n", qName);

    }

    @Override
    public void endElement(String uri,
            String localName,
            String qName) {

        pad = new String(new char[level]).replace("\0", "  ");

        System.out.println(pad+currentValue.toString());
        System.out.printf(pad+"End Element : %s%n", qName);

        level--;
    }

    // http://www.saxproject.org/apidoc/org/xml/sax/ContentHandler.html#characters%28char%5B%5D,%20int,%20int%29
    // SAX parsers may return all contiguous character data in a single chunk,
    // or they may split it into several chunks
    @Override
    public void characters(char ch[], int start, int length) {

        // The characters() method can be called multiple times for a single text node.
        // Some values may missing if assign to a new string
        // avoid doing this
        // value = new String(ch, start, length);
        // better append it, works for single or multiple calls
        currentValue.append(ch, start, length);
        String val = String.copyValueOf(ch);
        //System.out.println(pad+val);
    }

}
