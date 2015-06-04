// This is the script.js file for bid-well

$(document).ready(function(){

	//////////////////////////////////////
	// jQuery UI Functions
	// --------------------
	// Used in the following pages:
	// home.php
	// admin.php
	// Created 5/15/2015
	// Authored by Alex Chaudoin
	// Purpose: To provide additional
	//			visual and functional
	//			features to the user
	//			interface with jQuery UI.
	//
	// Updated: 5/25/2015 by Adam Duthie w/ Alex's permission
	//////////////////////////////////////

	////////////////////////////
	// jQuery UI for all Pages:
	// Tooltip
	// ------------------------
	// Created 5/15/2015
	// Authored by Alex Chaudoin
	/////////////////////////////
	$('span.ui-icon').tooltip();

	/////////////////////////////
	// jQuery UI for Home Page:
	// Tabs, Datepicker, Progressbar
	// ------------------------
	// Created 5/15/2015
	// Authored by Alex Chaudoin
	/////////////////////////////
	$('#home-tabs').tabs();
	$('#project_due_date').datepicker().on('change', function(){
		$('#project_due_date').valid();
	});
	$('#progress-bar').progressbar({
		value: 25
	}); 
	/////////////////////////////
	// jQuery UI for Admin Page:
	// Tabs
	// ------------------------
	// Created 5/15/2015
	// Authored by Alex Chaudoin
	/////////////////////////////
	$('#admin-tabs').tabs();

}); // end of document.ready


////////////////////////////////
// Home Page Functions
// --------------------
// Created 5/15/2015
// Authored by Alex Chaudoin
////////////////////////////////

// For the two button functions below:
// ------------------------------------
// These two functions are called as
// onclick events by the "Previous" and 
// "Next" buttons on the Home Page.
// When the "Next" button is clicked,
// the "active" class on its parent div
// gets removed and added to the next div,
// making the parent div disappear and the
// next div visible. Also, the "active-form"
// class is removed from the form div with
// the class and that class is then placed
// on the next div, making the former div
// disappear while the latter div appears.
// With each subsequent click on the "Next"
// button, the current value of the progress
// bar will be incremented by 25.
//
// Clicking the "Previous" button works in 
// the same way except the "active" class 
// is placed on the previous div instead, 
// making the parent div disappear and the 
// previous div visible. The "active-form" 
// class also gets placed on the previous div
// instead and the progress bar is decremented
// by 25 with each subsequent click of the
// "Previous" button.
//
// nextSibling = holds the next sibling element
//			of the div with the "active-form" class.
// prevSibling = holds the previous sibling element
//			of the div with the "active-form" class.

function nextDiv(button) {
	$(button).parent('div').removeClass('active');
	$(button).parent('div').next().addClass('active');
	var nextSibling = $('div.active-form').next();
	$('div.active-form').removeClass('active-form');
	nextSibling.addClass('active-form');
	var current = $('#progress-bar').progressbar('option', 'value');
	$('#progress-bar').progressbar('option', 'value', current+=25)
} // end function
function prevDiv(button) {
	$(button).parent('div').removeClass('active');
	$(button).parent('div').prev().addClass('active');
	var prevSibling = $('div.active-form').prev();
	$('div.active-form').removeClass('active-form');
	prevSibling.addClass('active-form');
	var current = $('#progress-bar').progressbar('option', 'value');
	$('#progress-bar').progressbar('option', 'value', current-=25)
} // end function

/////////////////////////////
// Admin Page Functions
// --------------------
// Created 5/17/2015
// Edited 6/3/2015
// Authored by Alex Chaudoin
/////////////////////////////

// For the sendID function below:
// When the user clicks on one of the
// three buttons in the Admin Table-
// Edit Account, Password Reset, or
// Delete Account- this function will
// retrieve the account ID number from
// the anchor tag wrapped around the 
// button and send that number with
// AJAX for a specified PHP file.
// ---------------------------------
// button_class = class of button to
//				be selected for function.
// url = local URL path to PHP file to
//		to use the account ID number.

function sendID(button_class, url){
	$(button_class).click(function(){
		var data = $(this).parent('a').attr('href');
		var id = data.split('=');
		id = id[1];
		$.ajax({
			url: url,
			type: 'get',
			data: {'id': id},
			success: function(data) {
				console.log("It works " + data);
			},
			error: function(xhr, desc, err) {
		        console.log(xhr);
		        console.log("Details: " + desc + "\nError:" + err);
		    }
		}); // end ajax
		return false;
	}); // end click
} // end function

sendID('.edit-account', 'includes/admin-edit-account.php');
sendID('.reset-pass', 'includes/admin-reset-password.php');
// deleting account will be determined later
//sendID('.delete-acc', 'includes/admin-reset-password.php');


