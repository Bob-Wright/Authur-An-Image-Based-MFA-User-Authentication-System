<?php
// Start session
//	@session_start();
session_name("Storybook");
//@session_start();
require("/var/www/session2DB/Zebra.php");
// Database connection
include('/var/www/Storybook/htdocs/config/db.php');

// global $email_verified, $email_already_verified, $activation_error;
$_SESSION['activation_error'] = '';
$_SESSION['email_already_verified'] = '';
$_SESSION['email_verified'] = '';

    // GET the token = ?token
    if(!empty($_GET['token'])){
       $token = $_GET['token'];
	$_SESSION['activation_error'] = '<div class="alert alert-danger">
		Activation Token present.</div>';
    } else {
        $token = "";
	$_SESSION['activation_error'] = '<div class="alert alert-danger">
		Activation Token missing.</div>';
	return;
    }

if($token != "") {
	$token32 = chop($token, substr($token, 32)); //strip chars after md5 token 32 chars
	//$sqlQuery = mysqli_query($connection, "SELECT * FROM users WHERE token = '$token' ");
	$sqlQuery = mysqli_query($connection, "SELECT * FROM users WHERE token LIKE '$token32%'");
	$countRow = mysqli_num_rows($sqlQuery);

	if($countRow <= 0){
		$_SESSION['activation_error'] = '<div class="alert alert-danger">
			Activation Token match error.</div>';
				return;
	}

	while($rowData = mysqli_fetch_array($sqlQuery)){
		$is_active = $rowData['is_active'];
		$sent = $rowData['modified'];
		$dbToken = $rowData['token'];
		$userEmail = $rowData['email']; }
	if($is_active == 0) { // user is not active, we should not be here
		// check if user email exists in db
		$email_check_query = mysqli_query($connection, "SELECT * FROM users WHERE email = '{$userEmail}' ");
		$rowCount = mysqli_num_rows($email_check_query);
		if($rowCount == 1) {
		$delete = mysqli_query($connection, "DELETE FROM users WHERE email = '{$userEmail}' ");
		}
		$email_check_query2 = mysqli_query($connection, "SELECT * FROM users WHERE email = '{$userEmail}' ");
		$rowCount = mysqli_num_rows($email_check_query2);
		if($rowCount == 0) {
			$_SESSION['link_expired'] = '<div class="alert alert-danger">This User was not active so the user account was deleted.<br>Please retry your request to Sign Up.<br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a></div>';
		}
		return;
	} else { // user is active
		$_SESSION['dbToken'] = $dbToken;
		$emailtime = new DateTime($sent);
		$current_time = new DateTime();
		$interval = date_diff($emailtime, $current_time);
		// Generate new random activation token
		$nutoken = md5(rand().time());
		$update = mysqli_query($connection, "UPDATE users SET token = '$nutoken' WHERE token LIKE '$token%' ");
		if($update){
			$_SESSION['elapsed_time'] = $interval->format("Elapsed Time Days = %a HMS = %H:%I:%S .");
			$days = intval($interval->format("%a"));
			// days greater than zero?
			$hours = intval($interval->format("%H"));
			// hours greater than or equal to one?
			$minutes = intval($interval->format("%I"));
			//echo $days.'-'.$hours.':'.$minutes;
			if(!(($days > 0) || ($hours >= 1) || ($minutes >= 2))) { // link not expired
				// change email request successfully verified
				// dbToken has the new requested Email address appended to token
				$nuEmail = substr($dbToken, 32); //strip md5 token 32 chars to get nu email
				// extract username part of email
				$username = (explode('@', $nuEmail))[0];

				$update = mysqli_query($connection, "UPDATE users SET email = '$nuEmail', gatekeeper = '$username' WHERE token = '$nutoken' ");
				if($update) {
					$_SESSION['email_verify_success'] = '<div class="alert alert-success">
							User email changed
							</div>
					';
				} else {
				$_SESSION['_emailErr'] = '<div class="alert alert-success">
					Verification error
					</div>
				';
				}
				header("Location: https://syntheticreality.net/Storybook/Portal.php");
					echo 'User email change verified!';

			} else { // link expired
			$_SESSION['link_expired'] = '<div class="alert alert-danger">This Link has expired so the user account was not changed.<br>Please retry your Email address change request.<br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a></div>';
			return;
			}
		} else {
			$_SESSION['activation_error'] = '<div class="alert alert-danger">
				Activation Error.</div>';
			return;
		}
	}
}
?>