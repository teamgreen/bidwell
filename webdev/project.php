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
<script src="js/project-script.js"></script>
</head>
<body>

	<div class="wrapper">

		<?php @require_once "includes/header.inc.php"; ?>

		<div class="content">

			<?php
			//connect to the database.
			@require_once 'includes/mysqli_connect.inc.php';
			$dbc = SQLConnect();

			// set up the project class.
			@require_once "includes/project-class.inc.php";

			// FIX THIS: the 23 should be taken from a session variable.
			$project = new Project(23);
			$project->loadProjectFromDatabase($dbc);
//var_dump($project);
//echo "<p>Testing, testing: " . $project->getProjectName() . "</p>"
			?>

			<div id="home-tabs">
				<ul>
					<li><a href="#tab1">Project<br>Information</a></li>
					<li><a href="#tab2">Project<br>Description</a></li>
					<li><a href="#tab3">Internal<br>Bid Sheets</a></li>
					<li><a href="#tab4">External<br>Bid Sheets</a></li>
					<li><a href="#tab5">Change<br>Bid Sheets</a></li>
				</ul>
				<div id="tab1">
					<?php
					//require_once 'includes/project-tab1.inc.php';
					?>
				</div>
				<div id="tab2">
					<?php
	//				require_once 'includes/project-tab2.inc.php';
					?>
<!-- 					<div class="description-cont">
						<p class="description-left-title">Description:</p>
						<p class="description-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas gravida ut purus id ullamcorper. Praesent fringilla eros tortor, nec mollis nunc cursus eget. Vivamus odio leo, lacinia id faucibus id, viverra sed nunc. Aenean id posuere orci. Duis vehicula laoreet nulla ac rutrum. Ut consectetur elit in risus aliquam, vel iaculis justo commodo. Sed imperdiet malesuada libero, ac consequat orci lacinia sed.</p>
					</div>
					<div class="description-cont">
						<p class="description-right-title">Files Uploaded:</p>
						<p class="description-right">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas gravida ut purus id ullamcorper. Praesent fringilla eros tortor, nec mollis nunc cursus eget. Vivamus odio leo, lacinia id faucibus id, viverra sed nunc. Aenean id posuere orci. Duis vehicula laoreet nulla ac rutrum. Ut consectetur elit in risus aliquam, vel iaculis justo commodo. Sed imperdiet malesuada libero, ac consequat orci lacinia sed.</p>
					</div>
					<button><a href="#">Upload</a></button>
					<button><a href="#">Save Changes</a></button>
					<button><a href="#">Print</a></button> -->
				</div>
				<div id="tab3">
					<div class="scroller">
						<div class="accordion">
							<?php
							$sheetResult = $project->getSheetIDs($dbc);
//var_dump($sheetResult);
							?>
							<h3>Section 1</h3>
							<div>
								<p>
									Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
									ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
									amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
									odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
								</p>
							</div>
							<h3>Section 2</h3>
							<div>
								<p>
									Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
									purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
									velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
									suscipit faucibus urna.
								</p>
							</div>

						</div> <!-- end of accordion -->
					</div>
					<button><a href="#">Version</a></button>
					<button><a href="#">Save</a></button>
					<button><a href="#">Save As</a></button>
				</div>
				<div id="tab4">
					<?php
					//require_once 'includes/project-tab4.inc.php';
					?>
					<!-- <div class="scroller">
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
								</table>
								<input class="login_button" type="submit" value="Login" tabindex=4>
							</form>
						</div>
					</div>
					<button><a href="#">Version</a></button>
					<button><a href="#">Save</a></button>
					<button><a href="#">Save As</a></button> -->
				</div>
				<div id="tab5">
					<?php
					//require_once 'includes/project-tab2.inc.php';
					?>

<!-- 					<div class="scroller">
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
								</table>
								<input class="login_button" type="submit" value="Login" tabindex=4>
							</form>

						</div>
					</div>
					<button><a href="#">Version</a></button>
					<button><a href="#">Save</a></button>
					<button><a href="#">Save As</a></button> -->
				</div>
			</div>
		</div>
	</div>
	<?php @require_once "includes/footer.inc.php"; ?>
	<!-- JavaScript/jQuery script file -->
	<script src="js/script.js"></script>
</body>
</html>
