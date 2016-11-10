<!DOCTYPE HTML>
<html>
<?php
require('includes/connect_db.php');
$query = 'SELECT * FROM names';
$results = mysqli_query($dbc, $query);
if($results){
	echo '<H1>I LIKE POOP</H1>';
	echo '<TABLE border = 1;>';
	echo '<TR>';
	echo '<TH>Poopoo</TH>';
	echo '<TH>Doodoo</TH>';
	echo '</TR>';
	while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
		echo '<TR>';
		echo '<TD>'.$row['id'].'</TD>';
		echo '<TD>'.$row['name'].'</TD>';
		echo '</TR>';
	}
	echo '</TABLE>';
	echo '<form>';
	echo '</form>';
}
else{
	mysqli_error($results);
}
mysqli_free_result($results);
mysqli_close($dbc);

?>
</html>