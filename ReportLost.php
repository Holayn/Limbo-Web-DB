<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="home.css" type="text/css" rel="stylesheet">
		<title>Report Lost</title>
	</head>
	<body>
			<!--Used to insert lost item-->
		<?php
			# Connect to MySQL server and the database
			require( 'includes/connect_limbo_db.php' ) ;
			# Includes these helper functions
			require( 'includes/limbohelpers.php' ) ;
			# Check to make sure it is the first time user is visiting the page
			if ($_SERVER['REQUEST_METHOD'] == 'GET'){
				$owner_name = "";
				$item_name = "";
				$phone = "";
				$email = "";
				$name = "";
				$description = "";
			}
			# Check to make sure the form method is post
			if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
				$owner_name = $_POST['owner_name']; 
				$item_name = $_POST['item_name']; 
				$phone = $_POST['phone'];
				$description = $_POST['description'];
				$location = $_POST['location'];
				$date = $_POST['date'];
				#Creating an error array to store the errors
				$error = array();
				#Checks to see if name input is valid	
				if (!valid_name($owner_name)) 
					$error[] = 'owner_name';
				#Checks to see if item name input is valid	
				if (!valid_name($item_name)) 
					$error[] = 'item_name';
				#Checks to see if description input is valid
				if(!valid_name($description))
					$error[] = 'description';
				#Checks to see if phone input is valid
				if (!valid_number($phone)) 
					$error[] = 'phone';
				#Report the errors or success
				if (!empty($error)){
					echo 'Error! Please enter the ' ;
					foreach ($error as $field){
						echo " - $field";
					}
				}
				else { 
					#Inserts inputs into table if all inputs are valid
					$owner_name = trim($owner_name);
					$description = trim($description);
					$item_name = trim($item_name);
					$phone = trim($phone);
					$result = insert_record_loststuff($dbc, $owner_name, $phone, $item_name,$description, $location, $date) ;
					echo "Success! Thanks" ; 
				}
			}
			#If the user clicks on a link, the GET method will be returned, so run this else-if block to show the user more information about the president
			else if($_SERVER['REQUEST_METHOD'] == 'GET'){
				if(isset($_GET['id']))
					show_record($dbc, $_GET['id']);
			}
			# Close the connection
			mysqli_close( $dbc ) ;
		?>
			<!--page layout-->
		<img src="maristlogo.png" id="maristlogo">
		<div id="background"> </div>
		<br><br>
		<div style="position: absolute; left: 0; top: 105; width: 100%">
					<!--menu for navigation-->
			<nav>
              <a href="Home.html">Home</a>
              <a href="Lost.php">Lost</a>
              <a href="Found.php">Found</a>
              <a href="admin_login.php">Admin</a>
            </nav>
		<div class="box" style="opacity: 0.9">
		
			<!--Allow user to insert lost item-->
		<div style="position: relative; top: 0px; left:10px;">
			<h1> Report a Lost Item </h1>
			<form action ="ReportLost.php" method = "POST">
				<p class="para">Your Name*: <input type="text" name="owner_name" value="<?php if (isset($_POST['owner_name'])) echo $_POST['owner_name'];?>")><br>
				Phone Number*: <input type="text" name="phone" value="<?php if (isset($_POST['phone_name'])) echo $_POST['phone_name'];?>")><br>
				Name of Item*: <input type="text" name="item_name" value="<?php if (isset($_POST['item_name'])) echo $_POST['item_name'];?>")><br>
				Description of Item: <input type="text" name = "description" value="<?php if (isset($_POST['description'])) echo $_POST['description'];?>")><br>
				Location Item Was Lost: <select name="location" value="<?php if (isset($_POST['location'])) echo $_POST['location'];?>")>
					<?php 
						require( 'includes/connect_limbo_db.php' ) ;
						#populating dropdown with table values in db
						show_locations($dbc);
					?>
				</select><br><br>
				Approx. Date Lost: <input type="date" name="date" value="<?php if (isset($_POST['date'])) echo $_POST['date'];?>")><br>
				<input type = "submit">
				</p>
				<!--Show user table has been updated-->
			<?php show_report_lost_records($dbc);?>
			</form>
			</div> 
			</div>
		</div>
	</body>
</html>