<?php
// disable this error reporting for production code
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

// Start session
session_name("Storybook");
//	@session_start(); // we use Zebra database sessions handler
require("/var/www/session2DB/Zebra.php");

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
	<link rel="icon" href="../favicon.ico" type="image/ico"/>
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
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
input:focus, input:hover {
  /*background-color: GreenYellow;*/
  	outline: .5vw solid GreenYellow;
	outline-offset: .1vw;
	cursor: pointer;
}
button.gallery {
background: rgba(0,0,0,0);
border: 0;
}
button:focus, button:hover {
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
      <a id="navbarContent" href="https://syntheticreality.net/Storybook/controllers/logout.php" class="navbar-brand d-flex align-items-center" title="return to Login Portal">
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
      <h1 style="color: black;" class="font-weight-bolder">Select your gatekeeper</h1>
    </div></nav>
</header>

<main class="container" role="main">
     <img class="sr-only" alt="The page has a rock wall pattern as a background image." width="1px" height="1px" src="../images/1x1pixel.png">

  <!-- headline banner message below the header -->
<div style="background:#f3ff86;" class="row d-flex justify-content-center">
  <div class="text-center text-dark font-weight-bolder">
    <h2 style="color: blue;">You have successfully verified your Email address!</h2>
  </div>
  <div class="text-left text-dark font-weight-bolder">
    <h3>As the last step in the Storybook user registration you must choose one of the NFT images from the gallery below to serve as your future "gatekeeper".<br>The image you choose will be used as part of the NFTimage AuthUR MFA logon procedure.<br>Choose an image that you will later be able to easily recognize and select from among a gallery of images similar to this gallery.</h3>
  </div>
</div><br>
html1;
echo $htmltop; // display the HTML head and styles content above

// get the image gallery names list data file
include '/var/www/Storybook/htdocs/Portal/cknames.php';

// default is no names are displayed in gallery
$_SESSION["showNames"] = 0;
/*
$_SESSION["gatekeeper"] = 'itzbobwright'; // for the demo
$_SESSION["email"] = 'itzbobwright@gmail.com'; // for the demo
*/
// the actual array has 13 names, we only use twelve
$gatekeeper = $_SESSION["gatekeeper"];
$namesCount = count($ckNFTNames) - 1;
if($gatekeeper == 'itzbobwright') { // this exception trap is for the demo
    $baseIndex = 144; // use the first 12 including 144
    $_SESSION["ckName"] = 'Bob';
} else {
    $baseIndex = 145; // use the last 12 excluding 144
    $_SESSION["ckName"] = '';
}

// set up an array of ckNFTNames filenames ckxxx thru ckyyy
$namesIndex = range($baseIndex, $baseIndex + $namesCount);
for ($i = 0; $i < $namesCount; $i++) {
  $imageFiles[$i] = 'ck' . $namesIndex[$i];
}
$_SESSION["imageFiles"] = $imageFiles;

// set up an array of ckNFTNames
for ($i = 0; $i < $namesCount; $i++) {
  $imageNames[$i] = $ckNFTNames[$i];
}
$_SESSION["imageNames"] = $imageNames; // list of ckNFTNames by index

// set up a shuffled image array
$imageIndex = range(0, $namesCount - 1);
shuffle($imageIndex);
$_SESSION["imageIndex"] = $imageIndex; // scrambled list of index values

for ($i = 0; $i < $namesCount; $i++) {
  $displayList[$i] = $imageNames[$imageIndex[$i]];
}
$_SESSION["displayList"] = $displayList; // full length lists

for ($i = 0; $i < $namesCount; $i++) {
  $displayFiles[$i] = $imageFiles[$imageIndex[$i]];
}
$_SESSION["displayFiles"] = $displayFiles;

// find our chosen image index in shuffled image array
$ckName = $_SESSION["ckName"];
$srcIndex = 0;
for ($i = 0; $i < $namesCount; $i++) {
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

echo
'<div class="container flex-col col-11">'.
	'<form action="./mugshotChoice.php" method="post" enctype="text">'.
  //'<form action="https://messenga.net:8080/keygen" method="post" enctype="text">'.
    '<input hidden type="text" name="email" value="'.$_SESSION["email"].'"></input>'.
  '<div class="form-group">'.
  '<div class="row d-flex justify-content-center">'.
    '<button class="col-3 gallery" type="submit" name="imageName" value="'.$displayList[0].'"><img src="./ckimages/'.$displayFiles[0].'.jpg" width="100%" height="auto" alt="' .$displayList[0].'"></button>'.
    '<button class="col-3 gallery" type="submit" name="imageName" value="'.$displayList[1].'"><img src="./ckimages/'.$displayFiles[1].'.jpg" width="100%" height="auto" alt="' .$displayList[1].'"></button>'.
    '<button class="col-3 gallery" type="submit" name="imageName" value="'.$displayList[2].'"><img src="./ckimages/'.$displayFiles[2].'.jpg" width="100%" height="auto" alt="' .$displayList[2].'"></button>'.
    '<button class="col-3 gallery" type="submit" name="imageName" value="'.$displayList[3].'"><img src="./ckimages/'.$displayFiles[3].'.jpg" width="100%" height="auto" alt="' .$displayList[3].'"></button>'.
    /*'<a tabindex="0" class="col" href="./mugshot.php?tile=1&mug='.$displayFiles[0].'"><img src="./ckimages/'.$displayFiles[0].'.jpg" width="100%" height="auto" alt="' .$displayList[0].'"></a>'.*/
  '</div>';
    if ($_SESSION["showNames"] == 1) { // default is no names display
echo
  '<div class="row d-flex justify-content-center">'.
      '<div class="col suspect" title=""><h3>&ensp;'.$displayList[0].'</h3></div>'.
      '<div class="col suspect" title=""><h3>&ensp;'.$displayList[1].'</h3></div>'.
      '<div class="col suspect" title=""><h3>&ensp;'.$displayList[2].'</h3></div>'.
      '<div class="col suspect" title=""><h3>&ensp;'.$displayList[3].'</h3></div>'.
  '</div>';
    }
    echo '<div class="col12"><hr></div>';
    echo
  '<div class="row d-flex justify-content-center">'.
    '<button class="col-3 gallery" type="submit" name="imageName" value="'.$displayList[4].'"><img src="./ckimages/'.$displayFiles[4].'.jpg" width="100%" height="auto" alt="' .$displayList[4].'"></button>'.
    '<button class="col-3 gallery" type="submit" name="imageName" value="'.$displayList[5].'"><img src="./ckimages/'.$displayFiles[5].'.jpg" width="100%" height="auto" alt="' .$displayList[5].'"></button>'.
    '<button class="col-3 gallery" type="submit" name="imageName" value="'.$displayList[6].'"><img src="./ckimages/'.$displayFiles[6].'.jpg" width="100%" height="auto" alt="' .$displayList[6].'"></button>'.
    '<button class="col-3 gallery" type="submit" name="imageName" value="'.$displayList[7].'"><img src="./ckimages/'.$displayFiles[7].'.jpg" width="100%" height="auto" alt="' .$displayList[7].'"></button>'.
  '</div>';
    if ($_SESSION["showNames"] == 1) {
echo
  '<div class="row d-flex justify-content-center">'.
    '<div class="col suspect" title=""><h3>&ensp;'.$displayList[4].'</h3></div>'.
    '<div class="col suspect" title=""><h3>&ensp;'.$displayList[5].'</h3></div>'.
    '<div class="col suspect" title=""><h3>&ensp;'.$displayList[6].'</h3></div>'.
    '<div class="col suspect" title=""><h3>&ensp;'.$displayList[7].'</h3></div>'.
  '</div>';
    }
    echo '<div class="col12"><hr></div>';
    echo
  '<div class="row d-flex justify-content-center">'.
    '<button class="col-3 gallery" type="submit" name="imageName" value="'.$displayList[8].'"><img src="./ckimages/'.$displayFiles[8].'.jpg" width="100%" height="auto" alt="' .$displayList[8].'"></button>'.
    '<button class="col-3 gallery" type="submit" name="imageName" value="'.$displayList[9].'"><img src="./ckimages/'.$displayFiles[9].'.jpg" width="100%" height="auto" alt="' .$displayList[9].'"></button>'.
    '<button class="col-3 gallery" type="submit" name="imageName" value="'.$displayList[10].'"><img src="./ckimages/'.$displayFiles[10].'.jpg" width="100%" height="auto" alt="' .$displayList[10].'"></button>'.
    '<button class="col-3 gallery" type="submit" name="imageName" value="'.$displayList[11].'"><img src="./ckimages/'.$displayFiles[11].'.jpg" width="100%" height="auto" alt="' .$displayList[11].'"></button>'.
  '</div>';
    if ($_SESSION["showNames"] == 1) {
      echo
  '<div class="row d-flex justify-content-center">'.
    '<div class="col suspect" title=""><h3>&ensp;'.$displayList[8].'</h3></div>'.
    '<div class="col suspect" title=""><h3>&ensp;'.$displayList[9].'</h3></div>'.
    '<div class="col suspect" title=""><h3>&ensp;'.$displayList[10].'</h3></div>'.
    '<div class="col suspect" title=""><h3>&ensp;'.$displayList[11].'</h3></div>'.
  '</div>';
    }
    echo '<div class="col12"><hr></div>';
echo
  '</div></form>'.
'</div>';
echo '</main></body></html>';
?>