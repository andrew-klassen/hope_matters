/*
This file is part of a web application designed to help Hope Matters interact with their database.
The web application is licensed under the Affero General Public License v3.
View the web application's readme.txt for more details.

Copyright © 2017 Andrew Klassen
 */

// all the vital signs need to be filled out
function validate_form() {

/*

This part of the file is no longer in use, due to the user's decision. However, it is left in the project 
because it is still functional and could be potentially useful.

	var t = document.forms["women_health"]["t"].value;
	var bp = document.forms["women_health"]["bp"].value;
	var pr = document.forms["women_health"]["pr"].value;
	var rr = document.forms["women_health"]["rr"].value;
	var sao2 = document.forms["women_health"]["sao2"].value;
	
	// make sure vital signs are filled out
	if (bp == "" || t == 0 || pr == 0 || rr == 0 || sao2 == 0){

		alert("All vital signs need to be filled out.");
		return false;

	}
	
	var return_visit = document.forms["women_health"]["return_visit"].value;
	
	if (return_visit == ""){

		alert("You need to provide a date for the return visit.");
		return false;

	}

*/
	
	var lmp = document.forms["women_health"]["lmp"].value;
	
	if (lmp == ""){

		alert("LMP date needs to be filled out.");
		return false;

	}
	
	
	/*********** lmp validation ***********/
	
	var lmp = document.forms["women_health"]["lmp"].value;
	
    // make sure date is in the correct format
    var regex_date = /^\d{4}\-\d{1,2}\-\d{1,2}$/;

    if (!regex_date.test(lmp))
    {	
		alert("Please enter the LMP in the following format. \n\n yyyy-mm-dd");
        return false;
    }

    // break up each part of the date
    var parts   = lmp.split("-");
    var day     = parseInt(parts[2], 10);
    var month   = parseInt(parts[1], 10);
    var year    = parseInt(parts[0], 10);

    // make sure user provides a valid year
    if (year < 1800 || year > 2500) 
    {
		alert("The year given for the LMP is invalid.");
        return false;
    }
	
	// make sure user provides a valid month
	if (month == 0 || month > 12) {
		alert("The month given for the LMP is invalid.");
        return false;
	}
	

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    // adjust for leap years
    if (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
    {
        monthLength[1] = 29;
    }

    // make sure user provides a valid day
    if (!(day > 0 && day <= monthLength[month - 1])){
		alert("The day given for the LMP is invalid.");
        return false;
	}

}

function toggle_disabled_biopsies(_checked) {
	document.getElementById('biopsies_comment').value = ""
	
	document.getElementById('biopsies_comment').disabled = _checked ? false : true;
}

function toggle_disabled_family_planning_bottom(_checked) {
	document.getElementById('family_planning_comment').value = ""
	
	document.getElementById('family_planning_comment').disabled = _checked ? false : true;
}


function toggle_disabled_via_months(_checked) {
	document.getElementById('via_months_count').value = ""
	
	document.getElementById('via_months_count').disabled = _checked ? false : true;
}

function toggle_disabled_colposcopy(_checked) {
	document.getElementById('colposcopy_month_count').value = ""
	
	document.getElementById('colposcopy_month_count').disabled = _checked ? false : true;
}

function toggle_disabled_biopsy_results(_checked) {
	document.getElementById('biopsy_results_count').value = ""
	
	document.getElementById('biopsy_results_count').disabled = _checked ? false : true;
}