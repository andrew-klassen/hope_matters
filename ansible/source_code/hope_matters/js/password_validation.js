/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
 */

// This script makes sure that the user meets the password requirements.
function validate_form() {

	var new_password = document.forms["password_form"]["new_password"].value;
	var confirm_password = document.forms["password_form"]["confirm_password"].value;
	
	// make sure new password and confirmed password are the same
	if (new_password != confirm_password){

		alert("The new passwords don't match.");
		document.location.href = '/html/change_password.html'; 
		return false;

	}



/************************************************/	
	/* password complexity requirements */
	
	var minimum_length = 8; //acceptible values are 1-20
	
	// all values below must either be true or false
	var require_a_lower_case_letter = true;
	var require_a_capital_letter = true;
	var require_a_number = false;
	var require_a_special_character = false;
/************************************************/	


	
	// make sure password meets the length requirement
	if (new_password.length < minimum_length) {
		var temp = "Password must be a least " + minimum_length + " characters in length.";
		alert(temp);
		document.location.href = '/html/change_password.html'; 
		return false;
	}
	
	// make sure password contains a lower case letter
	var temp = new RegExp(/[a-z]/);
	
	if (require_a_lower_case_letter && !(temp.test(new_password))) {
		alert("Your new password must contain a lower case letter.");
		document.location.href = '/html/change_password.html'; 
		return false;
	}
	
	// make sure password contains a upper case letter
	var temp = new RegExp(/[A-Z]/);
	
	if (require_a_capital_letter && !(temp.test(new_password))) {
		alert("Your new password must contain a upper case letter.");
		document.location.href = '/html/change_password.html'; 
		return false;
	}
	
	// make sure password contains a number
	var temp = new RegExp(/[0-9]/);
	
	if (require_a_number && !(temp.test(new_password))) {
		alert("Your new password must contain a number.");
		document.location.href = '/html/change_password.html'; 
		return false;
	}
	
	// make sure password contains a special character
	var temp = new RegExp(/[~`!#$%\^&*+=\-\[\]\\';,/{}|\\":<>\?]/);
	
	if (require_a_special_character && !(temp.test(new_password))) {
		alert("Your new password must contain a special character. (~`!#$%\^&*+=\-\[\]\\';,/{}|\\\":<>\?)");
		document.location.href = '/html/change_password.html'; 
		return false;
	}
	
	
}