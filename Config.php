<?php
/*
 * Configuration settings
 */

// Useful directories
$root_path = dirname(dirname(__FILE__)) . '/';
$web_path = dirname($_SERVER['PHP_SELF']);
$relative_path = $_SERVER['SERVER_NAME'] . dirname($web_path) . '/';
$path_parts = explode('/', $web_path);
$app_path = end($path_parts) . '/';
if (isset($_SERVER['HTTPS'])) {
	$server_name = "https://" . $relative_path;
} else {
	$server_name = "http://" . $relative_path;
}


/***********************************************************
 * Don't forget to insert the web root directory 
 * for example: "C:/wamp/www/" is the default root web dir in a standard wampServer setup)
 ***********************************************************
 */
//define("HTDOCS_ROOT", "/code/");  
// Following should work in all situations (with trailing slash)
define("HTDOCS_ROOT", $root_path);

/*********************************************************** 
 * Replace 'localhost' with your IP address, 
 * if you want to access the template with a mobile device
 * connected to the same network 
 ***********************************************************
 */
//define("SERVERNAME", "http://localhost/"); 
// Automatically set server name - should work in most cases, use above setting if not
define("SERVERNAME", $server_name);

/*********************************************************** 
 * Leave all the settings below unchanged if you only want
 * to run the template with the default dataset and parameters.
 ***********************************************************
 */
 
define("BASE_DIR", $app_path);
define("CLASSES_DIR", "php/");
define("CLASSES", HTDOCS_ROOT . BASE_DIR . CLASSES_DIR);

define("DEBUG", true);

// dataset
define("DATASET_FILE", HTDOCS_ROOT . BASE_DIR ."data/POI_gent.json");
define("DATASET_ID", 36);
define("DATASET_URL", SERVERNAME . BASE_DIR . "dataset.php");
define("USE_DATABASE", false);

// Map Options (coords point to center of Gent)
define("MAP_CENTER_LATITUDE", 51.033261); 
define("MAP_CENTER_LONGITUDE", 3.726488);
define("MAP_ZOOM", 16);

// database
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_HOSTNAME", "127.0.0.1");
define("DB_PORT", "3306");
define("DB_NAME", "citadel");


