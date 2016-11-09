<?php 
# CONNECT TO MySQL DATABASE.


# Connect  on 'localhost' for user 'mike' with password 'easysteps' to database 'site_db'.

# Otherwise fail gracefully and explain the error. 

$dbc = @mysqli_connect ( 'localhost', 'root', '', 'limbo_db' )


OR die ( mysqli_connect_error() ) ;


# Set encoding to match PHP script encoding.

mysqli_set_charset( $dbc, 'utf8' ) ;