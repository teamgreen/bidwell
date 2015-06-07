
//////////////////////////////
// jQuery Validate Plugin 
// for Home Page
// ------------------------
// Created 5/29/2015
// Authored by Alex Chaudoin
// ------------------------
// The form on the home page 
// will be validated using the 
// "validate" function. 
//////////////////////////////

$('#home-form').validate({
	rules : {
		project_name: "required",
		project_due_date: {
			required: true,
			date: true
		},
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
	}
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

