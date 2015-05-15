<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bid-Well Login Page</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<div class="wrapper">
	<?php @require_once "includes/header.inc.php"; ?>
	<div class="content">
		<h2>Login Page</h2>
		<form method="post" action="#">
			<label for="username">Username:</label>
			<input type="text" name="username" tabindex=1 autofocus require><br>
			<label for="company">Company:</label>
			<input type="text" name="company" tabindex=2 require><br>
			<label for="password">Password:</label>
			<input type="text" name="password" tabindex=3 require><br><br>
			<input type="submit" value="Login" tabindex=4><br><br>
		</form>
		<p><a href="#">Admin</a>&nbsp;&nbsp;<a href="main.php">Project</a></p>
		<?php @require_once "includes/footer.inc.php"; ?>
		
	</div>
	
</div>
</body>
</html>
