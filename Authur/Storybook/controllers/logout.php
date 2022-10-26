<?php     
// Start session
session_name("Storybook");
include("/var/www/session2DB/Zebra.php");
// session_start();
    session_unset();
    session_destroy();
      
    header("Location: https://syntheticreality.net/Storybook/Portal.php");
?>