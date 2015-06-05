<!-- 
///////////////////////////////////////
// Login Page
// Authored by Tim Willbanks
// Purpose: To provide a page where
// 			the user can login. Checks to 
// 			see what level user is and
// 			goes to either the admin or
// 			home page based on level. 
/////////////////////////////////////////
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bid-Well Login Page</title>
	<link rel="stylesheet" type="text/css" href="css/login-style.css">
</head>
<body>
<div class="wrapper">
	<?php 
	$filename=basename(__FILE__);
	@require_once "includes/login-header.inc.php"; ?>
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
					<input type="password" name="password" tabindex=3 required><br><br>
					<input type="submit" value="Login" tabindex=4><br><br>
					</form>
				</div>
		</div>
		<?php 			@require_once 'includes/mysqli_connect.inc.php';
						$dbc = SQLConnect();

						if ($_SERVER['REQUEST_METHOD'] == 'POST') {
							$username = $_POST['username'];
							$company = $_POST['company'];
							$password = $_POST['password'];

							// build the sql search condition using the posted data
							$sql_account="SELECT * FROM account WHERE LoginName='$username' AND Password=PASSWORD('$password')";
							$result_account = @mysqli_query($dbc, $sql_account);


							// check to see if company is valid
							$sql_company="SELECT * FROM company WHERE CompanyName = '$company'";
							$result_company = @mysqli_query($dbc, $sql_company);

							//check that we got match using mysqli_num_rows function
							if ((mysqli_num_rows($result_account)==1) && (mysqli_num_rows($result_company)==1)) {
								//now check that the CompanyID matches
								$row_account = @mysqli_fetch_array($result_account);
								$row_company = @mysqli_fetch_array($result_company);
								if($row_account['CompanyID'] === $row_company['CompanyID']) {
									// Set session variables
									$_SESSION["username"] = "username";
									$_SESSION["company"] = "company"; 

									// if admin user go to admin page or goto projects
									if ($row_account['PresetName'] === 'Admin') {
										header("Location:admin.php");
									} else {
										header("Location:home.php");
									}
								}
							} 
							echo "Not valid";
								
						}
			?>
		
		<?php @require_once "includes/login-footer.inc.php"; ?>
		
	</div>
	
</div>
</body>
</html>
