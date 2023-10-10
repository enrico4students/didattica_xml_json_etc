<?php
//https://googleapis.github.io/google-cloud-php/#/docs/google-cloud/v0.122.0/storage/storageclient

// al promt de comandi digitare
// set GOOGLE_APPLICATION_CREDENTIALS="D:\TPSIT3\FIREBASE\TPSIT-acd3df46769d.json"

# Includes the autoloader for libraries installed with composer
//require __DIR__ . '/vendor/autoload.php';


namespace Coderatio\PhpFirebase;
require __DIR__ . '\Engine.php';

 
# Imports the Google Cloud client library
use Google\Cloud\Storage\StorageClient;

# Your Google Cloud Platform project ID
$projectId = 'tpsit-15d0b';

$pathToSecretKeyJsonFile='hoepli/PHP/Firebase';  


include("PhpFirebase.php");
$pfb = new PhpFirebase($pathToSecretKeyJsonFile);
$pfb->setTable('posts');
$pfb->insertRecord([
    'title' => 'Post one',
    'body' => 'Post one contents'
  ], $returnData);


  //The $returnData which is boolean returns inserted data if set to true. Default is false.


//To read created records, do this...(R)

// Getting all records
$pfb->getRecords();

// Getting a record. Note: This can only be done via the record id.
$pfb->getRecord(1); 


//To update a record, do this... (U)

// This takes the record ID and any column you want to update.
$pfb->updateRecord(1, [
  'title' => 'Post one edited'
]);

//To delete created record, do this... (D)

 // This takes only the record ID. Deleting all records will be added in Beta-2
 
 $pfb->deleteRecord(1);


?>
