<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bid-Well Admin Page</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<div class="wrapper">
	<?php @require_once "includes/header.inc.php"; ?>
	<!-- <header>
		<div class="logo"><a href="#" title="Home"><img src="images/greenwell.jpg" alt="Greenwell Logo"></a></div>
		<div class="title">Bid-Well</div>
		<div>
			<ul class="top-nav">
				<li><a href="#" title="Contact">Contact</a></li>
				<li><a href="#" title="Admin">Admin</a></li>
				<li><a href="#" title="About">About</a></li>
			</ul>
		</div>
	</header> -->
	<div class="content">
		<p>ADMIN</p>
		<form method="post" action="#">
			<label for="username">Username:</label>
			<input type="text" name="username" tabindex=1 autofocus require><br>
			<label for="company">Company:</label>
			<input type="text" name="company" tabindex=2 require><br>
			<label for="password">Password:</label>
			<input type="text" name="password" tabindex=3 require><br><br>
			<input type="submit" value="Login" tabindex=4><br><br><br><br>
		</form>
		<?php @require_once "includes/footer.inc.php"; ?>
		<!-- <footer>
		<ul>
				<li><a href="#" title="About">About</a></li>
				<li><a href="#" title="Admin">Admin</a></li>
				<li><a href="#" title="Contact">Contact</a></li>
		</ul>
		<p>Product of Greenwell Bank &copy; 2015</p>
	</footer> -->
	</div>
	
</div>
</body>
</html>
