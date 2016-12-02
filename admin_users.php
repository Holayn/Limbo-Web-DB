<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="Home.css" type="text/css" rel="stylesheet">
		<title>Manage Admin</title>
	</head>
	<body>
		<!--Used to update admin password-->
		<?php
			# Connect to MySQL server and the database
			require( 'includes/connect_limbo_db.php' ) ;
			# Includes these helper functions
			require( 'includes/limbohelpers.php' ) ;
			# Check to make sure it is the first time user is visiting the page
			if ($_SERVER['REQUEST_METHOD'] == 'GET'){
				$id = '';
				$password = '';
			}
			# Check to make sure the form method is post
			if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
				$id = $_POST['f_id'];
				$password = $_POST['f_password'];
				#Checks to see if inputs are entered	
				if (empty($id)&&empty($password)) 
					echo 'Please enter both fields to continue';
				else{
					$id = trim($id);
					$status = trim($password);
					$result = update_password_users($dbc, $id, $password);
					echo "Success! Thanks" ; 
				}
			}
			# Close the connection
			mysqli_close( $dbc ) ;
		?>
				<!--Used to delete users-->
		<?php 
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				# Connect to MySQL server and the database
				require( 'includes/connect_limbo_db.php' ) ;
				# Delete item
				if(isset($_GET['id']))
					admin_users_delete($dbc, $_GET['id']);
				# Close the connection
				mysqli_close( $dbc ) ;
			}
		?>
	<img src="maristlogo.png" id="maristlogo">
		<div id="background"> </div>
		<br><br>
		<div style="position: absolute; left: 50; top: 80;">
				<!--menu for navigation-->
			<nav>
              <a href="Home.html">Home</a>
              <a href="Lost.php">Lost</a>
              <a href="Found.php">Found</a>
              <a href="admin_login.php">Admin</a>
            </nav>
		</div>
		<div class="box" style="opacity: 0.9">
			<!--make updates to found-->
			<?php 		
				# Show the users
				admin_show_users($dbc); 
			?>
			<br>
			<h1 style="margin-top: 0px"> Change Password: </h1>
			<img src="managedoge.jpg" height="380" width="480" style="position: absolute; top: 150px; left: 600px;"/>
			<form action ="admin_users.php" method = "POST">
				<p class="para">Id #*: <input type="text" name="f_id" value="<?php if (isset($_POST['f_id'])) echo $_POST['f_id'];?>")><br>
				Password*: <input type = "text" name="f_password" value="<?php if (isset($_POST['f_password'])) echo $_POST['f_password'];?>")><br>
				<input type = "submit" > </p>
			</form>
			<!-- allow admin to go back to task page-->
			<form>
				<button id="backtaska" class="button" formaction="admin.html">Back to task page</button>
			</form>
        </div>
	</body>
</html>