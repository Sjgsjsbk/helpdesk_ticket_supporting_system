<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Change Password</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="SS_LOGO.jpg" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

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
            <div class="authentication-inner py-4">
                <!-- Forgot Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Change Password? 🔒</h4>
                        <form id="FrmDetails" class="mb-3" method="POST" ng-controller="forgotpassCtrl" ng-submit="ChangePassword($event)" ng-model="FrmDetails">
                            <div class="mb-3">
                                <label for="email" class="form-label">Old Password</label>
                                <input type="text" class="form-control" id="OldPaasword" ng-change="ResetLoginError()" name="OldPaasword" ng-model="FrmDetails.OldPaasword" placeholder="Enter your Old Password" autofocus />
                                <!-- <p class="text-danger text-center"><b>{{LoginError}}</b></p> -->
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">New Password</label>
                                <input type="text" class="form-control" id="NewPaasword" ng-change="ResetLoginError()" name="NewPaasword" ng-model="FrmDetails.NewPaasword" placeholder="Enter your New Password" autofocus />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Confirm Password</label>
                                <input type="text" class="form-control" id="Confirm" name="ConfirmPassword" ng-model="FrmDetails.ConfirmPassword" placeholder="confirm  your New Password" autofocus ng-change="ResetLoginError()" />
                                <p class="text-danger text-center"><b>{{PasswordError}}</b></p>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit" id="btn_LoginUser" ng-disabled="isAuthenticating">
                                    <span ng-if="!isAuthenticating">Change Password</span>
                                    <span ng-if="isAuthenticating"><i class="fa fa-spin fa-spinner"></i>&nbsp;Changeing....</span>
                                </button>
                            </div>
                        </form>
                        <div class="text-center">
                            <a ng-href="{{UserTypeId == 1 ? 'Dashboard' : (UserTypeId == 2 ? 'AgentDashboard' : (UserTypeId == 3 ? 'CustomerDashboard' : (UserTypeId == 4 ? 'UserDashboard' : '')))}}"
                            class="d-flex align-items-center justify-content-center">
                                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Forgot Password -->
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
    <script src="angular/1.8.0angular.min.js"></script>
    <script src="package/dist/sweetalert2.all.min.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
</body>
<script>
    var LoginData = JSON.parse(sessionStorage.getItem("LoginData"));
    var APIBasePath = sessionStorage.getItem('BasePath');
    var APIRootPath = sessionStorage.getItem("APIRootPath")
    var app = angular.module('MyApp', []);
    var urlconfig = {
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            "Authorization": "Bearer " + LoginData.AuthToken
        }
    };
    app.controller('forgotpassCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalFrmScope = $scope;
        $scope.FrmDetails = [];
        $rootScope.UserUUID = LoginData.Uuid;
        $rootScope.UserTypeId = LoginData.UserType.Id;
        $rootScope.LinkedToId = LoginData.LinkedToId;
        $scope.LoginError = "";
        $scope.PasswordError = "";

        $scope.ChangePassword = function(event) {
            event.preventDefault(); // Prevent the default form submission
            $scope.LoginError = "";
            $scope.PasswordError = "";
            $scope.isAuthenticating = true;
            var url = APIRootPath + "api/ChangePassword/" + $rootScope.UserUUID + "/" + $rootScope.LinkedToId + "/" + $rootScope.UserTypeId;
            var param = {
                "OldPaasword": $scope.FrmDetails.OldPaasword,
                "NewPaasword": $scope.FrmDetails.NewPaasword,
                "ConfirmPassword": $scope.FrmDetails.ConfirmPassword
            };
            $http.post(url, param, urlconfig).then(function(response) {
                    $scope.isAuthenticating = false;
                    Swal.fire("Done", "Password saved successfully", "success");
                    window.location.replace(APIBasePath);
                },
                function(response) {
                    if (response.data.status != 401) {
                        $scope.isAuthenticating = false;
                        // Swal.fire("OOPS", response.data.message, "error");
                        $scope.PasswordError = response.data.message;
                    } else {
                        window.location.replace(APIBasePath);
                    }
                }
            );
        };
        $scope.ResetLoginError = function() {
            $scope.LoginError = "";
            $scope.PasswordError = "";
        }
    })
</script>

</html>