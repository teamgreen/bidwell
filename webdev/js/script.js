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
	$('#project_due_date').datepicker();
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


	// ---------------------------------- //
	// ---------------------------------- //

	/////////////////////////////
	// Admin Page Functions
	// --------------------
	// Created 5/17/2015
	// Authored by Alex Chaudoin
	/////////////////////////////

	// For the click function below:
	// ------------------------------------------
	// When clicking on a row in the admin table,
	// the text values of children elements of that 
	// selected row (td) will be assigned to an array 
	// called "cells". Then a variable named "accountID" 
	// will hold the first element of that array.
	// Also, that row will be highlighted and the 
	// "New" button will change to "Edit".
	// The pointer events on other rows will be
	// disabled until the selected row is clicked
	// on again.

	$('#tab-a tr:not(:first-child)').click(function(){

		if ($('.new-edit').attr('value') === 'New') {
			$(this).css('background-color', '#ffffff');
			$(this).siblings('tr:not(:first-child)').css('pointer-events', 'none');
			$('.new-edit').attr('value', 'Edit');
			$('.delete').show();
		} else {
			$('.delete').hide();
			$('.new-edit').attr('value', 'New');
			$(this).siblings('tr:not(:first-child)').css('pointer-events', 'auto');
			$(this).css('background-color', '#dcf6ac');
		};

	}); // end click

	// For the click function below:
	// ------------------------------------
	// When the New/Edit button is clicked,
	// depending on the name of its "value",
	// either the add-account or the 
	// edit-account dialog will be opened.
	//
	// addDialog = holds #add-account div
	//			as an dialog with specified
	//			values, such as height and
	//			width, as well as buttons.
	// editDialog = holds #edit-account div
	//			as an dialog with specified
	//			values, such as height and
	//			width, as well as buttons.
	// buttonval = holds the "value" attribute
	//			of the "new/edit" button.


	var addDialog = $('#add-account').dialog({
			autoOpen: false,
			minHeight: 500,
			width: 350,
			modal: true,
			buttons: { 
				Cancel: function(){
					addDialog.dialog('close');
				},
				Save: function(){
					addDialog.dialog('close'); 
					$('#add-form').submit();
				}
			}
		}); // end dialog

	var editDialog = $('#edit-account').dialog({
			autoOpen: false,
			minHeight: 500,
			width: 350,
			modal: true,
			buttons: { 
				Cancel: function(){
					editDialog.dialog('close');
				},
				Save: function(){
					editDialog.dialog('close'); 
					$('#edit-form').submit();
				}
			}
		}); // end dialog

	$('.new-edit').click(function(){
		var buttonVal = $(this).attr('value');
		if (buttonVal === "New") {
			addDialog.dialog('open');
		} else {
			editDialog.dialog('open');
		};
	}); // end click

	/////////////////////////////
	// jQuery for Project Page:
	// division slideToggle
	// ------------------------
	// Created 5/25/2015
	// Authored by Tim Willbanks and Adam Duthie
	/////////////////////////////

	$('input[type="checkbox"]').click(function(){

		if($(this).attr("value")=="division1"){

			$(".division1").slideToggle();
		}

		if($(this).attr("value")=="division2"){

			$(".division2").slideToggle();

		}

		if($(this).attr("value")=="division3"){

			$(".division3").slideToggle();

		}

		if($(this).attr("value")=="division4"){

			$(".division4").slideToggle();

		}

		if($(this).attr("value")=="division5"){

			$(".division5").slideToggle();

		}

		if($(this).attr("value")=="division6"){

			$(".division6").slideToggle();

		}

		if($(this).attr("value")=="division7"){

			$(".division7").slideToggle();

		}

		if($(this).attr("value")=="division8"){

			$(".division8").slideToggle();

		}

		if($(this).attr("value")=="division9"){

			$(".division9").slideToggle();

		}

		if($(this).attr("value")=="division10"){

			$(".division10").slideToggle();

		}
	}); // end of Project Page jQuery
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

// jQuery Validate Plugin functions
// --------------------------------
// The form on the home page will be
// validated using the "validate" 
// function. 

$('#home-form').validate({
	rules : {
		project_name: "required",
		project_due_date: "required",
		name_owner: "required",
		phone_owner: {
			required: true,
			minlength: 10,
			number: true
		},
		cellphone_owner: {
			required: true,
			minlength: 10,
			number: true
		},
		email_owner: {
			required : true,
			email : true
		},
		address1_owner: "required",
		city_owner: "required",
		state_owner: "required",
		zip_owner: {
			required: true,
			minlength: 5,
			number: true
		},
		name_architect: "required",
		phone_architect: {
			required: true,
			minlength: 10,
			number: true
		},
		cellphone_architect: {
			required: true,
			minlength: 10,
			number: true
		},
		email_architect: {
			required : true,
			email : true
		},
		address1_architect: "required",
		city_architect: "required",
		state_architect: "required",
		zip_architect: {
			required: true,
			minlength: 5,
			number: true
		},
		address1_location: "required",
		city_location: "required",
		state_location: "required",
		zip_location: {
			required: true,
			minlength: 5,
			number: true
		},
		ignore: ":hidden"
	},
	messages : {
		project_name: "Please enter a name for your project",
		project_due_date: "Please choose a due date for your project",
		name_owner : "Please enter the owner's name",
		phone_owner: {
			required: "Please enter a phone number, in this format: 1112223333 (111-222-3333)",
			minlength: "Please enter at least 10 digits",
			number: "Please enter numbers only"
		},
		cellphone_owner: {
			required: "Please enter a cellphone number, in this format: 1112223333 (111-222-3333)",
			minlength: "Please enter at least 10 digits",
			number: "Please enter numbers only"
		},
		email_owner: {
			required: "Please enter an email address for the owner",
			email: "Please enter a valid email address, like example@email.com"
		},
		address1_owner: "Please enter an address",
		city_owner: "Please enter a city",
		state_owner: "Please select a state",
		zip_owner: {
			required: "Please enter a zipcode",
			minlength: "Please enter at least 5 digits for a zipcode",
			number: "Please enter numbers only"
		},
		name_architect : "Please enter the architect's name",
		phone_architect: {
			required: "Please enter a phone number, in this format: 1112223333 (111-222-3333)",
			minlength: "Please enter at least 10 digits",
			number: "Please enter numbers only"
		},
		cellphone_architect: {
			required: "Please enter a cellphone number, in this format: 1112223333 (111-222-3333)",
			minlength: "Please enter at least 10 digits",
			number: "Please enter numbers only"
		},
		email_architect: {
			required: "Please enter an email address for the architect",
			email: "Please enter a valid email address, like example@email.com"
		},
		address1_architect: "Please enter an address",
		city_architect: "Please enter a city",
		state_architect: "Please select a state",
		zip_architect: {
			required: "Please enter a zipcode",
			minlength: "Please enter at least 5 digits for a zipcode",
			number: "Please enter numbers only"
		},
		address1_location: "Please enter an address",
		city_location: "Please enter a city",
		state_location: "Please select a state",
		zip_location: {
			required: "Please enter a zipcode",
			minlength: "Please enter at least 5 digits for a zipcode",
			number: "Please enter numbers only"
		}
	},
}); // end validate
$('#next1').click(function(){
	if ($('#home-form').valid()) {
		nextDiv('#next1');
	} else {
		return false;
	};
}); // end click
$('#next2').click(function(){
	if ($('#home-form').valid()) {
		nextDiv('#next2');
	} else {
		return false;
	};
}); // end click
$('#next3').click(function(){
	if ($('#home-form').valid()) {
		nextDiv('#next3');
	} else {
		return false;
	};
}); // end click