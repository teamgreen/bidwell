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
	
	// user has elected to change the current sheet.
	$('.loadSheetSelect').change(
		function(evt)
		{
			// set session var for active tab
			var active = $( "#home-tabs" ).tabs( "option", "active" );
			setSessionVariable('activetab', active);

			// and now the sheet we want.
			//$(this).find(':selected').val();
			if(active==2)
				setSessionVariableAndReload('InternalBidSheetID', $(this).find(':selected').val());
			else if (active==3)
				setSessionVariableAndReload('ExternalBidSheetID', $(this).find(':selected').val());
			else if(active==4)
				setSessionVariableAndReload('ChangeBidSheetID', $(this).find(':selected').val());
		}
	);
});
