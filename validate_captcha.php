<!DOCTYPE html>
<?php
ob_start();
include_once("util/Util.php");
?>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="<?php print $_SESSION["DocRoot"]; ?>assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Verification</title>
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
    <script>
        var LoginData = JSON.parse(sessionStorage.getItem("LoginData"));
        var APIBasePath = "<?php print $_SESSION["DocRoot"]; ?>";
        var APIRootPath = "<?php print $_SESSION["ApiRoot"]; ?>";
        var ticketOtp = <?php echo json_encode(trim($params['otp'])); ?>;
        var ticketId = <?php echo json_encode(trim($params['id'])); ?>;
        var ticketpass = <?php echo json_encode(($params['password'])); ?>;
        var app = angular.module("MyApp", []);
        app.controller("DashBoardCtrl", function ($scope) {

          
            $scope.generatedCaptcha = "";
           var pageUrl = APIBasePath +"CloseTicket"+"/"+ticketOtp+"/"+ticketId+"/"+ticketpass;
            
            // Generate CAPTCHA
            $scope.generateCaptcha = function () {
                $scope.generatedCaptcha = "";
                const randomchar = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                for (let i = 1; i < 5; i++) {
                    $scope.generatedCaptcha += randomchar.charAt(Math.floor(Math.random() * randomchar.length));
                }
                document.getElementById("captchaDisplay").innerHTML = $scope.generatedCaptcha;
                $scope.userCaptcha = "";
            };

            // Validate CAPTCHA
            $scope.validateCaptcha = function () {
                if ($scope.userCaptcha === $scope.generatedCaptcha) {
                    window.open(pageUrl, "_self");
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'CAPTCHA Not Matched!',
                        text: 'Please try again.',
                        confirmButtonText: 'Retry',
                        confirmButtonColor: '#d33'
                    });
                    $scope.generateCaptcha();
                }
            };

            // Initialize CAPTCHA on load
            $scope.generateCaptcha();
        });
    </script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        #captcha-container {
            margin: 50px auto;
            width: 100%;
            max-width: 400px;
            text-align: center;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        #captchaDisplay {
            margin: 15px auto;
            padding: 10px 20px;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 3px;
            background: #f1f1f1;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: inline-block;
            user-select: none;
        }

        #userCaptcha {
            width: 80%;
            padding: 10px;
            margin: 10px auto;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .refresh-icon {
            font-size: 20px;
            color: #007bff;
            cursor: pointer;
            margin-left: 10px;
            vertical-align: middle;
        }

        .refresh-icon:hover {
            color: #0056b3;
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

<body ng-app="MyApp" ng-controller="DashBoardCtrl">
    <div id="captcha-container">
        <img src="<?php print $_SESSION["DocRoot"]; ?>assets/img/avatars/SS_LOGO.jpg" alt="LOGO" style="width: 100px; height: auto; margin-bottom: 20px;">
        <h3>Verify you're not a robot</h3>
        <div id="captchaDisplay"></div>
        <input type="text" id="userCaptcha" placeholder="Enter CAPTCHA" ng-model="userCaptcha" />
        <i class="fas fa-sync-alt refresh-icon" onclick="angular.element(this).scope().generateCaptcha()"></i>
        <br />
        <button type="button" ng-click="validateCaptcha()">Submit</button>
    </div>
    <footer>
        SSINFORMATICS © <script>document.write(new Date().getFullYear());</script> 
        <a href="https://www.ssinformatics.info" target="_blank">Designed by SSINFORMATICS SOFTWARE SOLUTIONS</a>
    </footer>
</body>

</html>
