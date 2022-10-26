<?php
// Start session
session_name("Storybook");
include("/var/www/session2DB/Zebra.php");
//session_start();
//if(!isset($_SESSION)) { session_start(); }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://syntheticreality.net/Storybook/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://syntheticreality.net/Storybook/css/style.css">
    <title>User Registration</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://syntheticreality.net/Storybook/js/jquery.min.js"></script>
    <script src="https://syntheticreality.net/Storybook/js/bootstrap.min.js"></script>
</head>
<style>
.fcheckbox {
  height: 1.5vw;
  width: 1.5vw;
  padding: 1vw 1vw;
  cursor: pointer;
    outline: .2vw solid black;
}
.fcheckbox:focus {
  height: 1.75vw;
  width: 1.75vw;
	outline: .5vw solid #b22242;
}
input[type=text]:focus {
  background-color: GreenYellow;
}
input[type=submit]:focus {
  background-color: GreenYellow;
}
input[type=checkbox]:focus {
  background-color: GreenYellow;
}
input[type=file]:focus {
  background-color: GreenYellow;
}
textarea:focus {
  background-color: GreenYellow;
}
a:focus {
  background-color: GreenYellow;
}
.inner-block {
  background-color: LightGray;
  border: .2vw solid blue;
}
.form-group {
  background-color: mistyrose;
  border: .2vw solid DarkRed;
}
.card-body {
padding: 0 1vw;
}
</style>
<body>
   <?php
   if($_SESSION['email_verify_success'] == '') {
   include('/var/www/Storybook/htdocs/header.php'); }
   ?>
<div class="App">
	<div class="vertical-center">
		<div class="inner-block">
		<h1>User Data</h1>
		<h2>Your Email address is the only user data entry that Storybook verifies. You may use an alias or pseudonym for the name entries.</h2>
		<div style="opacity: 0;" class="card col-12"><br></div>
			<?php
			if($_SESSION['email_verify_success'] != '') {
				echo $_SESSION['email_verify_success'];
			} else {
			echo
			'<form action="https://syntheticreality.net/Storybook/controllers/register.php" method="post">';

			if($_SESSION['modify_success'] != '') { echo $_SESSION['modify_success'];}
			if($_SESSION['email_exist'] != '') { echo $_SESSION['email_exist'];}
			if($_SESSION['email_verify_err'] != '') { echo $_SESSION['email_verify_err'];}
			echo
			'<div class="form-group">'.
			'<div style="opacity: 0;" class="card col-12"><br></div>'.
			'<div style="margin: 0 1vw;background-color: LightYellow;" class="card col-11 d-flex flex-column align-items-center shadow-md">'.
			'<label id="firstname" class="card-body" ><h3>First Name</h3></label>'.
			'</div>'.
			'<div style="opacity: 0;" class="card col-12"><br></div>'.
			//'<label>First name</label>'.
			//'<div class="alert alert-primary">Only letters and white space allowed.</div>'.
			'<div class="col-10 mb-4">'.
			'<input style="margin: 0 1vw;background-color: LightCyan; color: black;" type="text" class="form-control col-9" placeholder="Enter your first name" name="firstname" id="firstName" required value="'. $firstname .'" />';
			if($_SESSION['f_NameErr'] != '') { echo $_SESSION['f_NameErr'];}
			if($_SESSION['fNameEmptyErr'] != '') { echo $_SESSION['fNameEmptyErr'];}
			echo
			'</div></div>'.
			'<div style="opacity: 0;" class="card col-12"><br></div>'.

			'<div class="form-group">'.
			'<div style="opacity: 0;" class="card col-12"><br></div>'.
			'<div style="margin: 0 1vw;background-color: LightYellow;" class="card col-11 d-flex flex-column align-items-center shadow-md">'.
			'<label id="lastname" class="card-body" ><h3>Last Name</h3></label>'.
			'</div>'.
			'<div style="opacity: 0;" class="card col-12"><br></div>'.
			//'<div class="alert alert-primary">Only letters and white space allowed.</div>'.
			'<div class="col-10 mb-4">'.
			'<input style="margin: 0 1vw;background-color: LightCyan; color: black;" type="text" class="form-control" placeholder="Enter your last name" name="lastname" id="lastName" required value="'. $lastname.'" />';
			if($_SESSION['l_NameErr'] != '') { echo $_SESSION['l_NameErr'];}
			if($_SESSION['lNameEmptyErr'] != '') { echo $_SESSION['lNameEmptyErr'];}
			echo
			'</div></div>'.
			'<div style="opacity: 0;" class="card col-12"><br></div>'.

			'<div class="form-group">'.
			'<div style="opacity: 0;" class="card col-12"><br></div>'.
			'<div style="margin: 0 1vw;background-color: LightYellow;" class="card col-11 d-flex flex-column align-items-center shadow-md">'.
			'<label id="emailaddress" class="card-body" ><h3>Email Address</h3></label>'.
			'</div>'.
			'<div style="opacity: 0;" class="card col-12"><br></div>'.
			//'<div class="alert alert-primary">Valid Email address format only.</div>'.
			'<div class="col-10 mb-4">'.
			'<input style="margin: 0 1vw;background-color: LightCyan; color: black;" type="email" class="form-control" placeholder="Enter your Email address " name="email" id="email" required value="'. $email.'" />';
			if($_SESSION['_emailErr'] != '') { echo $_SESSION['_emailErr'];}
			if($_SESSION['emailEmptyErr'] != '') { echo $_SESSION['emailEmptyErr'];}
			echo
			'</div></div>'.
			'<div style="opacity: 0;" class="card col-12"><br></div>'.

			'<div class="form-group">'.
			'<div style="opacity: 0;" class="card col-12"><br></div>'.
			'<div style="margin: 0 1vw;background-color: LightYellow;" class="card col-11 flex-column align-items-center shadow-md">'.
			'<label id="pwd" class="card-body" ><h3>Password</h3><p style="margin: 1vw;"><b>6 to 20 characters, both lowercase and uppercase, begin with a letter or digit and contain at least one of @#!%& and a digit.</b></p></label>'.
			'</div>'.
			'<div style="opacity: 0;" class="card col-12"><br></div>'.
			//'<div class="alert alert-primary">Valid Email address format only.</div>'.
			'<div class="col-10 mb-4">'.
			'<input style="margin: 0 1vw;background-color: LightCyan; color: black;" type="password" class="form-control" placeholder="Enter a password" name="password" id="password" required />';

			if(isset($_SESSION['_passwordErr'])) { echo $_SESSION['_passwordErr'];}
			if(isset($_SESSION['passwordEmptyErr'])) { echo $_SESSION['passwordEmptyErr'];}
			echo
			'</div></div>';
$factors = <<< EOT1
		<div style="opacity: 0;" class="card col-12"><br></div>
		<h1>User Verification Factors</h1>
		<h2>You may be asked to verify your response to one or more of the following questions when you log in.</h2>
<div style="opacity: 0;" class="card col-12"><br></div>
<div class="row mx-1 d-flex col-12">
	<div class="form-group">
	<div style="opacity: 0;" class="card col-12"><br></div>
	<div style="background-color: LightYellow;" class="card col-11 d-flex flex-column align-items-center shadow-md">
		<div id="fontColor" class="card-body" ><h3>Odd or even birth year</h3></div>
	</div>
	<div style="opacity: 0;" class="card col-12"><br></div>
			<div class="col-10 mb-4">
				<div class="color-block z-depth-2" style="background-color: LightBlue; color: black;"><label style="margin: 0 1vw;"><p><br><input class="fcheckbox" type="radio" name="YEO" value="even" />&emsp;&emsp;An even number year (last digit is 0, 2, 4, 6, or 8).</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightSteelBlue; color: black;"><label style="margin: 0 1vw;"><p><br><input class="fcheckbox" type="radio" name="YEO" value="odd" />&emsp;&emsp;An odd number year (last digit is 1, 3, 5, 7, or 9).</p></label></div>
			</div>
	</div>
<div style="opacity: 0;" class="card col-12"><br></div>
	<div class="form-group">
	<div style="opacity: 0;" class="card col-12"><br></div>
	<div style="background-color: LightYellow;" class="card col-11 d-flex flex-column align-items-center shadow-md">
		<div id="fontColor2" class="card-body"><h3>Odd or even birth month</h3></div>
	</div>
	<div style="opacity: 0;" class="card col-12"><br></div>
			<div class="col-10 mb-4">
				<div class="color-block z-depth-2" style="background-color: LightSteelBlue; color: black;"><label style="margin: 0 1vw;"><p><br><input class="fcheckbox" type="radio" name="MEO" value="even" />&emsp;&emsp;An even numbered month (February, April, June, August, October, or December).</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightBlue; color: black;"><label style="margin: 0 1vw;"><p><br><input class="fcheckbox" type="radio" name="MEO" value="odd" />&emsp;&emsp;An odd numbered month (January, March, May, July, September, or November).</p></label></div>
			</div>
	</div>
<div style="opacity: 0;" class="card col-12"><br></div>
	<div class="form-group">
	<div style="opacity: 0;" class="card col-12"><br></div>
	<div style="background-color: LightYellow;" class="card col-11 d-flex flex-column align-items-center shadow-md">
		<div id="fontColor3" class="card-body"><h3>Odd or even day of your birth</h3></div>
	</div>
	<div style="opacity: 0;" class="card col-12"><br></div>
			<div class="col-10 mb-4">
				<div class="color-block z-depth-2" style="background-color: LightSteelBlue; color: black;"><label style="margin: 0 1vw;"><p><br><input class="fcheckbox" type="radio" name="DEO" value="even" />&emsp;&emsp;An even numbered  day (2, 4, 6, 8 etc.).</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightBlue; color: black;"><label style="margin: 0 1vw;"><p><br><input class="fcheckbox" type="radio" name="DEO" value="odd" />&emsp;&emsp;An odd numbered day (1, 3, 5, 7 etc.).</p></label></div>
			</div>
	</div>
<div style="opacity: 0;" class="card col-12"><br></div>
	<div class="form-group">
	<div style="opacity: 0;" class="card col-12"><br></div>
	<div style="background-color: LightYellow;" class="card col-11 d-flex flex-column align-items-center shadow-md">
		<div id="fontColor4" class="card-body"><h3>Have you ever flown in an airplane?</h3></div>
	</div>
	<div style="opacity: 0;" class="card col-12"><br></div>
			<div class="col-10 mb-4">
				<div class="color-block z-depth-2" style="background-color: LightSteelBlue; color: black;"><label style="margin: 0 1vw;"><p><br><input class="fcheckbox" type="radio" name="FA" value="no" />&emsp;&emsp;No I have not flown in an airplane.</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightBlue; color: black;"><label style="margin: 0 1vw;"><p><br><input class="fcheckbox" type="radio" name="FA" value="yes" />&emsp;&emsp;Yes I have flown in an airplane.</p></label></div>
			</div>
	</div>
<div style="opacity: 0;" class="card col-12"><br></div>
	<div class="form-group">
	<div style="opacity: 0;" class="card col-12"><br></div>
	<div style="background-color: LightYellow;" class="card col-11 d-flex flex-column align-items-center shadow-md">
		<div id="fontColor4" class="card-body"><h3>Can you swim or ride a bicycle?</h3></div>
	</div>
	<div style="opacity: 0;" class="card col-12"><br></div>
			<div class="col-10 mb-4">
				<div class="color-block z-depth-2" style="background-color: LightBlue; color: black;"><label style="margin: 0 1vw;"><p><br><input class="fcheckbox" type="radio" name="SB" value="nono" />&emsp;&emsp;No I can neither swim nor ride a bicycle.</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightSteelBlue; color: black;"><label style="margin: 0 1vw;"><p><br><input class="fcheckbox" type="radio" name="SB" value="yesyes" />&emsp;&emsp;Yes I can both swim and ride a bicycle.</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightBlue; color: black;"><label style="margin: 0 1vw;"><p><br><input class="fcheckbox" type="radio" name="SB" value="yesno" />&emsp;&emsp;I can swim but not ride a bicycle.</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightSteelBlue; color: black;"><label style="margin: 0 1vw;"><p><br><input class="fcheckbox" type="radio" name="SB" value="noyes" />&emsp;&emsp;I can ride a bicycle but not swim.</p></label></div>
			</div>
	</div>
<div style="opacity: 0;" class="card col-12"><br></div>
	<div class="form-group">
	<div style="opacity: 0;" class="card col-12"><br></div>
	<div style="background-color: LightYellow;" class="card col-11 d-flex flex-column align-items-center shadow-md">
		<div id="fontColor4" class="card-body"><h3>Were you born near the ocean?</h3></div>
	</div>
	<div style="opacity: 0;" class="card col-12"><br></div>
			<div class="col-10 mb-4">
				<div class="color-block z-depth-2" style="background-color: LightSteelBlue; color: black;"><label style="margin: 0 1vw;"><p><br><input class="fcheckbox" type="radio" name="NO" value="no" />&emsp;&emsp;No I was not born near the ocean.</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightBlue; color: black;"><label style="margin: 0 1vw;"><p><br><input class="fcheckbox" type="radio" name="NO" value="yes" />&emsp;&emsp;Yes I was born near the ocean.</p></label></div>
			</div>
	</div>
<div style="opacity: 0;" class="card col-12"><br></div>
	<div class="form-group">
	<div style="opacity: 0;" class="card col-12"><br></div>
	<div style="background-color: LightYellow;" class="card col-11 d-flex flex-column align-items-center shadow-md">
		<div id="fontColor4" class="card-body"><h3>Odd or an even number of characters in your first name?</h3></div>
	</div>
	<div style="opacity: 0;" class="card col-12"><br></div>
			<div class="col-10 mb-4">
				<div class="color-block z-depth-2" style="background-color: LightSteelBlue; color: black;"><label style="margin: 0 1vw;"><p><br><input class="fcheckbox" type="radio" name="NC" value="odd" />&emsp;&emsp;My first name has an odd number of characters (1, 3, 5, 7 etc.).</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightBlue; color: black;"><label style="margin: 0 1vw;"><p><br><input class="fcheckbox" type="radio" name="NC" value="even" />&emsp;&emsp;My first name has an even number of characters (2, 4, 6, 8 etc.).</p></label></div>
			</div>
<div style="opacity: 0;" class="card col-12"><br></div>
	</div>
	</div></div>
EOT1;
echo $factors;
if($_SESSION['email_verify_success'] == '') {
	echo
		'<div style="opacity: 0;" class="card col-12"><br></div>'.
		'<button  style="background-color: LightSteelBlue; color: black;" type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg btn-block"><h2>Sign up</h2></button>'.
		'</form>';}

		}
?>
		</div>
	</div>
</div>
</body>
</html>
