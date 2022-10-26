<?php
// Start session
//	@session_start();
session_name("Storybook");
//@session_start();
require("/var/www/session2DB/Zebra.php");
// Database connection
include('/var/www/Storybook/htdocs/config/db.php');

// Error & success messages
$_SESSION['email_exist'] = ''; $_SESSION['f_NameErr'] = ''; $_SESSION['l_NameErr'] = ''; $_SESSION['_emailErr'] = ''; $_SESSION['_mobileErr'] = '';
$_SESSION['fNameEmptyErr'] = ''; $_SESSION['lNameEmptyErr'] = ''; $_SESSION['emailEmptyErr'] = ''; $_SESSION['mobileEmptyErr'] = '';
$_SESSION['email_verify_success'] = ''; $_SESSION['modify_success'] = '';
// Set empty form vars for validation mapping
$_first_name = $_last_name = $post_email = "";
$firstname = $lastname = $_email = "";

if(isset($_POST["submit"])) {
	$firstname     = $_POST["firstname"];
	$lastname      = $_POST["lastname"];
	$post_email    = $_POST["email"];
// Verify form values not empty
if(empty($firstname) || empty($lastname) || empty($post_email)){
	if(empty($firstname)){
		$_SESSION['fNameEmptyErr'] = '<div class="alert alert-danger">
			First name cannot be blank.
		</div>';
	}
	if(empty($lastname)){
		$_SESSION['lNameEmptyErr'] = '<div class="alert alert-danger">
			Last name cannot be blank.
		</div>';
	}
	if(empty($post_email)){
		$_SESSION['emailEmptyErr'] = '<div class="alert alert-danger">
			Email cannot be blank.
		</div>';
	}
	//echo 'a value is empty<br>';
}	
	$_SESSION['formdata'] = '<br>form data is present<br>';
}
	//clean the form data
	$_first_name = mysqli_real_escape_string($connection, $firstname);
	$_last_name = mysqli_real_escape_string($connection, $lastname);
	$_email = mysqli_real_escape_string($connection, $post_email);

	// perform validation
	if(!preg_match("/^[a-zA-Z][a-zA-Z\s]*$/", $_first_name)) {
		$_SESSION['f_NameErr'] = '<div class="alert alert-danger">
				Only letters and white space allowed.
			</div>';
	}
	if(!preg_match("/^[a-zA-Z][a-zA-Z\s]*$/", $_last_name)) {
		$_SESSION['l_NameErr'] = '<div class="alert alert-danger">
				Only letters and white space allowed.
			</div>';
	}
	$_emailErr = "";
	$_email = filter_var($_email, FILTER_SANITIZE_EMAIL);
	if(!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
		$_SESSION['_emailErr'] = '<div class="alert alert-danger">
				Email format is invalid.
			</div>';
	}
	
	// Store the data in db, if all the preg_match conditions met
	if(($_SESSION['f_NameErr'] == '') && ($_SESSION['l_NameErr'] == '') && ($_SESSION['_emailErr'] == '')){
	//flag clean data
	$_SESSION['formdata'] = $_SESSION['formdata'].'form data is clean<br>';

	// get user ip address
	include '/var/www/Storybook/htdocs/controllers/get_ip_address.php';
	$link = get_ip_address();
	// Generate random activation token
	$token = md5(rand().time());

 // original $email was saved by caller
$email = $_SESSION['email'];
// $_email is requested new email
// user changed email address?
if($email != $_email) {
	$_username = explode('@', $_email)[0];
	$email_check_query = mysqli_query($connection, "SELECT * FROM users WHERE email LIKE '$_username'% ");
	$rowCount = mysqli_num_rows($email_check_query);
	if($rowCount > 0) {
		$_SESSION['email_exist'] = '
			<div class="alert alert-danger" role="alert">
				User account with that user name or email address already exists! Duplicates are not permitted.
			</div>';
		header("Location: https://syntheticreality.net/Storybook/controllers/modify.php");
		exit;
	}
	// new address requested
	// $active = 0;
	$_SESSION['formdata'] = $_SESSION['formdata'].'email is different<br>';
	// Send verification email
		// Create the Verify Request Mail
		$from    = 'noreply@syntheticreality.net';
		$subject = 'Please Verify Your Email Address';
		$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
		//$message = '<p>Please use the activation link to verify your email: <a href="https://syntheticreality.net/Storybook/user_verification.php?token='.$token.'"> Click to verify email</a></p>';
		$nutoken = $token; // variable name in message text
		include '/var/www/Storybook/htdocs/controllers/verifyEmod.php';
		//send to new POST email address
		mail($_email, $subject, $message, $headers);
		$_SESSION['email_verify_success'] = '<div class="alert alert-success">
			 <h2>A Verification request email has been sent to the new address!<br><br>The emailed link will only be active for 2 minutes.<br>Please check your email to activate your new email address!</h2><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>
			</div>';
			
		// append new email to $token
		$token = $token . $_email;

} else {
	// $active = 1; //email is not changed, keep account active
	$_SESSION['formdata'] = $_SESSION['formdata'].'email is same<br>';
}

	// Query to update db with new values
	$sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$email', link = '$link', token = '$token', modified = now() WHERE email = '$email' ";
	// run mysql query
	$sqlQuery = mysqli_query($connection, $sql);
	if(!$sqlQuery){
		die("MySQL query failed!"); // . mysqli_error($connection));
	} 
	// flag 'updated DB';
	$_SESSION['formdata'] = $_SESSION['formdata']. 'sql DB updated.<br>';
	
	//$_SESSION['email'] = $_email;
	//$email = $_SESSION['email'];

	$_SESSION['modify_success'] = '<div class="alert alert-success">
		<h2>User Profile Data saved as shown!</h2>
	</div>';
}
	header("Location: https://syntheticreality.net/Storybook/controllers/modify.php");
?>