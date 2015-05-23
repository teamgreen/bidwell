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
		value: 12
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

	// Click function below:
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


	// In progress function below:
	// when the new/edit button is clicked,
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
	});

});