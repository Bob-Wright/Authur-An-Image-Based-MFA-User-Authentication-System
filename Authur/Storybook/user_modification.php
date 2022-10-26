<?php include('/var/www/Storybook/htdocs/controllers/user_mod.php'); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://syntheticreality.net/Storybook/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://syntheticreality.net/Storybook/css/style.css">
    <title>Verification Status</title>

    <!-- jQuery + Bootstrap JS -->
    <script src="https://syntheticreality.net/Storybook/js/jquery.min.js"></script>
    <script src="https://syntheticreality.net/Storybook/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container">
        <div class="jumbotron text-center">
            <h1 class="display-4">Email Verification Status</h1>
            <div class="col-12 mb-5 text-center">
                <?php if(isset($_SESSION['email_already_verified'])) {echo $_SESSION['email_already_verified'];}
					if(isset($_SESSION['email_verified'])) {echo $_SESSION['email_verified'];}
					if(isset($_SESSION['link_expired'])) {echo $_SESSION['link_expired'];}
					if(isset($_SESSION['activation_error'])) {echo $_SESSION['activation_error'];} ?>
            </div>
            <p class="lead">Verified users may login.</p>
            <a class="btn btn-lg btn-success" href="./Portal.php">Click to Login</a>
        </div>
    </div>
</body>
</html>