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
<?php
# Connect to MySQL server and the database
require( 'includes/connect_limbo_db.php' ) ;

# Includes these helper functions
require( 'includes/limbo_helpers.php' ) ;

# Check to make sure it is the first time user is visiting the page
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	$number = "";
	$fname= "";
	$lname= "";
}

# Check to make sure the form method is post
if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {
    $number = $_POST['number'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
	
	#Make sure user is inputting values into number, first name, and last name
    #Display error message if user does not input required values

	#Creating an error array to store the errors
	$error = array();
	
	#Checks to see if number input is valid	
	if (!valid_number($number)) 
		$error[] = 'number';
	#Checks to see if first name input is valid
	if(!valid_name($fname))
		$error[] = 'first name';
	#Checks to see if last name input is valid
	if(!valid_name($lname)) 
		$error[] = 'last name';
	
	#Report the errors or success
	if (!empty($error)){
		echo 'Error! Please enter the ' ;
		foreach ($error as $field){
			echo " - $field";
		}
	}
	else { 
		#Inserts inputs into table if all inputs are valid
		$fname = trim($fname);
		$lname = trim($lname);
		$result = insert_record($dbc, $number, $fname, $lname) ;
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

<!-- Get inputs from the user. -->
<form action="linkypresidents.php" method="POST">
<table>
<tr>
<!--Added Number input field -->
<td>Number:</td><td><input type="text" name="number" value="<?php if (isset($_POST['number'])) echo $_POST['number'];?>")></td>
</tr>
<tr>
<!--Added First Name input field -->
<td>First Name:</td><td><input type="text" name="fname" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>")></td>
</tr>
<tr>
<!--Added Last Name input field -->
<td>Last Name:</td><td><input type="text" name="lname" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>")></td>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>