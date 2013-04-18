<?php
include_once 'Config.php';
include_once CLASSES.'Util.class.php';
include_once CLASSES.'Filter.class.php';
include_once CLASSES.'Database.class.php';
include_once CLASSES.'Response.class.php';
include_once CLASSES.'PoisDataset.class.php';

/**
 * echoes a javascript array with the filters of the active dataset (from Config.php)
 */
function printFilters() {
	$filters = array();
	
	$keys = array();
	
	if(USE_DATABASE) {
		if(!Database::isConnected()) Database::connect();
		$filters = Dataset::getCategories(DATASET_ID);
	}
	else {
		$handle = fopen(DATASET_FILE, "r");
		$json = fread($handle, filesize(DATASET_FILE));
		fclose($handle);
	
		// TODO: should type check the source file
		$assocArray = json_decode($json, true);
	
		$poisDataset = Response::createFromArray(DatasetTypes::Poi, $assocArray);
		
		foreach($poisDataset->poi as $poi) {
			foreach($poi->category as $cat) {
				if(!in_array($cat, $keys))  {
					$keys[] = $cat;
					$filters[] = new Filter($cat, true);
				}
			}
		}
	}
	Util::printJsonObj($filters);
}
?>