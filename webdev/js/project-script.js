$(document).ready(function(){

	// //set up accordions.
	// $(function() {
	// 	$(".accordion").accordion({
	// 		heightStyle: "content",
	// 		collapsible: true,
	// 		active: false
	// 	});
	// });

	// set the active tab if session variable is set.
	$.ajax({
		url: 'phpscripts/AjaxHelper.php',
		type: 'post',
		data: {'getSessionVariable': 'activetab'},
		//async: false,
		success: function(data) {
			var activeTab = data||0;
			console.log('activeTab = ' + activeTab); 
			// and the tabs
  			$('#home-tabs').tabs({'active': activeTab});
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	});

  	// and the tooltip
  	$('span.ui-icon').tooltip();

  	$('#tab-markers').click(
  		function(evt)
  		{
  			// set session var for active tab
			var active = $( "#home-tabs" ).tabs( "option", "active" );
			setSessionVariable('activetab', active);
  		}
  	);

  	// if an empty line has been changed, add a new empty line at the bottom.
	$('.newLine').change(
		function(evt)
		{
			var newLine = $(this).clone(true);
			newLine.find(".exLineNum").html( parseInt(($(this).find(".exLineNum").html())) +1);
			newLine.find('input').val('');
			$(this).after(newLine);
			$(this).unbind('change');
		}
	);

	// internal bid sheet total updating.
	(function () {
	    var previous;

	    $('#tab3 .inAmtInput').on('focus', 
	    	function()
	    	{
		        // Store the current value on focus and on change
		        previous = this.value;
	    	}).change(
			function(evt)
			{
				var dif = $(this).val() - previous; // difference of the old and new value

				// update the subtotal
				var tr = $(this).parents('table');
				var subtotal = tr.find('.inSubTotal');
				var newSubtotal = parseInt(subtotal.html().match(/\d+/)) + parseInt(dif); // the new subtotal amount
				subtotal.html("$" + newSubtotal);
				// and now for total box
				var total = $('#tab3 .inTotal'); //total stored here.
				var newTotal = parseInt(total.html().match(/\d+/)) + parseInt(dif); // the new total amount
				total.html("$" + newTotal);

		        // Make sure the previous value is updated, in case they change it again.
		        previous = this.value;
			}
	    );
	})();

	// change bid sheet total updating.
	(function () {
	    var previous;

	    $('#tab5 .exAmtInput').on('focus', 
	    	function()
	    	{
		        // Store the current value on focus and on change
		        previous = this.value;
	    	}).change(
			function(evt)
			{
				var dif = $(this).val() - previous; // difference of the old and new value
				var total = $('#tab5 .exTotal'); //total stored here.
				var newTotal = parseInt(total.html().match(/\d+/)) + parseInt(dif); // the new total amount

				// now update the total box.
				total.html("$" + newTotal);

		        // Make sure the previous value is updated, in case they change it again.
		        previous = this.value;
			}
	    );
	})();

	// external bid sheet total updating.
	(function () {
	    var previous;

	    $('#tab4 .exAmtInput').on('focus', 
	    	function()
	    	{
		        // Store the current value on focus and on change
		        previous = this.value;
	    	}).change(
			function(evt)
			{
				var dif = $(this).val() - previous; // difference of the old and new value
				var total = $('#tab4 .exTotal'); //total stored here.
				var newTotal = parseInt(total.html().match(/\d+/)) + parseInt(dif); // the new total amount

				// now update the total box.
				total.html("$" + newTotal);

		        // Make sure the previous value is updated, in case they change it again.
		        previous = this.value;
			}
	    );
	})();
	
	
	// user has elected to change the current sheet.
	$('.loadSheetSelect').change(
		function(evt)
		{
			// get the active tab
			var active = $( "#home-tabs" ).tabs( "option", "active" );

			var changeTo = $(this).find(':selected').val();
			if(changeTo=='-'){
				// create new sheet and go there.
				if(active==2){
					console.log("new InternalBidSheet needs to be created.");
					goToNewSheet('InternalBidSheet');
				}
				else if (active==3){
					console.log("new ExternalBidSheet needs to be created.");
					goToNewSheet('ExternalBidSheet');
				}
				else if(active==4){
					console.log("new ChangeBidSheet needs to be created.");
					goToNewSheet('InternalBidSheet');
				}
				return;
			}

			// and now the sheet we want.
			//$(this).find(':selected').val();
			if(active==2)
				setSessionVariableAndReload('InternalBidSheetID', changeTo);
			else if (active==3)
				setSessionVariableAndReload('ExternalBidSheetID', changeTo);
			else if(active==4)
				setSessionVariableAndReload('ChangeBidSheetID', changeTo);
		}
	);

	/////////////////////////////////
	// handle file download
	/////////////////////////////////
	$("#dllink").click(
		function(evt)
		{
			dllink=$(this);
			var folder=$(this).attr('data-folder');
			var filename=$("#file_dl_list :selected").val();
//			console.log(filename);
			if(filename!=""){
				dllink.href=folder;
				dllink.attr("download", filename);
			} else {
				console.log("No file name");
				evt.preventDefault();
				return false;
			}
		}
	);


// 	/////////////////////////////////
// 	// handle file download
// 	/////////////////////////////////
// 	$("#filedownload").click(
// 		function(evt)
// 		{
// 			var folder=$(this).attr('data-folder');
// 			var filename=$("#file_dl_list :selected").val();
// 			var dllink = $("#dllink");
// 			dllink.href=folder;
// 			dllink.attr("download", filename);

// 			dllink.click();
// //			console.log(filename);
// 			// if(filename!=""){
// 			// 	$.ajax({
// 			// 		url: 'phpscripts/downloadfile.php',
// 			// 		type: 'get',
// 			// 		data: {'file_to_download': filename, 'dl_folder':folder},
// 			// 		//async: false,
// 			// 		success: function(data) {
// 			// 			console.log('fileDL data: ' + data);
// 			// 		},
// 			// 		error: function(xhr, desc, err) {
// 			// 			console.log(xhr);
// 			// 			console.log("Details: " + desc + "\nError:" + err);
// 			// 		}
// 			// 	});
// 			// }
// 		}
// 	);
});
// end Ready

function saveProjectDescriptionSheet()
{
	//tab2

}

function saveInternalBidSheet()
{
	//tab3
}

//tab4
function saveExternalBidSheet()
{
	var notfirst=false;

	//step 1: get the sheetID from the load select box.  It should be the selected one.
	var sheetid = $("#tab4 form").attr("data-sheetID");
	// save that as a value pair and start the existing lines one.
	var jdon_string='{ {"SheetID":'+sheetid+'},{ "existingExLines" : [';// +

	// step 2: add all those existing lines.
	// build the datapairs we'll need.
	$("#tab4 .existingLine").each(
		function()
		{
			if(notfirst){
				jdon_string+=',';
			}
			// vars first in case need to deal with quotes and such.
			var desc = $(this).find('.exDescInput').val();
			var amt = $(this).find('.exAmtInput').val();
			var id = $(this).attr("data-lineID");
			//open an object
			jdon_string+='{ ';
			jdon_string+= '"LineID":"'+id+'", "WorkDescription":"'+desc+'", "Amount":'+amt;
			jdon_string+='}';

			notfirst=true;
		}
	)

	//close off the string.
	jdon_string+=']},';

	// Step 3: and now for all the new lines.

	// and now for the new lines
	notfirst=false;
	jdon_string+='{ "newExLines" : [';
	// build the datapairs we'll need for new lines.
	$("#tab4 .newLine").each(
		function()
		{
			if(notfirst){
				jdon_string+=',';
			}
			// vars first in case need to deal with quotes and such.
			var desc = $(this).find('.exDescInput').val();
			var amt = $(this).find('.exAmtInput').val();
			//open an object
			jdon_string+='{ ';
			jdon_string+= '"WorkDescription":"'+desc+'", "Amount":'+amt;
			jdon_string+='}';

			notfirst=true;
		}
	)
	//close off the string.
	jdon_string+=']}}';

	console.log(jdon_string);

	// step 4: ajax time.  Off to php land we go.
	$.ajax({
		url: 'phpscripts/AjaxHelper.php',
		type: 'post',
		data: {'Variable': 'dog',
				'value': 0},
		success: function(data, status) {
			// do something here.
			console.log("stuff happened");
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	}); // end ajax call


	event.preventDefault();
	return false;
}

function saveChangeBidSheet()
{
	//tab5

}

