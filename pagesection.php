<?php
function pageHeader()
{
?>
  <!DOCTYPE html>
  <html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="<?php print $_SESSION["DocRoot"]; ?>assets/" data-template="vertical-menu-template-free">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php print $_SESSION["DocRoot"]; ?>assets/img/avatars/SS_LOGO.jpg" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/libs/apex-charts/apex-charts.css" />


    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/js/config.js"></script>

    <script src="<?php print $_SESSION["DocRoot"]; ?>package/dist/sweetalert2.all.min.js"></script>
    <script src="<?php print $_SESSION["DocRoot"]; ?>angular/1.8.0angular.min.js"></script>
    <script>
      var LoginData = JSON.parse(sessionStorage.getItem("LoginData"));
      var APIBasePath = sessionStorage.getItem("BasePath");
      var APIRootPath = sessionStorage.getItem("APIRootPath");
      // alert(APIBasePath);
      var app = angular.module("MyApp", []);
      if (LoginData && LoginData.AuthToken) {
        var urlconfig = {
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            "Authorization": "Bearer " + LoginData.AuthToken
          }
        };
        var fileconfig = {
          headers: {
            'Content-Type': undefined,
            "Authorization": "Bearer " + LoginData.AuthToken
          }
        };
      } 
      else 
      {
        window.location.replace("http://localhost/helpdesk/");
      }

      app.controller('TopnavCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        $rootScope.AdminName = LoginData.Agent.Name;
        $rootScope.UserUUID = LoginData.Uuid;
        $rootScope.ProfileUrl = LoginData.Agent.AgentProfileUrl;
        $rootScope.LinkedToId = LoginData.LinkedToId;
        $rootScope.UserTypeID = LoginData.UserType.Id;
        $scope.GetProfileUrl = function(fileName) {
          return APIRootPath + fileName;
        }
        $scope.SignOut = function() {
          var url = APIRootPath + "api/SignOut/" + $rootScope.UserUUID + "/" + $rootScope.LinkedToId + "/" + $rootScope.UserTypeID;
          $http.get(url, urlconfig).then(
            function(response) {
              window.location.replace(APIBasePath);
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
      });
      app.controller('NotificationController', function($scope, $rootScope, $timeout) {
        $scope.notificationVisible = false;

        // Listen for the broadcast event
        $rootScope.$on('newTicketRaised', function(event, data) {
          $scope.notificationMessage = data.message;
          $scope.notificationVisible = true;

          // Automatically hide the notification after 5 seconds
          $timeout(function() {
            $scope.notificationVisible = false;
          }, 5000);
        });

        // Function to manually close the notification
        $scope.closeNotification = function() {
          $scope.notificationVisible = false;
        };
      });
    </script>
  </head>

  <body ng-app="MyApp">
    <!-- Layout wrapper -->
  <?php
}
function LayoutWrapperStart()
{
  ?>
    <div class="layout-wrapper layout-content-navbar">
    <?php
  }
  function LayoutContainerStart()
  {
    ?>
      <div class="layout-container">
        <!-- Menu -->
      <?php
    }
    function sideBarStart()
    {
      ?>
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <?php
      }
      function sideBar_Brand()
      {
        ?>
          <div class="app-brand demo">
            <a href="<?php print $_SESSION["DocRoot"]; ?>Dashboard" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="<?php print $_SESSION["DocRoot"]; ?>assets/img/avatars/SS_LOGO.jpg" alt="LOGO" class="d-block" height="65" width="85" id="uploadedAvatar">
                <!-- <img src="SS_LOGO.jpg" alt style= "height: 120px;width: 120px;"/> -->
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2"></span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>
          <div class="menu-inner-shadow"></div>
        <?php
      }
      function SidebarListStart()
      {
        ?>

          <ul class="menu-inner py-1">
          <?php
        }
        function Dashboard()
        {
          ?>
            <!-- Dashboard -->
            <li class="menu-item ">
              <a href="<?php print $_SESSION["DocRoot"]; ?>Dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
          <?php
        }
        function sidebar_Layouts()
        {
          ?>
            <!-- Layouts -->
            <li class="menu-item">
            <li class="menu-item">
              <a href="<?php print $_SESSION["DocRoot"]; ?>Customer" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-plus"></i>
                <div data-i18n="Without navbar">Customers</div>
              </a>
            </li>
            </li>
          <?php
        }
        function sidebar_Pages()
        {
          ?>
            <li class="menu-item">
              <a href="<?php print $_SESSION["DocRoot"]; ?>Agents" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                <div data-i18n="Notifications">Agents </div>
              </a>
            </li>
          <?php
        }
        function sidebar_Component()
        {
          ?>
            <!-- <li class="menu-item">
              <a href="Product" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Boxicons">Products </div>
              </a>
            </li> -->
            <li class="menu-item">
              <a href="<?php print $_SESSION["DocRoot"]; ?>Services" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Text Divider">Services </div>
              </a>
            </li>
            <!-- <li class="menu-item">
              <a href="Tickets" class="menu-link">
                <i class='menu-icon tf-icons bx bx-envelope'></i>
                <div data-i18n="Text Divider">Tickets</div>
              </a>
            </li> -->

            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-envelope'></i>
                <div data-i18n="Text Divider">Tickets</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<?php print $_SESSION["DocRoot"]; ?>Tickets/1?" class="menu-link">
                    <div data-i18n="Without menu">New Development </div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php print $_SESSION["DocRoot"]; ?>Tickets/2?" class="menu-link">
                    <div data-i18n="Without navbar">Service</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php print $_SESSION["DocRoot"]; ?>Tickets/3?" class="menu-link">
                    <div data-i18n="Container">Bug Fix</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php print $_SESSION["DocRoot"]; ?>Tickets/4?" class="menu-link">
                    <div data-i18n="Fluid">Update</div>
                  </a>
                </li>
              </ul>
            </li>
            <!-- <li class="menu-item">
              <a href="TicketSetting" class="menu-link">
                <i class='menu-icon tf-icons bx bx-cog'></i>
                <div data-i18n="Text Divider">Ticket Settings</div>
              </a>
            </li> -->
          <?php
        }
        function sidebar_Forms_And_Tables()
        {
          ?>
          <?php
        }
        function sidebar_Mics()
        {
          ?>
            <!-- Misc -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
            <li class="menu-item">
              <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Support</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Documentation">Documentation</div>
              </a>
            </li>
          <?php
        }
        function SidebarList_End()
        {
          ?>
          </ul>
        <?php
        }
        function sideBarEnd()
        {
        ?>
        </aside>
      <?php
        }
      ?>
      <!-- / Menu -->

      <!-- Layout container -->
      <?php
      function MainContainer_2Start()
      {
      ?>
        <div class="layout-page">
          <!-- Navbar -->
        <?php
      }
      function navbarStart()
      {
        ?>
          <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar" ng-controller="TopnavCtrl">
            <?php
            // }
            // function navLayout()
            // {
            ?>
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>
            <?php
            // }
            // function navbarFlexDivStart()
            // {
            ?>
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <?php //}
              //function navSearch()
              //{
              ?>
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <!-- <i class="bx bx-search fs-4 lh-0"></i>
                  <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." /> -->
                </div>
              </div>
              <?php
              // }
              // function navbarlinksStart()
              // {
              ?>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <?php
                // }
                // function navbarlink1()
                // {
                ?>
                <?php
                // }
                // function navbarlink2Start()
                // {
                ?>
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img ng-src="{{ ProfileUrl ? GetProfileUrl(ProfileUrl) : '<?php print $_SESSION["DocRoot"]; ?>assets/img/avatars/8.png' }}" alt="Profile Image" class=" w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <?php
                  // }
                  // function navbardropdownStart()
                  // {
                  ?>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <?php
                    // }
                    // function navbarlink2_1()
                    // {
                    ?>
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img ng-src="{{ ProfileUrl ? GetProfileUrl(ProfileUrl) : '<?php print $_SESSION["DocRoot"]; ?>assets/img/avatars/8.png' }}" alt="Profile Image" class=" w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{AdminName}}</span>
                            <small class="text-muted">{{AdminType}}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <?php
                    // }
                    // function navbarlink2_2()
                    // {
                    ?>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <?php
                    // }
                    // function navbarlink2_3()
                    // {
                    ?>
                    <li>
                      <a class="dropdown-item" href="<?php print $_SESSION["DocRoot"]; ?>Profile">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <?php
                    // }
                    // function navbarlink2_4()
                    // {
                    ?>
                    <li>
                      <a class="dropdown-item" href="<?php print $_SESSION["DocRoot"]; ?>ChangePassword">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Change Password</span>
                      </a>
                    </li>
                    <?php
                    // }
                    // function navbarlink2_5()
                    // {
                    ?>
                    <!-- <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li> -->
                    <?php
                    // }
                    // function navbarlink2_6()
                    // {
                    ?>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <?php
                    // }
                    // function navbarlink2_7()
                    // {
                    ?>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0)" ng-click="SignOut()">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                    <?php
                    // }
                    // function navbardropdownEnd()
                    // {
                    ?>
                  </ul>
                  <?php
                  // }
                  // function navbarlink2End()
                  // { 
                  ?>
                </li>
                <!--/ User -->
                <?php
                // }
                // function navbarlinksEnd()
                // {
                ?>
              </ul>
              <?php
              // }
              // function navbarFlexDivEnd()
              // {
              ?>
            </div>
            <?php
            // }
            // // function navbarEnd()
            // {
            ?>
          </nav>
        <?php
      }
      function MainContentStart()
      {
        ?>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
          <?php
        }
        function pageContainerStart()
        {
          ?>
            <div class="container-xxl flex-grow-1 container-p-y">
            <?php
          }
          function form_With_Icon()
          {
            ?>
              <div ng-controller="NotificationController" class="toast-container">
                <div id="" class="bs-toast toast toast-placement-ex m-2 fade bg-success bottom-0 end-0 show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" ng-class="{'show': notificationVisible, 'hide': !notificationVisible}" ng-show="notificationMessage">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <strong class="me-auto">Notification</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    {{ notificationMessage }}
                  </div>
                </div>
              </div>
            <?php
          }
          function profileSection()
          {
            ?>

            <?php
          }
          function pageTable()
          {
            ?>

            <?php
          }
          function ModalStart($ModalId, $ModalSize, $ModalTitle, $FormId, $FormModel, $Controller)
          {
            ?>
              <div class="row">
                <div class="modal fade" id="<?php echo $ModalId; ?>" tabindex="-1" aria-hidden="true" ng-controller="<?php echo $Controller; ?>">
                  <div class="modal-dialog modal-<?php echo $ModalSize; ?>" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel4"><?php echo $ModalTitle; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form id="<?php echo $FormId; ?>" autocomplete="off" ng-model="<?php echo $FormModel; ?>" ng-submit="">

                        <div class="modal-body" ng-model="<?php echo $FormModel; ?>">
                        <?php
                      } ?>
                        <?php
                        function ModalEnd($Btn1Name, $BtnStatus, $Btn1title, $BtnId)
                        {
                        ?>
                        </div>
                        <div class="modal-footer">
                          <!-- <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                          </button> -->
                          <button type="button" id="<?php echo $BtnId; ?>" class="btn btn-primary" ng-click="<?php echo $Btn1Name;  ?>" ng-show="<?php echo $BtnStatus; ?>"><?php echo $Btn1title; ?></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php
                        }
                        function pageContainerEnd()
                        {
            ?>

            <?php
                        }
            ?>
            <!-- / Content -->

            <!-- Footer -->
            <?php
            function pageFooter()
            {
            ?>
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
            <?php
            }
            function MainContentEnd()
            {
            ?>
            </div>
            <div class="content-backdrop fade"></div>
          <?php
            }
          ?>

          <!-- Content wrapper -->
          <?php
          function MainContainer_2End()
          {
          ?>
          </div>
        </div>
      <?php
          }
          function LayoutContainerEnd()
          {
      ?>
        <!-- / Layout page -->
      </div>
    <?php
          }
          function LayoutWrapperEnd()
          {
    ?>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
  <?php
          }
          function pageEnd()
          {
  ?>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
    <script src="<?php print $_SESSION["DocRoot"]; ?>js/excelexport.js"></script>
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?php print $_SESSION["DocRoot"]; ?>assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->
  </body>

  </html>
<?php
          }
?>