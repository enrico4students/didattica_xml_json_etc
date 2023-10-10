
<?php
 require_once('lib/nusoap.php');
 #if you use https://soap.oventus.com/LiquidWS/MessageService you will need additional cURL extensions for ssl support
 define ("SERVER_ENDPOINT", " https://soap.oventus.com/LiquidWS/MessageService ");
 $ns2 = "http://jaxb.liquidsoap.pageone.com";

 #create login request and get sessionID
 #enter a user name and password in get_login_body methodcall
 $sessionID = send_soapLoginRequest("login", get_login_body('enter user name here','enter password'));

 #create sendMessage request
 #enter a valid mobile number and a message

send_message_request('sendMessage',get_sendMesssage_body('enter a valid mobile number','enter your message here'),$sessionID);

 function send_soapLoginRequest($method, $body)
 {
 echo "<h3>Performing '".$method."' test</h3>";
 $client=new nusoap_client(SERVER_ENDPOINT);
 if (check_error($client, "Constructor error"))
 return;
 $soapxml = $client->serializeEnvelope($body, "", array(), 'document', 'literal');
 $result = $client->send($soapxml, $method); 
 printRequestResponse($client, $result);
 return get_session_id($client, $result);
 }

 function send_message_request($method, $body,$sessionID)
 {
 echo "<h3>Performing '".$method."' test</h3>";
 $client=new nusoap_client(SERVER_ENDPOINT);
 if (check_error($client, "Constructor error"))
 return;
 $soapxml = $client->serializeEnvelope($body, get_header($sessionID), array(), 'document', 'literal');
 $result = $client->send($soapxml, $method);
 printRequestResponse($client, $result);
 $info = $client->response;
 $parts = explode("transactionID",$info);
 $lpart = ltrim($parts[1], ">");
 $session_info = rtrim($lpart, "</");
 echo '<h2>transactionID is :: </h2><pre>';
 echo $session_info;
 echo '</pre>';

 return;
 }

 
 function get_login_body($userid,$pwd)
 {
 echo "<h3>Getting Login body</h3>";
 return "<m:loginRequest
xmlns:m=\"http://jaxb.liquidsoap.pageone.com\" service-id=\"0\"
vezrsion-id=\"\">\n"
 ."<user-id>".$userid."</user-id>\n"
 ."<pwd>".$pwd."</pwd>\n"
 ."</m:loginRequest>\n";
 }

 function get_sendMesssage_body($destination,$message)
 {
 echo "<h3>Getting Send message body</h3>";
 return "<m:sendMessageRequest
xmlns:m=\"http://jaxb.liquidsoap.pageone.com\"
flashSMS=\"false\">\n"		
 ."<destinationAddress>".$destination."</destinationAddres
s>\n"
 ."<message>".$message."</message>\n"
 ."</m:sendMessageRequest>\n";
 }

 function get_header($sessionID)
 {
 return "<m:pageoneHeader
xmlns:m=\"http://jaxb.liquidsoap.pageone.com\"><session-id>".
$sessionID."</session-id></m:pageoneHeader>";
 }
 
 function get_session_id($client, $result)
 {
 $info = $client->response;
 $parts = explode("session-id",$info);
 $lpart = ltrim($parts[1], ">");
 $session_info = rtrim($lpart, "</");
 echo '<h2>sessionid is :: </h2><pre>';
 echo $session_info;
 echo '</pre>';
 return $session_info;
 }


 function printRequestResponse($client, $result)
 {
 echo '<h3>Sending</h3><textarea cols="100"
rows="20">'.$client->request.'</textarea><br />'.
 '<h3>Response</h3><textarea cols="100"
rows="20">'.$client->response.'</textarea><br />';
 if ($client->fault)
 {
echo '<h2>Fault</h2><pre>';
 print_r($result);
 echo '</pre>';
 }
 else
 {
 check_error($client); 
 }
 }

 function check_error($client)
 {
 $err = $client->getError();
 if ($err)
 {
 echo '<h2>'.$message.'</h2><pre>'.$err.'</pre>';
 return true;
 }
 else
 {
 echo "<p>No errors</p>";
 }

 return false;
 }

?> 