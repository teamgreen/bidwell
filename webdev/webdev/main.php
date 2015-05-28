<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bid-Well Project Page</title>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){

            $('input[type="checkbox"]').click(function(){

                if($(this).attr("value")=="division1"){

                    $(".division1").toggle();

                }

                if($(this).attr("value")=="division2"){

                    $(".division2").toggle();

                }

                if($(this).attr("value")=="blue"){

                    $(".blue").toggle();

                }

            });

        });

    </script>
</head>
<body>
<div class="wrapper">
	<?php @require_once "includes/header.inc.php"; ?>
	<div class="content">
		<a href="login.php">Back to Login</a>
		<h2>Main Page</h2>
		<label><input type="checkbox" name="Checkbox" value="division1"><img src="images/caret-down.jpg">New Project</label>
		<label><input type="checkbox" name="Checkbox" value="division2"><img src="images/caret-down.jpg">Current Project</label><br><br>

		<div class="division1 box">
		<p>New Project</p>
			<table>
				<tr>
					<th>Line Item</th>
					<th>Constr No</th>
					<th>Project City</th>
					<th>General Conditions</th>
					<th>Sub Bid Used</th>
					<th>Notes</th>
				</tr>
				<tr>
					<td>1</td>
					<td>1001</td>
					<td>Portland</td>
					<td>City License</td>
					<td>N/A</td>
					<td>Almost Done</td>
				</tr>
				<tr>
					<td>2</td>
					<td>1001</td>
					<td>Portland</td>
					<td>Field Office</td>
					<td>N/A</td>
					<td>Almost Done</td>
				</tr>
				<tr>
					<td>3</td>
					<td>1001</td>
					<td>Portland</td>
					<td>Good</td>
					<td>N/A</td>
					<td>Almost Done</td>
				</tr>
				<tr>
					<td>4</td>
					<td>1001</td>
					<td>Portland</td>
					<td>Good</td>
					<td>N/A</td>
					<td>Almost Done</td>
				</tr>
			</table>
			<p><a href="description.php">Description Sheet</a></p>
		</div>

		<div class="division2 box">
			<p>Current Project</p>
			<table>
				<tr>
					<th>Line Item</th>
					<th>Constr No</th>
					<th>Project City</th>
					<th>General Conditions</th>
					<th>Sub Bid Used</th>
					<th>Notes</th>
				</tr>
				<tr>
					<td>1</td>
					<td>1001</td>
					<td>Portland</td>
					<td>City License</td>
					<td>N/A</td>
					<td>Almost Done</td>
				</tr>
				<tr>
					<td>2</td>
					<td>1001</td>
					<td>Portland</td>
					<td>Field Office</td>
					<td>N/A</td>
					<td>Almost Done</td>
				</tr>
				<tr>
					<td>3</td>
					<td>1001</td>
					<td>Portland</td>
					<td>Good</td>
					<td>N/A</td>
					<td>Almost Done</td>
				</tr>
				<tr>
					<td>4</td>
					<td>1001</td>
					<td>Portland</td>
					<td>Good</td>
					<td>N/A</td>
					<td>Almost Done</td>
				</tr>
			</table>
			<p><a href="change.php">Change Bid</a>&nbsp;&nbsp;<a href="internal.php">Internal Bid</a>&nbsp;&nbsp;<a href="external.php">External Bid</a>&nbsp;&nbsp;<a href="description.php">Description Sheet</a></p>
		</div>
		
		<!-- <footer>
		<ul>
				<li><a href="#" title="About">About</a></li>
				<li><a href="#" title="Admin">Admin</a></li>
				<li><a href="#" title="Contact">Contact</a></li>
		</ul>
		<p>Product of Greenwell Bank &copy; 2015</p>
	</footer> -->
	<?php @require_once "includes/footer.inc.php"; ?>
	</div>
</div>
</body>
</html>
