<?php
# Helpers.php 
# Authors: Kai Wong, Wendy Ni, Jae Kyoung Lee (LJ)
# Date: 11/02/2016
$debug = true;
function show_records($dbc) {
		# Connect to MySQL server and the database
		require( 'includes/connect_limbo_db.php' ) ;
		# Create a query to get the number, first name, and last name sorted by number in descending order
		$query = 'SELECT number, fname, lname FROM stuff ORDER BY number DESC' ;
		# Execute the query
		$results = mysqli_query( $dbc , $query ) ;
		# Show results
		if( $results )
		{
		  # But...wait until we know the query succeeded before
		  # starting the table.
		  echo '<H1>Stuff</H1>' ;
		  echo '<TABLE border=1 style = "font-family:courier;">';
		  echo '<TR>';
		  echo '<TH>Number</TH>';
		  echo '<TH>First Name</TH>';
		  echo '<TH>Last Name</TH>';
		  echo '</TR>';
		  # For each row result, generate a table row
		  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
		  {
			echo '<TR>' ;
			echo '<TD>' . $row['description'] . '</TD>' ;
			echo '<TD>' . $row['finder_name'] . '</TD>' ;
			echo '</TR>' ;
		  }
		  # End the table
		  echo '</TABLE>';
		  # Free up the results in memory
		  mysqli_free_result( $results ) ;
		}
		else
		{
		  # If we get here, something has gone wrong
		  echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
		}
		# Close the connection
		mysqli_close( $dbc ) ;
}
#$dbc, $findername, $phone, $email, $itemname, $description, $location, $date, $status
function show_found_records($dbc) {
		# Connect to MySQL server and the database
		require( 'includes/connect_limbo_db.php' ) ;
		# Create a query to get all fields in foundstuff 
		$query = 'SELECT id, finder_name, phone_number, email, item_name, description, location_name, found_date, status FROM foundstuff' ;
		# Execute the query
		$results = mysqli_query( $dbc , $query ) ;
		# Show results
		if( $results )
		{
		  # But...wait until we know the query succeeded before
		  # starting the table.
		  echo '<H1>Found Stuff</H1>' ;
		  echo '<TABLE border=1 style = "font-family:courier;">';
		  echo '<TR>';
		  echo '<TH>Id</TH>';
		  echo '<TH>Finder Name</TH>';
		  echo '<TH>Phone Number</TH>';
		  echo '<TH>Email</TH>';
		  echo '<TH>Name of Item</TH>';
		  echo '<TH>Description of item</TH>';
		  echo '<TH>Location</TH>';
		  echo '<TH>Date</TH>';
		  echo '<TH>Status</TH>';
		  echo '</TR>';
		  # For each row result, generate a table row
		  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
		  {
			/* //Creates an anchor link to display more information about the president
			$alink = '<a href = found.php?id=' . $row['id'] . '>' . $row['id'] . '</a>';
			echo '<TR>' ;
			echo '<TD align = right>' . $alink . '</TD>';
			echo '<TD>' . $row['description'] . '</TD>' ;
			echo '</TR>' ; */
			echo '<TR>' ;
			echo '<TD>' . $row['id'] . '</TD>' ;
			echo '<TD>' . $row['finder_name'] . '</TD>' ;
			echo '<TD>' . $row['phone_number'] . '</TD>' ;
			echo '<TD>' . $row['email'] . '</TD>' ;
			echo '<TD>' . $row['item_name'] . '</TD>' ;
			echo '<TD>' . $row['description'] . '</TD>' ;
			echo '<TD>' . $row['location_name'] . '</TD>' ;
			echo '<TD>' . $row['found_date'] . '</TD>' ;
			echo '<TD>' . $row['status'] . '</TD>' ;
			echo '</TR>' ;
		  }
		  # End the table
		  echo '</TABLE>';
		  # Free up the results in memory
		  mysqli_free_result( $results ) ;
		}
		else
		{
		  # If we get here, something has gone wrong
		  echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
		}
		# Close the connection
		mysqli_close( $dbc ) ;
}
function show_lost_records($dbc) {
		# Connect to MySQL server and the database
		require( 'includes/connect_limbo_db.php' ) ;
		# Create a query to get all fields from loststuff
		$query = 'SELECT id, item_name, description, location_name, lost_date, owner_name, phone_number, status FROM loststuff';
		# Execute the query
		$results = mysqli_query( $dbc , $query ) ;
		# Show results
		if( $results )
		{
		  # But...wait until we know the query succeeded before
		  # starting the table.
		  echo '<H1>Lost Stuff</H1>' ;
		  echo '<TABLE border=1 style = "font-family:courier;">';
		  echo '<TR>';
		  echo '<TH>Id</TH>';
		  echo '<TH>Name of Item</TH>';
		  echo '<TH>Description</TH>';
		  echo '<TH>Location</TH>';
		  echo '<TH>Date</TH>';
		  echo '<TH>Owner</TH>';
		  echo '<TH>Phone</TH>';
		  echo '<TH>Status</TH>';
		  echo '</TR>';
		  # For each row result, generate a table row
		  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
		  {
			/* //Creates an anchor link to display more information about the president
			$alink = '<a href = found.php?id=' . $row['id'] . '>' . $row['id'] . '</a>';
			echo '<TR>' ;
			echo '<TD align = right>' . $alink . '</TD>';
			echo '<TD>' . $row['description'] . '</TD>' ;
			echo '</TR>' ; */
			echo '<TR>' ;
			echo '<TD>' . $row['id'] . '</TD>' ;
			echo '<TD>' . $row['item_name'] . '</TD>' ;
			echo '<TD>' . $row['description'] . '</TD>' ;
			echo '<TD>' . $row['location_name'] . '</TD>' ;
			echo '<TD>' . $row['lost_date'] . '</TD>' ;
			echo '<TD>' . $row['owner_name'] . '</TD>' ;
			echo '<TD>' . $row['phone_number'] . '</TD>' ;
			echo '<TD>' . $row['status'] . '</TD>' ;
			echo '</TR>' ;
		  }
		  # End the table
		  echo '</TABLE>';
		  # Free up the results in memory
		  mysqli_free_result( $results ) ;
		}
		else
		{
		  # If we get here, something has gone wrong
		  echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
		}
		# Close the connection
		mysqli_close( $dbc ) ;
}
function show_record($dbc, $id) {
		# Connect to MySQL server and the database
		require( 'includes/connect_db.php' ) ;
		# Create a query to get the number, first name, and last name sorted by number in descending order
		$query = 'SELECT finder_name FROM stuff WHERE id = ' . $id;
		# Execute the query
		$results = mysqli_query( $dbc , $query ) ;
		# Show results
		if( $results )
		{
		  # But...wait until we know the query succeeded before
		  # starting the table.
/* 		  echo '<H1>Dead Presidents</H1>' ;
		  echo '<TABLE border=1 style = "font-family:courier;">';
		  echo '<TR>';
		  echo '<TH>Number</TH>';
		  echo '<TH>Last Name</TH>';
		  echo '<TH>First Name</TH>';
		  echo '</TR>'; */
		  # For each row result, generate a table row
		  while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) )
		  {
			echo '<TR>' ;
			echo '<TD>' . $row['description'] . '</TD>' ;
			echo '<TD>' . $row['findername'] . '</TD>' ;
			echo '<TD>' . $row['found_date'] . '</TD>' ;
			echo '</TR>' ;
		  }
		  # End the table
		  echo '</TABLE>';
		  # Free up the results in memory
		  mysqli_free_result( $results ) ;
		}
		else
		{
		  # If we get here, something has gone wrong
		  echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
		}
		# Close the connection
		mysqli_close( $dbc ) ;
}
# Inserts a record into the found table with number, first name, and last name
function insert_record_foundstuff($dbc, $findername, $phone, $email, $itemname, $description, $location, $date) {
  $query = 'INSERT INTO foundstuff(finder_name, phone_number, email, item_name, description, location_name, found_date) VALUES ("' . $findername . '" , "' . $phone . '" , "' . $email . '" , "' . $description . '" , "' . $itemname . '", "' . $location . '", "' . $date . '" )' ;
  show_query($query);
  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;
  return $results ;
}
function insert_record_loststuff($dbc, $ownername, $phone, $email, $itemname, $description, $location, $date) {
  $query = 'INSERT INTO loststuff(owner_name, phone_number, email, item_name, description, location_name, lost_date, status) VALUES ("' . $ownername . '" , "' . $phone . '" , "' . $email . '" , "' . $description . '" , "' . $itemname . '", "' . $location . '", "' . $date . '" , "Lost")' ;
  show_query($query);
  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;
  return $results ;
}
# Update status of item into the found table using id
function update_status_foundstuff($dbc, $id, $status) {
  $query = "UPDATE foundstuff SET status='" .$status."' WHERE id='".$id."'";
  show_query($query);
  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;
  return $results ;
}
function update_status_loststuff($dbc, $id, $status) {
  $query = "UPDATE loststuff SET status='" .$status."' WHERE id='".$id."'";
  show_query($query);
  $results = mysqli_query($dbc,$query) ;
  check_results($results) ;
  return $results ;
}
# Shows the query as a debugging aid
function show_query($query) {
  global $debug;
  if($debug)
    echo "<p>Query = $query</p>" ;
}
#This function populates the dropdown menu with locations
function show_locations($dbc){
	$query = "SELECT name FROM locations";
	show_query($query);
	#Execute query
	$results = mysqli_query($dbc, $query);
	if($results){
		while ( $row = mysqli_fetch_array( $results , MYSQLI_ASSOC ) ){
			echo '<option value = '.$row['name'].'>'.$row['name'].'</option>';
		}
		mysqli_free_result( $results ) ;
		
	}
	else{
		#Something went wrong
		echo '<p>' . mysqli_error( $dbc ) . '</p>'  ;
	}
	# Close the connection
	mysqli_close( $dbc ) ;
}
# Checks the query results as a debugging aid
function check_results($results) {
  global $dbc;
  if($results != true)
    echo '<p>SQL ERROR = ' . mysqli_error( $dbc ) . '</p>'  ;
}
#Created function that validates a number
function valid_number($num) {
	if (empty($num) || !is_numeric($num))
			return false;
	else {
		$num = intval($num);
		if($num <= 0)
			return false;
	}
	return true;
}
#Created function that validates name input
function valid_name($name) {
	if (empty($name))
		return false;
	else 
		return true;
}
?>