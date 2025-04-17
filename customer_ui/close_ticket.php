<!DOCTYPE html>
<?php include_once("util/Util.php"); ?>
<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="<?php print $_SESSION["DocRoot"]; ?>assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Close Ticket</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php print $_SESSION["DocRoot"]; ?>assets/img/avatars/SS_LOGO.jpg" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/js/config.js"></script>
    <script src="<?php print $_SESSION["DocRoot"]; ?>angular/1.8.0angular.min.js"></script>
    <script src="<?php print $_SESSION["DocRoot"]; ?>package/dist/sweetalert2.all.min.js"></script>
    <style>
        .custom-background {
            background-color: #ece5dd;
            max-height: 500px;
            /* Set the max height as needed */
            overflow-y: auto;
            /* Enables vertical scrolling */
            /* Change to your desired color */
        }
    </style>
    <link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/css/closingUi.css" />

    <script>
        // var LoginData = JSON.parse(sessionStorage.getItem("LoginData"));
        var APIBasePath = "<?php print $_SESSION["DocRoot"]; ?>";
        var APIRootPath = "<?php print $_SESSION["ApiRoot"]; ?>";
        var ticketOtp = <?php echo json_encode(trim($params['otp'])); ?>;
        var ticketId = <?php echo json_encode(trim($params['id'])); ?>;
        var ticketpass = <?php echo json_encode(($params['password'])); ?>;

        var app = angular.module("MyApp", []);
        app.controller('DashBoardCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
            $scope.TotalCustomer = "";
            $scope.customers = "";
            $scope.ProductsDetails = [];
            $rootScope.getDownloadUrl = function(fileName) {
                console.log(APIRootPath + fileName);
                return APIRootPath + fileName;
            }

            $scope.matchUrl = function() {
                var url = APIRootPath + "api/matchPasscode/" + ticketId + "/" + ticketpass + "/" + ticketOtp;
                $http.get(url).then(
                    function(response) {
                        if (response.data.status == 200) {
                            $scope.GetTicket();
                            $scope.GetChats();
                        }
                    },
                    function(response) {
                        if (response.data.status != 401) {
                            Swal.fire("OOPS", response.data.message, "error");
                        } else {
                            window.location.replace(APIBasePath);
                        }
                    }
                );
            }

            $scope.GetTicket = function() {
                var url = APIRootPath + "api/GetClosingTicketDetail/" + ticketId;
                $http.get(url).then(
                    function(response) {
                        $scope.ticketsDetail = response.data.ticket;
                        $scope.ShowButton = $scope.ticketsDetail[0].StatusId;
                    },
                    function(response) {
                        if (response.data.status != 401) {
                            Swal.fire("OOPS", response.data.message, "error");
                        } else {
                            window.location.replace(APIBasePath);
                        }
                    }
                );
            }


            $scope.GetChats = function() {
                var url = APIRootPath + "api/GetChat/" + ticketId;
                $http.get(url).then(
                    function(response) {
                        $rootScope.QueryDetails = response.data.Query;
                        $scope.showLable = $rootScope.QueryDetails.length;
                    },
                    function() {
                        if (response.data.status != 401) {
                            Swal.fire("OOPS", response.data.message, "error")
                        } else {
                            window.location.replace(APIBasePath);
                        }
                    }
                )
            }
            $rootScope.isImageFile = function(fileName) {
                if (!fileName) return false;
                const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];
                const fileExtension = fileName.split('.').pop().toLowerCase();
                return imageExtensions.includes(fileExtension);
            };


            $scope.closeTicket = function() {
                $scope.ErrorMsg = "";
                var url = APIRootPath + "api/CloseTicket/" + ticketId + "/" + ticketOtp;
                $http.get(url).then(function(response) {
                        $scope.GetTicket();
                        window.location.replace(APIBasePath + "confirmation")
                    },
                    function(response) {
                        $scope.SaveClicked = false;
                        if (response.data.status != 401) {
                            Swal.fire("OOPS", response.data.message, "error"); // Set the error message here
                        } else {
                            window.location.replace(APIBasePath);
                        }
                    }
                );
            };
            $scope.matchUrl();
        });
    </script>
</head>

<body ng-app="MyApp" ng-controller="DashBoardCtrl">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
        <div class="layout-container">
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <!-- Layout Demo -->
                        <div class="row">
                            <div class="col-md mb-4 mb-md-0">
                                <div class="accordion mt-3" id="accordionExample">
                                    <div class="card accordion-item active">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button
                                                type="button"
                                                class="accordion-button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#accordionOne"
                                                aria-expanded="true"
                                                aria-controls="accordionOne">
                                                Ticket Information
                                            </button>
                                        </h2>

                                        <div
                                            id="accordionOne"
                                            class="accordion-collapse collapse show"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body" ng-repeat="t in ticketsDetail">
                                                <!-- <div class="accordion-body"> -->
                                                <!-- Customer Details -->
                                                <div class="divider text-start">
                                                    <div class="divider-text" style="font-size:medium;">Customer Details</div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Name</h6>
                                                        <div class="card-subtitle text-muted">{{t.CustomerFullName}}</div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Mobile No</h6>
                                                        <div class="card-subtitle text-muted">{{t.CustomerMobile}}</div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Email</h6>
                                                        <div class="card-subtitle text-muted">{{t.CustomerEmail}}</div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Company Name</h6>
                                                        <div class="card-subtitle text-muted">{{t.CompanyName}}</div>
                                                    </div>
                                                </div>

                                                <!-- Ticket Created By -->
                                                <div class="row" ng-show="t.CustomerUserFullName">
                                                    <div class="divider text-start">
                                                        <div class="divider-text" style="font-size:medium;">Ticket Created By</div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Name</h6>
                                                        <div class="card-subtitle text-muted">{{t.CustomerUserFullName}}</div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Mobile No</h6>
                                                        <div class="card-subtitle text-muted">{{t.CustomerUserMobile}}</div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Email</h6>
                                                        <div class="card-subtitle text-muted">{{t.CustomerUserEmail}}</div>
                                                    </div>
                                                </div>

                                                <!-- Ticket & Product Details -->
                                                <div class="divider text-start">
                                                    <div class="divider-text" style="font-size:medium;">Ticket & Product Details</div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Ticket Code</h6>
                                                        <div class="card-subtitle text-muted">{{t.Code}}</div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Ticket Date</h6>
                                                        <div class="card-subtitle text-muted">{{t.RaisedOn}}</div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Ticket Status</h6>
                                                        <div class="card-subtitle text-muted">
                                                            {{t.StatusId == 1 ? 'Raised' : (t.StatusId == 2 ? 'Processing' : (t.StatusId == 3 ? 'Query Response' : 'Closed'))}}
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Updated On</h6>
                                                        <div class="card-subtitle text-muted">{{t.UpdatedOn}}</div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Product Name</h6>
                                                        <div class="card-subtitle text-muted">{{t.customerProduct}}</div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Processing On</h6>
                                                        <div class="card-subtitle text-muted">{{t.ProcessingOn}}</div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Processed By</h6>
                                                        <div class="card-subtitle text-muted">{{t.AgentName}}</div>
                                                    </div>
                                                </div>

                                                <!-- Subject & Description -->
                                                <div class="divider text-start">
                                                    <div class="divider-text" style="font-size:medium;">Subject & Description</div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <h6 class="card-title">Subject</h6>
                                                        <div class="card-subtitle text-muted">{{t.Subject}}</div>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <h6 class="card-title">Description
                                                        </h6>
                                                        <div class="card-subtitle text-muted">{{t.Description}}</div>
                                                    </div>
                                                </div>

                                                <!-- Ticket Attachments -->
                                                <div class="row" ng-show="t.Filepath">
                                                    <div class="divider text-start">
                                                        <div class="divider-text" style="font-size:medium;">Ticket Attachments</div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Attachment</h6>
                                                        <div class="card-subtitle text-muted">
                                                            <a class="badge bg-primary" ng-href="{{getDownloadUrl(t.Filepath)}}" target="_blank">View</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Agent Details -->
                                                <div class="row">
                                                    <div class="divider text-start">
                                                        <div class="divider-text" style="font-size:medium;">Agent Details</div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Agent Code</h6>
                                                        <div class="card-subtitle badge bg-primary">{{t.AgentCode}}</div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Name</h6>
                                                        <div class="card-subtitle badge bg-primary">{{t.AgentName}}</div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Mobile No</h6>
                                                        <div class="card-subtitle badge bg-primary">{{t.AgentMobile}}</div>
                                                    </div>
                                                    <div class="mb-3 col-md-3">
                                                        <h6 class="card-title">Email</h6>
                                                        <div class="card-subtitle badge bg-primary">{{t.AgentEmail}}</div>
                                                    </div>
                                                </div>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button
                                                type="button"
                                                class="accordion-button collapsed"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#accordionTwo"
                                                aria-expanded="false"
                                                aria-controls="accordionTwo">
                                                Chat / Close Ticket
                                            </button>
                                        </h2>
                                        <div
                                            id="accordionTwo"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body custom-background">

                                                <label for="form-control" style="display: flex; justify-content: center; align-items: center;padding-top: 15px;" ng-show="showLable>0" class="scroll-label">Scroll down to close the ticket</label>

                                                <div ng-repeat="Query in QueryDetails | orderBy: ['QueryOn', 'ResponseOn']">
                                                    <!-- Your content for each Query goes here -->
                                                </div>

                                                <!-- <div class="container"> -->
                                                <div ng-repeat="Query in QueryDetails | orderBy: ['QueryOn', 'ResponseOn']">

                                                    <!-- User 2 (Customer) Chat -->
                                                    <div class="chat-row user-2" style="padding-top: 15px;" ng-if="Query.QueryRemark">
                                                        <div class="chat-bubble user-2-bubble">
                                                            <span class="chatName">{{Query.CustomerName || Query.CustomerUserName}}</span>
                                                            <p>{{Query.QueryRemark}}</p>
                                                            <span class="time">{{Query.QueryOn | date:'short'}}</span>
                                                        </div>
                                                    </div>
                                                    <!-- User 2 (Customer) Attachment -->
                                                    <div class="chat-row user-2" style="padding-top: 15px;" ng-if="Query.QueryFileName && Query.QueryFileName !== '0'">
                                                        <div class="chat-bubble user-2-bubble">
                                                            <label class="form-label">Attachment</label><br />
                                                            <a class="card-img-top" ng-href="{{getDownloadUrl(Query.QueryFileName)}}" target="_blank">
                                                                <img ng-if="Query.QueryFileName && isImageFile(Query.QueryFileName)" class="card-img-top" src="{{getDownloadUrl(Query.QueryFileName)}}" alt="Image" height="300" width="300">
                                                                <i ng-if="Query.QueryFileName.endsWith('.docx')" class="fas fa-file-word" style="font-size: 40px; color: #0072C6;"></i>
                                                                <i ng-if="Query.QueryFileName.endsWith('.xlsx')" class="fas fa-file-excel" style="font-size: 40px; color: #217346;"></i>
                                                                <i ng-if="Query.QueryFileName.endsWith('.pdf')" class="fas fa-file-pdf" style="font-size: 40px; color: #D9534F;"></i>
                                                            </a>
                                                            <span class="time">{{Query.QueryOn | date:'short'}}</span>
                                                        </div>
                                                    </div>

                                                    <!-- User 1 (Agent) Chat -->
                                                    <div class="chat-row user-1" style="padding-top: 15px;" ng-if="Query.ResponseRemark && Query.QueryById !== 0">
                                                        <div class="chat-bubble user-1-bubble">
                                                            <span class="chatName">{{Query.AgentName}}</span>
                                                            <p>{{Query.ResponseRemark}}</p>
                                                            <span class="time">{{Query.ResponseOn | date:'short'}}</span>
                                                        </div>
                                                    </div>
                                                    <!-- User 1 (Agent) Attachment -->
                                                    <div class="chat-row user-1" style="padding-top: 15px;" ng-if="Query.ResponseFileName && Query.ResponseFileName !== '0'">
                                                        <div class="chat-bubble user-1-bubble">
                                                            <label class="form-label">Attachment</label><br />
                                                            <a class="card-img-top" ng-href="{{getDownloadUrl(Query.ResponseFileName)}}" target="_blank">
                                                                <img ng-if="Query.ResponseFileName && isImageFile(Query.ResponseFileName)" class="card-img-top" src="{{getDownloadUrl(Query.ResponseFileName)}}" alt="Image" height="300" width="300">
                                                                <i ng-if="Query.ResponseFileName.endsWith('.docx')" class="fas fa-file-word" style="font-size: 40px; color: #0072C6;"></i>
                                                                <i ng-if="Query.ResponseFileName.endsWith('.xlsx')" class="fas fa-file-excel" style="font-size: 40px; color: #217346;"></i>
                                                                <i ng-if="Query.ResponseFileName.endsWith('.pdf')" class="fas fa-file-pdf" style="font-size: 40px; color: #D9534F;"></i>
                                                            </a>
                                                            <span class="time">{{Query.ResponseOn | date:'short'}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Chat Input -->
                                                <div class="chat-input-container" ng-show="ShowButton < 4">
                                                    <a href="#" ng-click="closeTicket()" class="btn btn-danger btn-buy-now">Close Ticket</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Layout Demo -->
                </div>
                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            SSINFORMATICS © Copyrights
                            <script>
                                document.write(new Date().getFullYear());
                            </script>

                            <a href="https://www.ssinformatics.info" target="_blank" class="footer-link fw-bolder">Design by SSINFORMATICS SOFTWARE SOLUTIONS</a>
                        </div>

                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
    </div>
    <!-- / Layout wrapper -->

    <!-- <div class="buy-now mt-5" ng-show="ShowButton<4">
        <a href="" ng-click="closeTicket()" class="btn btn-danger btn-buy-now">Close Ticket</a>
    </div> -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>