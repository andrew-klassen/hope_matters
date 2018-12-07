<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<html>

<head>
	<title>Hope Matters</title>
	<link rel='icon' href='/images/hope_matters_logo.png'>
	<link rel='stylesheet' type='text/css' href='/css/navbar.css'>
	<link rel='stylesheet' type='text/css' href='/css/add_client.css'>
	<script src='/js/client_validation.js' type='text/javascript'> </script>
</head>
<style>
	body {
			padding-top: 70px;
		}
	@media print {
		body {
			padding-top: 0px;
			background: none !important
		}
	}
</style>

<body >

<div class='no_print'>

<!-- nav bar -->
<div id='container'>
				   	
	<div id='sign-out'>
		<form method='post' action='/php/dashboard.php'>
			<input type='submit' value='Dashboard'>
		</form>
	</div>
			
	<div id='sign-out'>
		<form method='post' action='/php/sign_out.php'>
			<input type='submit' value='Sign Out'>
		</form>
	</div>
				  
	<div style="float: left;  width: 300px;">
		<form method="post" action="master_log.php">
			<input style="width: 300px;" type="submit" value="Back to Overview">
		</form>
	</div>
				  
</div>
<br></br>

<?php
		require('../database_credentials.php');
		session_start();
		
		// make sure user is logged in
		login_check();
		master_log_check();

		$choosen_payment_id = $_SESSION['choosen_payment_id'];
		
		
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
		
		
		// make database connection
		$conn = new PDO($dbconnection, $dbusername, $dbpassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		
		$stmt = $conn->prepare("SELECT first_name FROM master_log WHERE payment_id='$choosen_payment_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$first_name = $_SESSION['temp'];
		
		
		
		$stmt = $conn->prepare("SELECT last_name FROM master_log WHERE payment_id='$choosen_payment_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$last_name = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT department FROM master_log WHERE payment_id='$choosen_payment_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$department = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT payment_method FROM master_log WHERE payment_id='$choosen_payment_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$payment_method = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT revisit FROM master_log WHERE payment_id='$choosen_payment_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$revisit = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT billed FROM master_log WHERE payment_id='$choosen_payment_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$billed = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT paid FROM master_log WHERE payment_id='$choosen_payment_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$paid = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT owes FROM master_log WHERE payment_id='$choosen_payment_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$owes = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT notes FROM master_log WHERE payment_id='$choosen_payment_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$notes = $_SESSION['temp'];
		
		
		$stmt = $conn->prepare("SELECT date_format(timestamp, '%b %d %Y %h:%i %p') FROM master_log WHERE payment_id='$choosen_payment_id';");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		foreach(new grab_value(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		
		}
		$timestamp = $_SESSION['temp'];
		
		
?>


 <!-- start of change payment card -->
 <div class='accountCard'>
				<p class='p'style='color: black; font-weight:100;'>Change the Payment</p>
				<form  name='client_form' action='update_payment.php' onsubmit='return validate_form()' method='post'>
						
						
						<?php
							
							// display labels
							echo '<div style=" float: left; padding-left: 20px;">';
							echo '<b>Payment ID:</b>' . '<br>' . '<br>';
							echo '<b>Client Name:</b>' . '<br>' . '<br>';
							echo '<b>Department:</b>' . '<br>' . '<br>';
							echo '<b>Method:</b>' . '<br>' . '<br>';
							echo '<b>Revisit:</b>' . '<br>' . '<br>';
							echo '</div>';
							
							// display clients infomation
							echo '<div style=" float: left; padding-left: 20px; margin-right: 80px;">';
							echo $choosen_payment_id . '<br>' . '<br>';
							echo $first_name . ' ' . $last_name . '<br>' . '<br>';
							
							// select current department on drop down menu
							switch ($department){
								case 'general':
									$general_selected = 'selected=\'selected\'';
									break;
								case 'dental':
									$dental_selected = 'selected=\'selected\'';
									break;
								case 'inquiry':
									$inquiry_selected = 'selected=\'selected\'';
									break;
								case 'laboratory':
									$laboratory_selected = 'selected=\'selected\'';
									break;
								case 'mch_anc':
									$mch_anc_selected = 'selected=\'selected\'';
									break;
								case 'mch_cwc':
									$mch_cwc_selected = 'selected=\'selected\'';
									break;
								case 'mch_delivery':
									$mch_delivery_selected = 'selected=\'selected\'';
									break;
								case 'mch_fp':
									$mch_fp_selected = 'selected=\'selected\'';
									break;
								case 'optometry':
									$optometry_selected = 'selected=\'selected\'';
									break;
								case 'payment_rec':
									$payment_rec_selected = 'selected=\'selected\'';
									break;
								case 'pharmacy':
									$pharmacy_selected = 'selected=\'selected\'';
									break;
								case 'referral':
									$referral_selected = 'selected=\'selected\'';
									break;
								case 'screening_dm':
									$screening_dm_selected = 'selected=\'selected\'';
									break;
								case 'screening_gyn':
									$screening_gyn_selected = 'selected=\'selected\'';
									break;
								case 'screening_other':
									$screening_other_selected = 'selected=\'selected\'';
									break;
								case 'tb_injection':
									$tb_injection_selected = 'selected=\'selected\'';
									break;
								case 'treatment':
									$treatment_selected = 'selected=\'selected\'';
									break;
								case 'vct':
									$vct_selected = 'selected=\'selected\'';
									break;
								case 'ultrasound':
									$ultrasound_selected = 'selected=\'selected\'';
									break;
							}
							
							
							// make transaction type drop down menu
							echo "
								<select name='transaction_type' method='post'>
									<option value='general' $general_selected>General</option>
									<option value='dental' $dental_selected >Dental</option>
									<option value='inquiry' $inquiry_selected >Inquiry</option>
									<option value='laboratory' $laboratory_selected >Laboratory</option>
									<option value='mch_anc' $mch_anc_selected >MCH/ANC</option>
									<option value='mch_cwc' $mch_cwc_selected >MCH/CWC</option>
									<option value='mch_delivery' $mch_delivery_selected>MCH/Delivery</option>
									<option value='mch_fp' $mch_fp_selected>MCH/FP</option>
									<option value='optometry' $optometry_selected >Optometry</option>
									<option value='payment_rec' $payment_rec_selected >Payment Rec</option>
									<option value='pharmacy' $pharmacy_selected >Pharmacy</option>
									<option value='referral' $referral_selected >Referral</option>
									<option value='screening_dm' $screening_dm_selected >Screening/DM</option>
									<option value='screening_gyn' $screening_gyn_selected >Screening/GYN</option>
									<option value='screening_other' $screening_other_selected >Screening/OTHER</option>
									<option value='tb_injection' $tb_injection_selected >TB Injection</option>
									<option value='treatment' $treatment_selected >Treatment</option>
									<option value='vct' $vct_selected >VCT</option>
									<option value='ultrasound' $ultrasound_selected>Ultrasound</option>
								</select>
							" . '<br>' . '<br>';
							
							// select payment method on drop down menu
							switch ($payment_method){
								case 'unknown':
									$unknown_selected = 'selected=\'selected\'';
									break;
								case 'cash':
									$cash_selected = 'selected=\'selected\'';
									break;
								case 'm-pesa':
									$m_pesa_selected = 'selected=\'selected\'';
									break;
							}
							
							echo "
								<select name='payment_method' method='post'>
									<option value='unknown' $unknown_selected>unknown</option>
									<option value='cash' $cash_selected>cash</option>
									<option value='m-pesa' $m_pesa_selected>M-Pesa</option>
									
								</select>
							" . '<br>' . '<br>';
							
							// determine which revisit radio button should be checked
							if ($revisit == 'yes') {
								$yes_checked = 'checked';
							}
							else {
								$no_checked = 'checked';
							}
							
							echo "
								 <input type='radio' name='revisit' value='yes' $yes_checked> yes
								 <input type='radio' name='revisit' value='no' $no_checked> no
								 " . '<br>' . '<br>';
							
							echo '</div>';
							
							echo '<div style=" float: left; width: 400px;">';
								echo '<div style=" float: left; padding-left: 20px;">';
								echo '<b>Billed:</b>' . '<br>' . '<br>';	
							echo '</div>';
								
							echo '<div style=" float: left; padding-left: 20px;">';
								echo "<input type='number'  name='billed' value='$billed' min='0' max='999999' style='width: 75px; height: 20px;'>";	
								echo '</div>';
							echo '</div>';
							
							echo '<div style=" float: left; width: 400px;">';
								echo '<div style=" float: left; padding-left: 20px;">';
								echo '<b>Paid:</b>' . '<br>' . '<br>';
							echo '</div>';
									
							echo '<div style=" float: left; padding-left: 30px;">';
								echo "<input type='number'  name='paid' value='$paid' min='0' max='999999' style='width: 75px; height: 20px;'>";
							echo '</div>';
							
							echo '</div>';
							
							echo '<div style=" float: left; margin-left: 20px;">';
								echo "<b>Notes:</b> <br> <textarea style='height: 60px; width: 350px;' name='notes' class='comment_area' maxlength='150'>$notes</textarea><br><br>";
							echo '</div>';
							
						?>
						
						<br><br>
						
						<input type='submit' name='submit_button' class='submitbtn' value='Submit'>
					</form>
					<br><br><p></p>
			  
			  </div>
			  
			</div>
			
			<!-- beginning of receipt -->
			<div class="only_print" >
				<div style="float: left; width: 400px;">
					<div style="float: left;">
						<img src="/images/hope_matters_logo.png" style="width: 100px; height: 100px;">
					</div>
					<div style="float: left; margin-top: 25px; margin-left: 3px;">
						<p style="font-size: 18px; padding-bottom: 15px;"><i>Village Of Hope Medical Center</i></p>
						<label style="font-size: 12px;">P..o.Box 6367-30100</label>
						<p style="font-size: 12px;">Eldoret,Kenya</p>
					</div>
					
					<div style="float: left; width: 400px; ">
						<?php
							echo "<label style='font-size: 14px;  '><b>Payment ID:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $choosen_payment_id . '</label><br>'
							. "<label style='font-size: 14px;  margin-top: 5px; '><b>Customer:</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $first_name . ' ' . $last_name . '</label><br>'
							. "<label style='font-size: 14px; margin-top: 5px; '><b>Payment Method:</b> &nbsp;" . $payment_method . '</label><br><br>'
							. "<label style='font-size: 14px; margin-top: 5px; margin-bottom: 5px; '><b>Notes:</b> &nbsp;&nbsp;&nbsp;" . "<br><div style='width: 300px; height: 100px; word-wrap: break-word;'>" . $notes . '</div></label>' ;
						?>
					</div>
					
				</div>
				<div style="float: right; margin-top: 25px;">
					<p style="padding-bottom: 5px;">Official Receipt</p>
					<label style="font-size: 14px;"><b>Payment Time:</b> </label>
					<?php 
						echo $timestamp . '<br>'
						. "<label style='font-size: 14px;'><b>Department: </b>&nbsp;&nbsp;&nbsp;&nbsp;" . $department . '</label><br>'
						. "<label style='font-size: 14px;'><b>Revisit: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $revisit . '</label><br><br>'
						. "<label style='font-size: 14px; '><b>Billed: </b>" . $billed . '</label><br>'
						. "<label style='font-size: 14px; '><b>Paid:&nbsp;&nbsp; </b>" . $paid . '</label><br><br>'
						. "<label style='font-size: 14px; '><b>Payment Balance: </b>" . $owes . '</label><br><br>';
					?>
					
				</div>
			</div>
			<!-- end of receipt -->
			
</body>

</html>
