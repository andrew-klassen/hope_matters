/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
 */

function validate_form() {

	var child_growth_weight = document.forms["child_growth"]["child_growth_weight"].value;
	var child_growth_weight_percentile = document.forms["child_growth"]["child_growth_weight_percentile"].value;
	var child_growth_height = document.forms["child_growth"]["child_growth_height"].value;
	var child_growth_height_percentile = document.forms["child_growth"]["child_growth_height_percentile"].value;

	
	if (child_growth_weight == "") {
		alert("You forgot to provide the weight.");
		return false;
	}
	
	if (child_growth_weight_percentile == "") {
		alert("You forgot to provide the weight percentile.");
		return false;
	}
	
	if (child_growth_height == "") {
		alert("You forgot to provide the height.");
		return false;
	}
	
	if (child_growth_height_percentile == "") {
		alert("You forgot to provide the height percentile.");
		return false;
	}
	
}