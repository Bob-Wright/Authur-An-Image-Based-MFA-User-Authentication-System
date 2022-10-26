<?php
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
	//$sqlQuery = mysqli_query($connection, "SELECT * FROM users WHERE token = '$token' ");
	$sqlQuery = mysqli_query($connection, "SELECT * FROM users WHERE token LIKE '$token%'");
	$countRow = mysqli_num_rows($sqlQuery);

	if($countRow <= 0){
		$_SESSION['activation_error'] = '<div class="alert alert-danger">
			Activation Token match error.</div>';
				return;
	}

	while($rowData = mysqli_fetch_array($sqlQuery)){
		$is_active = $rowData['is_active'];
		$sent = $rowData['modified'];
		$token = $rowData['token'];
		$userEmail = $rowData['email'];
		$gatekeeper= $rowData['gatekeeper'];
		// $_SESSION['email'] = $rowData['email'];
		$emailtime = new DateTime($sent);
		$current_time = new DateTime();
		$interval = date_diff($emailtime, $current_time);
		// Generate new random activation token
		$nutoken = md5(rand().time());
		// wait on gatekeeper select to make user active
		//$update = mysqli_query($connection, "UPDATE users SET token = '$nutoken', is_active = '1', email = '$nuemail' WHERE token LIKE '$token%' ");
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
				/*
				*			User successfully verified!
				*/
				// could just continue as logged in and go to the app landing page
				// header("Location: https://syntheticreality.net/Storybook/controllers/dashboard.php");
				// or just tell them they can now log in
				/* $_SESSION['email_verified'] = '<div class="alert alert-danger">
						User email verified! You may login.</div>';
				return; */

				// go to the MFA image assigner page
				$_SESSION['gatekeeper'] = $gatekeeper;
				$_SESSION['email'] = $userEmail;
				header("Location: https://syntheticreality.net/Storybook/Portal/GatekeeperSelect.php");
				echo 'User email verified! Continuing user registration.';

			} else { // link expired
				if($is_active == 0) {
				// check if user email exists in db
				$email_check_query = mysqli_query($connection, "SELECT * FROM users WHERE email = '{$userEmail}' ");
				$rowCount = mysqli_num_rows($email_check_query);
				if($rowCount == 1) {
				$delete = mysqli_query($connection, "DELETE FROM users WHERE email = '{$userEmail}' ");
				}
				$email_check_query2 = mysqli_query($connection, "SELECT * FROM users WHERE email = '{$userEmail}' ");
				$rowCount = mysqli_num_rows($email_check_query2);
				if($rowCount == 0) {
					$_SESSION['link_expired'] = '<div class="alert alert-danger">This Link has expired so the user account was deleted.<br>Please retry your request to Sign Up.<br><a class="btn btn-outline-primary btn-block text-center mb-4" href="https://syntheticreality.net/Storybook/controllers/logout.php"><h3>Continue</h3></a></div>';
				}
				return;
				}
			}
		} else {
			$_SESSION['activation_error'] = '<div class="alert alert-danger">
				Activation Error.</div>';
			return;
		}
	}
}
?>