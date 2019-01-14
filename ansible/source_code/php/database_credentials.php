<?php

/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen

*/

session_start();

// if DEBUG_MODE is true, users will have the ability to report bugs
const DEBUG_MODE = false;

// storage checking
/*********************************
The STORAGE_CHECK constant determines whether or not the program will check
to see if any thing is wrong with the hard drives in the array. The only offically
supported raid controller is the LSI 9240-8i. This program also depends on
storcli64 being installed. Below is a link to a mirror were storcli64 can be downloaded.
ftp://ftp.supermicro.com/Driver/SAS/LSI/Tools/storcli_6.6-1.14.12/Linux/
If STORAGE_CHECK is set to false, set NUMBER_OF_HARD_DRIVES equall to 0.
*********************************/

const STORAGE_CHECK = false;
const NUMBER_OF_HARD_DRIVES = 3;
const SERVER_WITH_STORAGE_ARRAY = '';
const USERNAME = 'root';
const PASSWORD = '';

// database connection information
/*********************************
Remember to duplicate the database connection information
into the create_database_error function, which is defined
below.
*********************************/

$servername = '{{ php_host }}';
$dbusername = 'php';
$dbpassword = '{{ php_password }}';
$dbname = 'hope_matters';
$dbconnection = "mysql:host=$servername;dbname=$dbname";

$dbconnection_custom = "mysql:host=$servername;dbname=custom_forms";
$dbusername_custom = $_SESSION['username'];
$dbpassword_custom = $_SESSION['login_password'];

$password_hashing_algorithim = PASSWORD_ARGON2ID;
$password_hash_migration = true;

// database query limits
$search_limit = 200;
$wild_card_limit = 200;
$master_log_limit = 4000;
$client_form_limit = 4000;
$client_all_form_limit = 200;

/*********************************
Below are function definitions.
*********************************/

// checks to see if the user is logged in
function login_check() {
	if ($_SESSION['account_id'] == '') {
		header( 'Location: ../../index.html' );
		exit();
	}
}
// makes sure user has access to the master log
function master_log_check() {
	if ($_SESSION['master_log_access'] != 'yes') {
		header( 'Location: ../dashboard.php' );
		exit();
	}
}

// creates the error message when record is inserted or updated incorrectly
function create_database_error($query, $error_location, $pdo_error) {
	
	require_once('browser_info.php');
	
	// database connection information
	$servername = '{{ php_host }}';
	$dbusername = 'php';
	$dbpassword = '{{ php_password }}';
	$dbname = 'hope_matters';
	$dbconnection = "mysql:host=$servername;dbname=$dbname";
	$dbconnection_custom = "mysql:host=$servername;dbname=custom_forms";

	$browser_info = get_browser_info();
	$account_id = $_SESSION['account_id'];
	$browser = $browser_info['name'];
	$version = $browser_info['version'];
	$platform = $browser_info['platform'];
	$time_of_error = date('Y-m-d H:i:s');
	
	
	// display error message to the user
	echo '**************************************************************************' . '</br>' .
		 '<b>Error</b>' . '</br>' . '</br>' .
		 
		 'Please create a bug report that contains the information below.' . '</br>' . '</br>' .
		 
		 '**************************************************************************' . '</br>' . '</br>' .
		 
		 
		 '<b>Error Location:</b> ' . $error_location . '</br>' . '</br>' . '</br>' .
		 '<b>SQL Query:</b>'. '</br>' . '</br>' . $query . '</br>' . '</br>' .
		 '<b>Database Error:</b>' . '</br>' . '</br>' . $pdo_error . '</br>' . '</br>' .	
		 '<b>Client\'s Web Browser:</b> ' . $browser . '</br>' .
		 '<b>Version:</b> ' . $version . '</br>' .
		 '<b>Platform:</b> ' . $platform . '</br>' . '</br>' .
		 '<b>User Account ID:</b> ' . $account_id . '</br>' .
		 '<b>Time:</b> ' . $time_of_error . '</br>' . '</br>' . '</br>' .
		 
		 '**************************************************************************' . '</br>' .
		 "<form  action='../dashboard.php'>
			<input type='submit' value='Back to dashboard'>
		  </form>" .
		 '**************************************************************************';
	
	
	// replace single quotes with correct excape keys
	$query = str_replace('\'', '\\\'', $query);
	$database_error = str_replace('\'', '\\\'', $pdo_error);
	
	
	// establish database connection
	$conn = new PDO($dbconnection, $dbusername, $dbpassword);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
	// push the contents of the error message into the database
	$query = "INSERT INTO error (account_id, error_location, query, database_error, browser, version, platform, time_of_error) 
			  VALUES ('$account_id', '$error_location','$query', '$database_error', '$browser', '$version', '$platform', '$time_of_error');"; 
    	$conn->exec($query);
}

function generate_initialization_vector($length = 16) {
   
	do {

		$initialization_vector = random_bytes($length);

	} while (strpos($initialization_vector, "'") !== false or strpos($initialization_vector, "\"") !== false or strpos($initialization_vector, "\$") !== false or strpos($initialization_vector, "\\") !== false);	

	return $initialization_vector;

}


function database_format($string) {

	$search = array("\\",  "\x00", "\n",  "\r", "\x1a");
        $replace = array("\\\\","\\0","\\n", "\\r", "\\Z");

	$string = strtolower($string);
	$string = str_replace(' ', '_', $string);
	$string = str_replace($search, $replace, $string);

        return $string;

}

function query_format($string) {

	$search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
        $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

	$string = str_replace($search, $replace, $string);

        return $string;

}

function html_value_format($string) {

	$search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
        $replace = array("\\\\","\\0","\\n", "\\r", "&#39;", "&#34;", "\\Z");

	$string = str_replace($search, $replace, $string);

        return $string;

}


function html_name_format($string) {

	$search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a", ".");
        $replace = array("\\\\","\\0","\\n", "\\r", "", "", "\\Z", "");

	$string = str_replace($search, $replace, $string);

        return $string;

}


function html_format($string) {

	$string = ucfirst($string);
	$string = str_replace('_', ' ', $string);
	
	$string = htmlentities($string);

	return $string;

}










