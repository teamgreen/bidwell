<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bid-Well Login Page</title>
	<link rel="stylesheet" type="text/css" href="css/login-style.css">
</head>
<body>
<div class="wrapper">
	<?php @require_once "includes/login-header.inc.php"; ?>
	<div class="content">
		<h2>Login Page</h2><br><br>
		<div class="admin">
			<div class="logo2">
				<img src="images/greenwell.jpg">
			</div>
				<div class="form">
					<form method="post" action="#">
					<label for="username">Username:</label>
					<input type="text" name="username" tabindex=1 autofocus required><br>
					<label for="company">Company:</label>
					<input type="text" name="company" tabindex=2 required><br>
					<label for="password">Password:</label>
					<input type="text" name="password" tabindex=3 required><br><br>
					<input type="submit" value="Login" tabindex=4><br><br>
					</form>
				</div>
		</div>
		<?php 			@require_once 'includes/mysqli_connect.inc.php';
						$dbc = SQLConnect();

						if ($_SERVER['REQUEST_METHOD'] == 'POST') {
							$sql_preset = "SELECT * FROM `preset`";
							$result_preset = @mysqli_query($dbc, $sql_preset);

							$company = $_POST['id'];
							$username = $_POST['PresetName'];
							$password = $_POST['password'];
						
							if ($username == 'Admin') {
							header("Location:admin.php");
							} else {
							header("Location:home.php");
							}
						}
						
						// SQL statement to select everything from preset table to test user level		
						
					?>
		
		<?php @require_once "includes/login-footer.inc.php"; ?>
		
	</div>
	
</div>
</body>
</html>
