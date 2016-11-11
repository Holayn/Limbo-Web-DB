<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="ReportLost.css" type="text/css" rel="stylesheet">
<link href="home.css" type="text/css" rel="stylesheet">
<title>ReportLost</title>
</head>
<body>
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
	#TODO: SUBMIT PHOTO, ADD INFO
	#$addinfo = $_POST['addinfo'];
	
	#Make sure user is inputting values into number, first name, and last name
    #Display error message if user does not input required values
	#Creating an error array to store the errors
	$error = array();
	
	#Checks to see if name input is valid	
	if (!valid_name($owner_name)) 
		$error[] = 'owner_name';
	#Checks to see if item input is valid	
	if (!valid_name($item_name)) 
		$error[] = 'item_name';
	#Checks to see if description input is valid
	if(!valid_name($description))
		$error[] = 'description';
	if (!valid_name($phone)) 
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
//If the user clicks on a link, the GET method will be returned, so run this else-if block to show the user more information about the president
else if($_SERVER['REQUEST_METHOD'] == 'GET'){
	if(isset($_GET['id']))
		show_record($dbc, $_GET['id']);
}
#delete this later, being used as debugging
# Close the connection
mysqli_close( $dbc ) ;
?>
<img src="maristlogo.png" id="maristlogo">
<br><br>
<!--page layout-->
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
<h1> Report a Lost Item </h1>
<form action ="ReportLost.php" method = "POST">
	Your Name*: <input type="text" name="owner_name" value="<?php if (isset($_POST['owner_name'])) echo $_POST['owner_name'];?>")><br>
	Phone Number*: <input type="text" name="phone" value="<?php if (isset($_POST['phone'])) echo $_POST['phone'];?>")><br>
	Name of Item*: <input type="text" name="item_name" value="<?php if (isset($_POST['item_name'])) echo $_POST['item_name'];?>")><br>
	Description of Item: <input type="text" name = "description" value="<?php if (isset($_POST['description'])) echo $_POST['description'];?>")><br>
	<!--TODO: MAKE DROPDOWN STICKY-->
	Location Item Was Lost: <select name="location" value="<?php if (isset($_POST['location'])) echo $_POST['location'];?>")><?php 
			require( 'includes/connect_limbo_db.php' ) ;
			#populating dropdown with table values in db
			show_locations($dbc);?>
			</select><br><br>
	Approx. Date Lost: <input type="date" name="date" value="<?php if (isset($_POST['date'])) echo $_POST['date'];?>")><br>
	<!--TODO: SUBMIT PHOTO-->
	<!--Additional Information: <input type="text" name="addinfo" value="<?php if (isset($_POST['addinfo'])) echo $_POST['addinfo'];?>")>-->
<input type = "submit" >
<?php show_result_lost_records($dbc);?>
		</div>

</form>
</body>
</html>
