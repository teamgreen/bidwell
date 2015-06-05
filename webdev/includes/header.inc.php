<?php 
	session_start();
	var_dump($_SESSION); 
	var_dump($filename);
	if($filename != "login.php") {
		if( !(isset($_SESSION['username']) AND $_SESSION['username']) ) {
			header("Location:login.php");
		}
	}
 ?>
		<header>
			<div>
				<ul class="top-nav">
					<li><a href="#" title="Greenwell">Greenwell</a></li>
					<li><a href="#" title="About">About</a></li>
					<li><a href="#" title="Help">Help</a></li>
					<li><a href="#" title="Sign out">Sign out</a></li>
				</ul>
			</div>
			<div class="logo">
					<a href="#" title="Home">
						<img src="images/greenwell.jpg" alt="Greenwell Logo">
					</a>
			</div>
			<div>
				
				<div class="title">
					<h1>Bid-Well Application</h1>
					<h2>Greenwell Bank</h2>
				</div>
			</div>
		</header>
