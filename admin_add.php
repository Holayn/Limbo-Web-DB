<!--
This PHP script was modified based on result.php in McGrath (2012).
It demonstrates how to ...
  1) Connect to MySQL.
  2) Write a complex query.
  3) Format the results into an HTML table.
  4) Update MySQL with form input.
By Ron Coleman
Edited by Kai Wong, Wendy Ni, Jae Kyoung Lee (LJ)
		11/02/2016
-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="Home.css" type="text/css" rel="stylesheet">
		<title>Add Admin</title>
	</head>
	<body>
			<!--Used to add admin-->
		<?php
			# Connect to MySQL server and the database
			require( 'includes/connect_limbo_db.php' ) ;
			# Includes these helper functions
			require( 'includes/limbohelpers.php' ) ;
			# Check to make sure it is the first time user is visiting the page
			if ($_SERVER['REQUEST_METHOD'] == 'GET'){
				$id = '';
				$status = '';
			}
			# Check to make sure the form method is post
			if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
				$first_name = $_POST['f_id'];
				$email = $_POST['email'];
				$pass = $_POST['pass'];
				#Checks to see if inputs are entered	
				if (empty($first_name)||empty($email)||empty($pass)) 
					echo 'Please enter all fields to continue';
				else{
					$first_name = trim($first_name);
					$email = trim($email);
					$pass = trim($pass);
					$result = admin_add_user($dbc, $first_name, $email, $pass);
					echo "Success! Thanks" ; 
				}
			}
			# Close the connection
			mysqli_close( $dbc ) ;
		?>
			<!--page layout-->
		<img src="maristlogo.png" id="maristlogo">
		<div id="background"> </div>
		<br><br>
		<div style="position: absolute; left: 8px; top: 100px;">
				<!--menu for navigation-->
			<nav>
              <a href="Home.html">Home</a>
              <a href="Lost.php">Lost</a>
              <a href="Found.php">Found</a>
              <a href="admin_login.php">Admin</a>
            </nav>
		</div>
		<div class="box" style="opacity: 0.9">
		<!--Allow admin to add new user-->
			<h1> Add a New Admin </h1>
			<img src="dogeadd.png" height="380" width="480" style="position: absolute; top: 150px; left: 600px;"/>
			<form action ="admin_add.php" method = "POST">
				<p class="para">First Name*: <input type="text" name="f_id" value="<?php if (isset($_POST['f_id'])) echo $_POST['f_id'];?>")><br>
				Email*: <input type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>")><br>
				Password*: <input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo $_POST['pass'];?>")><br>
				<input type = "submit">
				</p>
			</form>
			<!-- allow admin to go back to task page-->
			<form>
				<button id="backtaska" class="button" formaction="admin.html">Back to task page</button>
			</form>
		</div>
	</body>
</html>

