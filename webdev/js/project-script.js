$(document).ready(function(){

	//set up accordions.
	$(function() {
		$(".accordion").accordion({
			heightStyle: "content",
			collapsible: true,
			active: false
		});
	});
	$(function() {
    	$( ".box" ).accordion();
  	});


	$('input[type="checkbox"]').click(function(){
		$("."+$(this).attr("value")).slideToggle();
	});
});