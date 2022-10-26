<?php
// Start session
session_name("Storybook");
include("/var/www/session2DB/Zebra.php");
// Database connection
include('/var/www/Storybook/htdocs/config/db.php');

if(isset($_POST["submit"])) {
	$firstname     = $_POST["firstname"];
	$lastname      = $_POST["lastname"];
	$post_email	   = $_POST["email"];
	$password  = $_POST["password"];
	$YEO  = $_POST["YEO"];
	$MEO  = $_POST["MEO"];
	$DEO  = $_POST["DEO"];
	$FA  = $_POST["FA"];
	$SB  = $_POST["SB"];
	$NO  = $_POST["NO"];
	$NC  = $_POST["NC"];
	$_SESSION["factors"] = $YEO.','.$MEO.','.$DEO.','.$FA.','.$SB.','.$NO.','.$NC;
	$factors= $_SESSION["factors"];
// Verify form values not empty
if(empty($firstname) || empty($lastname) || empty($post_email) || empty($factors) || empty($password)){
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
	if(empty($factors)){
		$_SESSION['factorsEmptyErr'] = '<div class="alert alert-danger">
			factors  cannot be blank.
		</div>';
	}
	if(empty($password)){
		$_SESSION['passwordEmptyErr'] = '<div class="alert alert-danger">
			Password cannot be blank.
		</div>';
	}
	//echo 'a value is empty<br>';
}	
$_SESSION['formdata'] = '<br>form data is present<br>';
}
	// clean the form data
	$_first_name = mysqli_real_escape_string($connection, $firstname);
	$_last_name = mysqli_real_escape_string($connection, $lastname);
	$_email = mysqli_real_escape_string($connection, $post_email);
	$_factors = mysqli_real_escape_string($connection, $factors);
	$_password = mysqli_real_escape_string($connection, $password);

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
	} else {
		$gatekeeper = (explode('@', $_email))[0]; // extract the user name as the gatekeeper image name
		$username = $gatekeeper;
	}
	if(!preg_match("/^[a-zA-Z][a-zA-Z,\s]*$/", $_factors)) {
		$_SESSION['_factorsError'] = '<div class="alert alert-danger">
				Only letters, commas and white space allowed.
			</div>';
	}
	if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#!%&])[A-Za-z0-9@#!%&]{6,20}$/", $_password)) {
		$_SESSION['_passwordErr'] = '<div class="alert alert-danger">
				 Password must be between 6 to 20 characters long, both lowercase and uppercase letters, must begin with a letter or a digit, and must contain at least one special character (@#!%&) and a digit.
			</div>';
			$pwdtest = false;
	} else {
		$pwdtest = true;
	}
	
	// if all the preg_match condition met
if(($_SESSION['f_NameErr'] == '') && ($_SESSION['l_NameErr'] == '') && ($_SESSION['_emailErr'] == '') && ($_SESSION['_factorsErr'] == '') && ($pwdtest == true)){
$_SESSION['formdata'] = $_SESSION['formdata'].'form data is clean<br>';

// check if email exists
$email_check_query = mysqli_query($connection, "SELECT * FROM users WHERE email = '$_email' ");
$rowCount = mysqli_num_rows($email_check_query);
	if($rowCount > 0) {	// check if user email already exists
		$_SESSION['email_exist'] = '
			<div class="alert alert-danger" role="alert">
				User with that email already exists! Duplicate user email addresses are not permitted.
			</div>';
		header("Location: https://syntheticreality.net/Storybook/signup.php");
		return;
	}
	$_SESSION['formdata'] = $_SESSION['formdata'].'email is new<br>';

// check if username part of email exists
$username = (explode('@', $_email))[0];
$email_check_query = mysqli_query($connection, "SELECT * FROM users WHERE email LIKE '".$username."%'");
$rowCount = mysqli_num_rows($email_check_query);
	if($rowCount > 0) {	// check if user email already exists
		$_SESSION['email_exist'] = '
			<div class="alert alert-danger" role="alert">
				User with that name already exists! Duplicate user names are not permitted.
			</div>';
		header("Location: https://syntheticreality.net/Storybook/signup.php");
		return;
	}
	$_SESSION['formdata'] = $_SESSION['formdata'].'user is new<br>';

		// get user ip address
		include '/var/www/Storybook/htdocs/controllers/get_ip_address.php';
		$link = get_ip_address();
		// Generate random activation token
		$token = md5(rand().time());
		// Password hash
		$password_hash = password_hash($_password, PASSWORD_BCRYPT);

	$_SESSION["firstname"] = $firstname;
	$_SESSION["lastname"] = $lastname;
	$_SESSION["email"] = $email;
	$_SESSION["gatekeeper"] = $gatekeeper;
	$_SESSION["password"] = $password_hash;
	$_SESSION["link"] = $link;
	$_SESSION["factors"] = $YEO.','.$MEO.','.$DEO.','.$FA.','.$SB.','.$NO.','.$NC;

		// Query
		$sql = "INSERT INTO users (firstname, lastname, email, factors, link, password, token, gatekeeper, is_active, created, modified) VALUES ('$firstname', '$lastname', '$_email', '$factors', '$link', '$password_hash', '$token', '$gatekeeper', '0', now(), now())";
		
		// Create mysql query
		$sqlQuery = mysqli_query($connection, $sql);
		if(!$sqlQuery){
			die("MySQL query failed! " . mysqli_error($connection));
		}
		//$_SESSION['formdata'] = $_SESSION['formdata']. $sql.'<br>';		
		$_SESSION['formdata'] = $_SESSION['formdata'].'updated DB<br>';
		$_SESSION['email'] = $_email;
		$email = $_SESSION['email'];

		// Send verification email
		if($sqlQuery) {
			// Create the Verify Request Mail
			$from    = 'noreply@syntheticreality.net';
			$subject = 'Please Verify Your Email Address';
			$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
			// Update the activation variable below
			//$message = '<p>Hello ' . $firstname . ' ' . $lastname. '<br>Please use the activation link to verify your email: <a href="https://syntheticreality.net/Storybook/user_verification.php?token='.$token.'"> Click to verify email</a></p>';
			$nutoken = $token; // variable name in message text
			include '/var/www/Storybook/htdocs/controllers/verifyEmail.php';

			mail($email, $subject, $message, $headers);
		$_SESSION['formdata'] = $_SESSION['formdata'].'sent verify email<br>';
			$_SESSION['email_verify_success'] = '<div class="alert alert-success">
			<h2>User Profile created!</h2></div><div class="alert alert-primary">
					 <h2>A Verification request email has been sent!<br><br>The emailed link will only be active for 2 minutes.<br>Please check your email to activate your account!</h2><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>
				</div>';
		}
}

	header("Location: https://syntheticreality.net/Storybook/signup.php");

?>