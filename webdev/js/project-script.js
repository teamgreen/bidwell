$(document).ready(function(){

	// //set up accordions.
	// $(function() {
	// 	$(".accordion").accordion({
	// 		heightStyle: "content",
	// 		collapsible: true,
	// 		active: false
	// 	});
	// });

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
			a_value = null;
		}
	});
	//var activeTab = getSessionVariable('activetab');
	


  	// and the tooltip
  	$('span.ui-icon').tooltip();


	// $('input[type="checkbox"]').click(function(){
	// 	$("."+$(this).attr("value")).slideToggle();
	// });

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
	
	$('.loadSheetSelect').change(
		function(evt)
		{
			// set session var for active tab
			var active = $( "#home-tabs" ).tabs( "option", "active" );
			setSessionVariable('activetab', active);

			// and now the sheet we want.
			//$(this).find(':selected').val();
			setSessionVariable('sheet', $(this).find(':selected').val());
		}
	);

});

