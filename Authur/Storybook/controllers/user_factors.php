<?php
// disable error reporting for production code
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
// Start session
session_name("Storybook");
include("/var/www/session2DB/Zebra.php");
//	session_start();
// -----------------------
	
$head1 = <<< EOT1
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>User Factors</title>
	<meta name="viewport" content="width=device-width"/>
	<meta NAME="Last-Modified" content="
EOT1;
echo $head1;
echo date ("F d Y H:i:s.", getlastmod()).'">';
$head2 = <<< EOT2
	<meta name="description" content="user factors form">
	<meta name="copyright" content="Copyright 2022 by IsoBlock.com">
	<meta name="author" content="Bob Wright">
	<meta name="keywords" content="web page">
	<meta name="rating" content="general">
	<meta name="robots" content="index, follow"> 
	<base href="./">
	<!-- <link href="./css/bootstrap.css" rel="stylesheet" media="screen"> -->
	<link rel="stylesheet" href="../css/mdb.min.css">
	<link href="../css/SiteFonts.css" media="screen" rel="stylesheet" type="text/css"/>
	<link href="../css/ComicCreator.css" rel="stylesheet">
	<link href="../css/ComicBuilder.css" rel="stylesheet">
  <!-- <script type="text/javascript" src="./js/bootstrap.min.js"></script> -->
  <script type="text/javascript" src="../js/mdb.min.js"></script>
  <script type="text/javascript" src="../js/jquery.min.js"></script>
	<link rel="icon" href="../favicon.ico" type="image/ico">
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
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
.navtoc {width: 15vw; padding-right: .5vw; margin-right: 2vw; border: .4vw solid #b22222; background-color: #b0bec5;}
div.navtoc p {color: #005a9c; padding: 0.25vw; margin: 0; font-weight: bold}

EOT2;
echo $head2;

$head2a = <<< EOT2a
</style>
<main class="pageWrapper" id="container">
<h1 class="col px-sm-0" style="color:blue; text-align:center;">User Factors Options</h1>
<!-- quick display of info -->
<h2 class="col" style="color:purple; text-align:center; padding: 1vw;">This page collects your reply to a few "multiple choice answer" questions. The questions and answers allow the login process to later verify your answers to the same questions.</h2>
<div class="msgBox"><!-- headings font choice -->
<div style="opacity: 0;" class="card col-12 #929fba mdb-color lighten-3 px-sm-0"><br></div>
	<div class="card col-11 d-flex flex-column align-items-center shadow-md #b0bec5 blue-grey lighten-3 px-sm-0">
	<div class="card-body">
		<h2 style="color:red;">Please choose one answer from the selection provided for each question!</h2>
	</div></div>
<div style="opacity: 0;" class="card col-12 #929fba mdb-color lighten-3 px-sm-0"><br></div>
EOT2a;
echo $head2a;
/* =============== */

$colrs = <<< EOT3
<div class="row mx-1 d-flex col-12">
	<div class="card col-11 d-flex flex-column align-items-center shadow-md #b0bec5 blue-grey lighten-3 px-sm-0">
		<div id="fontColor" class="card-body"><h3>For the year of your birth</h3></div>
	</div>
	<div style="opacity: 0;" class="card col-12 #929fba mdb-color lighten-3 px-sm-0"><br></div>
			<div class="col-10 mb-4">
				<div class="color-block z-depth-2" style="background-color: LightBlue; color: black;" id="fc#FFFFFF"><label style="margin-left: 1vw;"><p><br><input id="fcid#FFFFFF" class="fcheckbox" type="checkbox" name="Fntcolor" />&emsp;&emsp;the year is an even number.</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightGray; color: black;" id="fc#FFFFFE"><label style="margin-left: 1vw;"><p><br><input id="fcid#D3D3D3" class="fcheckbox" type="checkbox" name="Fntcolor" />&emsp;&emsp;the year is an odd number.</p></label></div>
			</div>
<div style="opacity: 0;" class="card col-12 #929fba mdb-color lighten-3 px-sm-0"><br></div>
	<div class="card col-11 d-flex flex-column align-items-center shadow-md #b0bec5 blue-grey lighten-3 px-sm-0">
		<div id="fontColor2" class="card-body"><h3>For the month of your birth</h3></div>
	</div>
	<div style="opacity: 0;" class="card col-12 #929fba mdb-color lighten-3 px-sm-0"><br></div>
			<div class="col-10 mb-4">
				<div class="color-block z-depth-2" style="background-color: LightGray; color: black;" id="fc#FFFFFD"><label style="margin-left: 1vw;"><p><br><input id="fcid#FFFFFF" class="fcheckbox" type="checkbox" name="Fntcolor" />&emsp;&emsp;the month is an even month (February, April, June, August, October, or December).</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightBlue; color: black;" id="fc#FFFFFC"><label style="margin-left: 1vw;"><p><br><input id="fcid#D3D3D3" class="fcheckbox" type="checkbox" name="Fntcolor" />&emsp;&emsp;the month is an odd month (January, March, May, July, September, or November).</p></label></div>
			</div>
<div style="opacity: 0;" class="card col-12 #929fba mdb-color lighten-3 px-sm-0"><br></div>
	<div class="card col-11 d-flex flex-column align-items-center shadow-md #b0bec5 blue-grey lighten-3 px-sm-0">
		<div id="fontColor3" class="card-body"><h3>For the day of your birth</h3></div>
	</div>
	<div style="opacity: 0;" class="card col-12 #929fba mdb-color lighten-3 px-sm-0"><br></div>
			<div class="col-10 mb-4">
				<div class="color-block z-depth-2" style="background-color: LightGray; color: black;" id="fc#FFFFFB"><label style="margin-left: 1vw;"><p><br><input id="fcid#FFFFFF" class="fcheckbox" type="checkbox" name="Fntcolor" />&emsp;&emsp;the day is an even day (2, 4, 6, 8 etc.).</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightBlue; color: black;" id="fc#FFFFFA"><label style="margin-left: 1vw;"><p><br><input id="fcid#D3D3D3" class="fcheckbox" type="checkbox" name="Fntcolor" />&emsp;&emsp;the day is an odd day (1, 3, 5, 7 etc.).</p></label></div>
			</div>
<div style="opacity: 0;" class="card col-12 #929fba mdb-color lighten-3 px-sm-0"><br></div>
	<div class="card col-11 d-flex flex-column align-items-center shadow-md #b0bec5 blue-grey lighten-3 px-sm-0">
		<div id="fontColor4" class="card-body"><h3>Have you ever flown on an airplane?</h3></div>
	</div>
	<div style="opacity: 0;" class="card col-12 #929fba mdb-color lighten-3 px-sm-0"><br></div>
			<div class="col-10 mb-4">
				<div class="color-block z-depth-2" style="background-color: LightGray; color: black;" id="fc#FFFFFD"><label style="margin-left: 1vw;"><p><br><input id="fcid#FFFFFF" class="fcheckbox" type="checkbox" name="Fntcolor" />&emsp;&emsp;No I have not flown on an airplane.</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightBlue; color: black;" id="fc#FFFFFC"><label style="margin-left: 1vw;"><p><br><input id="fcid#D3D3D3" class="fcheckbox" type="checkbox" name="Fntcolor" />&emsp;&emsp;Yes I have flown on an airplane.</p></label></div>
			</div>
<div style="opacity: 0;" class="card col-12 #929fba mdb-color lighten-3 px-sm-0"><br></div>
	<div class="card col-11 d-flex flex-column align-items-center shadow-md #b0bec5 blue-grey lighten-3 px-sm-0">
		<div id="fontColor4" class="card-body"><h3>Can you swim or ride a bicycle?</h3></div>
	</div>
	<div style="opacity: 0;" class="card col-12 #929fba mdb-color lighten-3 px-sm-0"><br></div>
			<div class="col-10 mb-4">
				<div class="color-block z-depth-2" style="background-color: LightBlue; color: black;" id="fc#FFFFFD"><label style="margin-left: 1vw;"><p><br><input id="fcid#FFFFFF" class="fcheckbox" type="checkbox" name="Fntcolor" />&emsp;&emsp;No I cannot swim or ride a bicycle.</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightGray; color: black;" id="fc#FFFFFC"><label style="margin-left: 1vw;"><p><br><input id="fcid#D3D3D3" class="fcheckbox" type="checkbox" name="Fntcolor" />&emsp;&emsp;Yes I can both swim and ride a bicycle.</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightBlue; color: black;" id="fc#FFFFFD"><label style="margin-left: 1vw;"><p><br><input id="fcid#FFFFFF" class="fcheckbox" type="checkbox" name="Fntcolor" />&emsp;&emsp;I can swim but not ride a bicycle.</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightGray; color: black;" id="fc#FFFFFC"><label style="margin-left: 1vw;"><p><br><input id="fcid#D3D3D3" class="fcheckbox" type="checkbox" name="Fntcolor" />&emsp;&emsp;I can ride a bicycle but not swim.</p></label></div>
			</div>
<div style="opacity: 0;" class="card col-12 #929fba mdb-color lighten-3 px-sm-0"><br></div>
	<div class="card col-11 d-flex flex-column align-items-center shadow-md #b0bec5 blue-grey lighten-3 px-sm-0">
		<div id="fontColor4" class="card-body"><h3>Were you born near the ocean?</h3></div>
	</div>
	<div style="opacity: 0;" class="card col-12 #929fba mdb-color lighten-3 px-sm-0"><br></div>
			<div class="col-10 mb-4">
				<div class="color-block z-depth-2" style="background-color: LightGray; color: black;" id="fc#FFFFFD"><label style="margin-left: 1vw;"><p><br><input id="fcid#FFFFFF" class="fcheckbox" type="checkbox" name="Fntcolor" />&emsp;&emsp;No I was not born near the ocean.</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightBlue; color: black;" id="fc#FFFFFC"><label style="margin-left: 1vw;"><p><br><input id="fcid#D3D3D3" class="fcheckbox" type="checkbox" name="Fntcolor" />&emsp;&emsp;Yes I was born near the ocean.</p></label></div>
			</div>
<div style="opacity: 0;" class="card col-12 #929fba mdb-color lighten-3 px-sm-0"><br></div>
	<div class="card col-11 d-flex flex-column align-items-center shadow-md #b0bec5 blue-grey lighten-3 px-sm-0">
		<div id="fontColor4" class="card-body"><h3>Is the number of characters in your first name an odd or an even number?</h3></div>
	</div>
	<div style="opacity: 0;" class="card col-12 #929fba mdb-color lighten-3 px-sm-0"><br></div>
			<div class="col-10 mb-4">
				<div class="color-block z-depth-2" style="background-color: LightGray; color: black;" id="fc#FFFFFD"><label style="margin-left: 1vw;"><p><br><input id="fcid#FFFFFF" class="fcheckbox" type="checkbox" name="Fntcolor" />&emsp;&emsp;My first name has an odd number of characters.</p></label></div>
				<div class="color-block z-depth-2" style="background-color: LightBlue; color: black;" id="fc#FFFFFC"><label style="margin-left: 1vw;"><p><br><input id="fcid#D3D3D3" class="fcheckbox" type="checkbox" name="Fntcolor" />&emsp;&emsp;My first name has an even number of characters.</p></label></div>
			</div>
<div style="opacity: 0;" class="card col-12 #929fba mdb-color lighten-3 px-sm-0"><br></div>
	</div></div>
</div>
EOT3;
echo $colrs;
?>
<label style="margin-left: 2vw;">Save selections<br><input id="saveChoices" type="submit" value="Save Selections"></label></span>
</form><br>
</div>

	<footer class="d-flex col-12 flex-column align-items-center shadow-md #b0bec5 blue-grey lighten-3 px-sm-0 infoBox" style="margin-left:0;" id="GalleryFooter">
	<nav id="navFooter"><p>&nbsp;&copy; 2021 by&nbsp;<span><svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" viewBox="0 0 40.000000 40.000000" preserveAspectRatio="xMidYMid meet">
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
	</svg></span>&nbsp;<a href="mailto:bob_wright@isoblock.com">Bob Wright.</a>&nbsp;Last modified&emsp;<?php echo date ("F d Y H:i.", getlastmod()) ?>&emsp;<a id="nextpagebutton" href="./user_factors.php" title="chooser">Next ❯</a></p></nav>
	</footer>
<script>
$( document ).ready(function() {
var $defhfont = 'Roboto-Bold';
var $defpfont = 'Merriweather-Regular';
var $defccolr = 'blue-grey<br>#b0bec5';
var $bkgdef = $defccolr.substr(-7, 7);
var $deftcolr = 'black';
var $fcolr = $deftcolr;
var $hid = $defhfont;
var $pid = $defpfont;
var $panelid = $bkgdef;

// default CSS styles
$("#hfontval").html('@font-face {font-family: "'+$hid+'"; src: url("./Fonts/'+$hid+'.ttf") format("truetype");} h1 { font: 3vw '+$hid+'; color: '+ $deftcolr +';} h2 { font: 2.5vw '+$hid+'; color: '+ $deftcolr +';} h3 { font: 2.2vw '+$hid+'; color: '+ $deftcolr +';}');
$("#pfontval").html('@font-face {font-family: "'+$pid+'"; src: url("./Fonts/'+$pid+'.ttf") format("truetype");} .card-body, p { font: 2vw '+$pid+'; color: '+ $deftcolr +';} ');
$("#cbval").html('{background: '+ $bkgdef +';}');
// styles for the example box
$("#xmplhdgs").html('@font-face {font-family: "'+$hid+'"; src: url("./Fonts/'+$hid+'.ttf") format("truetype");} h1.xmplh { font: 3vw '+$hid+'; color: '+ $deftcolr +';} h2.xmplh { font: 2.5vw '+$hid+'; color: '+ $deftcolr +';} h3.xmplh { font: 2.2vw '+$hid+'; color: '+ $deftcolr +';}');
$("#xmplbody").html('@font-face {font-family: "'+$pid+'"; src: url("./Fonts/'+$pid+'.ttf") format("truetype");} p.xmplp { font: 2vw '+$pid+'; color: '+ $deftcolr +';}');
$("#xmplcbox").html('.xmplc {background: '+ $bkgdef +';}');

// checkbox changed?
$('input[type="checkbox"]').on('change', function() {
    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
	console.info(this.checked +" "+ this.id +" "+ this.name);
var $id = this.id;

// caption font color
if(this.name == "Fntcolor") {
	if(this.checked == true) {
		var $fpanelid = $id.substr(-7, 7);
			console.info($fpanelid);
		$fcolr = $fpanelid;
			console.info($fcolr);
	} else {
		$fcolr = $deftcolr;
	}}
// caption headings font
if(this.name == "Headings") {
	if(this.checked == true) {
		$hid = $id.substr(1);
	} else {
		$hid = $defhfont;
	}}
// caption paragraph font
if(this.name == "Bodytext") {
	if(this.checked == true) {
		$pid = $id.substr(1);
	} else {
		$pid = $defpfont;
	}}
// caption background color
if(this.name == "Capcolor") {
	if(this.checked == true) {
		$panelid = $id.substr(-7, 7);
	} else {
		$panelid = $bkgdef;
	}}

// save selections for captions, alt image captions, or both
if(this.name == "captChoices") {
	if(this.checked == true) {
		$captChoices = $id.substr(1);
	} else {
		$captChoices = "bothChoices";
	}}

	$("#hfontval").html('@font-face {font-family: "'+$hid+'"; src: url("./Fonts/'+$hid+'.ttf") format("truetype");} @media screen and (max-width: 576px) {   h1 { font: 5vw '+$hid+'; color: '+ $fcolr +';} h2 { font: 4vw '+$hid+'; color: '+ $fcolr +';} h3 { font: 3.5vw '+$hid+'; color: '+ $fcolr +';}} @media screen and (min-width: 577px) and (max-width: 1079px) {h1 { font: 4vw '+$hid+'; color: '+ $fcolr +';} h2 { font: 3.5vw '+$hid+'; color: '+ $fcolr +';} h3 { font: 3vw '+$hid+'; color: '+ $fcolr +';}}  @media screen and (min-width: 1080px) {h1 { font: 3vw '+$hid+'; color: '+ $fcolr +';} h2 { font: 2.5vw '+$hid+'; color: '+ $fcolr +';} h3 { font: 2.2vw '+$hid+'; color: '+ $fcolr +';}}');
	$("#xmplhdgs").html('@font-face {font-family: "'+$hid+'"; src: url("./Fonts/'+$hid+'.ttf") format("truetype");} h1.xmplh { font: 3vw '+$hid+'; color: '+ $fcolr +';} h2.xmplh { font: 2.5vw '+$hid+'; color: '+ $fcolr +';} h3.xmplh { font: 2.2vw '+$hid+'; color: '+ $fcolr +';}');
	$("#pfontval").html('@font-face {font-family: "'+$pid+'"; src: url("./Fonts/'+$pid+'.ttf") format("truetype");} @media screen and (max-width: 576px) {   .card-body, p { font: 3.5vw '+$pid+'; color: '+ $fcolr +';}} @media screen and (min-width: 577px) and (max-width: 1079px) { .card-body, p { font: 2.5vw '+$pid+'; color: '+ $fcolr +';}}  @media screen and (min-width: 1080px) { .card-body, p { font: 2vw '+$pid+'; color: '+ $fcolr +';}}');
	$("#xmplbody").html('@font-face {font-family: "'+$pid+'"; src: url("./Fonts/'+$pid+'.ttf") format("truetype");} p.xmplp { font: 2vw '+$pid+'; color: '+ $fcolr +';}');
	$("#xmplcbox").html('.xmplc {background: '+ $panelid +';}');
	$("#cbval").html('{background: '+ $panelid +';}');
});
});
</script>
</main>
</body>
</html>
