<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="Found.css" type="text/css" rel="stylesheet">
	<link href="home.css" type="text/css" rel="stylesheet">
	<title>Found</title>
</head>
<body>
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
		<!--Found form-->
	<div style="position: relative; bottom: 600px; left: 200px;"> 
	<h1>Found Something?</h1>
	<form action ="Found.php" method = "POST">
		Your Name*: <input type="text" name="findername" value="<?php if (isset($_POST['findername'])) echo $_POST['findername'];?>")><br>
		Phone Number*: <input type="text" name="phone" value="<?php if (isset($_POST['phone'])) echo $_POST['phone'];?>")><br>
		Email*: <input type="text" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>")><br>
		Name of Item*: <input type="text" name="itemname" value="<?php if (isset($_POST['itemname'])) echo $_POST['itemname'];?>")><br>
		Description of Item: <input type="text" name = "description" value="<?php if (isset($_POST['description'])) echo $_POST['description'];?>")><br>
		<!--TODO: MAKE DROPDOWN LIST ALL DB LOCATION VALUES-->
		Location Item Was Found: <select name="location" value="<?php if (isset($_POST['location'])) echo $_POST['location'];?>")><option value="Hancock">Hancock</option></select><br>
		Approx. Date Found: <input type="date" name="date" value="<?php if (isset($_POST['date'])) echo $_POST['date'];?>")>
		<input type = "submit" >
	</form>
	</div>
	<div style="position: relative; bottom: 600px; left: 200px;">
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
			
			#Make sure user is inputting values into number, first name, and last name
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
		//If the user clicks on a link, the GET method will be returned, so run this else-if block to show the user more information about the president
		/* else if($_SERVER['REQUEST_METHOD'] == 'GET'){
			if(isset($_GET['id']))
				show_record($dbc, $_GET['id']);
		} */
		# Show the records
		show_found_records($dbc);
		# Close the connection
		mysqli_close( $dbc ) ;
		?>
	</div>
	
</body>
</html>