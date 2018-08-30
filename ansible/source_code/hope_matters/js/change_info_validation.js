/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
*/

function validate_form() {

	var first_name = document.forms["change_info"]["first_name"].value;
	var last_name = document.forms["change_info"]["last_name"].value;
	var email = document.forms["change_info"]["email"].value;
	var phone_number = document.forms["change_info"]["phone_number"].value;
	
	// make sure user provides a first name
	if (first_name == ""){

		alert("You forgot to provide your first name.");
		return false;

	}
	
	// make sure user provides a last name
	if (last_name == ""){

		alert("You forgot to provide your last name.");
		return false;

	}
	
	// make sure user provides a email
	if (email == ""){

		alert("You forgot to provide your email.");
		return false;

	}
	
	// make sure user provides a phone number
	if (phone_number == ""){

		alert("You forgot to provide your phone number.");
		return false;

	}

}