<?php
/*
 * filename: dumpSession.php
 * this code displays selected Session data for debug
 * some options are invoked by the query string
 * the option usage is displayed if no query string is used
 * this needs PHP version 5.4 or better but we don't check
*/

// enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

if(session_status() === PHP_SESSION_DISABLED) {
	echo
	'<html><head></head><body>'.
	'<h2>Sessions are Disabled!</h2>'.
	'</body></html>';
	exit;
}

// start the page display
echo
'<html><head>'.
'<style>'.
'*, *:before, *:after, html {box-sizing: border-box;}'.
'body {font-weight: 400; background-color: #EEEFFF; font-size: 1.6vw; width: 100%; height: 100%;}'.
'span {color: FireBrick;}'.
'</style>'.
'</head><body>'.
'<h1 style="color: MediumBlue;">dumpSession</h1>';
	
	// process options query string?
	// default values
	$Ckie = 'N';
	$Sess = 'Y';
	$Srvr = 'N';
	$Glbl = 'N';
	$All = 'N';
	$Sname = '';
	$Sstrt = 'N';
	$Sinfo = 'N';
	$Zebra = 'Y';
	$Brwsr = 'N';
	if(getenv('QUERY_STRING') == '') {
		echo
		'<p><b>Options are available by query strings.</b><br>'.
		'Use <span><b>dumpSession.php?help</b></span> to display the options.</p>';
	}
	if(getenv('QUERY_STRING') != '') {
		// parse query
		$qstring = getenv('QUERY_STRING');
		// echo '<p>'.$qstring.'</p>';
		parse_str($qstring, $pstrings);
		// see if valid URL query string
		if(array_key_exists('Ckie', $pstrings)) {
			$Ckie = $pstrings['Ckie'];} // display COOKIE data
		if(array_key_exists('Sess', $pstrings)) {
			$Sess = $pstrings['Sess'];} // display SESSION data
		if(array_key_exists('Srvr', $pstrings)) {
			$Srvr = $pstrings['Srvr'];} // display SERVER data
		if(array_key_exists('Glbl', $pstrings)) {
			$Glbl = $pstrings['Glbl'];} // display GLOBALS data
		if(array_key_exists('All', $pstrings)) {
			$All = $pstrings['All'];}
		if(array_key_exists('Sname', $pstrings)) {
			$Sname = $pstrings['Sname'];} // desired session_name
		if(array_key_exists('Sstrt', $pstrings)) {
			$Sstrt = $pstrings['Sstrt'];} // do we start Sname session if none are active?
		if(array_key_exists('Sinfo', $pstrings)) {
			$Sinfo = $pstrings['Sinfo'];} // display SESSION join steps?
		if(array_key_exists('Zebra', $pstrings)) {
			$Zebra = $pstrings['Zebra'];} // display SESSION join steps?
		if(array_key_exists('Brwsr', $pstrings)) {
			$Brwsr = $pstrings['Brwsr'];} // display browser Navigator data?
		if(array_key_exists('help', $pstrings)) {
			echo
			'<p><b>These options are available by query strings:</b><br>'.
			'The $_COOKIE array is not shown by default.<br>'.
			'Use <span><b>Ckie=Y</b></span> to display the $_COOKIE array.<br>'.
			'The REQUEST, GET, POST, FILES, and ENV arrays are not shown by default.<br>'.
			'Use <span><b>All=Y</b></span> to display the REQUEST, GET, POST, FILES, and ENV arrays.<br>'.
			'The SESSION array is shown by default.<br>'.
			'Use <span><b>Sess=N</b></span> to disable showing the SESSION array.<br>'.
			'The SERVER array is not shown by default.<br>'.
			'Use <span><b>Srvr=Y</b></span> to display the SERVER array.<br>'.
			'The GLOBALS array is not shown by default.<br>'.
			'Use <span><b>Glbl=Y</b></span> to display the GLOBALS array.<br>'.
			'Use <span><b>Sname=name-of-session</b></span> you want to start or join with dumpSession.<br>'.
			'Use <span><b>Sstrt=Y</b></span> to allow dumpSession to start a Requested Session Name.<br>'.
			'Use <span><b>Sinfo=Y</b></span> to show verbose session join. <br>'.
			'By default dumpSession uses the <b>Zebra database session handler</b><br>'.
			'Use <span><b>Zebra=N</b></span> to use the PHP default session handler.<br>'.
			'Examples<br>'.
			'<span><b>dumpSession.php</b></span><br>'.
			'will display the default arrays.<br>'.
			'<span><b>dumpSession.php?Glbl=Y&Sname=Storybook</b></span><br>'.
			'will display the GLOBALS array and the default arrays and join the Storybook SESSION<br>'.
			'if the domain already has an active Session with that name.<br>'.
			'<span><b>dumpSession.php?Sname=NewBoy&Sstrt=Y</b></span><br>'.
			'will display the default arrays and start a session named <b>Newboy</b><br>'.
			'or join the <b>NewBoy</b> session if domain already has active Session with that name.</p>';
		} else {
			echo
			'<p><b>Options are available by query strings.</b><br>'.
			'Use <span><b>dumpSession.php?help</b></span> to display the options.</p>';
		}
	}

	$cookieName = '';
	$cookieKeys = array();
	$cookieValues = array();
	// show if no COOKIE array info
	if(empty($_COOKIE)) {
		echo '<span><b>No $_COOKIE data is present.</b></span>';
	} else {
	if($Ckie == 'Y') { 	// show COOKIE array info?

		// echo '<pre><b>COOKIE</b> ';print_r($_COOKIE);
		//echo '<br>';
		// explode the cookie array
		echo '<pre><b>COOKIE Array Values</b>';echo var_dump($_COOKIE);echo '</pre>';
		echo '<pre><b>HTTP_COOKIE Array Values</b><br>';echo var_dump($_SERVER['HTTP_COOKIE']);echo '</pre>';
		// handle COOKIE array info
		// echo '<b>All $_COOKIE keys </b>';print_r(array_keys($_COOKIE, !NULL));echo '</pre>';
	}
	$cookieKeys = array_keys($_COOKIE);
		$cookieValues = array_values($_COOKIE);
		$cookieName = $cookieKeys[0];
	if($Ckie == 'Y') { 	// show COOKIE array info?
		echo '<pre><b>$_COOKIE keys </b>';var_dump($cookieKeys);echo '</pre>';
		echo '<pre><b>$_COOKIE values </b>';var_dump($cookieValues);echo '</pre>';
	}
	if(count(array_keys($_COOKIE)) == 1) {
		 // if we have current cookie info this is session_name
		echo '<b>There is one $_COOKIE key named <span>' . $cookieName . '</b></span><br>';
		if($Sname == '') {
			echo
			'No Requested Session Name query, using the COOKIE key value.<br>';
			$SessionName = $cookieName;
		}
		if(($Sname != '') && ($Sname != $cookieName)) {
			echo
			'Requested Session Name is not the same as the COOKIE key. Using the Requested Session Name.<br>';
			$SessionName = $Sname;
		}
		if($Sname == $cookieName) {
			echo
			'Requested Session Name is the same as the COOKIE key. No Changes.<br>';
			$SessionName = $cookieName;
		}
	} else {
		echo
		'<b>There are Multiple Session Cookies</b><br>';
		if(empty($Sname)) {
			echo
			'<span>Reload dumpSession with a choice of session name by an Sname=name-of-session query<br>'.
			'to select one of the existing session cookies or to start a new session.</span><br>';
			$cookieName = ''; }
		if(!empty($Sname)) {
			// see if valid URL query string
			if(array_key_exists($Sname, $_COOKIE)) {
				echo
					'Requested Session is same as an existing COOKIE key. Using the Requested Session name<br>';
				$SessionName = $Sname;
			} else {
				$SessionName = $Sname;
				echo
					'Requested Session does not match an existing COOKIE key. Starting a session with the Requested Session name<br>';
			}
		}
		}	
	}
	
	if(session_status() === PHP_SESSION_NONE) {
	if($Sinfo == 'Y') { echo '<b>Sessions are Enabled but none is yet active in dumpSession.</b>';
		if($Sname == '') {
			echo
		'<b>No Requested Session Name query.</b><br>'; }
		}
		if(($Sname != '') && ($Sstrt == 'N')) {
	if($Sinfo == 'Y') { echo '<b>Requested Session Name <span>' . $Sname . '</span> but no Session Start query.</b><br>';}
			$cookieName = '';
		}	
		if(($Sname != '') && ($Sstrt == 'Y')) {
	if($Sinfo == 'Y') { echo '<b>dumpSession will start a new session with the Requested Session Name <span>' .$Sname . '</span>.</b><br>';}
			$cookieName = $Sname;
			$SessionName = $Sname;
		}	
	}

	// Start session?
	if($cookieName !== '') {	
	if($Sinfo == 'Y') { echo '<b>Starting/joining a SESSION with session_name <span>' .$SessionName . '</span></b>';}
		session_name($SessionName);
		include("/var/www/session2DB/Zebra.php");
		//session_start();
		$_SESSION['Started'] = 'True'; //these values will appear in the dump
		$_SESSION['SessionName'] = session_name();
		$_SESSION['SessionID'] = session_id();
	} else {
		echo '<span><b>No session has been joined or started by dumpSession.</b></span>';
	}
	if (session_status() === PHP_SESSION_ACTIVE) {
	if($Sinfo == 'Y') { echo '<b>Active Session exists in dumpSession.</b>';}
	}
	if(session_status() !== PHP_SESSION_NONE) {
	if($Sinfo == 'Y') { echo '<b>Sessions are Enabled and one exists.</b>'; }
	}
	// some default valaues
	$dSname = '';
	$dSid = '';

	// display session name variables
	if(!empty($_SESSION['SessionName'])) {$dSname = $_SESSION['SessionName'];} else {$dSname = 'Not Set';}
		echo '<b>Current Session Name is <span>'.$dSname.'</span><br>';
	if(!empty($_SESSION['SessionID'])) {$dSid = $_SESSION['SessionID'];} else {$dSid = 'Not Set';}
		echo 'Current Session ID is <span>'.$dSid.'</span></b>';

	if($Glbl == 'N') { // don't repeat display if ALL is Y
		if($All == 'Y') {
		echo '<pre><b>REQUEST</b> ';print_r($_REQUEST);echo '</pre>';
		echo '<pre><b>GET</b> ';print_r($_GET);echo '</pre>';
		echo '<pre><b>POST</b> ';print_r($_POST);echo '</pre>';
		echo '<pre><b>FILES</b> ';print_r($_FILES);echo '</pre>';
		echo '<pre><b>ENV</b> ';print_r($_ENV);echo '</pre>'; }
	}

	// if Srvr query then dump the $_SERVER array
	if(($Srvr == 'Y') && ($Glbl == 'N')) {
		echo '<pre><b>SERVER</b> ';print_r($_SERVER);echo '</pre>'; }
	
	// display any $_SESSION array content
	if($Sess == 'Y') {
	if(!empty($_SESSION)) {
		echo '<pre><b>SESSION</b> ';print_r($_SESSION);echo '</pre>';
		} else {
		echo '<pre><b>No $_SESSION data</b></pre>'; }
	}
	// display ALL variables
	if($Glbl == 'Y') {
	//List All Session Variables, dangerous exposure
	echo '<pre><b>List ALL $GLOBALS Variables ';print_r($GLOBALS);echo '</pre>'; }

	if($Brwsr == 'Y') {
		echo
		'<div id="browserdetails"></div>'.	
		'<script>'.
		'//function myFunction() {'.
		'var txt;'.
		'txt = "<h4>Browser details from Navigator</h4>";'.
		'txt += "<p>Browser CodeName: " + navigator.appCodeName + "<br>";'.
		'txt += "Browser Name: " + navigator.appName + "<br>";'.
		'txt += "Browser Version: " + navigator.appVersion + "<br>";'.
		'txt += "Cookies Enabled: " + navigator.cookieEnabled + "<br>";'.
		'txt += "Platform: " + navigator.platform + "<br>";'.
		'txt += "Engine name: " + navigator.product + "<br>";'.
		'txt += "User-agent header: " + navigator.userAgent + "</p>";'.
		'document.getElementById("browserdetails").innerHTML = txt;'.
		'//}'.
		'</script>';
	}

echo '</body></html>';
?>
