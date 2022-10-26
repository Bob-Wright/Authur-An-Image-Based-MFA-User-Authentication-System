<?php
// Start session
//	@session_start();
session_name("Storybook");
//@session_start();
require("/var/www/session2DB/Zebra.php");
 // Database connection
include('/var/www/Storybook/htdocs/config/db.php'); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://syntheticreality.net/Storybook/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://syntheticreality.net/Storybook/css/style.css">
    <title>Change User Profile</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://syntheticreality.net/Storybook/js/jquery.min.js"></script>
    <script src="https://syntheticreality.net/Storybook/js/bootstrap.min.js"></script>
</head>
<body>
   <?php //include('/var/www/Storybook/htdocs/header.php');
	$email = $_SESSION['email'];
	// Query if email exists in db
	$sql = "SELECT * From users WHERE email = '$email' ";
	$query = mysqli_query($connection, $sql);
	$rowCount = mysqli_num_rows($query);
	// If query fails, show the reason 
	if(!$query){
	   die("SQL query failed: " . mysqli_error($connection));
	}
	//echo '<br>'.$user_email.' - '.$pswd.'<br>';
	// Check if email exists
	if($rowCount <= 0) {
		$_SESSION['accountNotExistErr'] = '<div class="alert alert-danger">
				User account does not exist.
			</div>';
		header("Location: https://syntheticreality.net/Storybook/Portal.php");
		exit;
		//echo $accountNotExistErr;
	} else {
		// Fetch user data
		//echo '<br>Fetching user from DB<br>';
		while($row = mysqli_fetch_array($query)) {
			$id            = $row['id'];
			$firstname     = $row['firstname'];
			$lastname      = $row['lastname'];
			$email         = $row['email'];
			$factors   = $row['factors'];
		}
	}
?>
	<div class="App">
        <div class="vertical-center">
            <div class="inner-block">
            <h1>Change User Data</h1>
                <?php
				if($_SESSION['email_verify_success'] != '') {
					echo $_SESSION['email_verify_success'];
				} else {
				echo
				'<form action="https://syntheticreality.net/Storybook/controllers/commit.php" method="post">';

				if($_SESSION['modify_success'] != '') { echo $_SESSION['modify_success'];}
                if($_SESSION['email_exist'] != '') { echo $_SESSION['email_exist'];}
                if($_SESSION['email_verify_err'] != '') { echo $_SESSION['email_verify_err'];}
				echo
                '<div class="form-group">'.
                '<label>First name</label>'.
                '<input type="text" class="form-control" placeholder="First Name" name="firstname" id="firstName" required value="'. $firstname .'" />';
				if($_SESSION['f_NameErr'] != '') { echo $_SESSION['f_NameErr'];}
				if($_SESSION['fNameEmptyErr'] != '') { echo $_SESSION['fNameEmptyErr'];}
				echo
				'</div>'.

                '<div class="form-group">'.
                '<label>Last name</label>'.
                '<input type="text" class="form-control" placeholder="Last Name" name="lastname" id="lastName" required value="'. $lastname.'" />';
				if($_SESSION['l_NameErr'] != '') { echo $_SESSION['l_NameErr'];}
				if($_SESSION['lNameEmptyErr'] != '') { echo $_SESSION['lNameEmptyErr'];}
				echo
				'</div>'.

                '<div class="form-group">'.
                '<label>Email</label>'.
				'<input type="email" class="form-control" placeholder="Email address" name="email" id="email" required value="'. $email.'" />';
				if($_SESSION['_emailErr'] != '') { echo $_SESSION['_emailErr'];}
				if($_SESSION['emailEmptyErr'] != '') { echo $_SESSION['emailEmptyErr'];}
				echo
				'</div>'.

				'<br><br>';
                if($_SESSION['email_verify_success'] == '') {
					echo
                '<button type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg btn-block"><h2>Commit Changes</h2></button></form><br>'.
				'<a class="btn btn-outline-primary btn-block text-center mb-4" href="dashboard.php"><h2>Exit</h2></a>';
				} else {
				echo
				'</form><br>';
				}
				}
				?>
            </div>
        </div>
    </div>
</body>
</html>
