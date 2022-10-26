<?php
/*
* This is login.php
* it is the forms handler for the portal.php code
* many of the functions duplicate code, but ordinarily
* we would likely only have one choice of login method
* and this listing allows for easy extraction of a method
*/
// Start session
session_name("Storybook");
//	@session_start();
require("/var/www/session2DB/Zebra.php");

if (!($_SERVER["REQUEST_METHOD"] == "POST")) {
	header("Location: https://syntheticreality.net/Storybook/Portal.php");
return;
}
if (($_SERVER["REQUEST_METHOD"] == "POST") && empty($_POST['email_signin'])) { //the forms handler should keep us from this
	$_SESSION['email_empty_err'] = '<div class="alert alert-danger email_alert">
		An Email address or Username is required for all Logins!<br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>
	</div>';
	header("Location: https://syntheticreality.net/Storybook/Portal.php");
	return;
}
// global $wrongPwdErr, $accountNotExistErr, $emailPwdErr, $verificationRequiredErr, $email_empty_err, $pass_empty_err;
$_SESSION['wrongPwdErr'] = '';
$_SESSION['accountNotExistErr'] = '';
$_SESSION['emailPwdErr'] = '';
$_SESSION['verificationRequiredErr'] = '';
$_SESSION['email_empty_err'] = '';
$_SESSION['pass_empty_err'] = '';

// put the POST variables in the SESSION
if(!(empty($_POST['email_signin']))) { $_SESSION['email_signin'] = $_POST['email_signin'];}
if(!(empty($_POST['password_signin']))) { $_SESSION['password_signin'] = $_POST['password_signin'];}
if(!(empty($_POST['login']))) { $_SESSION['login'] = $_POST['login'];}
if(!(empty($_POST['magiclink']))) { $_SESSION['magiclink'] = $_POST['magiclink'];}
if(!(empty($_POST['otp']))) { $_SESSION['otp'] = $_POST['otp'];}
if(!(empty($_POST['mfa']))) { $_SESSION['mfa'] = $_POST['mfa'];}
if(!(empty($_POST['chpwd']))) { $_SESSION['chpwd'] = $_POST['chpwd'];}

//------------------//
// see if we have an ordinary email or mfa login attempt without a password
if (($_SERVER["REQUEST_METHOD"] == "POST") && (!(empty($_POST))) && (!(empty($_POST['email_signin']))) && (empty($_POST['password_signin'])) && (!(empty($_POST['login'])) || !(empty($_POST['mfa'])))) {
	include('/var/www/Storybook/htdocs/config/db.php');
	$_SESSION['emailPwdErr'] = '<div class="alert alert-danger">
			This Login choice requires entry of both an Email and a Password.<br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a></div>';
	header("Location: https://syntheticreality.net/Storybook/Portal.php");
	return;
}
//-------------------------------//	
// see if we have an ordinary email plus password login
if (($_SERVER["REQUEST_METHOD"] == "POST") && (!(empty($_POST['email_signin']))) && (!(empty($_POST['password_signin']))) && (!(empty($_POST['login'])))) {
	// Database connection
	include('/var/www/Storybook/htdocs/config/db.php');
	$email_signin = $_POST['email_signin'];

	// check if domain part of email entry exists
	if (strpos($email_signin, '@')) {
	$_SESSION['isemail'] = 'yes';
		$semail = filter_var($email_signin, FILTER_SANITIZE_EMAIL);
		$user_email = filter_var($semail, FILTER_VALIDATE_EMAIL);
		$username = explode('@', $user_email)[0]; // extract the user name
	} else { // no @ in entry, check user name entry
		if(!preg_match("/(?:[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")/", $email_signin)) {
			$_SESSION['UserNameErr'] = '<div class="alert alert-danger">
					Only RFC 5322 compliant user names are allowed.
				</div><br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>';
			$username = '';
			header("Location: https://syntheticreality.net/Storybook/Portal.php");
			return;
		} else {
		$_SESSION['isemail'] = 'no';
		$username = $email_signin;
		}
	}
	$password_signin = $_POST['password_signin'];
	//echo '<br>'.$email_signin.' - '.$password_signin.'<br>';
	$pswd = mysqli_real_escape_string($connection, $password_signin);
	// Query if email exists in db
	//$sql = "SELECT * From users WHERE email = '{$user_email}' ";
	$sql = "SELECT * FROM users WHERE email LIKE '".$username."%'";
	$query = mysqli_query($connection, $sql);
	$rowCount = mysqli_num_rows($query);
	// If query fails, show the reason 
	if(!$query){
	   //'die("SQL query failed: " . mysqli_error($connection));
	   die("SQL query failed");
	}
	//echo '<br>'.$user_email.' - '.$pswd.'<br>';
		// Check if email exists
		if($rowCount <= 0) {
			$_SESSION['accountNotExistErr'] = '<div class="alert alert-danger">
					User account does not exist.<br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>
				</div>';
			header("Location: https://syntheticreality.net/Storybook/Portal.php");
			return;
			//echo $accountNotExistErr;
		} else {
			// Fetch user data and store in php session
			//echo '<br>Fetching user from DB<br>';
			while($row = mysqli_fetch_array($query)) {
				$id            = $row['id'];
				$firstname     = $row['firstname'];
				$lastname      = $row['lastname'];
				$email         = $row['email'];
				$factors		= $row['factors'];
				$gatekeeper		= $row['gatekeeper'];
				$link          = $row['link'];
				$pass_word     = $row['password'];
				$token         = $row['token'];
				$is_active     = $row['is_active'];
			}
			//echo '<br>'.$email.' - '.$pass_word.'<br>';
			// Verify password
			$ptest = password_verify($pswd, $pass_word);
			//if($ptest == true) { echo '<br>Valid Password hash<br>'; } else { echo '<br>Invalid Password hash<br>';};
			// Allow only verified user
			if($is_active == 1) {
				if($ptest == true) {
				   $_SESSION['id'] = $id;
				   $_SESSION['firstname'] = $firstname;
				   $_SESSION['lastname'] = $lastname;
				   $_SESSION['email'] = $email;
				   $_SESSION['factors'] = $factors;
				   $_SESSION['gatekeeper'] = $gatekeeper;
				   $_SESSION['link'] = $link;
				   $_SESSION['token'] = $token;
				   header("Location: https://syntheticreality.net/Storybook/controllers/dashboard.php");
				   exit;
				} else {
					//echo $emailPwdErr;
					$_SESSION['emailPwdErr'] = '<div class="alert alert-danger">
							User validation failed.<br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>
						</div>';
					header("Location: https://syntheticreality.net/Storybook/Portal.php");
					return;
				}
			} else {
			//echo $verificationRequiredErr;
			// resend verification email
		// mark the time and issue a new token
		// Generate random activation token
		$nutoken = md5(rand().time());
        $update = mysqli_query($connection, "UPDATE users SET token = '$nutoken', modified = now() WHERE email = '$email' ");
				if(!$update){
					die("SQL update failed: " . mysqli_error($connection));
				}
				// Create the Verify Request Mail
				$from    = 'noreply@syntheticreality.net';
				$subject = 'Please Verify Your Email Address';
				$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
				// Update the activation variable below
				//$message = '<p>Hello ' . $firstname . ' ' . $lastname. '<br>This account is not verified.<br>Please use the activation link to verify your email: <a href="https://syntheticreality.net/Storybook/user_verification.php?token='.$nutoken.'"> Click to verify email</a><br>This link will only be active for 2 minutes.</p>';
				include '/var/www/Storybook/htdocs/controllers/verifyEmail.php';
				mail($email, $subject, $message, $headers);
				$_SESSION['email_paswd_success'] = '<div class="alert alert-success">
					 <h2>Account verification is required before you can login.</h2><h3>Please check your email for a link to verify your account.<br>This link will only be active for 2 minutes.</h3><br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>
				</div>';
			//echo $_SESSION['email_paswd_success'];
			header("Location: https://syntheticreality.net/Storybook/Portal.php");
			return;
		}}
}
//-------------------------//
// see if we have an email plus password MFA login request
if (($_SERVER["REQUEST_METHOD"] == "POST") && (!(empty($_POST['email_signin']))) && (!(empty($_POST['password_signin']))) && (!(empty($_POST['mfa'])))) {
$_SESSION['breakpoint'] = 'here';
	// Database connection
	include('/var/www/Storybook/htdocs/config/db.php');
	$email_signin = $_POST['email_signin'];

	// check if domain part of email entry exists
	if (strpos($email_signin, '@')) {
	$_SESSION['isemail'] = 'yes';
		$semail = filter_var($email_signin, FILTER_SANITIZE_EMAIL);
		$user_email = filter_var($semail, FILTER_VALIDATE_EMAIL);
		$username = explode('@', $user_email)[0]; // extract the user name
	} else { // no @ in entry, check user name entry
		if(!preg_match("/(?:[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")/", $email_signin)) {
			$_SESSION['UserNameErr'] = '<div class="alert alert-danger">
					Only RFC 5322 compliant user names are allowed.
				</div><br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>';
			$username = '';
			header("Location: https://syntheticreality.net/Storybook/Portal.php");
			return;
		} else {
		$_SESSION['isemail'] = 'no';
		$username = $email_signin;
		}
	}
	$password_signin = $_POST['password_signin'];
	//echo '<br>'.$email_signin.' - '.$password_signin.'<br>';
	$pswd = mysqli_real_escape_string($connection, $password_signin);
	// Query if email exists in db
	//$sql = "SELECT * From users WHERE email = '{$user_email}' ";
	$sql = "SELECT * FROM users WHERE email LIKE '".$username."%'";
	$query = mysqli_query($connection, $sql);
	$rowCount = mysqli_num_rows($query);
	// If query fails, show the reason 
	if(!$query){
	   //'die("SQL query failed: " . mysqli_error($connection));
	   die("SQL query failed");
	}
	//echo '<br>'.$user_email.' - '.$pswd.'<br>';
		// Check if email exists
		if($rowCount <= 0) {
			$_SESSION['accountNotExistErr'] = '<div class="alert alert-danger">
					User account does not exist.<br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>
				</div>';
			header("Location: https://syntheticreality.net/Storybook/Portal.php");
			return;
			//echo $accountNotExistErr;
		} else {
			// Fetch user data and store in php session
			//echo '<br>Fetching user from DB<br>';
			while($row = mysqli_fetch_array($query)) {
				$id            = $row['id'];
				$firstname     = $row['firstname'];
				$lastname      = $row['lastname'];
				$email         = $row['email'];
				$factors		= $row['factors'];
				$gatekeeper		= $row['gatekeeper'];
				$link          = $row['link'];
				$pass_word     = $row['password'];
				$token         = $row['token'];
				$is_active     = $row['is_active'];
			}
			//echo '<br>'.$email.' - '.$pass_word.'<br>';
			// Verify password
			$ptest = password_verify($pswd, $pass_word);
			//if($ptest == true) { echo '<br>Valid Password hash<br>'; } else { echo '<br>Invalid Password hash<br>';};
			// Allow only verified user
			if($is_active == 1) {
				if($ptest == true) {
				   $_SESSION['id'] = $id;
				   $_SESSION['firstname'] = $firstname;
				   $_SESSION['lastname'] = $lastname;
				   $_SESSION['email'] = $email;
				   $_SESSION['factors'] = $factors;
				   $_SESSION['gatekeeper'] = $gatekeeper;
				   $_SESSION['link'] = $link;
				   $_SESSION['token'] = $token;

				   header("Location: https://syntheticreality.net/Storybook/Portal/TheUsualSuspects.php");
				   exit;
				} else {
					//echo $emailPwdErr;
					$_SESSION['emailPwdErr'] = '<div class="alert alert-danger">
							User validation failed.<br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>
						</div>';
					header("Location: https://syntheticreality.net/Storybook/Portal.php");
					return;
				}
			} else {
			//echo $verificationRequiredErr;
			// resend verification email
		// mark the time and issue a new token
		// Generate random activation token
		$nutoken = md5(rand().time());
        $update = mysqli_query($connection, "UPDATE users SET token = '$nutoken', modified = now() WHERE email = '$email' ");
				if(!$update){
					die("SQL update failed: " . mysqli_error($connection));
				}
				// Create the Verify Request Mail
				$from    = 'noreply@syntheticreality.net';
				$subject = 'Please Verify Your Email Address';
				$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
				// Update the activation variable below
				//$message = '<p>Hello ' . $firstname . ' ' . $lastname. '<br>This account is not verified.<br>Please use the activation link to verify your email: <a href="https://syntheticreality.net/Storybook/user_verification.php?token='.$nutoken.'"> Click to verify email</a><br>This link will only be active for 2 minutes.</p>';
				include '/var/www/Storybook/htdocs/controllers/verifyEmail.php';
				mail($email, $subject, $message, $headers);
				$_SESSION['email_paswd_success'] = '<div class="alert alert-success">
					 <h2>Account verification is required before you can login.</h2><h3>Please check your email for a link to verify your account.<br>This link will only be active for 2 minutes.</h3><br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>
				</div>';
			//echo $_SESSION['email_paswd_success'];
			header("Location: https://syntheticreality.net/Storybook/Portal.php");
			return;
		}}
}
//-------------------------------//	
// see if we have a request for a one time password logon
if (($_SERVER["REQUEST_METHOD"] == "POST") && (!(empty($_POST))) && (!(empty($_POST['email_signin']))) && (!(empty($_POST['otp'])))) {
	if(!(empty($_POST['password_signin']))) { //there is a password entry to test
	// Database connection
	include('/var/www/Storybook/htdocs/config/db.php');
	$email_signin = $_POST['email_signin'];

	// check if domain part of email entry exists
	if (strpos($email_signin, '@')) {
	$_SESSION['isemail'] = 'yes';
		$semail = filter_var($email_signin, FILTER_SANITIZE_EMAIL);
		$user_email = filter_var($semail, FILTER_VALIDATE_EMAIL);
		$username = explode('@', $user_email)[0]; // extract the user name
	} else { // no @ in entry, check user name entry
		if(!preg_match("/(?:[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")/", $email_signin)) {
			$_SESSION['UserNameErr'] = '<div class="alert alert-danger">
					Only RFC 5322 compliant user names are allowed.
				</div><br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a></div>';
			$username = '';
			header("Location: https://syntheticreality.net/Storybook/Portal.php");
			return;
		} else {
		$_SESSION['isemail'] = 'no';
		$username = $email_signin;
		}
	}
	$password_signin     = $_POST['password_signin'];
	//echo '<br>'.$email_signin.' - '.$password_signin.'<br>';
	// Query if email exists in db
	//$sql = "SELECT * From users WHERE email = '{$user_email}' ";
	$sql = "SELECT * FROM users WHERE email LIKE '".$username."%'";
	$query = mysqli_query($connection, $sql);
	$rowCount = mysqli_num_rows($query);
	// If query fails, show the reason 
	if(!$query){
	   //die("SQL query failed: " . mysqli_error($connection));
	   die("SQL query failed");
	}
	//echo '<br>'.$user_email.' - '.$pswd.'<br>';
		// Check if email exists
		if($rowCount <= 0) {
			$_SESSION['accountNotExistErr'] = '<div class="alert alert-danger">
					User account does not exist.<br><a class="btn btn-outline-primary btn-block text-center mb-4"  href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>
				</div>';
			header("Location: https://syntheticreality.net/Storybook/Portal.php");
			return;
			//echo $accountNotExistErr;
		} else {
			// Fetch user data and store in php session
			//echo '<br>Fetching user from DB<br>';
			while($row = mysqli_fetch_array($query)) {
				$id            = $row['id'];
				$firstname     = $row['firstname'];
				$lastname      = $row['lastname'];
				$email         = $row['email'];
				$factors   		= $row['factors'];
				$gatekeeper		= $row['gatekeeper'];
				$link          = $row['link'];
				$pass_word     = $row['password'];
				$token         = $row['token'];
				$is_active     = $row['is_active'];
			}
			//echo '<br>'.$email.' - '.$pass_word.'<br>';
			// Verify password is the token
			//$ptest = password_verify($pswd, $pass_word);
			//if($ptest == true) { echo '<br>Valid Password hash<br>'; } else { echo '<br>Invalid Password hash<br>';};
			if($password_signin == $token) {$ptest = true;} else {$ptest = false;}
			// Allow only verified user
			if($is_active == '1') {
				if($ptest == true) {
				   $_SESSION['id'] = $id;
				   $_SESSION['firstname'] = $firstname;
				   $_SESSION['lastname'] = $lastname;
				   $_SESSION['email'] = $email;
				   $_SESSION['factors'] = $factors;
				   $_SESSION['gatekeeper'] = $gatekeeper;
				   $_SESSION['link'] = $link;
				   $_SESSION['token'] = $token;
				   header("Location: https://syntheticreality.net/Storybook/controllers/dashboard.php");
				   return;
				} else {
					//echo $emailPwdErr;
					$_SESSION['emailPwdErr'] = '<div class="alert alert-danger">
							User validation failed.<br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>
						</div>';
					header("Location: https://syntheticreality.net/Storybook/Portal.php");
					return;
				}
			} else {
			//echo $verificationRequiredErr;
			// resend verification email
		// mark the time and issue a new token
		// Generate random activation token
		$nutoken = md5(rand().time());
        $update = mysqli_query($connection, "UPDATE users SET token = '$nutoken', modified = now() WHERE email = '$email' ");
				if(!$update){
					die("SQL update failed: " . mysqli_error($connection));
				}
				// Create the Verify Request Mail
				$from    = 'noreply@syntheticreality.net';
				$subject = 'Please Verify Your Email Address';
				$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
				// Update the activation variable below
				//$message = '<p>Hello ' . $firstname . ' ' . $lastname. '<br>This account is not verified.<br>Please use the activation link to verify your email: <a href="https://syntheticreality.net/Storybook/user_verification.php?token='.$nutoken.'"> Click to verify email</a><br>This link will only be active for 5 minutes.</p>';
				include '/var/www/Storybook/htdocs/controllers/verifyEmail.php';

				mail($email, $subject, $message, $headers);
				$_SESSION['email_paswd_success'] = '<div class="alert alert-success">
					 <h2>Account verification is required before you can login.</h2><h3>Please check your email for a link to verify your account.<br>This link will only be active for 2 minutes.</h3><br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>
				</div>';
			//echo $_SESSION['email_paswd_success'];
			header("Location: https://syntheticreality.net/Storybook/Portal.php");
			return;
		}}
} else { //there is no password entry to test
	//if(empty($_POST['password_signin'])) {
	$emailtopic = 'OTP password';
	requestHandler($emailtopic);
			header("Location: https://syntheticreality.net/Storybook/Portal.php");
			return;
}
}

//---------------------//
// see if we have a request for a magiclink logon token
if (($_SERVER["REQUEST_METHOD"] == "POST") && (!(empty($_POST))) && (!(empty($_POST['email_signin']))) && (!(empty($_POST['magiclink'])))) {
	$emailtopic = 'Magic Link';
	requestHandler($emailtopic);
			header("Location: https://syntheticreality.net/Storybook/Portal.php");
			return;
}

//------------------------//
// see if we have a request to change the password
if (($_SERVER["REQUEST_METHOD"] == "POST") && (!(empty($_POST))) && (!(empty($_POST['email_signin']))) && (!(empty($_POST['chpwd'])))) {
	$emailtopic = 'Change Password';
	requestHandler($emailtopic);
			header("Location: https://syntheticreality.net/Storybook/Portal.php");
			return;
}

//---------------------//
// our requestHandler function for OTP, Magic Link, and Change Password tasks
function requestHandler($emailtopic) {
	// Database connection
	include('/var/www/Storybook/htdocs/config/db.php');
	$email_signin = $_POST['email_signin'];

	// check if domain part of email entry exists
	if (strpos($email_signin, '@')) {
	$_SESSION['isemail'] = 'yes';
		$semail = filter_var($email_signin, FILTER_SANITIZE_EMAIL);
		$user_email = filter_var($semail, FILTER_VALIDATE_EMAIL);
		$username = explode('@', $user_email)[0]; // extract the user name
	} else { // no @ in entry, check user name entry
		if(!preg_match("/(?:[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")/", $email_signin)) {
			$_SESSION['UserNameErr'] = '<div class="alert alert-danger">
					Only RFC 5322 compliant user names are allowed.
				</div><br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>
				</div>';
			$username = '';
			header("Location: https://syntheticreality.net/Storybook/Portal.php");
			return;
		} else {
		$_SESSION['isemail'] = 'no';
		$username = $email_signin;
		}
	}

	// Query if email exists in db
	//$sql = "SELECT * From users WHERE email = '{$user_email}' ";
	$sql = "SELECT * FROM users WHERE email LIKE '".$username."%'";
	$query = mysqli_query($connection, $sql);
	$rowCount = mysqli_num_rows($query);
	// If query fails, show the reason, but security suggests not
	if(!$query){
	   // die("SQL query failed: " . mysqli_error($connection));
	   die("SQL query failed");
	}
	//echo '<br>'.$user_email.' - '.$pswd.'<br>';
	// Check if email exists
	if($rowCount <= 0) {
		$_SESSION['accountNotExistErr'] = '<div class="alert alert-danger">
				User account does not exist.<br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>
			</div>';
		header("Location: https://syntheticreality.net/Storybook/Portal.php");
		return;
		//echo $accountNotExistErr;
	} else {
		// Fetch user data and store in php session
		//echo '<br>Fetching user from DB<br>';
		while($row = mysqli_fetch_array($query)) {
			$id            = $row['id'];
			$firstname     = $row['firstname'];
			$lastname      = $row['lastname'];
			$email         = $row['email'];
			$factors	   = $row['factors'];
			$gatekeeper		= $row['gatekeeper'];
			$link          = $row['link'];
			$pass_word     = $row['password'];
			$token         = $row['token'];
			$is_active     = $row['is_active'];
		}
	if($is_active == 0) {
		// resend account verification email request
		// mark the time and issue a new token
		// Generate random activation token
		$nutoken = md5(rand().time());
        $update = mysqli_query($connection, "UPDATE users SET token = '$nutoken', modified = now() WHERE email = '$email' ");
			if(!$update){
				//die("SQL update failed: " . mysqli_error($connection));
				die("SQL update failed");
			}
			// Create the Verify Request Mail
			$from    = 'noreply@syntheticreality.net';
			$subject = 'Please Verify Your Email Address';
			$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
			// Update the activation variable below
			//$message = '<p>Hello ' . $firstname . ' ' . $lastname. '<br>This account is not verified.<br>Please use the activation link to verify your email: <a href="https://syntheticreality.net/Storybook/user_verification.php?token='.$nutoken.'"> Click to verify email</a><br>This link will only be active for 5 minutes.</p>';
			include '/var/www/Storybook/htdocs/controllers/verifyEmail.php';

			mail($email, $subject, $message, $headers);
			$_SESSION['email_paswd_success'] = '<div class="alert alert-success">
				 <h2>The user account must be verified before the ' . $emailtopic . ' login can be used.</h2><h3>Please check your email for a link to verify your account.<br>This reply email will only be active for 2 minutes.</h3><br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>
			</div>';
		//echo $_SESSION['email_paswd_success'];
		header("Location: https://syntheticreality.net/Storybook/Portal.php");
		return;
	}
		// Create the response Mail
		// mark the time and issue a new token
		// Generate random activation token
		$nutoken = md5(rand().time());
        $update = mysqli_query($connection, "UPDATE users SET token = '$nutoken', modified = now() WHERE email = '$email' ");
		//the mail				
		$from    = 'noreply@syntheticreality.net';
		$subject = $emailtopic . ' login request';
		$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
		if($emailtopic == 'Magic Link') {
			//$message = '<p>Hello ' . $firstname . ' ' . $lastname. '<br>Please use the link to login. <a href="https://syntheticreality.net/Storybook/magiclink_verification.php?token='.$nutoken.'"> Click to Login to Storybook.</a><br>This link will only be active for 2 minutes.</p>'; }
			include '/var/www/Storybook/htdocs/controllers/magiclinkEmail.php';
		}
		if($emailtopic == 'OTP') {
			//$message = '<p>Hello ' . $firstname . ' ' . $lastname. '<br>Please use this One Time Password with the OTP login choice to login. OTP='.$nutoken.'<br>This OTP will only be active for 2 minutes.</p>'; }
			include '/var/www/Storybook/htdocs/controllers/otpEmail.php';
		}
		if($emailtopic == 'Change Password') {
			//$message = '<p>Hello ' . $firstname . ' ' . $lastname. '<br>Please use the link to change your password.<br>If you do not want to change your password ignore this emai!: <a href="https://syntheticreality.net/Storybook/passwd_verification.php?token='.$nutoken.'"> Click to Change Password.</a><br><br>This link will only be active for 2 minutes.</p>';}
			include '/var/www/Storybook/htdocs/controllers/chpwdEmail.php';
		}
		mail($email, $subject, $message, $headers);
		$_SESSION['email_paswd_success'] = '<div class="alert alert-success">
				 <h2>An email has been sent in response to your request.</h2><h3>Please check your email for a reply to your ' .$emailtopic . ' request.<br>This reply email will only be active for 2 minutes.</h3><br><a class="btn btn-outline-primary btn-block text-center mb-4"  href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a>
			</div>';
		//echo $_SESSION['email_paswd_success'];
		header("Location: https://syntheticreality.net/Storybook/Portal.php");
		return;
	}
return;
}

?>