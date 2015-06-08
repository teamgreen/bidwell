////////////////////////////////////////////////////
// helper_functions.js
// This file exists to hold functions to make life easier.  Things
// like a function to query a php script to get the value of a session variable.
//
// Requires ajax libraries
//
// written by FVDS
// 6/7/2015
///////////////////////////////////////////////////


// DO NOT USE: AJAX is async, which causes issues.
// ///////////////////////////////////////
// // getSessionVariable - uses Ajax to get the session variable by
// // calling a php script.
// // a_var - the name of the session variable we want
// // return: the contents of the variable.  Null if not valid.
// ///////////////////////////////////////
// function getSessionVariable(a_var)
// {
// 	console.log("fetching " + a_var);
// 	return ($.ajax({
// 		url: 'phpscripts/AjaxHelper.php',
// 		type: 'post',
// 		data: {'getSessionVariable': a_var},
// 		success: function(data) {
// 			// do something here.
// 			//a_value =  data;
// 			console.log("Data: " + data);
// 		},
// 		error: function(xhr, desc, err) {
// 			console.log(xhr);
// 			console.log("Details: " + desc + "\nError:" + err);
// 			a_value = null;
// 		}
// 	})).responseText; // end ajax call
// }


///////////////////////////////////////
// setSessionVariable - uses Ajax to set the session variable by
// calling a php script.
// a_var - the name of the session variable we want
// a_value - the value to set it to
// return: the contents of the variable.  Null if not valid.
///////////////////////////////////////
function setSessionVariable(a_var, a_value)
{
	console.log("setting " + a_var);
	$.ajax({
		url: 'phpscripts/AjaxHelper.php',
		type: 'post',
		data: {'setSessionVariable': a_var,
				'value': a_value},
		success: function(data, status) {
			// do something here.
			console.log("setSessionVariable success.  Set "+a_var+" to "+a_value);
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	}); // end ajax call
}

///////////////////////////////////////
// setSessionVariableAndReload - uses Ajax to set the session variable by
// calling a php script, then reloads the page on success.
// a_var - the name of the session variable we want
// a_value - the value to set it to
// return: the contents of the variable.  Null if not valid.
///////////////////////////////////////
function setSessionVariableAndReload(a_var, a_value)
{
	console.log("setting " + a_var);
	$.ajax({
		url: 'phpscripts/AjaxHelper.php',
		type: 'post',
		data: {'setSessionVariable': a_var,
				'value': a_value},
		success: function(data, status) {
			// do something here.
			console.log("setSessionVariable success.  Set "+a_var+" to "+a_value);
			location.reload(true);
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	}); // end ajax call
}

///////////////////////////////////////
// unsetSessionVariable - uses Ajax to unset the session variable by
// calling a php script.
// a_var - the name of the session variable we want
///////////////////////////////////////
function unsetSessionVariable(a_var)
{
	console.log("unsetting " + a_var);
	$.ajax({
		url: 'phpscripts/AjaxHelper.php',
		type: 'post',
		data: {'unsetSessionVariable': a_var},
		success: function(data, status) {
			// do something here.
			console.log("unsetSessionVariable success.  Unset "+a_var);
		},
		error: function(xhr, desc, err) {
			console.log(xhr);
			console.log("Details: " + desc + "\nError:" + err);
		}
	}); // end ajax call
}

