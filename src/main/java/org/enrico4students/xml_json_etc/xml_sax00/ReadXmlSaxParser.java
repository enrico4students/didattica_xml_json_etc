/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package org.enrico4students.xml_json_etc.xml_sax00;

/**
 *
 * @author enric
 */
import org.xml.sax.SAXException;

import javax.xml.parsers.ParserConfigurationException;
import javax.xml.parsers.SAXParser;
import javax.xml.parsers.SAXParserFactory;
import java.io.IOException;

public class ReadXmlSaxParser {

    private static final String FILENAME = "./xml/film.xml";

    public static void main(String[] args) {

        System.out.println("Working Directory = " + System.getProperty("user.dir"));

        SAXParserFactory factory = SAXParserFactory.newInstance();

        try {

            // XXE attack, see https://rules.sonarsource.com/java/RSPEC-2755
            SAXParser saxParser = factory.newSAXParser();

            PrintAllHandlerSax handler = new PrintAllHandlerSax();

            saxParser.parse(FILENAME, handler);

        } catch (ParserConfigurationException | SAXException | IOException e) {
            e.printStackTrace();
        }

    }

}