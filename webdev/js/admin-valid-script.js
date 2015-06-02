
	//////////////////////////////
	// jQuery Validate Plugin 
	// for Admin Page
	// ------------------------
	// Created 5/30/2015
	// Authored by Alex Chaudoin
	// ------------------------
	// The forms on the admin page 
	// will be validated using the 
	// "validate" function. 
	//////////////////////////////

	// Validate Add Account Dialog form
	$('#add-form').validate({
		rules : {
			add_username: "required",
			add_email: {
				required : true,
				email : true
			},
			add_preset: "required",
			add_password: "required",
			add_confirm_password: {
				required : true,
				equalTo : "#add_password"
			}
		},
		messages : {
			add_username: "Please enter a username for the account",
			add_email: {
				required: "Please enter an email address",
				email: "Please enter a valid email address, like example@email.com"
			},
			add_preset: "Please select a preset",
			add_password: "Please enter a password",
			add_confirm_password: {
				required: "Please enter the password again",
				equalTo: "Please make sure both passwords match"
			}
		}
	}); // end validate

	// Validate Edit Account Dialog form
	$('#edit-form').validate({
		rules : {
			edit_username: "required",
			edit_email: {
				required : true,
				email : true
			},
			edit_preset: "required"
		},
		messages : {
			edit_username: "Please enter a username for the account",
			edit_email: {
				required: "Please enter an email address",
				email: "Please enter a valid email address, like example@email.com"
			},
			edit_preset: "Please select a preset"
		}
	}); // end validate

	// Validate Reset Password Dialog form
	$('#pass-form').validate({
		rules : {
			new_password: "required",
			new_confirm_password: {
				required : true,
				equalTo : "#new_password"
			}
		},
		messages : {
			new_password: "Please enter a password",
			new_confirm_password: {
				required: "Please enter the password again",
				equalTo: "Please make sure both passwords match"
			}
		}
	}); // end validate

	// If the Custom preset is chosen 
	// from the "add_preset" or "edit_preset"
	// select form elements, then a div with an
	// ID of "permissions" or "edit_permissions"
	// will appear, holding checkboxes with
	// permissions. If any other preset is
	// selected, this div will either remain
	// hidden or disappear.
	$('#add_preset').change(function(){
		var value = $('#add_preset option:selected').val();
		if (value === "Custom") {
			$('#permissions').show();
		} else {
			$('#permissions').hide();
		};
	}); // end change
	$('#edit_preset').change(function(){
		var value = $('#edit_preset option:selected').val();
		if (value === "Custom") {
			$('#edit_permissions').show();
		} else {
			$('#edit_permissions').hide();
		};
	}); // end change

	var add_successDialog = $('#add-success').dialog({
		autoOpen: false,
		modal: true,
		buttons: {
			Ok: function(){
				$(this).dialog('close');
			}
		}
	}); // end dialog

	var edit_successDialog = $('#edit-success').dialog({
		autoOpen: false,
		modal: true,
		buttons: {
			Ok: function(){
				$(this).dialog('close');
			}
		}
	}); // end dialog

	var pass_successDialog = $('#pass-success').dialog({
		autoOpen: false,
		modal: true,
		buttons: {
			Ok: function(){
				$(this).dialog('close');
			}
		}
	}); // end dialog