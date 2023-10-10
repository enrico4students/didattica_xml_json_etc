<?php  
  
#  HelloServer12.php
#- Copyright (c) 2007-2019, HerongYang.com, All Rights Reserved.
#
function hello($someone) { 
   return "Hello " . $someone . "! - SOAP 1.2";
} 
   $server = new SoapServer(null, array(
      'uri' => "urn://www.herong.home/res",
      'soap_version' => SOAP_1_2));
   $server->addFunction("hello"); 
   $server->handle(); 
?>
 