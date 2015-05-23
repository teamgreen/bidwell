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

	// For both hover functions below:
	// When the user hovers over one of
	// the even or odd rows in the admin
	// table in Tab A, the color will change
	// to a darker color. 
	// When the user hovers off any of the 
	// rows, the color will return to normal.

	$('#tab-a tr:nth-child(even)').hover(
		function(){
			$(this).css('background-color', '#d1f294');
		}, 
		function(){
			$(this).css('background-color', '#dcf6ac');
		}
	); // end hover

	$('#tab-a tr:nth-child(odd):not(:first-child)').hover(
		function(){
			$(this).css('background-color', '#f2fae3');
		}, 
		function(){
			$(this).css('background-color', '#ffffff');
		}
	); // end hover

	// In progress function below:
	// When clicking on a row in the admin table,
	// that row will be highlighted and the 
	// "New" button will change to "Edit".
	// ISSUES --> Have not figured out how to only
	//			  allow one row to be clicked on
	//	          at a time without using just a
	//			  a button instead.
	//            THE FUNCTION ONLY WORKS WITH
	//            THE FIRST CHANGED ROW.

	$('#tab-a tr:not(:first-child)').click(function(){

		var originalBg = $(this).css('background-color');
		var changedRow = $(this);
		changedRow.css('background-color', '#efefef');
		$('.new-edit').attr('value', 'Edit');

		changedRow.click(function(){
			$('.new-edit').attr('value', 'New');
			changedRow.css('background-color', originalBg);
		})
	}); // end click

	// In progress function below:
	// when the new/edit button is clicked,
	// depending on the name of its "value",
	// either the add-account or the 
	// edit-account dialog will be opened.
	// BUTTONS DONT WORK

	var addDialog = $('#add-account').dialog({
			autoOpen: false,
			minHeight: 500,
			width: 350,
			modal: true,
			buttons: { 
				Save: function(){
					dialog.dialog('close'); 
					// need to add "add user" function
				},
				Cancel: function(){
					dialog.dialog('close');
				}
			}
		}); // end dialog

	var editDialog = $('#edit-account').dialog({
			autoOpen: false,
			minHeight: 500,
			width: 350,
			modal: true,
			buttons: { 
				Save: function(){
					dialog.dialog('close'); 
					// need to add "add user" function
				},
				Cancel: function(){
					dialog.dialog('close');
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