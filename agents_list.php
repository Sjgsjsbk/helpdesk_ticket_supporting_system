<!DOCTYPE html>
<html lang="en">
<title>Agents List</title>

<?php
include 'pagesection.php';
pageHeader();
LayoutWrapperStart();
LayoutContainerStart();

sideBarStart(); //Sidebar Start 
sideBar_Brand();
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
            <span class="text-muted fw-light">Agents List</span>
        </h4>
    </div>
</div>
<div class="row" ng-controller="agentTblCtrl">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                <div class="col-md-4">
                    <input class="form-control" type="text" name="searchText" id="searchText" placeholder="Type to search" value="" ng-model="searchText" />
                </div>
                <div>
                    <button type="button" class="btn btn-primary" ng-click="AddNewAgent()">Add</button>
                </div>
            </h5>
            <div class="table-responsive text-nowrap" style="height: 350px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr ng-repeat="Agents in AgentsDetails | filter:searchText">
                            <td>{{Agents.Code}}</td>
                            <td>{{Agents.AgentFullName}}</td>
                            <td>{{Agents.Email}}</td>
                            <td>{{Agents.Mobile}}</td>
                            <td><span style="cursor: pointer;" class="badge  bg-{{Agents.IsActive == 1 ? 'success':'danger'}}" ng-click="UpdateAgentStatus(Agents)"><i class="bx bx-{{Agents.IsActive == 1 ? 'check':'x'}}"></i></span></td>
                            <td>
                                <a class="" href="javascript:void(0);" ng-click="EditAgentDetails(Agents)" title="Edit"><i class="bx bx-edit-alt me-1"></i></a>
                                <a class="" ng-show="Agents.isexist==0" href="javascript:void(0);" ng-click="DeleteAgent(Agents)" title="Delete"><i class="bx bx-trash me-1"></i></a>
                                <a class="" href="javascript:void(0);" ng-click="SendMail(Agents)" title="Send Mail"><i class='bx bx-mail-send me-1'></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
ModalStart("AddNewAgentModel", "xl", "Add Agent", "FrmAgent", "FrmAgent", "FrmAgentCtrl");
?>
<div class="row">
    <div class="mb-3 col-md-3">
        <label for="FirstName" class="form-label">First Name</label>
        <input class="form-control" type="text" id="FirstName" ng-model="FrmAgent.FirstName" required />
    </div>
    <div class="mb-3 col-md-3">
        <label for="lastName" class="form-label">Last Name</label>
        <input class="form-control" type="text" id="LastName" ng-model="FrmAgent.LastName" />
    </div>
    <div class="mb-3 col-md-4">
        <label for="Email" class="form-label">E-mail</label>
        <input class="form-control" type="text" placeholder="john.doe@example.com" ng-blur="duplicateEmailMobile(FrmAgent.Email,'Email')" ng-change="clearErrorMessage('Email')" id="Email" ng-model="FrmAgent.Email" required />
        <span ng-show="EmailErrorMessage" class="error">{{EmailErrorMessage}}</span>
    </div>
    <div class="mb-3 col-md-2">
        <label class="form-label" for="Mobile">Mobile Number</label>
        <div class="input-group input-group-merge">
            <input type="tel" class="form-control" placeholder="202 555 0111" id="Mobile" ng-model="FrmAgent.Mobile" ng-blur="duplicateEmailMobile(FrmAgent.Mobile,'Mobile')" pattern="[0-9]{10}" ng-change="clearErrorMessage('Mobile')" maxlength="10" required />
        </div>
        <span ng-show="MobileErrorMessage" class="error">{{MobileErrorMessage}}</span>
    </div>
</div>
<div class="row">
    <div class="mb-3 col-md-6">
        <label for="Address" class="form-label">Address</label>
        <input type="text" class="form-control" placeholder="Address" id="Address" ng-model="FrmAgent.Address" required />
    </div>
    <div class="mb-3 col-md-3">
        <label for="Country" class="form-label">Country</label>
        <input class="form-control" type="text" placeholder="" id="Country" ng-model="FrmAgent.Country" required />
    </div>
    <div class="mb-3 col-md-3">
        <label for="State" class="form-label">State</label>
        <input class="form-control" type="text" placeholder="California" id="State" ng-model="FrmAgent.State" required />
    </div>
</div>
<div class="row">
    <div class="mb-3 col-md-3">
        <label for="City" class="form-label">City</label>
        <input class="form-control" type="text" placeholder="" id="City" ng-model="FrmAgent.City" required />
    </div>
    <div class="mb-3 col-md-3">
        <label for="PinCode" class="form-label">Pin/Zip Code</label>
        <input type="text" class="form-control" placeholder="" maxlength="6" id="PinCode" ng-model="FrmAgent.PinCode" required />
    </div>
    <div class="mb-3 col-md-3">
        <label for="Username" class="form-label">Username</label>
        <input type="text" class="form-control" placeholder="Username" id="Username" ng-model="FrmAgent.Username" onkeypress="return event.charCode != 32" required maxlength="20" required />
    </div>
    <div class="mb-3  col-md-3 form-password-toggle">
        <div class="d-flex justify-content-between">
            <label class="form-label" for="Password">Password</label>
        </div>
        <div class="input-group input-group-merge">
            <input type="password" class="form-control" id="Password" ng-model="FrmAgent.Password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
    </div>
</div>
<?php
ModalEnd("AddNewAgents()", "true", "Save", "AddNewBtnId");
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
    // var app = angular.module("MyApp", []);
    var GlobalTblScope = "";
    var GlobalFrmScope = "";
    var LoginData = JSON.parse(sessionStorage.getItem("LoginData"));
    var APIRootPath = sessionStorage.getItem("APIRootPath")
    app.controller('agentTblCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalTblScope = $scope;
        $rootScope.UserUUID = LoginData.Uuid;
        //Get the agent details from Agent Table
        $scope.GetAgentDtail = function() {
            var url = APIRootPath + "api/GetAgent/" + $rootScope.UserUUID;
            $http.get(url, urlconfig).then(
                function(response) {
                    $scope.AgentsDetails = response.data.agents;
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
        $scope.GetAgentDtail();

        //Update agent Acount Status 
        $scope.UpdateAgentStatus = function(Agents) {
            var action = "";
            if (Agents.IsActive == 1) {
                action = 'Deactivate';
            } else {
                action = 'Activate';
            }
            Swal.fire({
                title: 'Confirm',
                text: action + " this Agent?",
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
                        "User_Id": Agents.Id,
                        "IsActive": Agents.IsActive,
                        "WorkOn": "agents",
                        "UserTypeID": 2,
                    };

                    $http.post(url, param, urlconfig).then(
                        function(response) {
                            Swal.fire("Done", "Agent " + action.toLowerCase() + "d successfully", "success");
                            $scope.GetAgentDtail();
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

        //Open modal for Edit agent Details
        $scope.EditAgentDetails = function(Agents) {
            angular.copy(Agents, GlobalFrmScope.FrmAgent);
            $rootScope.oldEmail = GlobalFrmScope.FrmAgent.Email;
            $rootScope.oldMoblile = GlobalFrmScope.FrmAgent.Mobile;
            $('#AddNewAgentModel').modal('show');
        }
        $scope.AddNewAgent = function(Agents) {
            GlobalFrmScope.FrmAgent = [];
            $('#AddNewAgentModel').modal('show');
        }

        $scope.DeleteAgent = function(Agents) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = APIRootPath + "api/DeleteDetails/" + $rootScope.UserUUID + "/" + Agents.Code + "/" + Agents.Id + "/" + "agents" + "/" + 2;
                    $http.get(url, urlconfig).then(
                        function(response) {
                            Swal.fire("Done", "Item deleted successfully", "success");
                            $scope.GetAgentDtail();
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
        }

        $scope.SendMail = function(Agents) {
            var url = APIRootPath + "api/UserRegistrationMail/" + $rootScope.UserUUID;
            var param = {
                "userId": Agents.Id,
                "UserTypeId": 2,
            };
            $http.post(url, param, urlconfig).then(function(response) {
                    $scope.isAuthenticating = false;
                    Swal.fire("Done", "Mail Send", "success");
                },
                function(response) {
                    if (response.data.status != 401) {
                        $scope.isAuthenticating = false;
                        Swal.fire("OOPS", response.data.message, "error");
                        $scope.PasswordError = response.data.message;
                    } else {
                        window.location.replace(APIBasePath);
                    }
                }
            );
        }
        setInterval(GlobalTblScope.GetAgentDtail, 10000);
    });
    app.controller('FrmAgentCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalFrmScope = $scope;
        $scope.FrmAgent = [];
        $rootScope.EmailErrorMessage = "";
        $rootScope.MobileErrorMessage = "";

        //Function to Update the Agent Details
        $scope.AddNewAgents = function() {
            var form = document.getElementById("FrmAgent");
            if (form.reportValidity()) {
                if (!$scope.SaveClicked) {
                    $scope.SaveClicked = true;
                    var btn = document.getElementById("AddNewBtnId").innerHTML;
                    document.getElementById("AddNewBtnId").innerHTML = "Saving...";
                    document.getElementById("AddNewBtnId").disabled = true;

                    var url = APIRootPath + "api/AddAgent/" + $rootScope.UserUUID;
                    var param = {
                        "UUID": $scope.FrmAgent.Uuid == undefined ? '' : $scope.FrmAgent.Uuid,
                        "Code": $scope.FrmAgent.Code == undefined ? '' : $scope.FrmAgent.Code,
                        "Id": $scope.FrmAgent.Id == undefined ? '' : $scope.FrmAgent.Id,
                        "FirstName": $scope.FrmAgent.FirstName,
                        "LastName": $scope.FrmAgent.LastName,
                        "Email": $scope.FrmAgent.Email,
                        "Mobile": $scope.FrmAgent.Mobile,
                        "Username": $scope.FrmAgent.Username,
                        "Password": $scope.FrmAgent.Password,
                        "Address": $scope.FrmAgent.Address,
                        "City": $scope.FrmAgent.City,
                        "State": $scope.FrmAgent.State,
                        "PinCode": $scope.FrmAgent.PinCode,
                        "Country": $scope.FrmAgent.Country,
                    }
                    $http.post(url, param, urlconfig).then(function(response) {
                            $scope.FrmAgent = [];
                            $("#AddNewAgentModel").modal('hide');
                            Swal.fire("Done", "Agent Add successfully", "success");
                            $scope.SaveClicked = false;
                            document.getElementById("AddNewBtnId").innerHTML = btn;
                            document.getElementById("AddNewBtnId").disabled = false;
                            GlobalTblScope.GetAgentDtail();
                            // location.reload();
                        },
                        function(response) {
                            $scope.SaveClicked = false;
                            document.getElementById("AddNewBtnId").innerHTML = btn;
                            document.getElementById("AddNewBtnId").disabled = false;
                            if (response.data.status != 401) {
                                $("#AddNewAgentModel").modal('hide');
                                Swal.fire("OOPS", response.data.message, "error");
                            } else {
                                window.location.replace(APIBasePath);
                            }
                        }
                    );

                }
            }

        }
        /*Function for check Duplicate Email Or Mobile */
        $scope.duplicateEmailMobile = function(EmailMobile, Action) {
            var btn = document.getElementById("AddNewBtnId");
            btn.disabled = true; // Initially disable the button

            if ($rootScope.oldEmail != $scope.FrmAgent.Email || $rootScope.oldMoblile != $scope.FrmAgent.Mobile) {
                var url = APIRootPath + "api/CheckDuplicateEmailMobile/" + $rootScope.UserUUID;
                var param = {
                    "EmailMobile": EmailMobile,
                    "Action": Action,
                    "WorkOn": 'agents'
                };

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
                            // Duplicate found
                            if (Action == 'Email') {
                                $rootScope.EmailErrorMessage = response.data.message; // Set error message in scope variable
                            } else if (Action == 'Mobile') {
                                $rootScope.MobileErrorMessage = response.data.message;
                            }
                            btn.disabled = true; // Keep the button disabled if a duplicate is found
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
        };
        $rootScope.clearErrorMessage = function(Type) {
            if (Type == 'Email') {
                $rootScope.EmailErrorMessage = "";
            } else {
                $rootScope.MobileErrorMessage = "";
            }
        }
    });
</script>

</html>