$(document).ready(function(){

	//set up accordions.
	$(function() {
		$(".accordion").accordion({
			heightStyle: "content",
			collapsible: true,
			active: false
		});
	});

	// and the tabs
  	$('#home-tabs').tabs();

  	// and the tooltip
  	$('span.ui-icon').tooltip();


	$('input[type="checkbox"]').click(function(){
		$("."+$(this).attr("value")).slideToggle();
	});
});