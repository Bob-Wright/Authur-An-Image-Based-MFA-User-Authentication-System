<?php
/*
 * create User Table
 *
*/
	// Database configuration
    $dbHost     = 'localhost'; //Database_Host
    $dbUsername = 'user'; //Database_Username
    $dbPassword = 'password'; //Database_Password
    $dbTable = 'users'; //Database_name

	/* -----------------
	 Connect to the server
	*/
	$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbTable);
	if(mysqli_connect_error()) {
	// if($conn->connect_error){ // limit information displayed on error
		die("Failed to connect with server. " . mysqli_connect_error());
	} else { echo "Connected to server<br>";}
	
	/* --------------------
	 Drop any existing prvkey table
	*/
	$sql = "DROP TABLE IF EXISTS prvkey";
	if ($conn->query($sql) === TRUE) {
		echo "table dropped successfully<br>";
	} else {
		echo "Error dropping table: " . $conn->error;
	}
	/* --------------------
	 Create the table
	*/
	$sql = "CREATE TABLE IF NOT EXISTS `prvkey` (
	  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	  `email` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `prvkey` varchar(4096) COLLATE utf8mb4_unicode_ci NOT NULL
	) COLLATE=utf8mb4_unicode_ci;
";
	if ($conn->query($sql) === TRUE) {
		echo "PRVKEY Table created successfully<br>";
	} else {
		echo "Error creating Table: " . $conn->error;
	}
	
	/* --------------------
	 Drop any existing pubkey table
	*/
	$sql = "DROP TABLE IF EXISTS pubkey";
	if ($conn->query($sql) === TRUE) {
		echo "table dropped successfully<br>";
	} else {
		echo "Error dropping table: " . $conn->error;
	}
	/* --------------------
	 Create the table
	*/
	$sql = "CREATE TABLE IF NOT EXISTS `pubkey` (
	  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	  `email` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
	  `pubkey` varchar(4096) COLLATE utf8mb4_unicode_ci NOT NULL
	) COLLATE=utf8mb4_unicode_ci;
";
	if ($conn->query($sql) === TRUE) {
		echo "PUBKEY Table created successfully<br>";
	} else {
		echo "Error creating Table: " . $conn->error;
	}

	$conn->close();
?>