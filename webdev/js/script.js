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

	///////////////////////////
	// jQuery UI for all Pages:
	//	Tooltip
	///////////////////////////
	$(document).tooltip();

	///////////////////////////
	// jQuery UI for Home Page:
	// Tabs, Progressbar
	///////////////////////////
	$('#home-tabs').tabs();
	$('#progress-bar').progressbar({
		value: 12
	}); 
	///////////////////////////
	// jQuery UI for Admin Page:
	// Tabs
	///////////////////////////
	$('#admin-tabs').tabs();


	// ---------------------------------- //
	// ---------------------------------- //

	//////////////////////////////////////
	// Admin Page Functions
	// --------------------
	//////////////////////////////////////

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

	$('#tab-a tr:not(:first)').click(function(){

		var originalBg = $(this).css('background-color');
		var changedRow = $(this);
		changedRow.css('background-color', '#efefef');
		$('.new-edit').attr('value', 'Edit');

		changedRow.click(function(){
			$('.new-edit').attr('value', 'New');
			changedRow.css('background-color', originalBg);
		})
	});

	// In progress function below:
	// when the new/edit button is clicked,
	// depending on the name of its "value",
	// either the add-account or the 
	// edit-account dialog will be opened.

	// $('.new-edit').click(function(){
	// 	var buttonVal = $(this).attr('value');
	// 	switch
	// 	if (buttonVal === "New") {
	// 		// show add-account dialog
	// 	} else {
	// 		// show edit-account dialog
	// 	};
	// });

});