<!--
This file contains PHP login helper functions.
Orginally created by Ron Coleman.
History:
Who	Date		Comment
RC	 7-Nov-13	Created.
-->
<?php
	# Includes these helper functions
	require( 'includes/limbohelpers.php' ) ;

	# Loads a specified or default URL.
	function load( $page = 'admin.php', $pid = -1 )
	{
	  # Begin URL with protocol, domain, and current directory.
	  $url = 'http://' . $_SERVER[ 'HTTP_HOST' ] . dirname( $_SERVER[ 'PHP_SELF' ] ) ;

	  # Remove trailing slashes then append page name to URL and the print id.
	  $url = rtrim( $url, '/\\' ) ;
	  $url .= '/' . $page . '?id=' . $pid;

	  # Execute redirect then quit.
	  session_start( );

	  header( "Location: $url" ) ;

	  exit() ;
	}

	# Validates the admin name and password.
	# Returns -1 if validate fails, and >= 0 if it succeeds
	# which is the primary key id.
	function validate($first_name = '',$pass = '')
	{
		global $dbc;

		if(empty($first_name)&&empty($pass)){
		  return -1 ;
		}
		
	else {
		# Make the query
		$query = "SELECT first_name, pass FROM users WHERE first_name='" . $first_name . "' and pass='".$pass."'";
		# shows query now for debugging purpose
		# will remove for final project
		show_query($query) ;

		# Execute the query
		$results = mysqli_query( $dbc, $query ) ;
		check_results($results);

		# If we get no rows, the login failed
		if (mysqli_num_rows( $results ) == 0 )
		  return -1 ;

		# We have at least one row, so get the first one and return it
		$row = mysqli_fetch_array($results, MYSQLI_ASSOC) ;

		$pid = $row [ 'user_id' ] ;

		return intval($pid) ;
		}
	}
?>