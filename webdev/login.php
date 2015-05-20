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
					<input type="text" name="username" tabindex=1 autofocus require><br>
					<label for="company">Company:</label>
					<input type="text" name="company" tabindex=2 require><br>
					<label for="password">Password:</label>
					<input type="text" name="password" tabindex=3 require><br><br>
					<input type="submit" value="Login" tabindex=4><br><br>
					</form>
				</div>
		</div>
		
		<?php @require_once "includes/login-footer.inc.php"; ?>
		
	</div>
	
</div>
</body>
</html>
