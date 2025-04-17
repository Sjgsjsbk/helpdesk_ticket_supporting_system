<!DOCTYPE html>
<html lang="en">
<title>Profile</title>

<?php
include 'customer_ui/customer_pagesection.php';
pageHeader();
LayoutWrapperStart();
LayoutContainerStart();

sideBarStart(); //Sidebar Start 
sidBar_Brand();
SidebarListStart();
Dashboard();
sidebar_Layouts();
sidebar_Pages();
sidebar_Component();
sidebar_Forms_And_Tables();
SidebarList_End();
sideBarEnd();

MainContainer_2Start();
navbarStart(); //navbar start
MainContentStart(); //main content Start
pageContainerStart();
?>
<form ng-controller="ProfileCtrl" ng-model="FrmProfile" method="POST" Id="FrmProfile" ng-submit="UpdateCustomerProfile()">
  <div class="row">
    <div class="d-flex justify-content-between align-items-center">
      <h4 class="fw-bold">
        <span class="text-muted fw-light">Profile</span>
      </h4>
      <a class="fw-bold" ng-show="UserType==3" href="CustomerDashboard" style="padding-bottom: 10px;"><button type="button" class="btn btn-dark">Back</button></a>
      <a class="fw-bold" ng-show="UserType==4" href="UserDashboard" style="padding-bottom: 10px;"><button type="button" class="btn btn-dark">Back</button></a>

    </div>
  </div>
  <!-- <div class="row" ng-controller="ProfileCtrl" ng-model="FrmProfile"> -->
  <!-- <form ng-controller="ProfileCtrl" ng-model="FrmProfile" method="POST" Id="FrmProfile" ng-submit="UpdateCustomerProfile()"> -->
  <div class="card mb-4">
    <h5 class="card-header">Profile Details</h5>
    <!-- Account -->
    <div class="card-body">
      <div class="d-flex align-items-start align-items-sm-center gap-4">
        <img ng-src="{{ avatarUrl ? GetProfileUrl(avatarUrl) : 'assets/img/avatars/8.png' }}" alt="user-avatar" class="d-block rounded" height="auto" width="100" id="uploadedAvatar" />
        <!-- <img ng-show="avatarUrl == null" src="assets/img/avatars/8.png" alt="user-avatar" class="d-block rounded" height="auto" width="100" id="uploadedAvatar" /> -->
        <div class="button-wrapper">
          <label for="ProfilImg" class="btn btn-primary me-2 mb-4" tabindex="0">
            <span class="d-none d-sm-block">Upload new photo</span>
            <i class="bx bx-upload d-block d-sm-none"></i>
            <input type="file" id="ProfilImg" ng-model="FrmProfile.ProfileUrl" class="account-file-input" onchange="checkFile(this.id)" hidden>
          </label>
          <p class="text-muted mb-0">Allowed JPG or PNG.</p>
        </div>
      </div>
    </div>
    <hr class="my-0" />
    <div class="card-body">
      <div class="row">
        <div class="mb-3 col-md-3">
          <label for="FirstName" class="form-label">First Name</label>
          <input class="form-control" type="text" id="FirstName" name="FirstName" value="" autofocus ng-model="FrmProfile[0].FirstName" required />
        </div>
        <div class="mb-3 col-md-3">
          <label for="LastName" class="form-label">Last Name</label>
          <input class="form-control" type="text" id="LastName" name="LastName" value="" ng-model="FrmProfile[0].LastName" />
        </div>
        <div class="mb-3 col-md-4">
          <label for="Email" class="form-label">E-mail</label>
          <input class="form-control" type="email" id="Email" name="Email" value="" placeholder="john.doe@example.com" ng-model="FrmProfile[0].Email" readonly />
        </div>
        <div class="mb-3 col-md-2">
          <label class="form-label" for="Phone">Mobile</label>
          <input type="tel" id="Phone" name="Phone" class="form-control" placeholder="202 555 0111" ng-model="FrmProfile[0].Mobile" pattern="[0-9]{10}" maxlength="10" ng-blur="duplicateEmailMobile(FrmProfile[0].Mobile,'Mobile')" ng-change="clearErrorMessage()" required />
          <span ng-show="MobileErrorMessage" class="error">{{MobileErrorMessage}}</span>
        </div>
      </div>
      <div class="row">
        <div class="mb-3 col-md-6">
          <label for="Address" class="form-label">Address</label>
          <input ng-if="UserType==3" type="text" class="form-control" id="Address" name="Address" placeholder="Address" ng-model="FrmProfile[0].CompanyAddress"
            required />
          <input ng-if="UserType== 4" type="text" class="form-control" id="Address" name="Address" placeholder="Address" ng-model="FrmProfile[0].Address"
            required />
        </div>
        <div class="mb-3 col-md-3" ng-if="UserType==3">
          <label for="Country" class="form-label">Country</label>
          <input class="form-control" type="text" id="Country" name="Country" placeholder="Country" ng-model="FrmProfile[0].Country" required required />
        </div>
        <div class="mb-3 col-md-3" ng-if="UserType==3">
          <label for="City" class="form-label">City</label>
          <input class="form-control" type="text" id="City" name="City" placeholder="City" ng-model="FrmProfile[0].City" required />
        </div>
      </div>
      <div class="row" ng-if="UserType==3">
        <div class="mb-3 col-md-6">
          <label for="State" class="form-label">State</label>
          <input class="form-control" type="text" id="State" name="State" placeholder="State" ng-model="FrmProfile[0].State" required />
        </div>
        <div class="mb-3 col-md-6">
          <label for="PostalCode" class="form-label">Postal Code</label>
          <input type="text" class="form-control" id="PostalCode" name="PostalCode" placeholder="231465" maxlength="6" ng-model="FrmProfile[0].Pincode" required />
        </div>
      </div>
      <div class="mt-2 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary me-2" id="SaveTicketBtn">Save changes</button>
      </div>

    </div>
  </div>
</form>
<!-- </div> -->
</div>
<?php
pageContainerEnd();
pageFooter();
MainContentEnd();
MainContainer_2End();
LayoutContainerEnd();
LayoutWrapperEnd();
pageEnd();
?>
<script>
  // var avatar = "";
  var GlobalFrmScope = "";
  var APIRootPath = sessionStorage.getItem("APIRootPath");

  function checkFile(Id) {
    var fileInput = $('#' + Id)[0].files[0];
    if (fileInput.type != "image/jpeg" && fileInput.type != "image/png") {
      Swal.fire("Warning", "Accept only .jpg, .png file", "warning");
      document.getElementById(Id).value = "";
    } else {
      GlobalFrmScope.FrmProfile.ProfileUrl = fileInput;
    }
  }
  app.controller('ProfileCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
    GlobalFrmScope = $scope;
    $scope.FrmProfile = [];
    $scope.avatarUrl = "";
    $scope.ProfileDetails = [];
    $rootScope.MobileErrorMessage = "";
    $rootScope.UserUUID = LoginData.Uuid;
    $rootScope.LinkedToId = LoginData.LinkedToId;
    if (LoginData.UserType.Id == 3) {
      $rootScope.UserType = LoginData.UserType.Id;
      $rootScope.LinkedToId = LoginData.LinkedToId;
      $rootScope.workon = "customers";
    } else {
      // $rootScope.ProfileUrl = LoginData.CustomerUser.CustomerUserProfile;
      $rootScope.UserType = LoginData.UserType.Id;
      $rootScope.LinkedToId = LoginData.LinkedToId;
      $rootScope.workon = "customer_user_detail";
    }
    // $rootScope.baseUrl = 'http://localhost/helpdeskAPI/';

    $rootScope.GetProfileUrl = function(fileName) {
      return APIRootPath + fileName;
    }
    $scope.GetCustoperProfile = function() {
      var url = APIRootPath + "api/GetUserProfile/" + $rootScope.UserUUID + "/" + $rootScope.LinkedToId + "/" + $rootScope.workon;
      $http.get(url, urlconfig).then(
        function(response) {
          $scope.ProfileDetails = response.data.Details;
          $scope.avatarUrl = $scope.ProfileDetails[0].ProfileUrl;
          $scope.FrmProfile = angular.copy($scope.ProfileDetails); // Copying the data to FrmProfile
          $rootScope.oldMoblile = $scope.ProfileDetails[0].Mobile;
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


    $scope.UpdateCustomerProfile = function() {
      var form = document.getElementById("FrmProfile");
      if (form.reportValidity()) {
        var form = document.getElementById("FrmProfile");
        var btn = document.getElementById("SaveTicketBtn").innerHTML
        if (form.reportValidity() && !$scope.SaveClicked) {
          $scope.SaveClicked = true;
          document.getElementById("SaveTicketBtn").innerHTML = "&nbsp;Saving...";
          var myFormData = new FormData();
          if ($rootScope.UserType == 3) {
            myFormData.append("UserUUID", $rootScope.UserUUID);
            myFormData.append("Id", $rootScope.LinkedToId);
            myFormData.append("UserCode", $scope.FrmProfile[0].Code);
            myFormData.append("FirstName", $scope.FrmProfile[0].FirstName);
            myFormData.append("LastName", $scope.FrmProfile[0].LastName);
            myFormData.append("Email", $scope.FrmProfile[0].Email);
            myFormData.append("Mobile", $scope.FrmProfile[0].Mobile);
            myFormData.append("CompanyAddress", $scope.FrmProfile[0].CompanyAddress);
            myFormData.append("City", $scope.FrmProfile[0].City);
            myFormData.append("State", $scope.FrmProfile[0].State);
            myFormData.append("Pincode", $scope.FrmProfile[0].Pincode);
            myFormData.append("Country", $scope.FrmProfile[0].Country);
            myFormData.append("ProfileUrl", GlobalFrmScope.FrmProfile.ProfileUrl);

            var url = APIRootPath + "api/UpdateCustomerProfile";
          } else if ($rootScope.UserType == 4) {
            myFormData.append("UserUUID", $rootScope.UserUUID);
            myFormData.append("Id", $rootScope.LinkedToId);
            myFormData.append("UserCode", $scope.FrmProfile[0].Code);
            myFormData.append("FirstName", $scope.FrmProfile[0].FirstName);
            myFormData.append("LastName", $scope.FrmProfile[0].LastName);
            myFormData.append("Email", $scope.FrmProfile[0].Email);
            myFormData.append("Mobile", $scope.FrmProfile[0].Mobile);
            myFormData.append("Address", $scope.FrmProfile[0].Address);
            myFormData.append("ProfileUrl", GlobalFrmScope.FrmProfile.ProfileUrl);
            var url = APIRootPath + "api/UpdateCustomerUser";
          }
          $http.post(url, myFormData, fileconfig).then(
            function(response) {
              $scope.FrmTicket = [];
              Swal.fire("Done", "Profile Updated successfully", "success");
              $scope.SaveClicked = false;
              document.getElementById("SaveTicketBtn").innerHTML = btn;
              $scope.GetCustoperProfile();
              // location.reload();
            },
            function(response) {
              $scope.SaveClicked = false;
              document.getElementById("SaveTicketBtn").innerHTML = btn;
              if (response.data.status != 401) {
                Swal.fire("OOPS", response.data.message, "error");
              } else {
                window.location.replace(APIBasePath);
              }
            }
          );
        }
      }
    }

    $scope.duplicateEmailMobile = function(EmailMobile, Action) {
      if ($rootScope.UserType == 3) {
        $rootScope.workon = "customers";
      } else if ($rootScope.UserType == 4) {
        $rootScope.workon = "customer_user_detail";
      }
      var btn = document.getElementById("SaveTicketBtn");
      btn.disabled = true; // Initially disable the button
      if ($rootScope.oldMoblile != $scope.FrmProfile[0].Mobile) {
        var url = APIRootPath + "api/CheckDuplicateEmailMobile/" + $rootScope.UserUUID;
        var param = {
          "EmailMobile": EmailMobile,
          "Action": Action,
          "WorkOn": $rootScope.workon
        }
        // Clear the error messages before making the API call
        if (Action == 'Mobile') {
          $rootScope.MobileErrorMessage = "";
        }
        $http.post(url, param, urlconfig).then(
          function(response) {
            console.log(response.data); // Log the entire response data
            if (response.data.status === 409) {
              if (Action == 'Mobile') {
                $rootScope.MobileErrorMessage = response.data.message;
              }
              btn.disabled = true;
            } else {
              // No duplicate found
              btn.disabled = false; // Enable the button if no duplicate is found
            }
          },
          function(error) {
            console.error("Error occurred:", error); // Log the error
            btn.disabled = false; // Enable the button if an error occurs
          }
        );
      }
      btn.disabled = false;
    }
    $rootScope.clearErrorMessage = function() {
      $rootScope.MobileErrorMessage = "";
    }
    //Calling
    $scope.GetCustoperProfile();
  })
</script>

</html>