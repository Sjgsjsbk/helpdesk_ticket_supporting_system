<!DOCTYPE html>
<html lang="en">
<title>User</title>

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
<div class="row">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold">
            <span class="text-muted fw-light">User Details</span>
        </h4>
    </div>
</div>
<div class="row" ng-controller="userCtrl">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                <div class="col-md-4">
                    <input class="form-control" type="text" name="searchText" id="searchText" placeholder="Type to search" value="" ng-model="FrmTbl.searchText" />
                </div>
                <div>
                    <button type="button" class="btn btn-primary" ng-click="showSaveUserModal()">Add</button>
                </div>
            </h5>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                    <div class="table-responsive text-nowrap" style="height: 350px; overflow-y: auto;">
                        <table class="table" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Created On</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <!-- ng-repeat="customerUser in customeruserdetails" -->
                                <tr ng-repeat="customerUser in customeruserdetails | filter:FrmTbl.searchText">
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{customerUser.customerUserName}}</td>
                                    <td>{{customerUser.Email}}</td>
                                    <td>{{customerUser.Mobile}}</td>
                                    <td>{{customerUser.CreatedOn}}</td>
                                    <td><span style="cursor: pointer;" class="badge  bg-{{customerUser.IsActive == 1 ? 'success':'danger'}}" ng-click="UpdateCustomerUserStatus(customerUser)"><i class="bx bx-{{customerUser.IsActive == 1 ? 'check':'x'}}"></i></span></td>
                                    <td>
                                        <a class="" href="javascript:void(0);" ng-click="editUserModal(customerUser)" title="Edit"><i class="bx bx-edit-alt me-1"></i></a>
                                        <a class="" href="javascript:void(0);" ng-show="customerUser.isexist==0" ng-click="DeleteCustomerUser(customerUser)" title="Delete"><i class="bx bx-trash me-1"></i></a>
                                        <a class="" href="javascript:void(0);" ng-click="SendMail(customerUser)" title="Send Mail"><i class='bx bx-mail-send me-1'></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
ModalStart("saveUserModal", "xl", "Add User", "FrmUSer", "FrmUSer", "saveUserCtrl", "saveUser()");
?>
<div class="row">
    <div class="mb-3 col-md-3">
        <label for="FirstName" class="form-label">First Name</label>
        <input class="form-control" type="text" ng-model="FrmUSer.FirstName" id="FirstName" required />
    </div>
    <div class="mb-3 col-md-3">
        <label for="LastName" class="form-label">Last Name</label>
        <input class="form-control" type="text" ng-model="FrmUSer.LastName" />
    </div>
    <div class="mb-3 col-md-4">
        <label for="Email" class="form-label">E-mail</label>
        <input class="form-control" type="email" placeholder="john.doe@example.com" id="Email" ng-blur="duplicateEmailMobile(FrmUSer.Email,'Email')" ng-change="clearErrorMessage('Email')" ng-model="FrmUSer.Email" required />
        <span ng-show="EmailErrorMessage" class="error">{{EmailErrorMessage}}</span>
    </div>
    <div class="mb-3 col-md-2">
        <label class="form-label" for="Mobile">Mobile</label>
        <div class="input-group input-group-merge">
            <input type="tel" class="form-control" pattern="[0-9]{10}" placeholder="202 555 0111" ng-model="FrmUSer.Mobile" ng-blur="duplicateEmailMobile(FrmUSer.Mobile,'Mobile')" ng-change="clearErrorMessage('Mobile')" maxlength="10" id="Mobile" required />
        </div>
        <span ng-show="MobileErrorMessage" class="error">{{MobileErrorMessage}}</span>
    </div>
</div>
<div class="row">
    <div class="mb-3 col-md-6">
        <label for="Compatibilityinfo" class="form-label">Address</label>
        <input class="form-control" type="text" ng-model="FrmUSer.Address" />
    </div>
    <div class="mb-3 col-md-3">
        <label for="Username" class="form-label">Username</label>
        <input type="text" class="form-control" placeholder="Username" onkeypress="return event.charCode != 32" required maxlength="20" ng-model="FrmUSer.Username" id="Username" required />
    </div>
    <div class="mb-3  col-md-3 form-password-toggle">
        <div class="d-flex justify-content-between">
            <label class="form-label" for="Password">Password</label>
        </div>
        <div class="input-group input-group-merge">
            <input type="password" class="form-control" name="Password" ng-model="FrmUSer.Password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required id="Password" />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
    </div>
</div>
<?php
ModalEnd("true", "Save", "SaveBtnID");
?>
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
    var GlobalTblScope = "";
    var GlobalFrmScope = "";
    var GlobalEditscopeScope = "";
    var GlobalShwDetailScope = "";
    var APIRootPath = sessionStorage.getItem("APIRootPath");
    app.controller('userCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalTblScope = $scope;
        $rootScope.FrmUSer = [];
        $scope.FrmTicket = {};
        $scope.customeruserdetails = [];
        $rootScope.UserUUID = LoginData.Uuid;
        $rootScope.LinkedToId = LoginData.LinkedToId;

        $rootScope.GetCustomeUser = function() 
        {
            var url = APIRootPath + "api/GetCustomerUser/" + $rootScope.UserUUID;
            $http.get(url, urlconfig).then(
                function(response) 
                {
                    $scope.customeruserdetails = response.data.customeruserdetails;
                },
                function(response) 
                {
                    if (response.data.status != 401) 
                    {
                        Swal.fire("OOPS", response.data.message, "error");
                    } else 
                    {
                        window.location.replace(APIBasePath);
                    }
                }
            );
        }

        $scope.showSaveUserModal = function() 
        {
            $rootScope.FrmUSer = [];
            $('#saveUserModal').modal('show');
        }

        $scope.editUserModal = function(customerUser) 
        {
            angular.copy(customerUser, $rootScope.FrmUSer);
            $('#saveUserModal').modal('show');
        }

        $scope.UpdateCustomerUserStatus = function(customerUser) 
        {
            var action = "";
            if (customerUser.IsActive == 1) 
            {
                action = 'Deactivate';
            } 
            else 
            {
                action = 'Activate';
            }
            Swal.fire({
                title: 'Confirm',
                text: action + " this User?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = APIRootPath + "api/UpdateStatus/" + $rootScope.UserUUID;
                    var param = {
                        "User_Id": customerUser.Id,
                        "IsActive": customerUser.IsActive,
                        "WorkOn": "customer_user_detail",
                        "UserTypeID": 4,
                    };

                    $http.post(url, param, urlconfig).then(
                        function(response) {
                            Swal.fire("Done", "Customer " + action.toLowerCase() + "d successfully", "success");
                            $rootScope.GetCustomeUser();
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
        };

        $scope.SendMail = function(customerUser) 
        {
            var url = APIRootPath + "api/UserRegistrationMail/" + $rootScope.UserUUID;
            var param = {
                "userId": customerUser.Id,
                "UserTypeId": 4,
            };
            $http.post(url, param, urlconfig).then(function(response)
                {
                    $scope.isAuthenticating = false;
                    Swal.fire("Done", "Mail Send", "success");
                },
                function(response) 
                {
                    if (response.data.status != 401) 
                    {
                        $scope.isAuthenticating = false;
                        Swal.fire("OOPS", response.data.message, "error");
                        $scope.PasswordError = response.data.message;
                    } 
                    else 
                    {
                        window.location.replace(APIBasePath);
                    }
                }
            );
        }

        $scope.DeleteCustomerUser = function(customerUser) 
        {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => 
            {
                if (result.isConfirmed) {
                    var url = APIRootPath + "api/DeleteDetails/" + $rootScope.UserUUID + "/" + customerUser.Code + "/" + customerUser.Id + "/" + "customer_user_detail" + "/" + 4;
                    $http.get(url, urlconfig).then(
                        function(response) 
                        {
                            Swal.fire("Done", "User deleted successfully", "success");
                            $rootScope.GetCustomeUser();
                        },
                        function(response) 
                        {
                            if (response.data.status != 401) 
                            {
                                Swal.fire("OOPS", response.data.message, "error");
                            } 
                            else 
                            {
                                window.location.replace(APIBasePath);
                            }
                        }
                    );
                }
            });
        }
        setInterval($rootScope.GetCustomeUser, 10000);
        $rootScope.GetCustomeUser();
    });
    // controller for ticket detail
    app.controller('saveUserCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalShwDetailScope = $scope;
        $scope.FrmProduct = {};

        $scope.saveUser = function() 
        {
            var form = document.getElementById("FrmUSer");
            if (form.reportValidity()) {
                if (!$scope.SaveClicked) {
                    $scope.SaveClicked = true;
                    var btn = document.getElementById("SaveBtnID").innerHTML;
                    document.getElementById("SaveBtnID").innerHTML = "Saving...";
                    document.getElementById("SaveBtnID").disabled = true;
                    var url = APIRootPath + "api/SaveCustomerUser/" + $rootScope.UserUUID;
                    var param = {
                        "UUID": $rootScope.FrmUSer.Uuid == undefined ? '' : $rootScope.FrmUSer.Uuid,
                        "Code": $rootScope.FrmUSer.Code == undefined ? '' : $rootScope.FrmUSer.Code,
                        "Id": $rootScope.FrmUSer.Id == undefined ? '' : $rootScope.FrmUSer.Id,
                        "FirstName": $rootScope.FrmUSer.FirstName,
                        "LastName": $rootScope.FrmUSer.LastName,
                        "Email": $rootScope.FrmUSer.Email,
                        "Mobile": $rootScope.FrmUSer.Mobile,
                        "Address": $rootScope.FrmUSer.Address,
                        "Username": $rootScope.FrmUSer.Username,
                        "Password": $rootScope.FrmUSer.Password,
                    }
                    $http.post(url, param, urlconfig).then(function(response) {
                            $rootScope.customer = JSON.stringify(response.data.customer);
                            $("#saveUserModal").modal('hide');
                            $rootScope.GetCustomeUser();
                            Swal.fire("Done", "User Add successfully", "success");
                            $scope.SaveClicked = false;
                            document.getElementById("SaveBtnID").innerHTML = btn;
                            document.getElementById("SaveBtnID").disabled = false;
                        },
                        function(response) {
                            $scope.SaveClicked = false;
                            document.getElementById("SaveBtnID").innerHTML = btn;
                            document.getElementById("SaveBtnID").disabled = false;
                            if (response.data.status != 401) {
                                $("#saveUserModal").modal('hide');
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
            var btn = document.getElementById("SaveBtnID");
            btn.disabled = true; // Initially disable the button
            if ($rootScope.oldEmail != $scope.FrmUSer.Email || $rootScope.oldMoblile != $scope.FrmUSer.Mobile) {
                var url = APIRootPath + "api/CheckDuplicateEmailMobile/" + $rootScope.UserUUID;
                var param = {
                    "EmailMobile": EmailMobile,
                    "Action": Action,
                    "WorkOn": 'customer_user_detail'
                }
                // Clear the error messages before making the API call
                if (Action == 'Email') {
                    $rootScope.EmailErrorMessage = "";
                } else if (Action == 'Mobile') {
                    $rootScope.MobileErrorMessage = "";
                }
                $http.post(url, param, urlconfig).then(
                    function(response) {
                        console.log(response.data); // Log the entire response data
                        if (response.data.status === 409) {
                            if (Action == 'Email') {
                                $rootScope.EmailErrorMessage = response.data.message; // Set error message in scope variable
                            } else if (Action == 'Mobile') {
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
        }

        $rootScope.clearErrorMessage = function(Type) 
        {
            if (Type == 'Email') {
                $rootScope.EmailErrorMessage = "";
            } else {
                $rootScope.MobileErrorMessage = "";
            }
        }
    });
</script>

</html>