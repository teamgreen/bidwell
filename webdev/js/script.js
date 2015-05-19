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
	
});