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

	var t = document.forms["vital_signs_form"]["t"].value;
	var bp = document.forms["vital_signs_form"]["bp"].value;
	var pr = document.forms["vital_signs_form"]["pr"].value;
	var rr = document.forms["vital_signs_form"]["rr"].value;
	var sao2 = document.forms["vital_signs_form"]["sao2"].value;
	
	// make sure vital signs are filled out
	if (bp == "" || t == 0 || pr == 0 || rr == 0 || sao2 == 0){

		alert("All vital signs need to be filled out.");
		return false;

	}

*/
	
	var lmp = document.forms["vital_signs_form"]["lmp"].value;
	
	if (lmp == ""){
		alert("You need to provide an LMP date.");
		return false;
	
	}
	
	
	var weeks_pregnant = document.forms["vital_signs_form"]["weeks_pregnant"].value;
	
	if (weeks_pregnant == ""){
		alert("You need to provide the number of weeks that the client was pregnant.");
		return false;
	
	}
	
	
	var days_pregnant = document.forms["vital_signs_form"]["days_pregnant"].value;
	
	if (days_pregnant == ""){
		alert("You need to provide the number of days that the client was pregnant.");
		return false;
	
	}
	
	
	
	/*********** lmp validation ***********/
	
	var lmp = document.forms["vital_signs_form"]["lmp"].value;
	
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

function disabled_baby_1(_checked){
	document.getElementById('placenta_baby_1').value = "";
	document.getElementById('placenta_baby_1').disabled = true;
	
	document.getElementById('fetal_movement_baby_1').value = "";
	document.getElementById('fetal_movement_baby_1').disabled = true;
	
	document.getElementById('fetal_heartbeat_baby_1').value = "";
	document.getElementById('fetal_heartbeat_baby_1').disabled = true;
	
	document.getElementById('amniotic_fluid_baby_1').value = "";
	document.getElementById('amniotic_fluid_baby_1').disabled = true;

}

function enable_baby_1(_checked){
	document.getElementById('placenta_baby_1').disabled = false;
	document.getElementById('fetal_movement_baby_1').disabled = false;
	document.getElementById('fetal_heartbeat_baby_1').disabled = false;
	document.getElementById('amniotic_fluid_baby_1').disabled = false;

}

function disabled_baby_2(_checked){
	document.getElementById('placenta_baby_2').value = "";
	document.getElementById('placenta_baby_2').disabled = true;
	
	document.getElementById('fetal_movement_baby_2').value = "";
	document.getElementById('fetal_movement_baby_2').disabled = true;
	
	document.getElementById('fetal_heartbeat_baby_2').value = "";
	document.getElementById('fetal_heartbeat_baby_2').disabled = true;
	
	document.getElementById('amniotic_fluid_baby_2').value = "";
	document.getElementById('amniotic_fluid_baby_2').disabled = true;

}

function enable_baby_2(_checked){
	document.getElementById('placenta_baby_2').disabled = false;
	document.getElementById('fetal_movement_baby_2').disabled = false;
	document.getElementById('fetal_heartbeat_baby_2').disabled = false;
	document.getElementById('amniotic_fluid_baby_2').disabled = false;

}


function disabled_baby_3(_checked){
	document.getElementById('placenta_baby_3').value = "";
	document.getElementById('placenta_baby_3').disabled = true;
	
	document.getElementById('fetal_movement_baby_3').value = "";
	document.getElementById('fetal_movement_baby_3').disabled = true;
	
	document.getElementById('fetal_heartbeat_baby_3').value = "";
	document.getElementById('fetal_heartbeat_baby_3').disabled = true;
	
	document.getElementById('amniotic_fluid_baby_3').value = "";
	document.getElementById('amniotic_fluid_baby_3').disabled = true;

}

function enable_baby_3(_checked){
	document.getElementById('placenta_baby_3').disabled = false;
	document.getElementById('fetal_movement_baby_3').disabled = false;
	document.getElementById('fetal_heartbeat_baby_3').disabled = false;
	document.getElementById('amniotic_fluid_baby_3').disabled = false;

}

function disabled_baby_4(_checked){
	document.getElementById('placenta_baby_4').value = "";
	document.getElementById('placenta_baby_4').disabled = true;
	
	document.getElementById('fetal_movement_baby_4').value = "";
	document.getElementById('fetal_movement_baby_4').disabled = true;
	
	document.getElementById('fetal_heartbeat_baby_4').value = "";
	document.getElementById('fetal_heartbeat_baby_4').disabled = true;
	
	document.getElementById('amniotic_fluid_baby_4').value = "";
	document.getElementById('amniotic_fluid_baby_4').disabled = true;

}

function enable_baby_4(_checked){
	document.getElementById('placenta_baby_4').disabled = false;
	document.getElementById('fetal_movement_baby_4').disabled = false;
	document.getElementById('fetal_heartbeat_baby_4').disabled = false;
	document.getElementById('amniotic_fluid_baby_4').disabled = false;

}

function open_baby_tab(evt, baby) {
				var i, tabcontent, tablinks;
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
					tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
					tablinks[i].className = tablinks[i].className.replace(" active", "");
				}
				document.getElementById(baby).style.display = "block";
				evt.currentTarget.className += " active";
}