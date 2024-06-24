
	<?php
	$dbConn = new mysqli('localhost', 'unn_w19015711', 'QURBNDDE', 'unn_w19015711'); // connecting to database - input my login details
	
	if ($dbConn->connect_error) {
		echo "<p>Connection failed: ".$dbConn->connect_error."</p>\n"; // if the connection is failed - display an error message
		exit; // terminates the connection
		
	}
	?>
