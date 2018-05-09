<!--
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
-->

<?php

/************************************************/	
	/* password complexity requirements */
	
	const minimum_length = 5; // acceptable values are 1-20
	
	// all values below must either be true or false
	const require_a_lower_case_letter = true;
	const require_a_capital_letter = true;
	const require_a_number = true;
	const require_a_special_character = true;
/************************************************/	


function password_check($new_password, $confirm_password) {

	// make sure new password and confirmed password are the same
	if ($new_password != $confirm_password){
		echo "<script type='text/javascript'>
				alert('The new passwords don\'t match.');
				document.location.href = '/html/change_password.html';
			  </script>";
		
		return false;
	}
	
	// make sure password meets the length requirement
	if (strlen($new_password) < minimum_length) {
		$temp = "'Password must be a least ' +" . minimum_length . "+ ' characters in length.'";
		echo "<script type='text/javascript'>
				alert($temp);
				document.location.href = '/html/change_password.html';
			  </script>";
		return false;
	}
	
	// make sure password contains a lower case letter
	if(require_a_lower_case_letter and !preg_match('/[a-z]/', $new_password)){
		echo "<script type='text/javascript'>
				alert('Your new password must contain a lower case letter.');
				document.location.href = '/html/change_password.html'; 
			  </script>";
		return false;
	}
	
	// make sure password contains a number
	if(require_a_number and !preg_match('/[0-9]/', $new_password)){
		echo "<script type='text/javascript'>
				alert('Your new password must contain a number.');
				document.location.href = '/html/change_password.html'; 
			  </script>";
		return false;
	}
	
	// make sure password contains a special character
	if(require_a_special_character and !preg_match('/[\^$%&*()}{@#~?><>,|=_+-]/', $new_password)){
		echo "<script type='text/javascript'>
				alert('Your new password must contain a special character. \\n(^$%&*()}{@#~?><>,|=_+-)');
				document.location.href = '/html/change_password.html'; 
			  </script>";
		return false;
	}
	
	// all tests have passed
	return true;
}