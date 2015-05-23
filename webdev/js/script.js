// This is the script.js file for bid-well

$(document).ready(function(){

	//////////////////////////////////////
	// jQuery UI Functions
	// --------------------
	// Used in the following pages:
	// home.php
	// admin.php
	// Purpose: To provide additional
	//			visual and functional
	//			features to the user
	//			interface with jQuery UI.
	//////////////////////////////////////

	////////////////////////////
	// jQuery UI for all Pages:
	// Tooltip
	// ------------------------
	// Authored by Alex Chaudoin
	/////////////////////////////
	$('span.ui-icon').tooltip();

	/////////////////////////////
	// jQuery UI for Home Page:
	// Tabs, Progressbar
	// ------------------------
	// Authored by Alex Chaudoin
	/////////////////////////////
	$('#home-tabs').tabs();
	$('#progress-bar').progressbar({
		value: 0
	}); 
	/////////////////////////////
	// jQuery UI for Admin Page:
	// Tabs
	// ------------------------
	// Authored by Alex Chaudoin
	/////////////////////////////
	$('#admin-tabs').tabs();


	// ---------------------------------- //
	// ---------------------------------- //

	/////////////////////////////
	// Admin Page Functions
	// --------------------
	// Authored by Alex Chaudoin
	/////////////////////////////

	// For the click function below:
	// When clicking on a row in the admin table,
	// that row will be highlighted and the 
	// "New" button will change to "Edit".

	$('#tab-a tr:not(:first-child)').click(function(){

		if ($('.new-edit').attr('value') === 'New') {
			$(this).css('background-color', '#ffffff');
			$('.new-edit').attr('value', 'Edit');
		} else {
			$('.new-edit').attr('value', 'New');
			$(this).css('background-color', '#dcf6ac');
		};

	}); // end click

	// For the click function below:
	// When the New/Edit button is clicked,
	// depending on the name of its "value",
	// either the add-account or the 
	// edit-account dialog will be opened.

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
					// need to add "add user" function
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
					// need to add "add user" function
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

});

////////////////////////////////
// Home Page Functions
// --------------------
// Authored by Alex Chaudoin
////////////////////////////////

// For the two button functions below:
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

//Clicking the "Previous" button works in 
// the same way except the "active" class 
// is placed on the previous div instead, 
// making the parent div disappear and the 
// previous div visible. The "active-form" 
// class also gets placed on the previous div
// instead and the progress bar is decremented
// by 25 with each subsequent click of the
// "Previous" button.

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