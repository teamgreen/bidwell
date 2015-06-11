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
	// Edited 6/4/2015
	// Authored by Alex Chaudoin
	/////////////////////////////
	$('.admin-buttons').tooltip();

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


	////////////////////////////////
	// Home Page Functions
	// --------------------
	// Created 5/15/2015
	// Authored by Alex Chaudoin
	////////////////////////////////

	// For the click row event below:
	// -------------------------------
	// When a user clicks on one of the
	// rows (not the heading row) of the
	// home table, then the hidden tr
	// below the selected row will be
	// toggled (either shown or hidden).

	$('table.home-table > tbody > tr:not(:first-child)').click(function(){
		$(this).next().toggle();
	}); // end click

	/////////////////////////////
	// Admin Page Functions
	// --------------------
	// Created 5/17/2015
	// Edited 6/3/2015
	// Edited by Frank van der Salm 6/10/2015
	// Authored by Alex Chaudoin
	/////////////////////////////

	// The input fields in the admin table
	// are disabled by default
	$('.accountRow :input:not("button")').attr('disabled', 'disabled');

	// For the click events below:
	// ---------------------------
	// If the user clicks on a button
	// with a specified class, either
	// divs will be revealed or hidden,
	// or the input fields in the admin
	// table will be enabled.

	$('.add-account').click(function(){
		$('#add-reset_bg').show();
		$('#add-dialog').show();
		return false;
	}); // end click
	$('.edit-account').click(function(){
		var tr = $(this).parents('tr');
		tr.find(':input').attr('disabled', false);
		tr.find('.save-cancel').show(); // get specificity to work by having the nearest .save-cancel buttons to $this show up
		event.preventDefault();
		return false;
	}); // end click

	// on click for the reset password button
	$('.reset-pass').click(function(evt){
		var button = $(this);

		// set the account id on the reset password box's submit button.  We'll need it later.
		$('#reset-submit').attr('data-accountid', button.attr('data-accountid'))

		// show the reset password box.
		$('#add-reset_bg').show();
		$('#reset-dialog').show();

		evt.preventDefault();
		return false;
	}); // end click

	$('.delete-account').click(function(){
		$('#add-reset_bg').show();
		$('#delete-dialog').show();
		return false;
	}); // end click
	$('.cancel-edit').click(function(){
		var tr = $(this).parents('tr');
		tr.find(':input:not("button")').attr('disabled', true);
		tr.find('.save-cancel').hide(); // get specificity to work by having the nearest .save-cancel buttons to $this show up
	});

	// handle the submit button for setting a new password.
	$('#reset-submit').click(function(evt){
		$('#pass-form').data('validator').resetForm();
		$('#add-reset_bg').hide();
		$('#reset-dialog').hide();

		// values of password/confirm password will
		// be compared for validation
		var pass_a = $('#password').val();
		var pass_b = $('#confirm_password').val();

		alert(pass_a);
		alert(pass_b);

		// if both passwords are equal, then
		// the rest of the code will be executed
		if(pass_a === pass_b){ // if valid, send ajax.
			var accountid = $(this).attr('data-accountid');
			var password=$("#password").val();
//			console.log("accountID = " + accountid + " password=" + password);
			$.ajax({
				type: 'POST',
				url: 'phpscripts/reset-password.php', 
				data: {'accountid':accountid, 'password':password},
				success: function(data){
					if(data == "SUCCESS") {
						console.log("Password reset successfully."+data);
						$('.post-success').show().delay(500).hide(5000);
					}
				},
				error: function(xhr, desc, err) {
					if(data == "ERROR") {
						console.log(xhr);
						console.log("Details: " + desc + "\nError:" + err);
						$('.post-error').show().delay(500).hide(5000);
					}
				}
			}); // end ajax
		}

		evt.preventDefault();
		return false;
	}); // end click

	// handle the add-submit button being clicked.
	$('#add-submit').click(function(evt){
		$('#add-form').data('validator').resetForm();
		$('#add-reset_bg').hide();
		$('#add-dialog').hide();

		// TODO: Validate the password!!!!

		if(1){ // if valid, send ajax.
			var username = $('#add-form #add_username').val();
			var email = $('#add-form #add_email').val();
			var preset = $('#add-form #add_preset :selected').val();
			var password = $('#add-form #add_password').val();

			$.ajax({
				type: 'POST',
				url: 'phpscripts/add-account.php', 
				data: {'add_username':username, 'add_email':email, 'add_preset':preset,'add_password':password},
				success: function(data){
					console.log("new account added: "+data);
					location.reload(); 
				},
				error: function(xhr, desc, err) {
					console.log(xhr);
					console.log("Details: " + desc + "\nError:" + err);
				}
			}); // end ajax
		}

		evt.preventDefault();
		return false;
	}); // end click


	// If the user clicks "Cancel" in any
	// of the dialogs, the dialogs and modal
	// background will be hidden.
	$('#add-cancel').click(function(){
		$('#add-form').data('validator').resetForm();
		$('#add-reset_bg').hide();
		$('#add-dialog').hide();
	}); // end click
	$('#reset-cancel').click(function(){
		$('#pass-form').data('validator').resetForm();
		$('#add-reset_bg').hide();
		$('#reset-dialog').hide();
	}); // end click
	$('#delete-cancel').click(function(){
		$('#add-reset_bg').hide();
		$('#delete-dialog').hide();
	}); // end click

	// If the user clicks on an enabled text
	// input field, the Save/Cancel buttons 
	// appear right beside the existing buttons.
	$('input[type="text"].admin-table').click(function(){
		$('.save-cancel').show(); // get specificity to work by having the nearest .save-cancel buttons to $this show up
	}); // end focus

}); // end of document.ready


