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
// Updated: by Adam Duthie on 5/31 @ 8:00PM
/////////////////////////////////////////

-->

	<meta charset="UTF-8">
	<title>Project | Bid-Well</title>

	<!-- Main Stylesheet and Home Page Stylesheet -->
	<link rel="stylesheet" href="css/project-tab2.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/project-style.css">

	<!-- Custom jQuery UI Library Stylesheets - 1.11.4 -->
	<link rel="stylesheet" href="libs/jquery-ui-1.11.4.custom/jquery-ui.min.css">
	<link rel="stylesheet" href="libs/jquery-ui-1.11.4.custom/jquery-ui.theme.min.css">

	<!-- jQuery Library - Google CDN -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Custom jQuery UI Library - 1.11.4 -->
	<script src="libs/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
	<script src='js/project-tab1-script.js'></script>
	<script src='js/helper_functions.js'></script>
	 <!-- <script src='js/project-tab1-script.js'></script> -->
	<script type="text/javascript" src="libs/jquery.validate.min.js"></script>
    <script type="text/javascript" src="libs/additional-methods.min.js"></script>
	<script src="js/project-script.js"></script>
	
</head>
<body>
	<?php

		session_start(); 
		# set up projectid SESSION variable
		# for use in project page
		$projectid =23;
		if (isset($_SESSION['projectid'])) {
			$projectid = $_SESSION['projectid'];

			// if our project has changed, clear the tab related stuff.
			if(!$_SESSION['prevprojectid'] || $_SESSION['prevprojectid'] != $projectid){
				// unset the session variables
				unset($_SESSION['InternalBidSheetID']);
				unset($_SESSION['ExternalBidSheetID']);
				unset($_SESSION['ChangeBidSheetID']);
				unset($_SESSION['activetab']);
				// store the page for the next time.
				$_SESSION['prevprojectid'] = $projectid;
			}
		}


	?>

	<div class="wrapper">

<?php
		$filename=basename(__FILE__);
		@require_once "includes/header.inc.php";
?>

		<div class="content">

			<?php
			//connect to the database.
			@require_once 'includes/mysqli_connect.inc.php';
			$dbc = SQLConnect();


			// set up the project class.
			@require_once "includes/project-class.inc.php";

			// FIX THIS: the 23 should be taken from a session variable.
			
			$project = new Project($projectid);
			$project->loadProjectFromDatabase($dbc);
			?>

			<h2><?php echo $project->getProjectName(); ?></h2>

			<div id="home-tabs">
				<ul>
					<li><a href="#tab1">Project<br>Information</a></li>
					<li><a href="#tab2">Project<br>Description</a></li>
					<li><a href="#tab3">Internal<br>Bid Sheets</a></li>
					<li><a href="#tab4">External<br>Bid Sheets</a></li>
					<li><a href="#tab5">Change<br>Bid Sheets</a></li>
				</ul>
				<div id="tab1">
					<?php require_once 'includes/project-tab1.inc.php';	?>
				</div>

				<div id="tab2">
					<?php require_once 'includes/project-tab2.inc.php';	?>
				</div>
				<div id="tab3">
					<div>
						<?php
						$project->displayProjectSheetOfType($dbc, Sheet::eInternalBidSheet, null);
						//$project->generateLoadSelectHTML($dbc, Sheet::eInternalBidSheet);
						$project->generateSaveHTML(null);
						?>
					</div>
				</div>
				<div id="tab4">
					<div>
						<?php
						$project->displayProjectSheetOfType($dbc, Sheet::eExternalBidSheet, null);
						//$project->generateLoadSelectHTML($dbc, Sheet::eExternalBidSheet);
						$project->generateSaveHTML(null);
						?>
					</div>
				</div>
				<div id="tab5">
					<div>
						<?php
						$project->displayProjectSheetOfType($dbc, Sheet::eChangeBidSheet, null);
						//$project->generateLoadSelectHTML($dbc, Sheet::eChangeBidSheet);
						$project->generateSaveHTML(null);
						?>
					</div>
				</div>
			</div>
		</div>
		<?php @require_once "includes/footer.inc.php"; ?>
	</div>
	<!-- JavaScript/jQuery script file -->
	<!-- <script src="js/script.js"></script>-->
</body>
</html>
