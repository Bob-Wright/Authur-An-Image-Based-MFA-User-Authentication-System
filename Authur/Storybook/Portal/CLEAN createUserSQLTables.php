<?php
/*
 * create User Table
 *
*/
	// Database configuration
    $dbHost     = 'localhost'; //Database_Host
    $dbUsername = 'user'; //Database_Username
    $dbPassword = 'password'; //Database_Password
    $dbTable = 'users'; //Database_Username

	/* -----------------
	 Connect to the server
	*/
	$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbTable);
	if(mysqli_connect_error()) {
	// if($conn->connect_error){ // limit information displayed on error
		die("Failed to connect with server. " . mysqli_connect_error());
	} else { echo "Connected to server<br>";}
	/* --------------------
	 Drop any existing table
	*/
	$sql = "DROP TABLE IF EXISTS users";
	if ($conn->query($sql) === TRUE) {
		echo "table dropped successfully<br>";
	} else {
		echo "Error dropping table: " . $conn->error;
	}
	/* --------------------
	 Create the table
	*/
	$sql = "CREATE TABLE IF NOT EXISTS `users` (
	  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	  `firstname` varchar(63) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `lastname` varchar(63) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `email` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `factors` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `link` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `gatekeeper` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `is_active` enum('0','1') NOT NULL,
	  `created` datetime NOT NULL,
	  `modified` datetime NOT NULL,
	  `views` int(11) NOT NULL DEFAULT 0,
	  `posts` int(11) NOT NULL DEFAULT 0
	) COLLATE=utf8mb4_unicode_ci;
";
	if ($conn->query($sql) === TRUE) {
		echo "Table created successfully<br>";
	} else {
		echo "Error creating Table: " . $conn->error;
	}
	$conn->close();
?>