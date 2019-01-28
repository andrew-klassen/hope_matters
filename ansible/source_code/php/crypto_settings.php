<?php


$servername_secret = '{{ secret_host }}';
$dbusername_secret = 'secret';
$dbpassword_secret = '{{ secret_password }}';
$dbname_secret = 'hope_matters';
$dbconnection_secret = "mysql:host=$servername_secret;dbname=$dbname_secret";

$password_hashing_algorithim = PASSWORD_ARGON2ID;
$password_hashing_options = [
    'memory_cost' => 1024,
    'time_cost'   => 2,
    'threads'     => 2,
];

// database query limits
$search_limit = 200;
$wild_card_limit = 200;



function generate_initialization_vector($length = 16) {
   
	$initialization_vector = random_bytes($length);

	return $initialization_vector;
}

function read_key_file($file_name) {

	$temp = file_get_contents($_FILES[$file_name]["tmp_name"]);

	// random bytes are writen over top of the file to prevent it from being recovered at the forensic level	
	if ($temp != '') {
		$temp_file = fopen($_FILES[$file_name]["tmp_name"], "w") or die("Unable to open key file.");
		fwrite($temp_file, random_bytes(strlen($temp)));
		fclose($temp_file);
	}

	return $temp;

}

// checks to see if the user is logged in
function login_check() {
	if ($_SESSION['account_id'] == '') {
		header( 'Location: ../../index.html' );
		exit();
	}
}

// creates the error message when record is inserted or updated incorrectly
function create_database_error($query, $error_location, $pdo_error) {
	
	require_once('browser_info.php');
	
	// database connection information
	$servername_secret = '{{ php_host }}';
	$dbusername_secret = 'php';
	$dbpassword_secret = '{{ php_password }}';
	$dbname_secret = 'hope_matters';
	$dbconnection_secret = "mysql:host=$servername_secret;dbname=$dbname_secret";

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
	$conn = new PDO($dbconnection_secret, $dbusername_secret, $dbpassword_secret);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	
	
	// push the contents of the error message into the database
	$stmt = $conn->prepare("INSERT INTO error (account_id, error_location, query, database_error, browser, version, platform, time_of_error) VALUES (:account_id, :error_location, :query, :database_error, :browser, :version, :platform, :time_of_error);");
	$stmt->execute(array('account_id' => $account_id, 'error_location' => $error_location, 'query' => $query, 'database_error' => $database_error, 'browser' => $browser, 'version' => $version, 'platform' => $platform, 'time_of_error' => $time_of_error));

}
