$(document).ready(function(){

	// //set up accordions.
	// $(function() {
	// 	$(".accordion").accordion({
	// 		heightStyle: "content",
	// 		collapsible: true,
	// 		active: false
	// 	});
	// });

	// and the tabs
  	$('#home-tabs').tabs();

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
	
	// $('form').change(
	// 	function(evt)
	// 	{
	// 		console.log("form has changed.");
			// $.ajax({
			// 	//url: 'phpscripts/project_interact.php',
			// 	url: 'project.php',
			// 	type: 'post',
			// 	data: {'action': 'newline'},
			// 	success: function(data, status) {
			// 		// do something here.
			// 		console.log(data);
			// 	},
			// 	error: function(xhr, desc, err) {
			// 		console.log(xhr);
			// 		console.log("Details: " + desc + "\nError:" + err);
			// 	}
			// }); // end ajax call
	//	}
	//);
});

