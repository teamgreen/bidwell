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
					<div class="scroller">
						<div class="accordion">
							<?php
							$project->getSheetsByType($dbc, Sheet::eInternalBidSheet);
						
//include_once 'includes/debugging-helper-functions.inc.php';
//varDump("project.php", "returnSheetRow()", $result);

							while($row = $project->returnSheetRow()){
								echo "<h3>" . $row['Name'] . "</h3>\n";
								echo "<div>\n";
								$sheet = new InternalBidSheet();
								$sheet->loadSheetFromResult($dbc, $row);
								$sheet->generateLinesTableHTML($dbc);
								echo "</div>\n";
							}
							?>


						</div> <!-- end of accordion -->
					</div>
<!-- 					<button><a href="#">Version</a></button>
					<button><a href="#">Save</a></button>
					<button><a href="#">Save As</a></button> -->
				</div>
				<div id="tab4">
					<div class="scroller">
						<div class="accordion">
							<?php
							$project->getSheetsByType($dbc, Sheet::eExternalBidSheet);
						
// include_once 'includes/debugging-helper-functions.inc.php';
// varDump("project.php", 'getSheetsByType()', $project);

							while($row = $project->returnSheetRow()){
								echo "<h3>" . $row['Name'] . "</h3>\n";
								echo "<div>\n";
								$sheet = new ExternalBidSheet();
	 							$sheet->loadSheetFromResult($dbc, $row);
 // include_once 'includes/debugging-helper-functions.inc.php';
 // varDump("project.php", "tab 4", $sheet);
								$sheet->generateLinesTableHTML($dbc);
								echo "</div>\n";
							}
							?>
						</div>
					</div>
				</div>
				<div id="tab5">
					<div class="scroller">
						<div class="accordion">
							<?php
							$project->getSheetsByType($dbc, Sheet::eChangeBidSheet);
//include_once 'includes/debugging-helper-functions.inc.php';
//varDump("project.php", "returnSheetRow()", $result);

							while($row = $project->returnSheetRow()){
								echo "<h3>" . $row['Name'] . "</h3>\n";
								echo "<div>\n";
								$sheet = new ChangeBidSheet();
								$sheet->loadSheetFromResult($dbc, $row);
// include_once 'includes/debugging-helper-functions.inc.php';
// varDump("project.php", "tab 5", $sheet);
								$sheet->generateLinesTableHTML($dbc);
								echo "</div>\n";
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php @require_once "includes/footer.inc.php"; ?>
	<!-- JavaScript/jQuery script file -->
	<script src="js/script.js"></script>
</body>
</html>
