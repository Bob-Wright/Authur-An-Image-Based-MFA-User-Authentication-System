<?php
// disable this error reporting for production code
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

// Start session
session_name("Storybook");
//	@session_start(); // we use Zebra database sessions handler
require_once("/var/www/session2DB/Zebra.php");

// some test values may be replacedfrom query strings
      $showNames = 0; // default is no names display
      $_SESSION["showNames"] = $showNames;
 			 $_SESSION["ckName"] = 'Charley'; //default gatekeeper name
      //$fctrlist = explode(',',$_SESSION['factors']);
      //$_SESSION['ckName'] = $fctrlist[count($fctrlist) -1];

if(getenv('QUERY_STRING') != '') {
	// parse query
	$qstring = getenv('QUERY_STRING');
	// echo '<p>'.$qstring.'</p>';
	parse_str($qstring, $pstrings);
	// see if valid URL query string keys
		if(array_key_exists('mug', $pstrings)) { // temp user name
			$mug = $pstrings['mug'];
			$_SESSION["ckName"] = $mug;
		}
		if(array_key_exists('N', $pstrings)) { //show mugshot names below images?
			$showNames = $pstrings['N'];
			$_SESSION["showNames"] = $showNames;
		}
}
// HTML head and styles section content
$htmltop = <<< html1
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Storybook Mugshots</title>
	<!-- <base href="./"> -->
	<base href="./">
    <meta name="description" content="part of the Synthetic Reality Storybook comic book gallery">
    <meta name="author" content="Bob Wright and other contributors">
    <!-- Bootstrap core CSS -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
   <!--    <link rel="manifest" href="site.webmanifest"> -->
	<link rel="icon" href="./favicon.ico" type="image/ico"/>
	<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"/>
<script src="../js/jquery.min.js"></script>
<script src= "../js/bootstrap.min.js"></script>
<style>
.pageWrapper:before {
    content: ' ';
    display: block;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
/*	background: #008; */
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
      <a id="navbarContent" href="https://syntheticreality.net/Storybook/Portal/Demo.php" class="navbar-brand d-flex align-items-center" title="return to Login Portal">
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
      <h1 style="color: black;" class="font-weight-bolder">Note the spots on your gatekeeper's dice.</h1>
    </div></nav>
</header>

<main role="main">
     <img class="sr-only" alt="The page has a rock wall pattern as a background image." width="1px" height="1px" src="../images/1x1pixel.png">
html1;
echo $htmltop; // display the HTML head and styles content above

// generate list of 3 digit radix6 dice triplet minute values
$minutesList = range(0,59); // one entry per minute value
    foreach ($minutesList as $key => $value) { // list of dice triplets
        $minsradix6[$key] = base_convert($value, 10, 6); // convert to base 6
        $minsStr = strval($minsradix6[$key]); // pad to 3 dice digits
        $minsPadded[$key] = str_pad($minsStr, 3, '0', STR_PAD_LEFT);
        // replace "0" dice digits with "6" so all dice are 1-6 in value
        $minsPadded[$key] = str_replace(0, 6, $minsPadded[$key]);
        // echo $minsPadded[$key] . ', '; // list of dice triplets as minutes
    }   unset($value);
        //$_SESSION["minsPadded"] = $minsPadded;

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
$_SESSION["minutesRadix6"] = $minsPadded[intval($minutesToken)];
// optionally display values
// headline banner below the header
//echo '<div style="background:#f3ff86;" class="container d-flex justify-content-center col-10"><div class="text-center text-dark font-weight-bolder">';
//echo '<h4>This browser\'s IP address is: ' . $link . '.&ensp;UCT Time is: ' . $timeString . '.</h4>';
// headline banner message
//echo '<h2>Note the spots on your gatekeeper\'s dice.</h2>';
//echo '</div></div><br>';

$ckName = $_SESSION["ckName"];

include '/var/www/Storybook/htdocs/Portal/cknames.php';

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
shuffle($imageIndex);
$_SESSION["imageIndex"] = $imageIndex; // scrambled list of index values

for ($i = 0; $i < count($ckNames); $i++) {
  $displayList[$i] = $imageNames[$imageIndex[$i]];
}
$_SESSION["displayList"] = $displayList; // full length lists

for ($i = 0; $i < count($ckNames); $i++) {
  $displayFiles[$i] = $imageFiles[$imageIndex[$i]];
}
$_SESSION["displayFiles"] = $displayFiles;

// find our chosen image index in shuffled image array
$ckName = $_SESSION["ckName"];
$srcIndex = 0;
for ($i = 0; $i < count($ckNames); $i++) {
    if ($displayList[$i] == $ckName) { // name match?
        $srcIndex = $i;
    }
  }
$_SESSION["srcIndex"] = $srcIndex;// source index for chosen name / image

// be sure our chosen name / image appears in the gallery
$targetIndex = $srcIndex;
if ($srcIndex >= 12) { // if index already in first 12 done else
    // in successive sets of twelve replace by modulo
    $indexInterval = floor(intval($srcIndex) / 12);
    $targetIndex = $srcIndex - ($indexInterval * 12);
}
$_SESSION["targetIndex"] = $targetIndex;// new index for chosen name / image
$displayList[$targetIndex] = $displayList[$srcIndex];
$displayFiles[$targetIndex] = $displayFiles[$srcIndex];

$displayList = array_slice($displayList, 0, 12);
$_SESSION["displayList"] = $displayList;
$displayFiles = array_slice($displayFiles, 0, 12);
$_SESSION["displayFiles"] = $displayFiles;

 // get a random array of 12 minute values
$diceOrder = array_rand($minsPadded, 12);
// $_SESSION["diceOrder"] = $diceOrder; //before the swap check
// see if one of the random diceOrder value matches the minutes value
    $counter = 1;
    $matched = 0;
for ($i = 0; $i < count($diceOrder); $i++) {
    if ($diceOrder[$i] == $minutesToken) { // time value match?
            $srcDiceIndex = $counter;
            $matched = 1;
    }
  }
    $counter++;
    $targetDiceIndex = $targetIndex; // target image index becomes
    $_SESSION["targetDiceIndex"] = $targetDiceIndex;

    if ($matched == 1) { // if we have a match swap the values
      $_SESSION["srcDiceIndex"] = $srcDiceIndex;// index for chosen name / image
      $diceTemp = $diceOrder[$targetDiceIndex];
      $diceOrder[$targetDiceIndex] = $diceOrder[$srcDiceIndex];
      $diceOrder[$srcDiceIndex] = $diceTemp;
    } else {
      $diceOrder[$targetDiceIndex] = $minutesToken;
    }
$_SESSION["diceOrder"] = $diceOrder; // dice values after the swap check
// diceOrder array to index into an array of radix 6 three digit values
// create an array of 3 value entries to then represent with three dice
for ($i = 0; $i < count($diceOrder); $i++) {
    $triplets[$i] = $minsPadded[$diceOrder[$i]];
    $diceImages[$i][0] = substr($triplets[$i], 0, 1); // get the first dice image
    $diceImages[$i][1] = substr($triplets[$i], 1, 1); // get the second dice image
    $diceImages[$i][2] = substr($triplets[$i], 2, 1); // get the third dice image
  }
$_SESSION["triplets"] = $triplets; // the radix6 value of the diceOrder entry
$_SESSION["diceImages"] = $diceImages; // dice images array

// displays a list of the dice image triplets
/*
for ($i = 0; $i < count($diceOrder); $i++) { //display list of dice image triplets
echo     '&nbsp;<img src="dice' . $diceImages[$i][0] . '.svg" class="oneDice">&nbsp;<img src="dice' . $diceImages[$i][1] . '.svg" class="oneDice">&nbsp;<img src="dice' . $diceImages[$i][2] . '.svg" class="oneDice"><br>'; }
    //$_SESSION["diceImage"] = $triplets;
*/
// display a random mugshots gallery of first 12 entries from the imageOrder
// display the first 4 entries from the imageOrder shuffle
$imgTable1 = '<div class="container flex-col col-11">'.
'<div class="row d-flex justify-content-center">'.
'<a tabindex="0" class="col" href="./DemoMugshot.php?tile=1&mug='.$displayFiles[0].'&token='.$diceOrder[0].'&dice=' . $diceImages[0][0] . $diceImages[0][1] . $diceImages[0][2] . '"><img src="./ckimages/'.$displayFiles[0].'.jpg" width="100%" height="auto" alt="' .$displayList[0].'"></a>'.
'<a  tabindex="0" class="col" href="./DemoMugshot.php?tile=2&mug='.$displayFiles[1].'&token='.$diceOrder[1].'&dice=' . $diceImages[1][0] . $diceImages[1][1] . $diceImages[1][2] . '"><img src="./ckimages/'.$displayFiles[1].'.jpg" width="100%" height="auto" alt="' .$displayList[1].'"></a>'.
'<a  tabindex="0" class="col" href="./DemoMugshot.php?tile=3&mug='.$displayFiles[2].'&token='.$diceOrder[2].'&dice=' . $diceImages[2][0] . $diceImages[2][1] . $diceImages[2][2] . '"><img src="./ckimages/'.$displayFiles[2].'.jpg" width="100%" height="auto" alt="' .$displayList[2].'"></a>'.
'<a  tabindex="0" class="col" href="./DemoMugshot.php?tile=4&mug='.$displayFiles[3].'&token='.$diceOrder[3].'&dice=' . $diceImages[3][0] . $diceImages[3][1] . $diceImages[3][2] . '"><img src="./ckimages/'.$displayFiles[3].'.jpg" width="100%" height="auto" alt="' .$displayList[3].'"></a>'.
'</div>'.
// display first 4 random shuffled dice pairs
'<div class="row d-flex justify-content-center">'.
'<div class="col dice" title="">&nbsp;<img src="./dice/dice' . $diceImages[0][0] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[0][1] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[0][2] . '.svg" class="oneDice"></div>'.
'<div class="col dice" title="">&nbsp;<img src="./dice/dice' . $diceImages[1][0] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[1][1] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[1][2] . '.svg" class="oneDice"></div>'.
'<div class="col dice" title="">&nbsp;<img src="./dice/dice' . $diceImages[2][0] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[2][1] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[2][2] . '.svg" class="oneDice"></div>'.
'<div class="col dice" title="">&nbsp;<img src="./dice/dice' . $diceImages[3][0] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[3][1] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[3][2] . '.svg" class="oneDice"></div>'.
'</div>';
// display the mughshot name below the image
$namesTable1 =
'<div class="row d-flex justify-content-center">'.
'<div class="col suspect" title=""><h3>&ensp;'.$displayList[0].'</h3></div>'.
'<div class="col suspect" title=""><h3>&ensp;'.$displayList[1].'</h3></div>'.
'<div class="col suspect" title=""><h3>&ensp;'.$displayList[2].'</h3></div>'.
'<div class="col suspect" title=""><h3>&ensp;'.$displayList[3].'</h3></div>'.
'</div>';

// display the next 4 entries from the imageOrder shuffle
$imgTable2 = '<div class="row d-flex justify-content-center">'.
'<a tabindex="0" class="col" href="./DemoMugshot.php?tile=5&mug='.$displayFiles[4].'&token='.$diceOrder[4].'&dice=' . $diceImages[4][0] . $diceImages[4][1] . $diceImages[4][2] . '"><img src="./ckimages/'.$displayFiles[4].'.jpg" width="100%" height="auto" alt="' .$displayList[4].'"></a>'.
'<a tabindex="0" class="col" href="./DemoMugshot.php?tile=6&mug='.$displayFiles[5].'&token='.$diceOrder[5].'&dice=' . $diceImages[5][0] . $diceImages[5][1] . $diceImages[5][2] . '"><img src="./ckimages/'.$displayFiles[5].'.jpg" width="100%" height="auto" alt="' .$displayList[5].'"></a>'.
'<a tabindex="0" class="col" href="/DemoMugshot.php?tile=7&mug='.$displayFiles[6].'&token='.$diceOrder[6]. '&dice=' . $diceImages[6][0] . $diceImages[6][1] . $diceImages[6][2] . '"><img src="./ckimages/'.$displayFiles[6].'.jpg" width="100%" height="auto" alt="' .$displayList[6].'"></a>'.
'<a tabindex="0" class="col" href="./DemoMugshot.php?tile=8&mug='.$displayFiles[7].'&token='.$diceOrder[7].'&dice=' . $diceImages[7][0] . $diceImages[7][1] . $diceImages[7][2] . '"><img src="./ckimages/'.$displayFiles[7].'.jpg" width="100%" height="auto" alt="' .$displayList[7].'"></a>'.
'</div>'.
// display next 4 random shuffled dice
'<div class="row d-flex justify-content-center">'.
'<div class="col dice" title="">&nbsp;<img src="./dice/dice' . $diceImages[4][0] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[4][1] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[4][2] . '.svg" class="oneDice"></div>'.
'<div class="col dice" title="">&nbsp;<img src="./dice/dice' . $diceImages[5][0] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[5][1] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[5][2] . '.svg" class="oneDice"></div>'.
'<div class="col dice" title="">&nbsp;<img src="./dice/dice' . $diceImages[6][0] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[6][1] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[6][2] . '.svg" class="oneDice"></div>'.
'<div class="col dice" title="">&nbsp;<img src="./dice/dice' . $diceImages[7][0] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[7][1] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[7][2] . '.svg" class="oneDice"></div>'.
'</div>';
// display the mughshot name below the image
$namesTable2 = '<div class="row d-flex justify-content-center">'.
'<div class="col suspect" title=""><h3>&ensp;'.$displayList[4].'</h3></div>'.
'<div class="col suspect" title=""><h3>&ensp;'.$displayList[5].'</h3></div>'.
'<div class="col suspect" title=""><h3>&ensp;'.$displayList[6].'</h3></div>'.
'<div class="col suspect" title=""><h3>&ensp;'.$displayList[7].'</h3></div>'.
'</div>';
// display the next 4 entries from the imageOrder shuffle
$imgTable3 = '<div class="row d-flex justify-content-center">'.
'<a tabindex="0" class="col" href="./DemoMugshot.php?tile=9&mug='.$displayFiles[8].'&token='.$diceOrder[8].'&dice=' . $diceImages[8][0] . $diceImages[8][1] . $diceImages[8][2] . '"><img src="./ckimages/'.$displayFiles[8].'.jpg" width="100%" height="auto" alt="' .$displayList[8].'"></a>'.
'<a tabindex="0" class="col" href="./DemoMugshot.php?tile=10&mug='.$displayFiles[9].'&token='.$diceOrder[9].'&dice=' . $diceImages[9][0] . $diceImages[9][1] . $diceImages[9][2] . '"><img src="./ckimages/'.$displayFiles[9].'.jpg" width="100%" height="auto" alt="' .$displayList[9].'"></a>'.
'<a tabindex="0" class="col" href="./DemoMugshot.php?tile=11&mug='.$displayFiles[10].'&token='.$diceOrder[10].'&dice=' . $diceImages[10][0] . $diceImages[10][1] . $diceImages[10][2] . '"><img src="./ckimages/'.$displayFiles[10].'.jpg" width="100%" height="auto" alt="' .$displayList[10].'"></a>'.
'<a tabindex="0" class="col" href="./DemoMugshot.php?tile=12&mug='.$displayFiles[11].'&token='.$diceOrder[11].'&dice=' . $diceImages[11][0] . $diceImages[11][1] . $diceImages[11][2] . '"><img src="./ckimages/'.$displayFiles[11].'.jpg" width="100%" height="auto" alt="' .$displayList[11].'"></a>'.
'</div>'.
// display next 4 random shuffled dice
'<div class="row d-flex justify-content-center">'.
'<div class="col dice" title="">&nbsp;<img src="./dice/dice' . $diceImages[8][0] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[8][1] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[8][2] . '.svg" class="oneDice"></div>'.
'<div class="col dice" title="">&nbsp;<img src="./dice/dice' . $diceImages[9][0] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[9][1] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[9][2] . '.svg" class="oneDice"></div>'.
'<div class="col dice" title="">&nbsp;<img src="./dice/dice' . $diceImages[10][0] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[10][1] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[10][2] . '.svg" class="oneDice"></div>'.
'<div class="col dice" title="">&nbsp;<img src="./dice/dice' . $diceImages[11][0] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[11][1] . '.svg" class="oneDice">&nbsp;<img src="./dice/dice' . $diceImages[11][2] . '.svg" class="oneDice"></div>'.
'</div>';
// display the mughshot name below the image
$namesTable3 ='<div class="row d-flex justify-content-center">'.
'<div class="col suspect" title=""><h3>&ensp;'.$displayList[8].'</h3></div>'.
'<div class="col suspect" title=""><h3>&ensp;'.$displayList[9].'</h3></div>'.
'<div class="col suspect" title=""><h3>&ensp;'.$displayList[10].'</h3></div>'.
'<div class="col suspect" title=""><h3>&ensp;'.$displayList[11].'</h3></div>'.
'</div>';
// document.getElementById('imgTable').innerHTML = imgTable;
echo $imgTable1;
if ($showNames == 1) {
  echo $namesTable1;
}
echo '<div class="col12"><hr></div>';
echo $imgTable2;
if ($showNames == 1) {
  echo $namesTable2;
}
echo '<div class="col12"><hr></div>';
echo $imgTable3;
if ($showNames == 1) {
  echo $namesTable3;
}
echo '<div class="col12"><hr></div>';

echo '</main></body></html>';
?>