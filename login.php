<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Helpdesk</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/avatars/SS_LOGO.jpg" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap" rel="stylesheet" />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
</head>

<body ng-app="MyApp">
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-2">Welcome! 👋</h4>
                        <!-- <p class="mb-4"></p> -->

                        <form id="formAuthentication" class="mb-3" ng-controller="FrmLoginCtrl" ng-submit="Authenticate($event)" ng-model="FrmLogin">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email or Username</label>
                                <input type="text" class="form-control" id="email" name="email-username" placeholder="Enter your email or username" ng-change="ResetLoginError()" autofocus ng-model="FrmLogin.UserId" required />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="Password" ng-model="FrmLogin.Password" ng-change="ResetLoginError()" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <p class="text-danger text-center"><b>{{LoginError}}</b></p>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit" id="btn_LoginUser" ng-disabled="isAuthenticating">
                                    <span ng-if="!isAuthenticating">Sign in</span>
                                    <span ng-if="isAuthenticating"><i class="fa fa-spin fa-spinner"></i>&nbsp;Signing In...</span>
                                </button>
                            </div>
                        </form>
                        <!-- <p class="text-center">
                            <span>New on our platform?</span>
                            <a href="auth-register-basic.html">
                                <span>Create an account</span>
                            </a>
                        </p> -->
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
    <!-- AngularJS -->
    <script src="angular/1.8.0angular.min.js"></script>
</body>
<script>
    sessionStorage.clear();
    sessionStorage.setItem('BasePath', "<?php echo $_SESSION['DocRoot']; ?>");
    sessionStorage.setItem('APIRootPath', "<?php echo $_SESSION['ApiRoot']; ?>");
    var APIBasePath = sessionStorage.getItem('BasePath');
    var APIRootPath = sessionStorage.getItem("APIRootPath");
    var app = angular.module('MyApp', []);
    app.controller('FrmLoginCtrl', function($scope, $rootScope, $http) {
        $scope.FrmLogin = {};
        $scope.LoginError = "";
        $scope.isAuthenticating = false;

        $scope.Authenticate = function(event) {
            event.preventDefault(); // Prevent the default form submission

            $scope.LoginError = "";
            $scope.isAuthenticating = true;
            var url = APIRootPath + "api/Login";
            var param = {
                "UserName": $scope.FrmLogin.UserId,
                "Password": $scope.FrmLogin.Password
            };
            $http.post(url, param).then(
                function(response) {
                    $scope.isAuthenticating = false;
                    if (response.data.success) {
                        sessionStorage.setItem("LoginData", JSON.stringify(response.data.LoginData));
                        var UserType = response.data.LoginData.UserType.Name;
                        //Redirect based on user type
                        if (UserType == 'Admin') {
                            window.location.replace('Dashboard');
                        } else if (UserType == 'Agent') {
                            window.location.replace('AgentDashboard');
                        } else if (UserType == 'Customer') {
                            window.location.replace('CustomerDashboard');
                        }else if(UserType == 'CustomerUser'){
                            window.location.replace('UserDashboard');
                        }
                    } else {
                        $scope.LoginError = response.data.message;
                        document.getElementById("btn_LoginUser").disabled = false;
                    }
                },
                function(response) {
                    $scope.isAuthenticating = false;
                    $scope.LoginError = response.data.message;
                    // $scope.LoginError = response.data.message || "Invalid user id or password";
                    document.getElementById("btn_LoginUser").disabled = false;
                }
            );
        };
        $scope.ResetLoginError = function() {
            $scope.LoginError = "";
        }
    });
</script>

</html>