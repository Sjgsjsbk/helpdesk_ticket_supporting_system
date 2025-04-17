<!DOCTYPE html>
<html lang="en">
<title>Profile</title>

<?php
include 'agent_ui/agent_pagesection.php';
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
<div class="row">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold">
            <span class="text-muted fw-light">Profile</span>
        </h4>
        <a class="fw-bold" href="AgentDashboard" style="padding-bottom: 10px;"><button type="button" class="btn btn-dark">Back</button></a>
    </div>
</div>
<!-- <div class="row" ng-controller="ProfileCtrl" ng-model="FrmProfile"> -->
<form ng-controller="AgentProfileCtrl" ng-model="FrmProfile" method="POST" Id="FrmProfile" ng-submit="UpdateCustomerProfile()">
    <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <!-- Account -->
        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img ng-src="{{ ProfileUrl ? GetProfileUrl(ProfileUrl) : '../assets/img/avatars/8.png' }}" alt="user-avatar" class="d-block rounded" height="auto" width="100" id="uploadedAvatar" />
                <div class="button-wrapper">
                    <label for="ProfilImg" class="btn btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">Upload new photo</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input type="file" id="ProfilImg" ng-model="FrmProfile.ProfileImage" class="account-file-input" onchange="checkFile(this.id)" hidden>
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
                    <input type="tel" id="Phone" name="Phone" class="form-control" placeholder="202 555 0111" ng-model="FrmProfile[0].Mobile" maxlength="10" pattern="[0-9]{10}" ng-blur="duplicateEmailMobile(FrmProfile[0].Mobile,'Mobile')" ng-change="clearErrorMessage()" required />
                    <span ng-show="MobileErrorMessage" class="error">{{MobileErrorMessage}}</span>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="Address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="Address" name="Address" placeholder="Address" ng-model="FrmProfile[0].Address" required />
                </div>
                <div class="mb-3 col-md-3">
                    <label for="Country" class="form-label">Country</label>
                    <input class="form-control" type="text" id="Country" name="Country" placeholder="Country" ng-model="FrmProfile[0].Country" required required />
                </div>
                <div class="mb-3 col-md-3">
                    <label for="City" class="form-label">City</label>
                    <input class="form-control" type="text" id="City" name="City" placeholder="City" ng-model="FrmProfile[0].City" required />
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="State" class="form-label">State</label>
                    <input class="form-control" type="text" id="State" name="State" placeholder="State" ng-model="FrmProfile[0].State" required />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="PostalCode" class="form-label">Postal Code</label>
                    <input type="text" class="form-control" id="PostalCode" name="PostalCode" placeholder="231465" maxlength="6" ng-model="FrmProfile[0].PinCode" required />
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
    var ProfileImage = "";
    var GlobalFrmScope = "";

    function checkFile(Id) {
        var fileInput = $('#' + Id)[0].files[0];
        if (fileInput.type != "image/jpeg" && fileInput.type != "image/png") 
        {
            Swal.fire("Warning", "Accept only .jpg, .png file", "warning");
            document.getElementById(Id).value = "";
        } 
        else 
        {
            GlobalFrmScope.FrmProfile.ProfileImage = fileInput;
        }
    }

    var APIRootPath = sessionStorage.getItem("APIRootPath");
    app.controller('AgentProfileCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalFrmScope = $scope;
        $scope.FrmProfile = [];
        $rootScope.MobileErrorMessage = "";
        $rootScope.UserUUID = LoginData.Uuid;
        $rootScope.LinkedToId = LoginData.LinkedToId;
        $scope.ProfileUrl = [];

        $rootScope.GetProfileUrl = function(fileName) 
        {
            return APIRootPath + fileName;
        }

        $scope.GetAgentProfile = function() 
        {
            var url = APIRootPath + "api/GetUserProfile/" + $rootScope.UserUUID + "/" + $rootScope.LinkedToId + "/" + 'agents';
            $http.get(url, urlconfig).then(
                function(response) 
                {
                    $scope.AgentProfileDetails = response.data.Details;
                    $scope.ProfileUrl = $scope.AgentProfileDetails[0].ProfileUrl;
                    $scope.FrmProfile = angular.copy($scope.AgentProfileDetails);
                    $rootScope.oldMoblile = $scope.AgentProfileDetails[0].Mobile;
                },
                function(response) 
                {
                    if (response.data.status != 401) 
                    {
                        Swal.fire("OOPS", response.data.message, "error");
                    }
                }
            );
        }

        $scope.UpdateCustomerProfile = function() {
            var form = document.getElementById("FrmProfile");
            if (form.reportValidity()) {
                var btn = document.getElementById("SaveTicketBtn").innerHTML
                if (form.reportValidity() && !$scope.SaveClicked) 
                {
                    $scope.SaveClicked = true;
                    document.getElementById("SaveTicketBtn").innerHTML = "&nbsp;Saving...";
                    var myFormData = new FormData();
                    myFormData.append("UserUUID", $rootScope.UserUUID);
                    myFormData.append("Id", $rootScope.LinkedToId);
                    myFormData.append("UserCode", $scope.FrmProfile[0].Code);
                    myFormData.append("FirstName", $scope.FrmProfile[0].FirstName);
                    myFormData.append("LastName", $scope.FrmProfile[0].LastName);
                    myFormData.append("Email", $scope.FrmProfile[0].Email);
                    myFormData.append("Mobile", $scope.FrmProfile[0].Mobile);
                    myFormData.append("Address", $scope.FrmProfile[0].Address);
                    myFormData.append("City", $scope.FrmProfile[0].City);
                    myFormData.append("State", $scope.FrmProfile[0].State);
                    myFormData.append("Pincode", $scope.FrmProfile[0].PinCode);
                    myFormData.append("Country", $scope.FrmProfile[0].Country);
                    myFormData.append("ProfileUrl", GlobalFrmScope.FrmProfile.ProfileImage);

                    var url = APIRootPath + "api/UpdateAgentProfile";
                    $http.post(url, myFormData, fileconfig).then(
                        function(response) 
                        {
                            $scope.FrmTicket = [];
                            Swal.fire("Done", "Profile Updated successfully", "success");
                            $scope.SaveClicked = false;
                            document.getElementById("SaveTicketBtn").innerHTML = btn;
                            $rootScope.GetProfileUrl();
                            $scope.GetAgentProfile();
                        },
                        function(response) 
                        {
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

        $scope.duplicateEmailMobile = function(EmailMobile, Action) 
        {
            var btn = document.getElementById("SaveTicketBtn");
            btn.disabled = true;
            if ($rootScope.oldMoblile != $scope.FrmProfile[0].Mobile) 
            {
                var url = APIRootPath + "api/CheckDuplicateEmailMobile/" + $rootScope.UserUUID;
                var param = 
                {
                    "EmailMobile": EmailMobile,
                    "Action": Action,
                    "WorkOn": 'agents'
                }
                if (Action == 'Mobile') 
                {
                    $rootScope.MobileErrorMessage = "";
                }
                $http.post(url, param, urlconfig).then(
                    function(response) 
                    {
                        if (response.data.status === 409) 
                        {
                            if (Action == 'Mobile') 
                            {
                                $rootScope.MobileErrorMessage = response.data.message;
                            }
                            btn.disabled = true;
                        } 
                        else 
                        {
                            btn.disabled = false;
                        }
                    },
                    function(error) 
                    {
                        btn.disabled = false;
                    }
                );
            }
        };

        $rootScope.clearErrorMessage = function() 
        {
            $rootScope.MobileErrorMessage = "";
        }

        $scope.GetAgentProfile();
    })
</script>

</html>