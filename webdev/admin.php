<!DOCTYPE html>
<html lang="en">
<head>

	<!-- 
	
	///////////////////////////////////////
	// Admin Page
	// Authored by Alex Chaudoin
	// Purpose: To provide a page where
	// 			the admin can access other
	//			accounts and change 
	//			system settings as well.
	///////////////////////////////////////

	-->

	<meta charset="UTF-8">
	<title>Admin | Bid-Well</title>
	
	<!-- Main Stylesheet and Admin Page Stylesheet -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/admin-style.css">
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
			
			<div id="admin-tabs">
				<ul>
					<li><a href="#tab-a">Accounts</a></li>
					<li><a href="#tab-b">System Settings</a></li>
				</ul>
				<div id="tab-a">
					<table>
						<tr>
							<th>Account ID</th>
							<th>Username</th>
							<th>Email</th>
							<th>Preset</th>
							<th>Password</th>
						</tr>
						<tr>
							<td>1</td>
							<td>Lorem Ipsum</td>
							<td>email@gmail.com</td>
							<td>Loan Officer</td>
							<td>***********</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Lorem Ipsum</td>
							<td>email@hotmail.com</td>
							<td>Bid Preparer</td>
							<td>***********</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Lorem Ipsum</td>
							<td>email@yahoo.com</td>
							<td>Custom</td>
							<td>***********</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Lorem Ipsum</td>
							<td>email@aol.com</td>
							<td>Executive</td>
							<td>***********</td>
						</tr>
					</table>
					<div id="admin-table_dashboard">
						<button class="prev" href="#">Reset</button>
						<button class="new-edit" href="#">New/Edit</button> <!--will change-->
						<button class="delete" href="#">Delete</button>
					</div>
				</div>
				<div id="tab-b">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate obcaecati porro eum repudiandae possimus repellat cumque asperiores magni architecto esse sed minima dolorum deserunt, quo animi quod omnis, earum! Veniam.</p>
				</div>
			</div>

		</div>

	<?php @require_once "includes/footer.inc.php"; ?>
		
	</div>

	<!-- JavaScript/jQuery script file -->
	<script src="js/script.js"></script>

</body>
</html>
