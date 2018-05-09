/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
 */

function validate_form() {

	var name = document.forms["add_expense"]["name"].value;
	var amount = document.forms["add_expense"]["amount"].value;
	

	if (name == "") {
		alert("Your forgot to give the expense a name.");
		return false;
	}
	
	if (amount == "") {
		alert("You need to provide the cost of the expense.");
		return false;
	}
	
}