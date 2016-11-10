
<!--
This PHP script was modified based on result.php in McGrath (2012).
It demonstrates how to ...
  1) Connect to MySQL.
  2) Write a complex query.
  3) Format the results into an HTML table.
  4) Update MySQL with form input.
By Ron Coleman
-->
<!DOCTYPE html>
<html>
<?php
# Connect to MySQL server and the database
require( 'includes/connect_db.php' ) ;

# Includes these helper functions
require( 'includes/helpers.php' ) ;

if ($_SERVER[ 'REQUEST_METHOD' ] == 'POST') {

    $name = $_POST['name'] ;
	
	$id = $_POST['id'] ;

    if(!empty($id) && !empty($name)) {
      $result = insert_record($dbc, $id, $name) ;

      #echo "<p>Added " . $result . " new print(s) ". $name . " @ $" . $price . " .</p>" ;
    }
    else
      echo '<p style="color:red">Please input a name and a price!</p>' ;
}

# Show the records
show_records($dbc);

# Close the connection
mysqli_close( $dbc ) ;
?>

<!-- Get inputs from the user. -->
<form action="ipresidents.php" method="POST">
<table>
<tr>
<td>Name:</td><td><input type="text" name="id"></td>
</tr>
<tr>
<td>Price:</td><td><input type="text" name="name"></td>
</tr>
</table>
<p><input type="submit" ></p>
</form>
</html>