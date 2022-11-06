<?php
// disable this error reporting for production code
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

// Start session
session_name("Storybook");
//	@session_start(); // we use Zebra database sessions handler
require_once("/var/www/session2DB/Zebra.php");

// some test values may be replacedfrom query strings
$gatekeeper = 'itzbobwright';
$userEmail = 'itzbobwright@gmail.com';
// go to the MFA image assigner page
				$_SESSION['gatekeeper'] = $gatekeeper;
				$_SESSION['email'] = $userEmail;
				header("Location: https://syntheticreality.net/Storybook/Portal/GatekeeperSelect.php");
				echo 'User email verified! Continuing user registration.';
?>