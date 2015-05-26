<!DOCTYPE html>
<html lang="en">
<head>

<!-- 

///////////////////////////////////////
// Project Page
// Authored by Tim Willbanks
// Purpose: To provide a page where
// 			the user can access project
// 			information, project descriptions 
//			and create/edit Internal/External
//			Bid sheets as well as Change Bids
//			for projects.
//
//			
// Project Page 
// Updated: by Adam Duthie on 5/24 @ 3:00PM - 2:21AM on 5/25
/////////////////////////////////////////

-->

<meta charset="UTF-8">
<title>Project | Bid-Well</title>

<!-- Main Stylesheet and Home Page Stylesheet -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/project-style.css">
<!-- Custom jQuery UI Library Stylesheets - 1.11.4 -->
<link rel="stylesheet" href="libs/jquery-ui-1.11.4.custom/jquery-ui.min.css">
<link rel="stylesheet" href="libs/jquery-ui-1.11.4.custom/jquery-ui.theme.min.css">

<!-- jQuery Library - Google CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Custom jQuery UI Library - 1.11.4 -->
<script src="libs/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){

$('input[type="checkbox"]').click(function(){

	if($(this).attr("value")=="division1"){

		$(".division1").slideToggle();
	}

	if($(this).attr("value")=="division2"){

		$(".division2").slideToggle();

	}

	if($(this).attr("value")=="division3"){

		$(".division3").slideToggle();

	}

	if($(this).attr("value")=="division4"){

		$(".division4").slideToggle();

	}

	if($(this).attr("value")=="division5"){

		$(".division5").slideToggle();

	}

	if($(this).attr("value")=="division6"){

		$(".division6").slideToggle();

	}

	if($(this).attr("value")=="division7"){

		$(".division7").slideToggle();

	}

	if($(this).attr("value")=="division8"){

		$(".division8").slideToggle();

	}

	if($(this).attr("value")=="division9"){

		$(".division9").slideToggle();

	}

	if($(this).attr("value")=="division10"){

		$(".division10").slideToggle();

	}
});
});

</script>
</head>
<body>

<div class="wrapper">

<?php @require_once "includes/header.inc.php"; ?>

<div class="content">

	<div id="home-tabs">
		<ul>
			<li><a href="#tab1">Project<br>Information</a></li>
			<li><a href="#tab2">Project<br>Description</a></li>
			<li><a href="#tab3">Internal<br>Bid Sheet</a></li>
			<li><a href="#tab4">External<br>Bid Sheet</a></li>
			<li><a href="#tab5">Change<br>Bid Sheet</a></li>
		</ul>
		<div id="tab1">
			<p class="project-info">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas gravida ut purus id ullamcorper. Praesent fringilla eros tortor, nec mollis nunc cursus eget. Vivamus odio leo, lacinia id faucibus id, viverra sed nunc. Aenean id posuere orci. Duis vehicula laoreet nulla ac rutrum. Ut consectetur elit in risus aliquam, vel iaculis justo commodo. Sed imperdiet malesuada libero, ac consequat orci lacinia sed.</p>
		</div>
		<div id="tab2">
			<div class="description-cont">
				<p class="description-left-title">Description:</p>
				<p class="description-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas gravida ut purus id ullamcorper. Praesent fringilla eros tortor, nec mollis nunc cursus eget. Vivamus odio leo, lacinia id faucibus id, viverra sed nunc. Aenean id posuere orci. Duis vehicula laoreet nulla ac rutrum. Ut consectetur elit in risus aliquam, vel iaculis justo commodo. Sed imperdiet malesuada libero, ac consequat orci lacinia sed.</p>
			</div>
			<div class="description-cont">
				<p class="description-right-title">Files Uploaded:</p>
				<p class="description-right">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas gravida ut purus id ullamcorper. Praesent fringilla eros tortor, nec mollis nunc cursus eget. Vivamus odio leo, lacinia id faucibus id, viverra sed nunc. Aenean id posuere orci. Duis vehicula laoreet nulla ac rutrum. Ut consectetur elit in risus aliquam, vel iaculis justo commodo. Sed imperdiet malesuada libero, ac consequat orci lacinia sed.</p>
			</div>
			<button><a href="#">Upload</a></button>
			<button><a href="#">Save Changes</a></button>
			<button><a href="#">Print</a></button>
		</div>
		<div id="tab3">
			<div class="scroller">
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division1">Division1</label>
				</div>

				<div class="division1 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Project Number</th>
								<th>Project Name</th>
								<th>Location</th>
								<th>Completion Date</th>
								<th>Status</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/12/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/19/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/27/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>4</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>8/2/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division2">Division2</label>
				</div>

				<div class="division2 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Project Number</th>
								<th>Project Name</th>
								<th>Location</th>
								<th>Completion Date</th>
								<th>Status</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/12/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/19/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/27/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>4</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>8/2/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>

				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division3">Division3</label>
				</div>

				<div class="division3 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Project Number</th>
								<th>Project Name</th>
								<th>Location</th>
								<th>Completion Date</th>
								<th>Status</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/12/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/19/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/27/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>4</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>8/2/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division4">Division4</label>
				</div>

				<div class="division4 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Project Number</th>
								<th>Project Name</th>
								<th>Location</th>
								<th>Completion Date</th>
								<th>Status</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/12/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/19/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/27/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>4</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>8/2/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division5">Division5</label>
				</div>

				<div class="division5 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Project Number</th>
								<th>Project Name</th>
								<th>Location</th>
								<th>Completion Date</th>
								<th>Status</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/12/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/19/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/27/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>4</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>8/2/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division6">Division6</label>
				</div>

				<div class="division6 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Project Number</th>
								<th>Project Name</th>
								<th>Location</th>
								<th>Completion Date</th>
								<th>Status</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/12/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/19/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/27/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>4</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>8/2/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division7">Division7</label>
				</div>

				<div class="division7 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Project Number</th>
								<th>Project Name</th>
								<th>Location</th>
								<th>Completion Date</th>
								<th>Status</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/12/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/19/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/27/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>4</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>8/2/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division8">Division8</label>
				</div>

				<div class="division8 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Project Number</th>
								<th>Project Name</th>
								<th>Location</th>
								<th>Completion Date</th>
								<th>Status</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/12/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/19/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/27/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>4</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>8/2/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division9">Division9</label>
				</div>

				<div class="division9 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Project Number</th>
								<th>Project Name</th>
								<th>Location</th>
								<th>Completion Date</th>
								<th>Status</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/12/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/19/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/27/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>4</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>8/2/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division10">Division10</label>
				</div>

				<div class="division10 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Project Number</th>
								<th>Project Name</th>
								<th>Location</th>
								<th>Completion Date</th>
								<th>Status</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/12/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>2</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/19/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>3</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>7/27/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
							<tr>
								<td>4</td>
								<td>Lorem Ipsum <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>Portland</td>
								<td>8/2/2015</td>
								<td>In Progress <span class="ui-icon ui-icon-info" title="Status on Project Completion."></span></td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
			</div>
			<button><a href="#">Version</a></button>
			<button><a href="#">Save</a></button>
			<button><a href="#">Save As</a></button>
		</div>
		<div id="tab4">
			<div class="scroller">
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division1">Division1</label>
				</div>

				<div class="division1 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Item Number</th>
								<th>Description of Work</th>
								<th>Amount</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$5000</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division2">Division2</label>
				</div>

				<div class="division2 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Item Number</th>
								<th>Description of Work</th>
								<th>Amount</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$5000</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>

				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division3">Division3</label>
				</div>

				<div class="division3 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Item Number</th>
								<th>Description of Work</th>
								<th>Amount</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$5000</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division4">Division4</label>
				</div>

				<div class="division4 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Item Number</th>
								<th>Description of Work</th>
								<th>Amount</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$5000</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division5">Division5</label>
				</div>

				<div class="division5 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Item Number</th>
								<th>Description of Work</th>
								<th>Amount</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$5000</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division6">Division6</label>
				</div>

				<div class="division6 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Item Number</th>
								<th>Description of Work</th>
								<th>Amount</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$5000</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division7">Division7</label>
				</div>

				<div class="division7 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Item Number</th>
								<th>Description of Work</th>
								<th>Amount</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$5000</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division8">Division8</label>
				</div>

				<div class="division8 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Item Number</th>
								<th>Description of Work</th>
								<th>Amount</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$5000</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division9">Division9</label>
				</div>

				<div class="division9 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Item Number</th>
								<th>Description of Work</th>
								<th>Amount</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$5000</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division10">Division10</label>
				</div>

				<div class="division10 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Item Number</th>
								<th>Description of Work</th>
								<th>Amount</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$5000</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
			</div>
			<button><a href="#">Version</a></button>
			<button><a href="#">Save</a></button>
			<button><a href="#">Save As</a></button>
		</div>
		<div id="tab5">
			<div class="scroller">
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division1">Division1</label>
				</div>

				<div class="division1 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Item Number</th>
								<th>Description of Work</th>
								<th>Amount</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$5000</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division2">Division2</label>
				</div>

				<div class="division2 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Item Number</th>
								<th>Description of Work</th>
								<th>Amount</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$5000</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>

				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division3">Division3</label>
				</div>

				<div class="division3 box">

					<form method="post" action="#">
						<table>
							<tr>
								<th>Item Number</th>
								<th>Description of Work</th>
								<th>Amount</th>
							</tr>
							<tr>
								<td>1</td>
								<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$5000</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
							<tr>
								<td>4</td>
								<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
								<td>$1000</td>
							</tr>
						</table>
						<input class="login_button" type="submit" value="Login" tabindex=4>
					</form>
				</div>
				<div class="division">
					<label><input type="checkbox" name="checkbox" value="division4">Division4</label>
				</div>

				<div class="division4 box">

					<form method="post" action="#">
						<table>
							<<tr>
							<th>Item Number</th>
							<th>Description of Work</th>
							<th>Amount</th>
						</tr>
						<tr>
							<td>1</td>
							<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$5000</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
					</table>
					<input class="login_button" type="submit" value="Login" tabindex=4>
				</form>
			</div>
			<div class="division">
				<label><input type="checkbox" name="checkbox" value="division5">Division5</label>
			</div>

			<div class="division5 box">

				<form method="post" action="#">
					<table>
						<tr>
							<th>Item Number</th>
							<th>Description of Work</th>
							<th>Amount</th>
						</tr>
						<tr>
							<td>1</td>
							<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$5000</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
					</table>
					<input class="login_button" type="submit" value="Login" tabindex=4>
				</form>
			</div>
			<div class="division">
				<label><input type="checkbox" name="checkbox" value="division6">Division6</label>
			</div>

			<div class="division6 box">

				<form method="post" action="#">
					<table>
						<tr>
							<th>Item Number</th>
							<th>Description of Work</th>
							<th>Amount</th>
						</tr>
						<tr>
							<td>1</td>
							<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$5000</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
					</table>
					<input class="login_button" type="submit" value="Login" tabindex=4>
				</form>
			</div>
			<div class="division">
				<label><input type="checkbox" name="checkbox" value="division7">Division7</label>
			</div>

			<div class="division7 box">

				<form method="post" action="#">
					<table>
						<tr>
							<th>Item Number</th>
							<th>Description of Work</th>
							<th>Amount</th>
						</tr>
						<tr>
							<td>1</td>
							<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$5000</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
					</table>
					<input class="login_button" type="submit" value="Login" tabindex=4>
				</form>
			</div>
			<div class="division">
				<label><input type="checkbox" name="checkbox" value="division8">Division8</label>
			</div>

			<div class="division8 box">

				<form method="post" action="#">
					<table>
						<tr>
							<th>Item Number</th>
							<th>Description of Work</th>
							<th>Amount</th>
						</tr>
						<tr>
							<td>1</td>
							<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$5000</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
					</table>
					<input  class="login_button" type="submit" value="Login" tabindex=4>
				</form>
			</div>
			<div class="division">
				<label><input type="checkbox" name="checkbox" value="division9">Division9</label>
			</div>

			<div class="division9 box">

				<form method="post" action="#">
					<table>
						<tr>
							<th>Item Number</th>
							<th>Description of Work</th>
							<th>Amount</th>
						</tr>
						<tr>
							<td>1</td>
							<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$5000</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
					</table>
					<input class="login_button" type="submit" value="Login" tabindex=4>
				</form>
			</div>
			<div class="division">
				<label><input type="checkbox" name="checkbox" value="division10">Division10</label>
			</div>

			<div class="division10 box">

				<form method="post" action="#">
					<table>
						<tr>
							<th>Item Number</th>
							<th>Description of Work</th>
							<th>Amount</th>
						</tr>
						<tr>
							<td>1</td>
							<td>Description of work being done will go here<span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$5000</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Description of work being done will go here <span class="ui-icon ui-icon-info" title="Project information goes here."></span></td>
							<td>$1000</td>
						</tr>
					</table>
					<input class="login_button" type="submit" value="Login" tabindex=4>
				</form>
			</div>
		</div>
		<button><a href="#">Version</a></button>
		<button><a href="#">Save</a></button>
		<button><a href="#">Save As</a></button>
	</div>
</div>
</div>
<?php @require_once "includes/footer.inc.php"; ?>
<!-- JavaScript/jQuery script file -->
<script src="js/script.js"></script>
</body>
</html>
