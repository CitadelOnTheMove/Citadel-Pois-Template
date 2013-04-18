<?php
header('Content-type: application/json; charset=utf-8');
include_once 'Config.php';
include_once CLASSES.'Response.class.php';
include_once CLASSES.'PoisDataset.class.php';
include_once CLASSES.'Util.class.php';

include_once CLASSES.'Database.class.php';


if(USE_DATABASE) {
	// open db connection
	Database::connect();
	
	$poisDataset = Response::createFromDb(DatasetTypes::Poi, DATASET_ID);
	Util::printJsonObj(new Response($poisDataset));
	
	Database::disconnect();
}
else {
	$handle = fopen(DATASET_FILE, "r");
	$json = fread($handle, filesize(DATASET_FILE));
	fclose($handle);
	
// 	echo $json;

	// TODO: should type check the source file
	$assocArray = json_decode($json, true);

	$poisDataset = Response::createFromArray(DatasetTypes::Poi, $assocArray);
	Util::printJsonObj(new Response($poisDataset));
}



?>