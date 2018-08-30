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
	  
	  <div style="float: left;  width: 300px;">
        <form method="post" action="view_all_client.php">
            <input style="width: 300px;" type="submit" value="Client Selection">
        </form>
      </div>
	  
</div>
<br></br>

  
<header>View/Change Forms</header>

 
 <!-- begining of search card -->
 <div class="login-card">
  

<?php

require('../database_credentials.php');
session_start();

// make sure user is logged in
login_check();

$_SESSION['temp'] = 0;
$choosen_client_id = $_SESSION['choosen_client_id'];

// class for displaying dental forms on the table
class dental_form extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
		$_SESSION['choosen_dental_form_id'] = parent::current();
		
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 4 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_dental_form_id'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='/php/view_change_any_client_forms/dental_forms_client/grab_choosen_dental_form_id.php? choosen_dental_form_id=$temp' style='color: black;'>" . parent::current() . "</a>" . "</td>";
  
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}


// class for displaying discharge forms on the table
class discharge_form extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
		$_SESSION['choosen_discharge_form_id'] = parent::current();
		
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 4 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_discharge_form_id'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='/php/view_change_any_client_forms/discharge_forms_client/grab_choosen_discharge_form_id.php? choosen_discharge_form_id=$temp' style='color: black;'>" . parent::current() . "</a>" . "</td>";
    
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}


// class for displaying lab forms on the table
class lab_form extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
		$_SESSION['choosen_lab_form_id'] = parent::current();
		
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 4 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_lab_form_id'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='/php/view_change_any_client_forms/labs_client/grab_choosen_lab.php? choosen_lab=$temp' style='color: black;'>" . parent::current() . "</a>" . "</td>";
  
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}


// class for displaying optometry forms on the table
class optometry_form extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
		$_SESSION['choosen_optometry'] = parent::current();
		
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 4 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_optometry'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='/php/view_change_any_client_forms/optometry_form_client/grab_choosen_optometry.php? choosen_optometry=$temp' style='color: black;'>" . parent::current() . "</a>" . "</td>";
  
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}


// class for displaying referral forms on the table
class referral_form extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
		$_SESSION['choosen_referral_form_id'] = parent::current();
		
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 4 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_referral_form_id'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='/php/view_change_any_client_forms/referral_form_client/grab_choosen_referral_form_id.php? choosen_referral_form_id=$temp' style='color: black;'>" . parent::current() . "</a>" . "</td>";
  
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}


// class for displaying return treatment forms on the table
class return_treatment_form extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
		$_SESSION['choosen_return_treatment_form_id'] = parent::current();
		
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 4 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_return_treatment_form_id'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='/php/view_change_any_client_forms/return_treatment_form_client/grab_choosen_return_treatment_form_id.php? choosen_return_treatment_form_id=$temp' style='color: black;'>" . parent::current() . "</a>" . "</td>";
  
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}

// class for displaying treatment forms on the table
class treatment_form extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
		$_SESSION['choosen_treatment_form_id'] = parent::current();
		
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 4 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_treatment_form_id'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='/php/view_change_any_client_forms/treatment_form_client/grab_choosen_treatment_form_id.php? choosen_treatment_form_id=$temp' style='color: black;'>" . parent::current() . "</a>" . "</td>";
  
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}

// class for displaying ultrasounds on the table
class ultrasound extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
		$_SESSION['choosen_ultrasound_id'] = parent::current();
		
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 4 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_ultrasound_id'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='/php/view_change_any_client_forms/ultrasounds_client/grab_choosen_ultrasound_id.php? choosen_ultrasound_id=$temp' style='color: black;'>" . parent::current() . "</a>" . "</td>";
  
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}

// class for displaying lab orders on the table
class lab_order extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
		$_SESSION['choosen_lab_order'] = parent::current();
		
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 4 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_lab_order'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='/php/view_change_any_client_forms/lab_orders_client/grab_choosen_lab_order.php? choosen_lab_order=$temp' style='color: black;'>" . parent::current() . "</a>" . "</td>";
  
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}

// class for displaying Women's Health Forms on the table
class women_health extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
		$_SESSION['choosen_women_health_id'] = parent::current();
		
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 4 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_women_health_id'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='/php/view_change_any_client_forms/women_health_client/grab_choosen_women_health_id.php? choosen_women_health_id=$temp' style='color: black;'>" . parent::current() . "</a>" . "</td>";
  
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}

// class for displaying Child Welfare Forms on the table
class child_welfare_care extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {
		$_SESSION['choosen_child_welfare_care'] = parent::current();
		
		if (($_SESSION['counter'] == 0) or ($_SESSION['counter'] % 4 == 0)) {
		
			$_SESSION['temp'] = $_SESSION['choosen_child_welfare_care'];
			
		}
		$temp = $_SESSION['temp'];
		
		return "<td style='border-style: solid; border-color: #black; background-color: white; color: black;font-weight: 500;font-size: 12px;font-size: 30px;  '>" . "<a href='/php/view_change_any_client_forms/child_welfare_care_client/grab_choosen_child_welfare_care.php? choosen_child_welfare_care=$temp' style='color: black;'>" . parent::current() . "</a>" . "</td>";
  
    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}


// class used for grabing a specific value
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



try {
	
	// make database connection
    $conn = new PDO($dbconnection, $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
	
	echo "<p style='color: black;;text-align: center;'>Click on a form to edit it. The newest forms will be at the top of the list.</p>";
	
	// get the client's name
	$stmt = $conn->prepare("SELECT CONCAT(first_name, ' ', last_name) FROM general_info WHERE client_id='$choosen_client_id'");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$name = $_SESSION['temp'];
	
	
	// get the client's gender
	$stmt = $conn->prepare("SELECT sex FROM general_info WHERE client_id='$choosen_client_id';");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
	foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
	}
	$sex = $_SESSION['temp'];
	
	
	// echo client name
	echo '<div style="  padding-left: 340px; width: 900px; height: 30px;">';
	echo '<b>Client ID:</b> '.$choosen_client_id . '&nbsp;&nbsp;&nbsp;' .'<b>Client Name:</b> ' . $name;
	echo '</div>';
	
	// search bar
	echo "<div id='searchDiv'>
				<div style='width: 850px;'>
					<div style='width: 320px; float: left; margin-left: 80px;'>
						<form action='/php/view_change_any_client_forms/view_all_form.php' method='post' id='searchForm'>
							<input style='margin-left: 20px; float: right; height: 20px;'type='submit' id='search_submit' value='Submit'>
						
							View Forms: <select name='transaction_type' method='post'>
											<option value='all' selected='selected'>All Forms</option>
											<option value='dental'>Dental</option>
											<option value='discharge'>Discharge</option>
											<option value='lab'>Lab</option>
											<option value='optometry'>Optometry</option>
											<option value='referral'>Referral</option>
											<option value='return_treatment'>Return Treatment</option>
											<option value='treatment'>Treatment</option>";
											if ($sex == 'female') {
												echo "<option value='ultrasound'>Ultrasound</option>";
												echo "<option value='women_health'>Women's Health</option>";
											} echo "
											<option value='lab_order'>Lab Order</option>
											<option value='child_welfare'>Child Welfare</option>
										</select>
										
						</form>
					</div>
					
					<div style='width: 310px; float: left; margin-left: 50px;'>
						<form action='/php/view_change_any_client_forms/grab_new_form.php' method='post' id='searchForm'>
							<input style='margin-left: 20px; float: right; height: 20px;'type='submit' id='search_submit' value='Add'>
							
							New Form: <select name='form_type' method='post'>
										<option value='dental' selected='selected'>Dental</option>
										<option value='discharge'>Discharge</option>
										<option value='lab'>Lab</option>
										<option value='optometry'>Optometry</option>
										<option value='referral'>Referral</option>
										<option value='return_treatment'>Return Treatment</option>
										<option value='treatment'>Treatment</option>";
										if ($sex == 'female') {
												echo "<option value='ultrasound'>Ultrasound</option>";
												echo "<option value='women_health'>Women's Health</option>";
										} echo "
										<option value='lab_order'>Lab Order</option>
										<option value='child_welfare'>Child Welfare</option>
									  </select>
								
						</form>
					</div>
				</div>
			</div>
	";
	
	$transaction_type = $_POST['transaction_type'];
	
    echo "<div id='tableCard'>";
	

	echo "<table style='border: none;'>";
	echo "<tr><th>Form Id</th><th>Form Type</th><th>Time Edited</th><th>Author</th></tr>";
	
	
	// filtered by dental forms
	if ($transaction_type == 'dental'){
	
		$stmt = $conn->prepare("SELECT dental_form_id, 'dental', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM dental_form WHERE client_id='$choosen_client_id' ORDER BY dental_form_id DESC LIMIT $client_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new dental_form(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	
	}
	// filtered by discharge forms
	elseif ($transaction_type == 'discharge'){
	
		$stmt = $conn->prepare("SELECT discharge_form_id, 'discharge', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM discharge_form WHERE client_id='$choosen_client_id' ORDER BY discharge_form_id DESC LIMIT $client_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new discharge_form(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	
	}
	// filtered by lab forms
	elseif ($transaction_type == 'lab'){
	
		$stmt = $conn->prepare("SELECT lab_id, 'lab', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM lab WHERE client_id='$choosen_client_id' ORDER BY lab_id DESC LIMIT $client_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new lab_form(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	
	}
	// filered by optometry forms
	elseif ($transaction_type == 'optometry'){
	
		$stmt = $conn->prepare("SELECT optometry_form_id, 'optometry', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM optometry_form WHERE client_id='$choosen_client_id' ORDER BY optometry_form_id DESC LIMIT $client_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new optometry_form(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	
	}
	// filered by referral forms
	elseif ($transaction_type == 'referral'){
	
		$stmt = $conn->prepare("SELECT referral_form_id, 'referral', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM referral_form WHERE client_id='$choosen_client_id' ORDER BY referral_form_id DESC LIMIT $client_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new referral_form(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	
	}
	// filered by return treatment forms
	elseif ($transaction_type == 'return_treatment'){
	
		$stmt = $conn->prepare("SELECT return_treatment_id, 'return_treatment', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM return_treatment WHERE client_id='$choosen_client_id' ORDER BY return_treatment_id DESC LIMIT $client_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new return_treatment_form(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	
	}
	// filered by treatment forms
	elseif ($transaction_type == 'treatment'){
	
		$stmt = $conn->prepare("SELECT treatment_id, 'treatment', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM treatment WHERE client_id='$choosen_client_id' ORDER BY treatment_id DESC LIMIT $client_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new treatment_form(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	
	}
	// filered by ultrasounds
	elseif ($transaction_type == 'ultrasound'){
	
		$stmt = $conn->prepare("SELECT ultrasound_id, 'ultrasound', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM ultrasound WHERE client_id='$choosen_client_id' ORDER BY ultrasound_id DESC LIMIT $client_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new ultrasound(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	
	}
	// filered by lab orders
	elseif ($transaction_type == 'lab_order'){
	
		$stmt = $conn->prepare("SELECT lab_order_id, 'lab_order', date_format(time_created, '%b %d %Y %h:%i %p'), created_by FROM lab_order WHERE completed_by IS NULL AND client_id='$choosen_client_id' ORDER BY lab_order_id DESC LIMIT $client_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new lab_order(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	
	}
	// filered by women's health
	elseif ($transaction_type == 'women_health'){
	
		$stmt = $conn->prepare("SELECT women_health_id, 'women_health', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM women_health WHERE client_id='$choosen_client_id' ORDER BY women_health_id DESC LIMIT $client_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new women_health(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	
	}
	// filered by child welfare care
	elseif ($transaction_type == 'child_welfare'){
	
		$stmt = $conn->prepare("SELECT child_welfare_care_id, 'child_welfare_care', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM child_welfare_care WHERE client_id='$choosen_client_id' ORDER BY child_welfare_care_id DESC LIMIT $client_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new child_welfare_care(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	
	}
	// all forms
	else {
	
		$stmt = $conn->prepare("SELECT dental_form_id, 'dental', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM dental_form WHERE client_id='$choosen_client_id' ORDER BY dental_form_id DESC LIMIT $client_all_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new dental_form(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
		
		
		$stmt = $conn->prepare("SELECT discharge_form_id, 'discharge', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM discharge_form WHERE client_id='$choosen_client_id' ORDER BY discharge_form_id DESC LIMIT $client_all_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new discharge_form(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	   
	   
		$stmt = $conn->prepare("SELECT lab_id, 'lab', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM lab WHERE client_id='$choosen_client_id' ORDER BY lab_id DESC LIMIT $client_all_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new lab_form(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
		
		
		$stmt = $conn->prepare("SELECT optometry_form_id, 'optometry', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM optometry_form WHERE client_id='$choosen_client_id' ORDER BY optometry_form_id DESC LIMIT $client_all_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new optometry_form(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
		
	
		$stmt = $conn->prepare("SELECT referral_form_id, 'referral', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM referral_form WHERE client_id='$choosen_client_id' ORDER BY referral_form_id DESC LIMIT $client_all_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new referral_form(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
		
		
		$stmt = $conn->prepare("SELECT return_treatment_id, 'return_treatment', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM return_treatment WHERE client_id='$choosen_client_id' ORDER BY return_treatment_id DESC LIMIT $client_all_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new return_treatment_form(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
		
		
		$stmt = $conn->prepare("SELECT treatment_id, 'treatment', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM treatment WHERE client_id='$choosen_client_id' ORDER BY treatment_id DESC LIMIT $client_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new treatment_form(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
		
		
		$stmt = $conn->prepare("SELECT ultrasound_id, 'ultrasound', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM ultrasound WHERE client_id='$choosen_client_id' ORDER BY ultrasound_id DESC LIMIT $client_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new ultrasound(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
		
	
		$stmt = $conn->prepare("SELECT lab_order_id, 'lab_order', date_format(time_created, '%b %d %Y %h:%i %p'), created_by FROM lab_order WHERE completed_by IS NULL AND client_id='$choosen_client_id' ORDER BY lab_order_id DESC LIMIT $client_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new lab_order(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	
	
		$stmt = $conn->prepare("SELECT women_health_id, 'women_health', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM women_health WHERE client_id='$choosen_client_id' ORDER BY women_health_id DESC LIMIT $client_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new women_health(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	
	
		$stmt = $conn->prepare("SELECT child_welfare_care_id, 'child_welfare_care', date_format(timestamp, '%b %d %Y %h:%i %p'), created_by FROM child_welfare_care WHERE client_id='$choosen_client_id' ORDER BY child_welfare_care_id DESC LIMIT $client_form_limit;");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$_SESSION['counter'] = 0;
		foreach(new child_welfare_care(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		   echo $v;
		   ++$_SESSION['counter'];
		}
	
   
	}
   
	echo "</table>";
    echo "</div>";
	
}


catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$conn = null;


?>

</div>