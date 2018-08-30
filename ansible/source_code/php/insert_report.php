<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

require('database_credentials.php');
require('file_upload.php');
require('browser_info.php');
session_start();

// make sure user is logged in
login_check();

// make sure image is acceptible before continuing
if ($snapshot = upload_file('snapshot', 'Snapshot', '/html/report_bug.html', '../uploaded_images/snapshots/')) {

	$account_id = $_SESSION['account_id'];	
	$severity_level = $_POST['severity_level'];
	$location = $_POST['location'];
	$description = $_POST['description'];
	$browser_info = get_browser_info();
	$browser = $browser_info['name'];
	$version = $browser_info['version'];
	$platform = $browser_info['platform'];
	$time_of_error = date('Y-m-d H:i:s');
	
	// excape backslashes
	$description = str_replace("\\", "\\\\", $description);
	$location = str_replace("\\", "\\\\", $location);
	
	// single quotes need to be replaced with the correct excape keys for the following values
	$description = str_replace('\'', '\\\'', $description);
	$location = str_replace('\'', '\\\'', $location);
	
}
	
// make database connection
$conn = new PDO($dbconnection, $dbusername, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


try {
			
	$query = "INSERT INTO report_bug (account_id, severity_level, location, description, browser, version, platform, snapshot, time_of_error) VALUES ('$account_id', '$severity_level', '$location', '$description', '$browser', '$version', '$platform', '$snapshot', '$time_of_error');"; 
	$conn->exec($query);
				
	// redirect user back to the dashboard
	echo "<script type='text/javascript'>
			alert('Thank you for filling out this bug report. You should hear from a developer shortly.'); 
			document.location.href = 'dashboard.php'; 
		  </script>";

}

catch(PDOException $e) {
	create_database_error($query, 'insert_report.php', $e->getMessage());
}

$conn = null;