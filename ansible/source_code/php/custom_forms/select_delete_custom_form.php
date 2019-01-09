
<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<head>
	<title>Hope Matters</title>
	<link rel="icon" href="/images/hope_matters_logo.png">
	<link rel="stylesheet" type="text/css" href="/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="/css/view_client.css">
</head>

<!-- nav bar -->
<div id="container">
	   
	  <div id="sign-out">
        <form method="post" action="/php/dashboard.php">
            <input type="submit" value="Dashboard">
        </form>
      </div>
	  
	  <div id="sign-out">
        <form method="post" action="/php/sign_out.php">
            <input type="submit" value="Sign Out">
        </form>
      </div>

	<div id="sign-out" style="width: 300px; float: left;">
        <form method="post" action="/php/custom_forms/select_custom_form.php">
            <input style="width: 300px;" type="submit" value="Form Selection">
        </form>
      </div>
	  
</div>
<br></br>

  
<header>Pick a Custom Form</header>


<!-- start of select client card --> 
<div style="height: 300px;" class="login-card">
  

<?php

require('../database_credentials.php');
session_start();

// make sure user is logged in
login_check();

$_SESSION['temp'] = 0;

// make database connection
$conn = new PDO($dbconnection_custom, $dbusername_custom, $dbpassword_custom);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


class grab_value extends RecursiveIteratorIterator {
			function __construct($it) {
				parent::__construct($it, self::LEAVES_ONLY);
			}
			function current() {
				$_SESSION['temp'] = parent::current();
			}
			function beginChildren() {
				echo "<tr>";
			}
			function endChildren() {
				echo "</tr>" . "\n";
			}

}

class display_forms extends RecursiveIteratorIterator {
	function __construct($it) {
		parent::__construct($it, self::LEAVES_ONLY);
	}
	function current() {		
		return "<option value='" . parent::current() . "'>";
	}
	function beginChildren() {
		echo "<tr>";
	}
	function endChildren() {
		echo "</tr>" . "\n";
	}

}

class get_meta_tables extends RecursiveIteratorIterator {
		function __construct($it) {
			parent::__construct($it, self::LEAVES_ONLY);
		}
		function current() {
			array_push($_SESSION['tables'], parent::current());
		}
		
}


try {

    echo "<p style='color: black;;text-align: center;'>Select a form to delete.</p>";
    echo "<p style='color: black;;text-align: center;'><b>Warning: This will permanently delete the form along with all its data.</b></p>";

    $_SESSION['tables'] = array();

    $stmt = $conn->prepare("SHOW tables IN custom_forms LIKE '%_meta';");
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
    foreach(new get_meta_tables(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {

    }

    $tables_max = count($_SESSION['tables']);
    $tables = $_SESSION['tables'];

    echo "<form name='delete_form' action='delete_custom_form.php' method='post'>";
    echo "<div style='margin-left: 380px;'>Form: <input list='form_list' name='form' style='padding-left: 10px; margin-left: 10px;width: 180px; height: 20px;' maxlength='20'> <br> 
	  <datalist id='form_list'>";
							
		for ($i = 0; $i < $tables_max; ++$i) {

			$stmt = $conn->prepare("SELECT value FROM $tables[$i] WHERE attribute='form_name';");
			$stmt->execute();
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			
			}
			$value = $_SESSION['temp'];
			$table_name = str_replace('_meta', '', $tables[$i]);

			echo "<option value='$table_name'>$value</option>";

		}
									
							
	echo "</datalist>";
	echo "<div style='margin-top: 50px; margin-left: 20px;'>		
			<input style='width: 200px; height: 30px; background-color: red; color: white;' type='submit' name='submit_button' class='submitbtn' value='Delete'>
	      </div>";
	echo "</form></div>";

}


catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;

?>

</div>
