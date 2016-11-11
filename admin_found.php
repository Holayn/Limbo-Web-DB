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
	<link href="home.css" type="text/css" rel="stylesheet">
	<link href="admin.css" type="text/css" rel="stylesheet">
	<title>Manage Found</title>
</head>
<body>
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
			
			#Checks to see if name input is valid	
			if (empty($id)&&empty($status)) 
				echo 'error';
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
	<img src="maristlogo.png" id="maristlogo">
	<br><br>
		<!--page layout-->
	<div style="position: relative; left: 0; top: 0;">
			<!--menu for navigation-->
		<ul>
		  <li><a href="Home.html">Home</a></li>
		  <li><a href="Lost.php">Lost</a></li>
		  <li><a href="Found.php">Found</a></li>
		  <li><a href="admin_login.php">Admin</a></li>
		</ul>
	<img src="white.jpg" height="500" width="1350" style="opacity: 0.8; position: relative; top: -136px; left: 100px;"/>
	</div>
		<!--make updates to found-->
	<div style="position: relative; bottom: 600px; left: 200px;"> 
		<h1>Found Something?</h1>
		<form action ="admin.php" method = "POST">
			Id #*: <input type="text" name="f_id" value="<?php if (isset($_POST['f_id'])) echo $_POST['f_id'];?>")><br>
			Status*: <input type="text" name="f_status" value="<?php if (isset($_POST['f_status'])) echo $_POST['f_status'];?>")><br>
			<input type = "submit" >
		</form>
		<?php 		
		# Show the records
		show_found_records($dbc); ?>
	</div>
</body>
</html>