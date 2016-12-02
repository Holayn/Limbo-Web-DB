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
		<title>Manage Found</title>
	</head>
	<body>
			<!--Used to change status of items-->
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
				$id = $_POST['f_id'];
				$status = $_POST['f_status'];
				#Checks to see if inputs are entered	
				if (empty($id)&&empty($status)) 
					echo 'Please enter both fields to continue';
				else{
					$id = trim($id);
					$status = trim($status);
					$result = update_status_foundstuff($dbc, $id, $status);
					echo "Success! Thanks" ; 
				}
			}
			# Close the connection
			mysqli_close( $dbc ) ;
		?>
				<!--Used to delete items-->
		<?php 
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				# Connect to MySQL server and the database
				require( 'includes/connect_limbo_db.php' ) ;
				# Delete item
				if(isset($_GET['id']))
					admin_found_delete($dbc, $_GET['id']);
				# Close the connection
				mysqli_close( $dbc ) ;
			}
		?>
			<!--page layout-->
		<img src="maristlogo.png" id="maristlogo">
		<div id="background"> </div>
		<br><br>
		<div style="position: absolute; left: 0; top: 105;">
				<!--menu for navigation-->
			<nav>
              <a href="Home.html">Home</a>
              <a href="Lost.php">Lost</a>
              <a href="Found.php">Found</a>
              <a href="admin_login.php">Admin</a>
            </nav>

		<div class="box" style="opacity: 0.9">
			<!--make updates to found-->
			<?php 		
				# Show the records
				admin_show_found_records($dbc); 
			?>
			<br>
			<h1 style="margin-top: 0px"> Update Status of item: </h1>
			<form action ="admin_found.php" method = "POST">
				<p class="para">Id #*: <input type="text" name="f_id" value="<?php if (isset($_POST['f_id'])) echo $_POST['f_id'];?>")><br>
				Status*: <select name="f_status" value="<?php if (isset($_POST['f_status'])) echo $_POST['f_status'];?>")><option value="Found">Found</option><option value="Claimed">Claimed</option></select><br>
				<input type = "submit" > </p>
			</form>
			<!-- allow admin to go back to task page-->
			<form>
				<button id="backtaskf" class="button" formaction="admin.html">Back to task page</button>
			</form>
        </div>
		</div>
	</body>
</html>
