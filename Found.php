<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="Found.css" type="text/css" rel="stylesheet">
		<link href="home.css" type="text/css" rel="stylesheet">
		<title>Found Something</title>
	</head>
	<body>
			<!--Used to insert records-->
		<?php
			# Connect to MySQL server and the database
			require( 'includes/connect_limbo_db.php' ) ;
			# Includes these helper functions
			require( 'includes/limbohelpers.php' ) ;
			# Check to make sure it is the first time user is visiting the page
			if ($_SERVER['REQUEST_METHOD'] == 'GET'){
				$findername = "";
				$phone = "";
				$email = "";
				$item_name = "";
				$description = "";
			}
			# Check to make sure the form method is post
			if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
				$findername = $_POST['findername']; 
				$phone = $_POST['phone'];
				$email = $_POST['email'];
				$itemname = $_POST['itemname'];
				$description = $_POST['description'];
				$location = $_POST['location'];
				$date = $_POST['date'];
				#Display error message if user does not input required values
				#Creating an error array to store the errors
				$error = array();
				#Checks to see if name input is valid	
				if (!valid_name($itemname)) 
					$error[] = 'itemname';
				if (!valid_number($phone)) 
					$error[] = 'phone';
				if (!valid_name($findername)) 
					$error[] = 'findername';
				if (!valid_name($email)) 
					$error[] = 'email';
				#Report the errors or success
				if (!empty($error)){
					echo 'Error! Please enter the ' ;
					foreach ($error as $field){
						echo " - $field";
					}
				}
				else { 
					#Inserts inputs into table if all inputs are valid
					$itemname = trim($itemname);
					$description = trim($description);
					$findername = trim($findername);
					$phone = trim($phone);
					$email = trim($email);
					$result = insert_record_foundstuff($dbc, $findername, $phone, $email, $itemname, $description, $location, $date);
					echo "Success! Thanks" ; 	
				}
			}
			# Close the connection
			mysqli_close( $dbc ) ;
		?>
			<!--page layout-->
		<img src="maristlogo.png" id="maristlogo">
		<br><br>
		<div style="position: absolute; left: 0; top: 150px;">
				<!--menu for navigation-->
			<ul>
				<li><a href="Home.html">Home</a></li>
				<li><a href="Lost.php">Lost</a></li>
				<li><a href="Found.php">Found</a></li>
				<li><a href="admin_login.php">Admin</a></li>
			</ul>
			<img src="white.jpg" height="500" width="1350" style="opacity: 0.8; position: relative; top: -136px; left: 100px;"/>
		</div> 
		<div style="position: relative; top: 50px; left: 200px;">
				<!--Show finder list of lost items first-->
			<?php show_initial_lost_records($dbc);?>
			<?php 
				if($_SERVER['REQUEST_METHOD'] == 'GET'){
					if(isset($_GET['id']))
					show_lost_records($dbc, $_GET['id']);
				}
			?>
				<!--Allow user to enter new found item-->
			<h1>Found something not on the list?</h1>
			<form action ="Found.php" method = "POST">
				Your Name*: <input type="text" name="findername" value="<?php if (isset($_POST['findername'])) echo $_POST['findername'];?>")><br><br>
				Phone Number*: <input type="text" name="phone" value="<?php if (isset($_POST['phone'])) echo $_POST['phone'];?>")><br><br>
				Email*: <input type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>")><br><br>
				Name of Item*: <input type="text" name="itemname" value="<?php if (isset($_POST['itemname'])) echo $_POST['itemname'];?>")><br><br>
				Description of Item: <input type="text" name = "description" value="<?php if (isset($_POST['description'])) echo $_POST['description'];?>")><br><br>
				Location Item Was Found: <select name="location" value="<?php if (isset($_POST['location'])) echo $_POST['location'];?>")>
					<?php 
						require( 'includes/connect_limbo_db.php' ) ;
						#populating dropdown with table values in db
						show_locations($dbc);
					?>
				</select><br><br>
				Approx. Date Found: <input type="date" name="date" value="<?php if (isset($_POST['date'])) echo $_POST['date'];?>")><br><br>
				<input type = "submit" >
			</form>
				<!--Show user that table was updated-->
			<?php show_report_found_records($dbc); ?>
		</div>
	</body>
</html>