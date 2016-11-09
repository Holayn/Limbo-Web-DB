<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="lost.css" type="text/css" rel="stylesheet">
<title>Lost</title>
</head>
<body>
<?php
# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;

# Includes these helper functions
require( 'includes/limbohelpers.php' ) ;

# Check to make sure it is the first time user is visiting the page
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	$name = "";
	$description = "";
}

# Check to make sure the form method is post
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
	$date = $_POST['date'];
	
	#Make sure user is inputting values into number, first name, and last name
    #Display error message if user does not input required values

	#Creating an error array to store the errors
	$error = array();
	
	#Checks to see if name input is valid	
	if (!valid_name($name)) 
		$error[] = 'name';
	#Checks to see if description input is valid
	if(!valid_name($description))
		$error[] = 'description';
	#Report the errors or success
	if (!empty($error)){
		echo 'Error! Please enter the ' ;
		foreach ($error as $field){
			echo " - $field";
		}
	}
	else { 
		#Inserts inputs into table if all inputs are valid
		$name = trim($name);
		$description = trim($description);
		$result = insert_record($dbc, $name, $description, $location, $date) ;
		echo "Success! Thanks" ; 
	}
}
//If the user clicks on a link, the GET method will be returned, so run this else-if block to show the user more information about the president
else if($_SERVER['REQUEST_METHOD'] == 'GET'){
	if(isset($_GET['id']))
		show_record($dbc, $_GET['id']);
}

# Show the records
show_link_records($dbc);

# Close the connection
mysqli_close( $dbc ) ;
?>

<img src="maristlogo.png" id="maristlogo">
<br><br>
<form action ="Lost.php" method = "POST">
	Name of Item: <input type="text" name="name" value="<?php if (isset($_POST['name'])) echo $_POST['name'];?>")><br>
	Description of Item: <input type="text" name = "description" value="<?php if (isset($_POST['description'])) echo $_POST['description'];?>")><br>
	<!--TODO: MAKE DROPDOWN STICKY-->
	Location Item Was Lost: <select name="location" value="<?php if (isset($_POST['location'])) echo $_POST['location'];?>")><option value="Hancock">Hancock</option></select><br>
	Approx. Date Lost: <input type="date" name="date" value="<?php if (isset($_POST['date'])) echo $_POST['date'];?>")>
<input type = "submit" >
</form>
</body>
</html>