<?php
/*
 * filename: Portal.php
 * this code processes the Facebook user authentication
 * and the uploading images OR deleting images/account dialog
*/

// disable error reporting for production
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

// Start session
//	@session_start();
session_name("Storybook");
//@session_start();
require("/var/www/session2DB/Zebra.php");

// Facebook login processing	
//require "/var/www/ComicsUser/htdocs/Login.php";
// AuthUR login processing
//require "/var/www/Storybook/htdocs/controllers/login.php";

$head1 = <<<EOT
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Logon Portal</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta NAME="Last-Modified" CONTENT="
EOT;
echo $head1;
echo date ("F d Y H:i:s.", getlastmod()).'">';
$head2 = <<< EOT2
	<meta name="description" content="Application Logon Portal">
	<meta name="copyright" content="Copyright 2021 by IsoBlock.com">
	<meta name="author" content="Bob Wright">
	<meta name="keywords" content="application logon">
	<meta name="rating" content="general">
	<meta name="robots" content="index, follow"> 
	<base href="https://syntheticreality.net/Storybook/">
<!--	<link href="https://SyntheticReality.net/Storybook/" rel="canonical"> -->
	<!-- Material Design Bootstrap -->
	<link rel="stylesheet" href="./css/mdb.min.css">
	<link href="./css/ComicCreator.css" rel="stylesheet" type="text/css">
	<link href="./css/ComicBuilder.css" rel="stylesheet" type="text/css">
	<link href="./css/oapstyle.css" rel="stylesheet" type="text/css">
  <!--    <link rel="manifest" href="site.webmanifest"> -->
	<link rel="icon" href="./favicon.ico" type="image/ico">
	<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
<!-- set up our cache choices -->
<!-- <meta http-equiv="Cache-Control" content="no-cache, no-store, max-age=0, must-revalidate"> -->
<!-- <meta http-equiv="Pragma" content="no-cache"> -->
<!-- <meta http-equiv="Expires" content="Mon, 26 Jul 1997 05:00:00 GMT"> -->
</head>
<!-- Build out the page -->
<body class="container-fluid d-flex flex-column align-items-top #929fba mdb-color lighten-3">
<!--#include file="./includes/browserupgrade.ssi" -->
<h1 class="sr-only">This is the login entry page for the Storybook comic book builder.</h1>
<!--------------------------------------->
<style>
#prevpagebutton {
	font-family: 'Roboto Slab', serif; 
	font-weight: bold;
	font-size: 2.4vw;
}
#nextpagebutton {
	font-family: 'Roboto Slab', serif; 
	font-weight: bold;
	font-size: 2.4vw;
}
ul {
padding-left: 2vw;
}
</style>
EOT2;
echo $head2;
echo
'<!-- ++++++++++++++++++++++ -->'.
'<!-- Logo and name -->'.
'<header class="myHeader" id="myHeader">'.
'<img class="Logo" id="Logo" src = "./images/IsoBlockLOGO.gif" alt="rotating IsoBlock sphere"><div class="sitename" id="sitename" >StoryBook</div>'.
'<span class="siteSubtitle">from Synthetic Reality</span></header>'.
'<nav class="row justify-content-end fixed-top">'.
'<div class="col-lg-1">'.
    '<button title="jump to the Comics gallery" class="btn btn-sm btn-secondary">
		<svg version="1.0" xmlns="http://www.w3.org/2000/svg"  id="comicsHome" class="bi-layout-wtf"
		 width="60.000000px" height="42.000000px" viewBox="0 0 60.000000 42.000000">
		<g transform="translate(0.000000,42.000000) scale(0.100000,-0.100000)"
		fill="black" stroke="black" stroke-width="5">
		<path d="M467 413 c-2 -2 -32 -4 -67 -4 -53 -1 -67 -5 -87 -26 l-25 -24 -43
		21 c-36 17 -58 20 -136 18 l-93 -3 3 -150 c1 -82 6 -153 10 -158 4 -4 24 -1
		44 8 41 17 85 19 107 5 11 -7 6 -10 -22 -10 -40 0 -121 -31 -133 -51 -9 -13
		-1 -12 75 16 51 19 97 14 149 -16 l34 -20 22 27 c20 25 25 26 92 22 48 -2 78
		-9 90 -20 22 -20 73 -34 73 -20 0 5 -24 21 -53 36 -43 21 -69 26 -127 26 -65
		0 -71 2 -59 16 13 16 35 16 197 -2 l52 -6 0 79 c0 43 5 109 10 147 6 38 7 73
		3 77 -9 7 -110 18 -116 12z m88 -70 c-4 -26 -9 -86 -11 -133 l-3 -85 -28 1
		c-15 1 -59 7 -97 14 -64 11 -70 11 -97 -9 -26 -20 -29 -20 -38 -3 -9 15 -10
		15 -11 -5 0 -27 2 -27 -61 -7 -48 16 -112 15 -152 -1 -16 -7 -17 3 -17 129 l0
		136 69 0 c70 0 149 -21 163 -43 4 -7 8 -40 8 -74 0 -35 4 -63 10 -63 6 0 10
		30 10 69 0 52 5 74 19 92 17 23 26 24 131 27 l112 3 -7 -48z"/>
		</g><a xmlns="http://www.w3.org/2000/svg" id="anchor" xlink:href="https://syntheticreality.net/Comics/Comics.php" xmlns:xlink="http://www.w3.org/1999/xlink" target="_top"><rect x="0" y="0" width="100%" height="100%" fill-opacity="0"/></a>
		</svg>
    </button></div>
</nav>';
//display the page function message
$pagetask1 = <<<EOT1
<!-- ~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- the message -->
<main class="pageWrapper d-flex row flex-row row-no-gutters justify-content-center" id="container">
EOT1;
echo $pagetask1;

// log the user in
echo
'<section class="orngBox col-11 flex-column #b0bec5 blue-grey lighten-3 px-sm-0">'.

'<section class="container-11">'.
    '<div class="row">'.
    '<div class="col-12 text-center mx-auto">'.
		'<h1 style="color:indigo;">Login Portal</h1>'.
		'<h2 style="color:purple;">This page manages Storybook Comic Book Builder Logins.</h2>'.
		'<h3 style="color:purple;">"Codex et ars pro arte."</h3>'.
	'</div>'.
	'<div>'.
		'<p style="display:block;padding:3vw;" id="mustLoginNotice"><b>To manage content in the Storybook application you must log in as an authenticated user and you must agree to the <a href="../TermsOfService.php" title="jump to the Terms of Service agreement">&ldquo;Terms of Service&ldquo;</a>. Your use of this site signifies your consent to these terms.</b><br><br>Four login options are offered by this demo portal. All of these login options require a previously verified Email address. You may then login to the Storybook Comic Builder application through this portal with an Email address (or Username) and a password, with a Magic Link, with a One Time Password, or through our <span style="color:indigo;">AuthUR NFT Image MFA login</span>.</p>'.
		'<ul style="padding:2vw;" class="redBox"><b><li>Storybook does not share or sell any of your personal data to any third party.</li><li>Except for your Name (which can be a pseudonym) and Email address Storybook does not store any personal data on our servers.</li><li>Storybook does not use persistent cookies, no cookies are stored on your device.</li><li>Storybook does not employ any user tracking methods.</li></b></ul>'.
	'</div>'.
    '<div class="col-6 flex-column align-items-center mx-auto">'.
		'<a><button class="btn btn-outline-success btn-lg btn-block text-center mb-1" data-mdb-toggle="modal" data-mdb-target="#staticBackdrop"><h4><small>Login Options Explained</small></h4></button></a>'.
	'</div>'.
	'</div>'.
'</section>';

echo //	'<!-- Login form -->'.
'<section class="container-11">'.
'<div class="row">'.
	'<div class="col-10 mx-auto card shadow-md #cfd8dc blue-grey lighten-4 text-center msgBox">'.
	'<div class="App">'.
		'<div class="inner-block">';
			if(isset($_SESSION['email_paswd_success']) && $_SESSION['email_paswd_success'] != '') {echo $_SESSION['email_paswd_success'];
			} else {
			echo
		'<form action="https://syntheticreality.net/Storybook/controllers/login.php" method="post">'.
			'<h3 class="text-dark text-center" ><b>Hello and Welcome to Storybook!<br>Please Log In to continue.</b></h3>';
			if(isset($_SESSION['email_empty_err'])) {echo $_SESSION['emailPwdErr'];}
			if(isset($_SESSION['emailPwdErr'])) {echo $_SESSION['emailPwdErr'];}
			if(isset($_SESSION['UserNameErr'])) {echo $_SESSION['UserNameErr'];}
			if(isset($_SESSION['_emailErr'])) {echo $_SESSION['_emailErr'];}
			if(isset($_SESSION['verificationRequiredErr'])) {echo $_SESSION['verificationRequiredErr'];}
			if(isset($_SESSION['accountNotExistErr'])) {echo $_SESSION['accountNotExistErr'];}
			echo
			'<div class="form-group">'.
				'<label>Email or Username</label>'.
				'<input type="text" placeholder="Enter your Email address or Username" class="form-control #b0bec5 blue-grey" name="email_signin" id="email_signin" size="64" required />'.
			'</div>';
			if(isset($_SESSION['email_empty_err'])) {echo $_SESSION['email_empty_err'];}
			echo
			'<div class="form-group">'.
				'<label>Password</label>'.
				'<input type="password"  placeholder="Enter your password" class="form-control #b0bec5 blue-grey" name="password_signin" id="password_signin" size="64" />'.
			'</div>';
			if(isset($_SESSION['pass_empty_err'])) {echo $_SESSION['pass_empty_err'];}
			echo
			'<br>'.
			'<button type="submit" name="login" id="login" value="login" class="btn btn-outline-success btn-block"><h3><small>Email or Username Log In</small></h3></button>'.
			'<button type="submit" name="magiclink" id="magiclink" value="magiclink" class="btn btn-outline-success btn-block"><h3><small>Magic Link</small></h3></button>'.
			'<button type="submit" name="otp" id="otp" value="otp" class="btn btn-outline-success btn-block"><h3><small>One Time Password</small></h3></button>'.
			'<button type="submit" name="mfa" id="mfa" value="mfa" class="btn btn-outline-success btn-block"><h3><small>NFT Image MFA</small></h3></button>'.
			'<div class="col-2"><br></div>'.
			'<button type="submit" name="chpwd" id="chpwd" value="chpwd" class="btn btn-outline-danger btn-block"><h3><small>Change Password</small></h3></button>'.
			'<div class="col-2"><br></div>'.
			'<a class="btn btn-outline-primary btn-block text-center mb-4" href="signup.php"><h3><small>Sign Up</small></h3></a>'.
		'</form>';}
		echo	
		'</div>'.
	'</div>'.
'</div></section>'.
'</div>'.
'</section>'.
     '<!-- Modal -->'.
      '<div class="modal fade" id="staticBackdrop" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'.
        '<div class="modal-dialog modal-xl">'.
          '<div class="modal-content">'.
           ' <div class="modal-header">'.
              '<h3 class="modal-title" id="staticBackdropLabel" style="color: MediumBlue;">AuthUR Log In Types</h3>'.
              '<button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>'.
            '</div>'.
			'<div class="modal-body">'.
				'<p style="color: FireBrick;">AuthUR is our name for our "Authorized User Registration" system which relies on sequences of "Authorized User Requests" and associated "Authorized User Response" replies.</p>'.
				'<p><span style="color: MediumBlue;">Facebook Oauth Login</span>: To login as a user and post content you must be a registered Facebook user and Login to Storybook (which was also a registered FB application) using the FB Oauth authentication scheme. The measure of security provided by this Login method is sufficient to satisfy Facebook requirements. Other social media also provide similar user ID schemes. These schemes notify the authorization provider, for example Facebook, that you have logged into the associated application. The lack of privacy and security are two of the reasons Storybook does not support social media logins.<br><br>'.
				'The next three login methods are presented as functional demos of some common login techniques.<br>'.
				'<span style="color: MediumBlue;">SignUp-SignIn</span>: To login as a user you must first authenticate yourself as having control over an email address by a token exchange, after which logins are done by entering both the Password and the verified email address or a user name we extract as the recipient name from the email address (the Username will change if the email address is changed). A periodic revalidation of the user email may be appropriate for this method.<br>'.
				'<span style="color: MediumBlue;">Magic Links</span>: Instead of asking a user for a password, this form of no password authentication asks a user to enter their  previously registered email address into the login box. An email is then sent to them, with a link they can click to log in. This process is repeated each time the user logs in because by default the Magic Link cannot be used more than once. Time to live (TTL) is a consideration for this scheme, how long is the link good or valid. The default TTL is two minutes. Password entries for this login choice are ignored.<br>'.
				'<span style="color: MediumBlue;">One-Time Passwords/Codes</span>: One-time passwords (OTP) or one-time codes (OTC) are similar to magic links but require users to input a code as a single use Password instead of simply clicking a link. The OTP is sent to their previously registered email or mobile device. This process is repeated each time a user logs in because by default the OTP cannot be used more than once. TTL is a consideration for this scheme, how long is the OTP good or valid. The default TTL is two minutes. Password entries are ignored for this choice until after an OTP has been requested and then the emailed OTP Password is used to Login one time.<br><br>'.
				'The MFA scheme used by Storybook leverages NFT images and encryption technologies to present a unique Multi-Factor Authentication method.<br>'.
				'<span style="color: MediumBlue;">AuthUR NFT Image MFA</span>: Multifactor Authentication schemes in general rely on a concept using two "factors" to identify a user. One factor is something the user knows, for example their password.The second factor is something the user (and hopefully only the user) has in their possession. Frequently the factor that the user possesses is a key fob with a frequently changing displayed code value, or perhaps more commonly a code sent by SMS messaging to their cellphone. A user is required to input the MFA code as an additional single use Password. This process is repeated each time a user logs in because by default the MFA token cannot be used more than once. TTL is a consideration for this scheme, how long is the MFA good or valid. The default TTL is two minutes. Password entries are ignored for this choice after an MFA has been requested until it is used to Login one time.</p>'.
			'</div>'.
            '<div class="modal-footer">'.
              '<button type="button" class="btn btn-lg btn-success" data-mdb-dismiss="modal"><h3>Close</h3></button>'.
            '</div>'.
          '</div>'.
        '</div>'.
      '</div>'.
    '</div>'.
    '</div>';

echo '</main>';
		echo
		'<footer class="d-flex col-sm-12 flex-column align-items-center justify-content-center shadow-md #b0bec5 blue-grey lighten-5 orngBox" id="ComicFooter">'.
		'<nav><p><a id="prevpagebutton" href="../Comics/Comics.php" title="return to the Comics gallery">❮ Previous</a>&emsp;&copy; 2020 by&nbsp;<span><svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 40.000000 40.000000" preserveAspectRatio="xMidYMid meet">
	<g transform="translate(0.000000,40.000000) scale(0.100000,-0.100000)"
	fill="#000000" stroke="none">
	<path d="M97 323 l-97 -78 0 -122 0 -123 200 0 201 0 -3 127 -3 127 -93 73
	c-52 40 -97 73 -101 73 -4 0 -51 -35 -104 -77z m184 -9 c43 -30 79 -59 79 -63
	0 -6 -63 -41 -75 -41 -3 0 -5 14 -5 30 l0 30 -85 0 -85 0 0 -30 c0 -16 -4 -30
	-10 -30 -16 0 -60 23 -60 31 0 9 142 128 153 129 5 0 45 -25 88 -56z m97 -177
	c1 -48 -1 -87 -5 -87 -10 0 -163 94 -163 100 0 9 144 79 155 76 6 -1 11 -42
	13 -89z m-273 51 c36 -18 65 -35 65 -38 0 -6 -125 -101 -143 -108 -4 -2 -7 37
	-7 87 0 53 4 91 10 91 5 0 39 -14 75 -32z m174 -99 c45 -29 81 -56 81 -60 0
	-5 -73 -9 -161 -9 -149 0 -160 1 -148 17 17 19 130 103 140 103 4 0 44 -23 88
	-51z"/>
	</g>
	</svg></span>&nbsp;<a href="mailto:itzbobwright@gmail.com">Bob Wright.</a>&nbsp;Last modified ';
		echo date ("F d Y H:i:s.", getlastmod()).'</p></nav>'.
		'</footer>';
echo
'<!-- End of the web page display -->'.
'<!-- ====================== -->'.
//'<script src="./js/jquery.min.js"></script>'.
'<script src="./js/mdb.min.js"></script>'.
//'<script src="./js/context.js"></script>'.
'<script src="./js/isoblockLogo.js"></script>'.
'<!-- +++++++++++++++++++++++ -->'.
'<!-- End of the web page -->'.
'</body>'.
'</html>';
?>