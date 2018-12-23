<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<!DOCTYPE html>
<html>

<head>
	<title>Hope Matters</title>
	<link rel="icon" href="/images/hope_matters_logo.png">
	<link rel="stylesheet" type="text/css" href="/css/dashboard.css">
	<link rel="stylesheet" type="text/css" href="/css/navbar_dashboard.css">
</head>

<body style="padding-top: 70px;">

<!-- nav bar -->
<div id="container">
  
	  <div id="sign-out" >
        <form  method="post" action="/php/sign_out.php">
            <input style="width: 195px;" type="submit" value="Sign Out">
        </form>
      </div>
	  
	  <div style="float: left;  width: 300px;">
        <form method="post" action="/html/change_password.html">
            <input style="width: 300px;" type="submit" value="Change Password">
        </form>
      </div>
	  
	  <div style="float: left;">
        <form method="post" action="/php/employee_info/change_info.php">
            <input style="width: 210px;" type="submit" value="Change Info">
        </form>
      </div>
	  
</div>
<br></br>


<!-- start of the dashboard card -->
<div class="login-card" style="width: 1075px;">
	
<?php
	
require('../php/database_credentials.php');
session_start();

$_SESSION['username'] = "noname";
$id = $_SESSION['account_id'];
$_SESSION['temp'] = 0;
				
		
class login extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }
    function current() {																								
		$_SESSION['username'] = parent::current();

    }
    function beginChildren() {
        echo "<tr>";
    }
    function endChildren() {
        echo "</tr>" . "\n";
    }
}


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
		// create new connection 
		$conn = new PDO($dbconnection, $dbusername, $dbpassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// fetch first name, so that it is displayed on the dashboard 
		$stmt = $conn->prepare("SELECT username FROM accounts WHERE account_id='$id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		foreach(new login(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
			echo $v;
			++$count;
		}
		
		// see if user has access to the master log
		$stmt = $conn->prepare("SELECT master_log_access FROM accounts WHERE account_id='$id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
				
		}
		$_SESSION['master_log_access'] = $master_log_access = $_SESSION['temp'];
		
		
		//make sure user is logged in
		login_check();
		
	}
		
		
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;						
	
	echo "<p class='p'style='color: black;font-weight:100;'>Welcome to your dashboard " . $_SESSION['username'] . "</p>";
	
?>

  <!-- displays the hope matters logo -->
  <h1><img src="/images/hope_matters_logo.png" style="width: 200px; height: 240px;"></h1><br>
	
	<div style="width: 450px;height: 35px; margin-left: 375px; " >
		<label style="font-size: 18px; " >The program manual can be viewed <a style="color: blue; opacity: 1;"href="/hope_matters_manual.pdf" target="_blank">here</a>.</label>
	</div>
	
	<!-- Report Bug -->
	<?php
		// DEBUG_MODE is a constant set in database_credentials.php
		if (DEBUG_MODE) {
			echo "
				<div style='float: left; margin-left: 475px; width: 900px; height: 60px;'>
					  <div>
						<form name='login_form'  action='/html/report_bug.html' method='post'>
							<input type='submit' name='not_login' class='login login-submit' value='Report Bug'>
						</form>
					  </div> 
					   
				</div>
			";
		}
	?>
	<div style="float: left; margin-left: 380px; width: 900px; height: 45px;">
		
		<label style="float: left; margin-right: 10px;">Current Clients:</label>
		
		<!-- Checked in Clients -->
		
		<form action="/php/current_clients/view_client.php" name="login_form" onsubmit="return validateForm()" method="post">
			<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="check in">
		</form>
		<form action="/php/current_clients/view_checked_out_clients.php" name="login_form" onsubmit="return validateForm()" method="post">
			<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="check out">
		</form>
		<form action="/php/current_clients/view_checked_in_clients.php" name="login_form" onsubmit="return validateForm()" method="post">
			<input style="float: left;" type="submit" name="not_login" class="login login-submit" value="view">
		</form>
		
	</div>
	
	<div style="width: 1000px; height: 235px;">
	
		<div style="float: left; padding-left: 50px; width: 225px;">
			
			<div style="height: 35px; width: 200px;"><label>Clients:</label></div>
			<!--<div style="height: 35px; width: 200px;"><label>Dental Forms:</label></div>-->
			<!--<div style="height: 35px; width: 200px;"><label>Discharge Forms:</label></div>-->
			<div style="height: 35px; width: 200px;"><label>Labs:</label></div>
			<!--<div style="height: 35px; width: 200px;"><label>Optometry Forms:</label></div>-->
			<div style="height: 35px; width: 200px;"><label>Child Welfare Care:</label></div>
			<div style="height: 35px; width: 200px;"><label>Referral Forms:</label></div>
			<div style="height: 35px; width: 200px;"><label>Vital Signs:</label></div>
		</div>
		
		<div style="float: left; width: 225px;">
			
			
			
			
			<!-- clients -->
			<div style="height: 35px; width: 200px;">
				<form action="/html/add_client.html" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="add">
				</form>
				<form action="/php/clients/view_client.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left;" type="submit" name="not_login" class="login login-submit" value="view/change">
				</form>
			</div>
			
			<!-- dental forms -->
			<!-- <div style="height: 35px; width: 200px;">
				<form action="/php/dental_forms/select_client_dental_form.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="add">
				</form>
				<form action="/php/dental_forms/select_dental_form.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left;" type="submit" name="not_login" class="login login-submit" value="view/change">
				</form>
			</div> -->
			
			<!-- discharge forms -->
			<!--<div style="height: 35px; width: 200px;">
				<form action="/php/discharge_forms/select_client_discharge_form.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="add">	
				</form>
				<form action="/php/discharge_forms/select_discharge_form.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left;" type="submit" name="not_login" class="login login-submit" value="view/change">
				</form>
			</div> -->
			
			<!-- lab forms -->
			<div style="height: 35px; width: 200px;">
				<form action="/php/labs/select_client_lab.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="add">	
				</form>
				<form action="/php/labs/select_lab.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left;" type="submit" name="not_login" class="login login-submit" value="view/change">
				</form>
			</div>
			
			<!-- optometry forms -->
			<!--<div style="height: 35px; width: 200px;">
				<form action="/php/optometry_form/select_client_optometry.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="add">
				</form>
				<form action="/php/optometry_form/select_optometry.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left;" type="submit" name="not_login" class="login login-submit" value="view/change">
				</form>
			</div> -->
			
			<!-- Child Welfare Care -->
			<div style="height: 35px; width: 200px;">
				<form action="/php/child_welfare_care/select_client_child_welfare_care.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="add">	
				</form>
				<form action="/php/child_welfare_care/select_child_welfare_care.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left;" type="submit" name="not_login" class="login login-submit" value="view/change">
				</form>
			</div>

			<!-- referral forms -->
			<div style="height: 35px; width: 200px;">
				<form action="/php/referral_form/select_client_referral_form.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="add">
				</form>
				<form action="/php/referral_form/select_referral_form.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left;" type="submit" name="not_login" class="login login-submit" value="view/change">
				</form>
			</div>

			<!-- Vital Signs -->
			<div style="height: 35px; width: 200px;">
				<form action="/php/vital_signs/select_client_vital_signs.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="add">
				</form>
			</div>
			
		</div>
		
		<div style="float: left; padding-left: 50px; width: 225px;">
			<div style="height: 35px; width: 200px;"><label>Return Treatment:</label></div>
			<div style="height: 35px; width: 200px;"><label>Treatment Forms:</label></div>
			<div style="height: 35px; width: 200px;"><label>Ultrasounds:</label></div>
			<!--<div style="height: 35px; width: 200px;"><label>Lab Orders:</label></div>-->
			<!--<div style="height: 35px; width: 200px;"><label>Women's Health Reports:</label></div>-->
			<div style="height: 35px; width: 200px;"><label>Medication Order:</label></div>
			
		</div>
		
		<div style="float: left; width: 225px;">
		
			<!-- return treatment forms -->
			<div style="height: 35px; width: 200px;">
				<form action="/php/return_treatment_form/select_client_return_treatment_form.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="add">
				</form>
				<form action="/php/return_treatment_form/select_return_treatment_form.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left;" type="submit" name="not_login" class="login login-submit" value="view/change">
				</form>
			</div>
			
			<!-- treatment forms -->
			<div style="height: 35px; width: 200px;">
				<form action="/php/treatment_form/select_client_treatment_form.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="add">
				</form>
				<form action="/php/treatment_form/select_treatment_form.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left;" type="submit" name="not_login" class="login login-submit" value="view/change">
				</form>
			</div>
			
			<!-- ultrasounds -->
			<div style="height: 35px; width: 200px;">
				<form action="/php/ultrasounds/select_client_ultrasound.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="add">	
				</form>
				<form action="/php/ultrasounds/select_ultrasound.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left;" type="submit" name="not_login" class="login login-submit" value="view/change">
				</form>
			</div>
			
			<!-- Lab Orders -->
			<!--<div style="height: 35px; width: 400px;">
				<form action="/php/lab_orders/select_client_lab_order.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="add">	
				</form>
				<form action="/php/lab_orders/select_lab_order.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left;  margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="view/change">
				</form>
				<form action="/php/lab_orders/select_complete_lab_order.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left;" type="submit" name="not_login" class="login login-submit" value="Complete an Order">
				</form>
			</div>-->
			
			<!-- women health reports -->
			<!--<div style="height: 35px; width: 200px;">
				<form action="/php/women_health/select_client_women_health.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="add">	
				</form>
				<form action="/php/women_health/select_women_health.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left;" type="submit" name="not_login" class="login login-submit" value="view/change">
				</form>
			</div>-->
			
			

			
			<!-- Medication Orders -->
			<div style="height: 35px; width: 400px;">
				<form action="/php/medication_order/select_client_medication_order.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="add">	
				</form>
				<form action="/php/medication_order/select_client_medication_order_change.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left; margin-right: 10px;" type="submit" name="not_login" class="login login-submit" value="view/change">
				</form>
				<form action="/php/medication_order/select_client_medication_order_complete.php" name="login_form" onsubmit="return validateForm()" method="post">
					<input style="float: left; " type="submit" name="not_login" class="login login-submit" value="Complete an Order">
				</form>
			</div>
			

			
		</div>
			
	</div>
	
  
  <div style="float: left; margin-left: 260px; margin-top: 20px; width: 900px; height: 50px;">
	
		  <!-- "view/change any of a client's forms" button -->
		  <div style="margin-left: 153px;">
			<form action="/php/view_change_any_client_forms/view_all_client.php" name="login_form" onsubmit="return validateForm()" method="post">
				<input type="submit" name="not_login" class="login login-submit" value="view/change any of a client's forms">
			</form>
		  </div>
		  
		  <br> 
  </div>
  
  
  <div style="float: left; margin-top: 10px;">
		  	  
		  <!-- Master Log -->
		  <?php
			if ($master_log_access == 'yes') {
				echo "<div style='margin-left: 100px;'>
						<form action='/php/master_log/master_log.php' name='login_form' onsubmit='return validateForm()' method='post'>
							<input type='submit' name='not_login' class='login login-submit' value='Master Log'>
						</form>
					  </div>
		  
					  <div style='margin-left: 100px; margin-top: 10px;'>
						<form action='/php/master_log_stats.php' name='login_form' method='post'>
							<input type='submit' name='not_login' class='login login-submit' value='Master Log Stats'>
						</form>
					  </div>";
			} else {
				echo "<div style='margin-left: 100px;'>
						<form action='/php/master_log/master_log.php' name='login_form' onsubmit='return validateForm()' method='post'>
							<input style='background-color: grey;' type='submit' name='not_login' class='login login-submit' value='Master Log' disabled>
						</form>
					  </div>
		  
					  <div style='margin-left: 100px; margin-top: 10px;'>
						<form action='/php/master_log_stats.php' name='login_form' method='post'>
							<input style='background-color: grey;' type='submit' name='not_login' class='login login-submit' value='Master Log Stats' disabled>
						</form>
					  </div>";
			}
		  ?>
		  
  </div>
  
  
  <div style="float: left; margin-left: 100px; margin-top: 10px;">
	
		  <!-- Employee Info -->
		  <div>
			<form name="login_form"  action="/php/employee_info/employee_list.php" method="post">
				<input style="" type="submit" name="not_login" class="login login-submit" value="Employee Info">
			</form>
		  </div>
		  
		  <!-- database administration log button -->
		  <div>
			<form name="login_form" style='margin-top: 10px;' onclick="window.open('/php_my_admin/index.php')" method="post">
				<input style="" type="submit" name="not_login" class="login login-submit" value="Database Administration">
			</form>
		  </div>
		   
  </div>
  
  
  <div style="float: left; margin-left: 100px; margin-top: 10px;">
	
		  <!-- Inventory -->
		  <!-- <div>
			<form action="/php/inventory/select_item.php" name="login_form" method="post">
				<input style="" type="submit" name="not_login" class="login login-submit" value="Inventory">
			</form>
		  </div> -->
		  
		  <!-- Diagnosis Totals -->
		  <div>
			<form name="login_form" style='margin-top: 10px;' action="/php/diagnosis_totals.php" method="post">
				<input style="" type="submit" name="not_login" class="login login-submit" value="Diagnosis Totals">
			</form>
		  </div>
		   
  </div>
  
   <div style="float: left; margin-left: 100px; margin-top: 10px;">
	
		  <!-- Expenses -->
		   <!--<?php
			if ($master_log_access == 'yes') {
				echo "<div>
						<form action='/php/expenses/select_expense.php' name='login_form' method='post'>
							<input style='' type='submit' name='not_login' class='login login-submit' value='Expenses'>
						</form>
					  </div>";
			} else {
				echo "<div>
						<form action='/php/expenses/select_expense.php' name='login_form' method='post'>
							<input style='background-color: grey;' type='submit' name='not_login' class='login login-submit' value='Expenses' disabled>
						</form>
					  </div>";
			}
		  ?>-->

 		  <!-- Client Secrets -->
		  
		  <div>
			<form name="login_form" style='margin-top: 10px;' action="/php/secrets/select_secrets.php" method="post">
				<input style="" type="submit" name="not_login" class="login login-submit" value="Secrets">
			</form>
		  </div>
		  
		 

		   
   </div>

  
</div>


</body>

</html>
