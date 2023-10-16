<?php
require_once "lib/nusoap.php"; // richiamiamo la libreria NuSOAP
 
class food {
 
 public function getFood($type) {   // creiamo la funzione getFood
 switch ($type) {
  case 'Starter':
   return 'Soup';
   break;
  case 'Main':
   return 'Curry';
   break;
  case 'Dessert':
   return 'Ice Cream';
   break;
  default:
   return 'digiuno';
  break;
  }
 }
}
 /* inizializziamo la classe soap_server e configuriamo il WSDL */
$server = new soap_server();

/*$server->configureWSDL("foodservice", "http://www.greenacorn-websolutions.com/foodservice"); */
$server->configureWSDL("foodservice", "http://localhost/hoepli/soap/foodservice"); 

$server->register("food.getFood",
 array("type" => "xsd:string"),
 array("return" => "xsd:string"),
 "http://localhost/hoepli/soap/foodservice",
 "http://localhost/hoepli/soap/foodservice#getFood", "document", "encoded", "Get food by type");
 
@$server->service($HTTP_RAW_POST_DATA);

?>

