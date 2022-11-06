<?php
// disable this error reporting for production code
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

// Start session
session_name("Storybook");
//	@session_start(); // we use Zebra database sessions handler
require_once("/var/www/session2DB/Zebra.php");

// HTML head and styles section content
$htmltop = <<< html1
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pick a Mugshot</title>
	<!-- <base href="./"> -->
	<base href="./">
    <meta name="description" content="part of the Synthetic Reality Storybook comic book gallery">
    <meta name="author" content="Bob Wright and other contributors">
    <meta property="og:url" content="https://syntheticreality.net/Storybook/Portal/Demo.php" >
    <meta property="og:type" content="website" >
    <meta property="og:title" content= "Login Demo" >
    <meta property="og:description" content="An app by Bob Wright">
    <meta property="og:image" content="https://syntheticreality.net/Storybook/Portal/demoscreen.jpg" >
    <meta property="og:image:type"       content="image/jpg" >
    <meta property="og:image:width"      content="1800" >
    <meta property="og:image:height"     content="960" >
        <!-- Bootstrap core CSS -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
   <!--    <link rel="manifest" href="site.webmanifest"> -->
<script src="../js/jquery.min.js"></script>
<script src= "../js/bootstrap.min.js"></script>
	<link rel="icon" href="../favicon.ico" type="image/ico"/>
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
<style>
.pageWrapper:before {
    content: ' ';
    display: block;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
	background: salmon;
	z-index: -1;
    opacity: 0.2;
    background-image: url("./Blox1.png");
	background-position: top center;
    background-repeat: no-repeat;
    -ms-background-size: 100% 100%;
    -o-background-size: 100% 100%;
    -moz-background-size: 100% 100%;
    -webkit-background-size: 100% 100%;
    background-size: 100% 100%;
}
body {
width: 100%;
 font-size: 2.4vw;
 overflow-x: hidden;
}
main {
width: 100%;
}
h1 {
font-size: 4vw;
}
h2 {
font-size: 3.2vw;
}
h3 {
font-size: 2.6vw;
}
h4 {
font-size: 2vw;
}
.dice {
display: block;
max-height: 5vw;
margin-left: .3vw;
margin-top: -4.5vw;
padding: .2vw;
}
.oneDice {
  width: 3.5vw;
  background-color: white;
  border-radius: .5vw;
  }
.suspect {
max-height: 5vw;
margin: .1vw;
padding: .2vw;
/*transform: translateX(30%);*/
}
a:focus, a:hover {
  /*background-color: GreenYellow;*/
  	outline: .5vw solid GreenYellow;
	outline-offset: .1vw;
	cursor: pointer;
}
button:focus {
  background-color: GreenYellow;
  	outline: .5vw solid #b22242;
} 
</style>
</head>
<!-- Page display begins -->
<body class="pageWrapper">
<!--Main Navigation-->
<header id="anchor1">
  <nav style="background:#b0a2ff;" class="navbar">
    <div class="container d-flex justify-content-between col-10">
      <a id="navbarContent" href="Comics.php" class="navbar-brand d-flex align-items-center" title="return to Comics gallery">
		<svg version="1.0" xmlns="http://www.w3.org/2000/svg" class="bi-layout-wtf"
		 width="60.000000pt" height="42.000000pt" viewBox="0 0 60.000000 42.000000">
		<g transform="translate(0.000000,42.000000) scale(0.100000,-0.100000)"
		fill="blue" stroke="black" stroke-width="5">
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
		</g>
		</svg>
        <b style="color: blue;">&emsp;Synthetic Reality<br>&emsp;Storybook</b></a>
      <h1 style="color: black;" class="font-weight-bolder">Pick a demo sample gatekeeper.</h1>
    </div></nav>
</header>

<main role="main">
     <img class="sr-only" alt="The page has a random boxes pattern as a background image." width="1px" height="1px" src="../images/1x1pixel.png">
html1;
echo $htmltop; // display the HTML head and styles content above

// generate list of 3 digit radix6 dice triplet minute values
/*$minutesList = range(0,59); // one entry per minute value
    foreach ($minutesList as $key => $value) { // list of dice triplets
        $minsradix6[$key] = base_convert($value, 10, 6); // convert to base 6
        $minsStr = strval($minsradix6[$key]); // pad to 3 dice digits
        $minsPadded[$key] = str_pad($minsStr, 3, '0', STR_PAD_LEFT);
        // replace "0" dice digits with "6" so all dice are 1-6 in value
        $minsPadded[$key] = str_replace(0, 6, $minsPadded[$key]);
        // echo $minsPadded[$key] . ', '; // list of dice triplets as minutes
    }   unset($value);
        //$_SESSION["minsPadded"] = $minsPadded; */

// get and optionally display some values, IP and UC time
// get user ip address
include '/var/www/Storybook/htdocs/Portal/get_ip_address.php';
	// include '/var/www/Storybook/htdocs/controllers/get_ip_address.php';
	$link = get_ip_address();
  $_SESSION["link"] = $link;
// time strings
// get current minutes and three digit radix6 value
date_default_timezone_set("UTC");
$_SESSION["UTCticks"]  = time();
$ticks = time();
$timeString = date('y:m:d, h:i:s', $ticks);
$_SESSION["UTCtime"] = $timeString;
$timeArray = explode( ':', $timeString);
//print_r($timeArray);
$minutesToken = intval($timeArray[3]); // time in minutes
$_SESSION["minutesToken"] = $minutesToken;
// $_SESSION["minutesRadix6"] = $minsPadded[intval($minutesToken)];
// optionally display values
// headline banner below the header
echo '<div style="background:#f08000;" class="container d-flex justify-content-center col-10"><div class="text-center text-dark font-weight-bolder">';
echo '<h4>This browser\'s IP address is: ' . $link . '.&ensp;UCT Time at page load is: ' . date('y/m/d, h:i:s', $ticks) . '.</h4>';
// headline banner message
//echo '<h2>Note the spots on your gatekeeper\'s dice.</h2>';
echo '</div></div><br>';

include '/var/www/Storybook/htdocs/Portal/cknames.php';

echo '<div class="container flex-col col-11">'.
'<div class="row d-flex justify-content-center">';
// set up an array of ckNames filenames ck1 thru ckxxx
$namesIndex = range(1, count($ckNames));
for ($i = 0; $i < count($ckNames); $i++) {
  $imageFiles[$i] = 'ck' . $namesIndex[$i];
}
$_SESSION["imageFiles"] = $imageFiles;

// set up an array of ckNames
for ($i = 0; $i < count($ckNames); $i++) {
  $imageNames[$i] = $ckNames[$i];
}
$_SESSION["imageNames"] = $imageNames; // list of ckNames by index

// set up a shuffled image array
$imageIndex = range(0, count($ckNames) - 1);
//shuffle($imageIndex);
$_SESSION["imageIndex"] = $imageIndex; // scrambled list of index values

for ($i = 0; $i < count($ckNames); $i++) {
  $displayList[$i] = $imageNames[$imageIndex[$i]];
}
$_SESSION["displayList"] = $displayList; // list of gatekeeper names

for ($i = 0; $i < count($ckNames); $i++) {
  $displayFiles[$i] = $imageFiles[$imageIndex[$i]];
}
$_SESSION["displayFiles"] = $displayFiles; // list of gatekeeper file names

// set up an array of ckNames and ckfilenames ck1 thru ckxxx
$namesIndex = range(1, count($ckNames));
for ($i = 0; $i < count($ckNames); $i++) {
  $imageFiles[$i] = $displayFiles[$i];
  $imageNames[$i] = $displayList[$i];
  echo
    '<div class="col-2" style="padding-bottom: 1vw;"><a tabindex="0" href="./DemoSuspects.php?tile='. ($i + 1) .'&mug='.$imageNames[$i].'"><img src="./ckimages/'.$imageFiles[$i].'.jpg" width="100%" height="auto" alt="' .$imageNames[$i]. '"></a><h3>'.$imageNames[$i].'<br>'.$displayFiles[$i].'</h3></div>';
}
$_SESSION["imageFiles"] = $imageFiles;
$_SESSION["imageNames"] = $imageNames; // list of ckNames by index

echo '</div></div>';
echo '<div class="col12"><hr></div>';

echo '</main></body></html>';
?>