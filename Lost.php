<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="Lost.css" type="text/css" rel="stylesheet">
<link href="Home.css" type="text/css" rel="stylesheet">
<title>Lost</title>
</head>
<body>
<?php
# Connect to MySQL server and the database
require( 'includes/connect_limbo_db.php' ) ;
# Includes these helper functions
require( 'includes/limbohelpers.php' ) ;
# Check to make sure it is the first time user is visiting the page
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	$item_name = "";
}
# Check to make sure the form method is post
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
	$itemname = $_POST['itemname'];
    $location = $_POST['location'];
	$date = $_POST['date'];
	
	#Make sure user is inputting values into number, first name, and last name
    #Display error message if user does not input required values
	#Creating an error array to store the errors
	$error = array();
	
	#Checks to see if name input is valid	
	if (!valid_name($itemname)) 
		$error[] = 'itemname';
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
		#we want this to display a table...
		/* $result = insert_record_foundstuff($dbc, $itemname, $location, $date); */
		//For now, only pass in the name
		$result = show_result_found_records($dbc, $itemname);
		echo "Here are found items that match your search:" ; 
	}
} 
//If the user clicks on a link, the GET method will be returned, so run this else-if block to show the user more information about the president
/* else if($_SERVER['REQUEST_METHOD'] == 'GET'){
	if(isset($_GET['id']))
		show_found_record($dbc, $_GET['id']);
} */
# Close the connection
mysqli_close( $dbc ) ;
?>

<img src="maristlogo.png" id="maristlogo">
<br><br>
<!--page layout-->
	<div style="position: absolute; left: 0; top: 150px; width: 100%">
			<!--menu for navigation-->
		<ul>
		  <li><a href="Home.html">Home</a></li>
		  <li><a href="Lost.php">Lost</a></li>
		  <li><a href="Found.php">Found</a></li>
		  <li><a href="admin_login.php">Admin</a></li>
		</ul>
		<!--<img src="white.jpg" style="max-width: 100%; max-height: 100%; opacity: 0.8; position: relative; top: -136px; left: 100px;"/>-->
		<img src="white.jpg" height="1300" width = "1300" style="opacity: 0.8; position: relative; top: -136px; left: 100px;"/>
		</div> 
		<div style="position: relative; top: 50px; left: 200px;">
		<h1> Lost something? </h1>
<form action ="Lost.php" method = "POST">
	Name of Item*: <input type="text" name="itemname" value="<?php if (isset($_POST['itemname'])) echo $_POST['itemname'];?>")><br>
	Location Item Lost: <select name="location" value="<?php if (isset($_POST['location'])) echo $_POST['location'];?>")>
		<?php require( 'includes/connect_limbo_db.php' ) ;
		#populating dropdown with table values in db
		show_locations($dbc);?>
		</select><br><br>
	Approx. Date Lost: <input type="date" name="date" value="<?php if (isset($_POST['date'])) echo $_POST['date'];?>")>
<input type = "submit">
</form>
<!--showing after inputs -->
<?php show_initial_found_records($dbc);?> <!-- edit this to show first few records...?-->
<?php if($_SERVER['REQUEST_METHOD'] == 'GET'){
	if(isset($_GET['id']))
		show_found_record($dbc, $_GET['id']);
}?>
</div>
</body>
</html>
