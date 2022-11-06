<?php
/*
 * create User DataBase.php
 * create a db
*/
	// Database configuration
    $dbHost     = 'localhost'; //Database_Host
    $dbUsername = 'user'; //Database_Username
    $dbPassword = 'password'; //Database_Password

	// Connect to the server
	$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword);
	if(mysqli_connect_error()) {
	// if($conn->connect_error){ // limit information displayed on error
		die("Failed to connect with server. " . mysqli_connect_error());
	} else { echo "Connected to server<br>";}
	/* --------------------
	 Drop any existing database
	*/
	$sql = "DROP DATABASE IF EXISTS users";
	if ($conn->query($sql) === TRUE) {
		echo "Database dropped successfully<br>";
	} else {
		echo "Error dropping database: " . $conn->error;
	}
	/* --------------------
	 Create the database
	*/
	$sql = "CREATE DATABASE IF NOT EXISTS users";
	if ($conn->query($sql) === TRUE) {
		echo "Database created successfully<br>";
	} else {
		echo "Error creating database: " . $conn->error;
	}
	$conn->close();
?>