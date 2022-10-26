<?php include('/var/www/Storybook/htdocs/controllers/magiclink_activation.php'); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://syntheticreality.net/Storybook/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://syntheticreality.net/Storybook/css/style.css">
    <title>Magic Link Status</title>

    <!-- jQuery + Bootstrap JS -->
    <script src="https://syntheticreality.net/Storybook/js/jquery.min.js"></script>
    <script src="https://syntheticreality.net/Storybook/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="jumbotron text-center">
            <h1 class="display-4">Magic Link Verification Status</h1>
            <div class="col-12 mb-5 text-center">
                <?php if(isset($_SESSION['link_already_used'])) {echo $_SESSION['link_already_used'];}
					//if(isset($_SESSION['email_verified'])) {echo $_SESSION['email_verified'];}
					if(isset($_SESSION['activation_error'])) {echo $_SESSION['activation_error'];}
					if(isset($_SESSION['link_expired'])) {echo $_SESSION['link_expired'];} ?>
            </div>
            <p class="lead"><a class="btn btn-lg btn-success" href="https://syntheticreality.net/Comics">Return to the Comics page</a></p>
        </div>
    </div>


</body>

</html>