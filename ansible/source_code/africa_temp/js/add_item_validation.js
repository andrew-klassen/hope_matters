/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
 */

function validate_form() {

	var name = document.forms["add_item"]["name"].value;
	var count = document.forms["add_item"]["count"].value;
	

	if (name == "") {
		alert("Your forgot to give your item a name.");
		return false;
	}
	
	if (count == "") {
		alert("You need to provide the amount of the item that you have.");
		return false;
	}
	
}