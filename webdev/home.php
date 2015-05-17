<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home | Bid-Well</title>
	
	<!-- Stylesheet -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Custom jQuery UI Library Stylesheets - 1.11.4 -->
	<link rel="stylesheet" href="libs/jquery-ui-1.11.4.custom/jquery-ui.min.css">
	<link rel="stylesheet" href="libs/jquery-ui-1.11.4.custom/jquery-ui.theme.min.css">

	<!-- jQuery Library - Google CDN -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Custom jQuery UI Library - 1.11.4 -->
	<script src="libs/jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
</head>
<body>

	<div class="wrapper">

	<?php @require_once "includes/header.inc.php"; ?>
		
		<div class="content">

			<div id="home-tabs">
				<ul>
					<li><a href="#tab1">Current Projects</a></li>
					<li><a href="#tab2">New Project</a></li>
					<li><a href="#tab3">Completed Projects</a></li>
				</ul>
				<div id="tab1">
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
							<td>Lorem Ipsum</td>
							<td>Portland</td>
							<td>7/12/2015</td>
							<td>In Progress</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Lorem Ipsum</td>
							<td>Portland</td>
							<td>7/19/2015</td>
							<td>In Progress</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Lorem Ipsum</td>
							<td>Portland</td>
							<td>7/27/2015</td>
							<td>In Progress</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Lorem Ipsum</td>
							<td>Portland</td>
							<td>8/2/2015</td>
							<td>In Progress</td>
						</tr>
					</table>
				</div>
				<div id="tab2">
					<!-- form elements go here -->
				</div>
				<div id="tab3">
					<table>
						<tr>
							<th>Project Number</th>
							<th>Project Name</th>
							<th>Location</th>
							<th>Completed Date</th>
							<th>Status</th>
						</tr>
						<tr>
							<td>1</td>
							<td>Lorem Ipsum</td>
							<td>Portland</td>
							<td>1/11/2015</td>
							<td>Closed</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Lorem Ipsum</td>
							<td>Portland</td>
							<td>1/14/2015</td>
							<td>Closed</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Lorem Ipsum</td>
							<td>Portland</td>
							<td>1/20/2015</td>
							<td>Closed</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Lorem Ipsum</td>
							<td>Portland</td>
							<td>2/4/2015</td>
							<td>Closed</td>
						</tr>
					</table>
				</div>
			</div>

		</div>

	<?php @require_once "includes/footer.inc.php"; ?>

	</div>

	<!-- JavaScript/jQuery script file -->
	<script src="js/script.js"></script>
</body>
</html>
