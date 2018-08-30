/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
 */

function validate_form() {
	
	// get paid and billing information
	var billed = document.forms["add_payment_form"]["billed"].value;
	var paid = document.forms["add_payment_form"]["paid"].value;
	

	// check to see if the user provided the billed amount
	if (billed == ""){

		alert("You need to provide the amount that the client will be billed.");
		return false;

	}
	// check to see if the user provided the amount the client has paid
	if (paid == ""){

		alert("You need to provide the amount that the client has paid.");
		return false;

	}
	
}