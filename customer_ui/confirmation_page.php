<!DOCTYPE html>
<?php
ob_start();
include_once("util/Util.php");
?>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="<?php print $_SESSION["DocRoot"]; ?>assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Confirmation</title>
    <meta name="description" content="CAPTCHA integration example for human verification" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php print $_SESSION["DocRoot"]; ?>assets/img/avatars/SS_LOGO.jpg" />
    <link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/css/core.css" />
    <link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/css/theme-default.css" />
    <link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/css/captcha.css" />
    <!-- AngularJS -->
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?php print $_SESSION["DocRoot"]; ?>angular/1.8.0angular.min.js"></script>
    <script src="<?php print $_SESSION["DocRoot"]; ?>package/dist/sweetalert2.all.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        #message-container {
            margin: 50px auto;
            width: 100%;
            max-width: 400px;
            text-align: center;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Success Message Styling */
        .success-message {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
            /* Green color for success */
            background-color: #d4edda;
            /* Light green background */
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #c3e6cb;
            /* Border matching the background */
        }

        footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #666;
        }

        footer a {
            text-decoration: none;
            color: #007bff;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body ng-app="MyApp">
    <div id="message-container">
        <img src="<?php print $_SESSION["DocRoot"]; ?>assets/img/avatars/SS_LOGO.jpg" alt="LOGO" style="width: 100px; height: auto; margin-bottom: 20px;">

        <!-- Success Message -->
        <div ng-if="ticketClosed" class="success-message">
            <p>Your ticket has been closed successfully!</p>
        </div>
    </div>

    <footer>
        SSINFORMATICS © <script>
            document.write(new Date().getFullYear());
        </script>
        <a href="https://www.ssinformatics.info" target="_blank">Designed by SSINFORMATICS SOFTWARE SOLUTIONS</a>
    </footer>
</body>


</html>