<?php
// Database connection
include('/var/www/Storybook/htdocs/config/db.php');

global $email_verified, $email_already_verified, $activation_error;

// GET the token = ?token
if(!empty($_GET['token'])){
   $token = $_GET['token'];
} else {
	$token = "";
}

if($token != "") {
	$sqlQuery = mysqli_query($connection, "SELECT * FROM users WHERE token = '$token' ");
	$countRow = mysqli_num_rows($sqlQuery);

	if($countRow == 1){
		while($rowData = mysqli_fetch_array($sqlQuery)){
			$is_active = $rowData['is_active'];
			$sent = $rowData['modified'];
			$_SESSION['email'] = $rowData['email'];
				if($is_active == 1) {
				$emailtime = new DateTime($sent);
				$current_time = new DateTime();
				$interval = date_diff($emailtime, $current_time);
 
					// Generate new random activation token
					$nutoken = md5(rand().time());
					$update = mysqli_query($connection, "UPDATE users SET token = '$nutoken' WHERE token = '$token' ");
					if($update){
					$_SESSION['elapsed_time'] = $interval->format("Elapsed Time Days = %a HMS = %H:%I:%S .");
					$days = intval($interval->format("%a"));
					// days greater than zero?
					$hours = intval($interval->format("%H"));
					// hours greater than or equal to one?
					$minutes = intval($interval->format("%I"));
					//echo $days.'-'.$hours.':'.$minutes;
					if(!(($days > 0) || ($hours >= 1) || ($minutes >= 2))) { //link not expired
					// Magic Link User email successfully verified!
					// go to the magic link landing page
					header("Location: https://syntheticreality.net/Storybook/controllers/dashboard.php");
					} else {
						$_SESSION['link_expired'] = '<div class="alert alert-danger">This Magic Link has expired.<br>Please retry your request for a link</div>';
					}
				}} else {
					$_SESSION['activation_error'] = '<div class="alert alert-danger">There is an activation error!<br>This account may not be verified.</div>';
				}
	}} else {
		$_SESSION['link_already_used'] = '<div class="alert alert-danger">There is an activation error!<br>This link may have been used</div>';
	}
}
?>