<?php
header('Content-type: application/json; charset=utf-8');
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
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