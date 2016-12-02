<!--
This PHP script front-ends linkyprints.php with a login page.
Originally created By Ron Coleman.
Revision history:
Who	Date		Comment
RC  07-Nov-13   Created.
-->
<!DOCTYPE html>
<html>
		<!--Used to validate user-->
	<?php
	# Connect to MySQL server and the database
	require( 'includes/connect_limbo_db.php' ) ;

	# Connect to MySQL server and the database
	require( 'includes/admin_login_tools.php' ) ;

	if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
		
		#get user's first name and last name
		$first_name = $_POST['first_name'] ;
		$pass = $_POST['pass'];
		
		#validate them with the database
		#$pid is the user_id (used for reference)
		$pid = validate($first_name,$pass) ;

		if($pid == -1)
		  echo '<P style=color:red>Login failed please try again.</P>' ;
		
		else
			#brings them to admin control page
			load('admin.html', $pid);
	}
	?>

	<head>
		<meta charset="utf-8">
		<link href="home.css" type="text/css" rel="stylesheet">
		<title>Admin</title>
	</head>
	<body>
		<img src="maristlogo.png" id="maristlogo">
		<div id="background"> </div>
		<br><br>
			<!--page layout-->
		<div style="position: relative; left: 0; top: 0;">
				<!--menu for navigation-->
			<nav>
              <a href="Home.html">Home</a>
              <a href="Lost.php">Lost</a>
              <a href="Found.php">Found</a>
              <a href="admin_login.php">Admin</a>
            </nav>
		<div class="box" style="opacity: 0.9">
		<img src="secret_doge.jpg" height="400" width="500" style="position: absolute; top: 50px; left: 600px;"/>
		</div>
			<!--Login form for the admin-->
		<div style="position: relative; bottom: 350px; left: 250px;"> 
			<h1>Admin login</h1>
			<form action="admin_login.php" method="POST">
				<table>
					<tr>
						<td>Name:</td><td><input type="text" name="first_name"></td>
					</tr>
					<tr>
						<td>Password:</td><td><input type="password" name="pass"></td>
					</tr>
				</table>
				<p><input type="submit" ></p>
			</form>
		</div>
        </div>
	</body>
</html>