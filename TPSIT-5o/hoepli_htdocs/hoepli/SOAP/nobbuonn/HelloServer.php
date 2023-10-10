<?php # HelloServer.php
# Copyright (c) 2007 HerongYang.com, All Rights Reserved.
#
function hello($someone) { 
   return "Hello " . $someone . "!";
} 
   $server = new SoapServer(null, 
      array('uri' => "urn://www.herong.home/res"));
   $server->addFunction("hello"); 
   $server->handle(); 
?>