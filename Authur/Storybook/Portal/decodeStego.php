<?php
// Start session
session_name("Storybook");
include("/var/www/session2DB/Zebra.php");

$head1 = <<< EOT
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>showMugshotChoice</title>
	<meta name="copyright" content="Copyright 2022 by Bob Wright">   
	<meta name="generator" content ="part of Synthetic Reality Storybook Comic Book Builder">
	<meta name="author" content="Bob Wright and other contributors">
	<meta name="keywords" content="comics,images,art,graphics,illustration">
	<meta name="rating" content="general">
<base href="./">
    <!-- Bootstrap core CSS -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
<script src="../js/jquery.min.js"></script>
<script src= "../js/bootstrap.min.js"></script>
   <!--    <link rel="manifest" href="site.webmanifest"> -->
	<link rel="icon" href="../favicon.ico" type="image/ico"/>
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
<!--
<script> //if we have javascript then remove no-js class from html
  document.documentElement.classList.remove("no-js");
</script>
<script type="text/javascript" src="./js/modernizr-webpdetect-min.js"></script>
<script>  // check for webp support
  Modernizr.on('webp', function(result) {
    if (result) {
      // supported
    } else {
      // not-supported
    }
  });
</script>
-->
<style>
* {
 box-sizing: border-box;
}
@media screen and (max-width: 800px) {
@font-face {font-family: "RobotoSlab-Regular"; src: url("../Fonts/RobotoSlab-Regular.ttf") format("truetype");} .card-body, p { font: 2.5vw RobotoSlab-Regular; color: #000000;} @font-face {font-family: "Montserrat-Bold"; src: url("../Fonts/Montserrat-Bold.ttf") format("truetype");} h1 { font: 5vw Montserrat-Bold; color: #000000;} h2 { font: 4vw Montserrat-Bold; color: #000000;} h3 { font: 3.5vw Montserrat-Bold; color: #000000;}.xmplc {background: #FFE4E1;}
}
@media screen and (min-width: 801px) and (max-width: 1279px)  {
@font-face {font-family: "RobotoSlab-Regular"; src: url("../Fonts/RobotoSlab-Regular.ttf") format("truetype");} .card-body, p { font: 1.5vw RobotoSlab-Regular; color: #000000;} @font-face {font-family: "Montserrat-Bold"; src: url("../Fonts/Montserrat-Bold.ttf") format("truetype");} h1 { font: 4vw Montserrat-Bold; color: #000000;} h2 { font: 3.5vw Montserrat-Bold; color: #000000;} h3 { font: 3vw Montserrat-Bold; color: #000000;}.xmplc {background: #FFE4E1;}
}
@media (min-width: 1280px) {
@font-face {font-family: "RobotoSlab-Regular"; src: url("../Fonts/RobotoSlab-Regular.ttf") format("truetype");} .card-body, p { font: 1vw RobotoSlab-Regular; color: #000000;} @font-face {font-family: "Montserrat-Bold"; src: url("../Fonts/Montserrat-Bold.ttf") format("truetype");} h1 { font: 3vw Montserrat-Bold; color: #000000;} h2 { font: 2.5vw Montserrat-Bold; color: #000000;} h3 { font: 2.2vw Montserrat-Bold; color: #000000;}.xmplc {background: #FFE4E1;}
}
/* no javascript fallback */
.no-js #container:before {
	content: ' ';
	display: block;
	position: fixed;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	z-index: -1;
	opacity: 0.6;
	background-image: url("../images/RockwallBackground.jpg");
	background-position: top center;
	background-repeat: no-repeat;
	-ms-background-size: 100% 100%;
	-o-background-size: 100% 100%;
	-moz-background-size: 100% 100%;
	-webkit-background-size: 100% 100%;
	background-size: 100% 100%;
}
</style>
</head>
<!-- End of the HTML head section-->
<!-- =========================== -->
<!-- +++++++++++++++++++++++ -->
<!-- Build out the page -->
<body class="#929fba mdb-color lighten-3"><!--#include file="./includes/browserupgrade.ssi" -->
<main  id="container" class="container justify-content-center">


<!-- +++++++++++++++++++++++ -->
<div class="row col-12">
    <nav title="jump to the mugshot gallery" class="btn" style="background-color: lightgreen">
		<svg version="1.0" xmlns="http://www.w3.org/2000/svg"  id="" class="bi-layout-wtf"
		 width="100px" height="60px" viewBox="0 0 60.000000 42.000000">
		<g transform="translate(0.000000,42.000000) scale(0.100000,-0.100000)"
		fill="black" stroke="black" stroke-width=".5">
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
		</g><a xmlns="http://www.w3.org/2000/svg" id="anchor" xlink:href="./GatekeeperSelect.php" xmlns:xlink="http://www.w3.org/1999/xlink" target="_top"><rect x="0" y="0" width="100%" height="100%" fill-opacity="0"/></a>
		</svg><h1>&emsp;mugshot info</h1>
    </nav>
</div>
<div id="info" class="row">
EOT;
echo $head1;
// set up stegoImage png
$stegoImage = './ckimagesPNG/'. $_SESSION['mugshotFile'] .'.png';
$_SESSION['stegoImage'] = $stegoImage;
require ('/var/www/Storybook/htdocs/SteganographyKit-1.1.0/vendor/autoload.php');

$stegoContainer = new Picamator\SteganographyKit\StegoContainer();
$stegoSystem    = new Picamator\SteganographyKit\StegoSystem\SecretLsb();

// configure secret key
list($width, $height, $type, $attr) = getimagesize($stegoImage);
$secretKey = intval($width.$height);

$stegoKey  = new Picamator\SteganographyKit\StegoKey\RandomKey($secretKey);

$stegoSystem->setStegoKey($stegoKey);
$stegoContainer->setStegoSystem($stegoSystem);
$secretText = $stegoContainer->decode($stegoImage, $stegoKey);

echo '<h2>' . $secretKey . '</h2>';
echo '<p>' . $secretText . '</p>';
echo
    '</body></html>';
?>