t<!DOCTYPE html>
<html lang="en">
<title>Customer List</title>
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
            <span class="text-muted fw-light">Customer List</span>
        </h4>
    </div>
</div>
<div class="row" ng-controller="customerTBlCtrl">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                <div class="col-md-4">
                    <input class="form-control" type="text" name="searchText" id="searchText" placeholder="Type to search" value="" ng-model="searchText" />
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" ng-click="AddNewCustomer()">Add</button>
                </div>
            </h5>
            <div class="table-responsive text-nowrap" style="height: 350px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr ng-repeat="Customer in customers | filter:searchText">
                            <td>{{Customer.Code}}</td>
                            <td>{{Customer.CustomerFullName}}</td>
                            <td>{{Customer.Mobile}}</td>
                            <td>{{Customer.Email}}</td>
                            <td>{{Customer.CompanyName}}</td>
                            <td><span style="cursor: pointer;" class="badge  bg-{{Customer.IsActive == 1 ? 'success':'danger'}}" ng-click="UpdateCustomerStatus(Customer)"><i class="bx bx-{{Customer.IsActive == 1 ? 'check':'x'}}"></i></span></td>
                            <td>
                                <a class="" href="javascript:void(0);" ng-click="EditCustomer(Customer)" title="Edit"><i class="bx bx-edit-alt me-1"></i></a>
                                <a class="" href="javascript:void(0);" ng-click="AddNewProduct(Customer)" title="Detail"><i class='bx bxs-user-detail'></i></a>
                                <a class="" ng-show="Customer.isexist==0" href="javascript:void(0);" ng-click="DeleteCustomer(Customer)" title="Delete"><i class="bx bx-trash me-1"></i></a>
                                <a class="" href="javascript:void(0);" ng-click="SendMail(Customer)" title="Send Mail"><i class='bx bx-mail-send me-1'></i></a>
                                <!-- <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show-alt me-1"></i> Show customers</a> -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
ModalStart("AddNewcustomerModal", "xl", "Add Customer ", "FrmCustomer", "FrmCustomer", "FrmCustomerCtrl");
?>
<div class="row">
    <div class="mb-3 col-md-3">
        <label for="FirstName" class="form-label">First Name</label>
        <input class="form-control" type="text" ng-model="FrmCustomer.FirstName" id="FirstName" required />
    </div>
    <div class="mb-3 col-md-3">
        <label for="LastName" class="form-label">Last Name</label>
        <input class="form-control" type="text" ng-model="FrmCustomer.LastName" id="LastName" />
    </div>
    <div class="mb-3 col-md-4">
        <label for="Email" class="form-label">E-mail</label>
        <input class="form-control" type="email" placeholder="john.doe@example.com" id="Email" ng-blur="duplicateEmailMobile(FrmCustomer.Email,'Email')" ng-change="clearErrorMessage('Email')" ng-model="FrmCustomer.Email" required />
        <span ng-show="EmailErrorMessage" class="error">{{EmailErrorMessage}}</span>
    </div>
    <div class="mb-3 col-md-2">
        <label class="form-label" for="Mobile">Mobile</label>
        <div class="input-group input-group-merge">
            <input type="tel" class="form-control" pattern="[0-9]{10}" placeholder="202 555 0111" ng-model="FrmCustomer.Mobile" ng-blur="duplicateEmailMobile(FrmCustomer.Mobile,'Mobile')" ng-change="clearErrorMessage('Mobile')" maxlength="10" id="Mobile" required />
        </div>
        <span ng-show="MobileErrorMessage" class="error">{{MobileErrorMessage}}</span>
    </div>
</div>
<div class="row">
    <div class="mb-3 col-md-3">
        <label for="CompanyName" class="form-label">Company</label>
        <input type="text" class="form-control" ng-model="FrmCustomer.CompanyName" id="CompanyName" required />
    </div>
    <div class="mb-3 col-md-3">
        <label for="IndustryTypeId" class="form-label col-md-12">Industry Type
            <span class="label" style="float: right;cursor: pointer;" ng-click="DeleteIndustryType(FrmCustomer.IndustryTypeId)" title="Add Industry Type"><i class="bx bx-trash me-1"></i></span>
            <span class="label" style="float: right;cursor: pointer;" ng-click="AddIndustryType()" title="Add Industry Type"><i class='bx bx-plus-circle'></i></span>
        </label>
        <select class="select2 form-select" ng-model="FrmCustomer.IndustryTypeId" id="IndustryTypeId" required ng-focus="clearErrorMsg()">
            <option value="">Select</option>
            <option ng-repeat="industry in industrys" value="{{industry.Id}}">{{industry.Type}}</option>
        </select>
        <p class="text-danger text-center"><b>{{ErrorMsg}}</b></p>
    </div>
    <div class="mb-3 col-md-6">
        <label for="CompanyName" class="form-label">Company Address</label>
        <input type="text" class="form-control" ng-model="FrmCustomer.CompanyAddress" id="CompanyAddress" required />
    </div>
</div>
<div class="row">
    <div class="mb-3 col-md-3">
        <label for="Country" class="form-label">Country</label>
        <input class="form-control" type="text" placeholder="" ng-model="FrmCustomer.Country" id="Country" required />
    </div>
    <div class="mb-3 col-md-3">
        <label for="State" class="form-label">State</label>
        <input class="form-control" type="text" placeholder="California" ng-model="FrmCustomer.State" id="State" required />
    </div>
    <div class="mb-3 col-md-4">
        <label for="City" class="form-label">City</label>
        <input class="form-control" type="text" placeholder="" ng-model="FrmCustomer.City" id="City" required />
    </div>
    <div class="mb-3 col-md-2">
        <label for="Pincode" class="form-label">Pin/Zip Code</label>
        <input type="text" class="form-control" placeholder="" maxlength="6" ng-model="FrmCustomer.Pincode" id="Pincode" required />
    </div>
</div>
<div class="row">
    <div class="mb-3 col-md-3">
        <label for="Username" class="form-label">Username</label>
        <input type="text" class="form-control" placeholder="Username" onkeypress="return event.charCode != 32" required maxlength="20" ng-model="FrmCustomer.Username" id="Username" required />
    </div>
    <div class="mb-3  col-md-3 form-password-toggle">
        <div class="d-flex justify-content-between">
            <label class="form-label" for="Password">Password</label>
        </div>
        <div class="input-group input-group-merge">
            <input type="password" class="form-control" name="Password" ng-model="FrmCustomer.Password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required id="Password" />
            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
    </div>
</div>
<?php
ModalEnd("AddCustomer()", "true", "Save", "AddCustomerBtnId");
ModalStart("AddIndustryTypeModal", "sm", "Add Industry Type", "FrmIndustry", "FrmIndustry", "IndustryModalCtrl");
?>
<div class="row">
    <div class="mb-3 col-md-12">
        <label for="IndustryName" class="form-label">Industry Type</label>
        <input type="text" id="IndustryName" class="form-control" placeholder=" Enter Industry Name" ng-model="FrmIndustry.IndustryName" required />
    </div>
</div>
<?php
ModalEnd("saveIndustry()", "true", "Save", "saveIndustryBtnId");
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
    var GlobalUpdateModelScope = "";
    var GlobalIndustryTypScope = "";
    var APIRootPath = sessionStorage.getItem("APIRootPath")
    app.controller('customerTBlCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        var LoginData = JSON.parse(sessionStorage.getItem("LoginData"));
        GlobalTblScope = $scope;
        $scope.FrmCustomer = [];
        $scope.customers = [];
        $rootScope.customer = [];
        /*Function for get Customer detail */
        $scope.GetCustomerDetail = function() {
            var url = APIRootPath + "api/GetCustomer/" + $rootScope.UserUUID;
            $http.get(url, urlconfig).then(
                function(response) {
                    $scope.customers = response.data.customers;
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

        /*edit services model*/
        $scope.EditCustomer = function(Customer) {
            angular.copy(Customer, GlobalFrmScope.FrmCustomer);
            $rootScope.oldEmail = GlobalFrmScope.FrmCustomer.Email;
            $rootScope.oldMoblile = GlobalFrmScope.FrmCustomer.Mobile;
            $('#AddNewcustomerModal').modal('show');
        }
        /*Add Customer model*/
        $scope.AddNewCustomer = function(Customer) {
            GlobalFrmScope.FrmCustomer = [];
            $('#AddNewcustomerModal').modal('show');
        }
        $scope.AddNewProduct = function(Customer) {
            sessionStorage.setItem('customer', JSON.stringify(Customer));
            window.open('ProductSection', '_self')
        }
        /*Function for Update Customer Status*/
        $scope.UpdateCustomerStatus = function(Customer) {
            var action = "";
            if (Customer.IsActive == 1) {
                action = 'Deactivate';
            } else {
                action = 'Activate';
            }
            Swal.fire({
                title: 'Confirm',
                text: action + " this Customer?",
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
                        "User_Id": Customer.Id,
                        "IsActive": Customer.IsActive,
                        "WorkOn": "customers",
                        "UserTypeID": 3,
                    };

                    $http.post(url, param, urlconfig).then(
                        function(response) {
                            Swal.fire("Done", "Customer " + action.toLowerCase() + "d successfully", "success");
                            $scope.GetCustomerDetail();
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

        /*FUnction For Delete Customer*/
        $scope.DeleteCustomer = function(Customer) {
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
                    var url = APIRootPath + "api/DeleteDetails/" + $rootScope.UserUUID + "/" + Customer.Code + "/" + Customer.Id + "/" + "customers" + "/" + 3;
                    $http.get(url, urlconfig).then(
                        function(response) {
                            Swal.fire("Done", "Customer deleted successfully", "success");
                            $scope.GetCustomerDetail();
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

        $scope.SendMail = function(Customer) {
            var url = APIRootPath + "api/UserRegistrationMail/" + $rootScope.UserUUID;
            var param = {
                "userId":Customer.Id,
                "UserTypeId": 3,
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

        setInterval(GlobalTblScope.GetCustomerDetail, 10000);
        /*Function Call*/
        $scope.GetCustomerDetail();
    });
    /*Controller For Add And Update customer Model*/
    app.controller('FrmCustomerCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalFrmScope = $scope;
        $scope.FrmCustomer = [];
        $scope.SaveClicked = false;
        $rootScope.EmailErrorMessage = "";
        $rootScope.MobileErrorMessage = "";
        /*Function For Add Customer*/
        $scope.AddCustomer = function() {
            var form = document.getElementById("FrmCustomer");
            if (form.reportValidity()) {
                if (!$scope.SaveClicked) {
                    $scope.SaveClicked = true;
                    var btn = document.getElementById("AddCustomerBtnId").innerHTML;
                    document.getElementById("AddCustomerBtnId").innerHTML = "Saving...";
                    document.getElementById("AddCustomerBtnId").disabled = true;
                    var url = APIRootPath + "api/AddCustomer/" + $rootScope.UserUUID;
                    var param = {
                        "UUID": $scope.FrmCustomer.Uuid == undefined ? '' : $scope.FrmCustomer.Uuid,
                        "Code": $scope.FrmCustomer.Code == undefined ? '' : $scope.FrmCustomer.Code,
                        "Id": $scope.FrmCustomer.Id == undefined ? '' : $scope.FrmCustomer.Id,
                        "FirstName": $scope.FrmCustomer.FirstName,
                        "LastName": $scope.FrmCustomer.LastName,
                        "Email": $scope.FrmCustomer.Email,
                        "Mobile": $scope.FrmCustomer.Mobile,
                        "CompanyName": $scope.FrmCustomer.CompanyName,
                        "IndustryTypeId": $scope.FrmCustomer.IndustryTypeId,
                        "CompanyAddress": $scope.FrmCustomer.CompanyAddress,
                        "Country": $scope.FrmCustomer.Country,
                        "State": $scope.FrmCustomer.State,
                        "City": $scope.FrmCustomer.City,
                        "Pincode": $scope.FrmCustomer.Pincode,
                        "Username": $scope.FrmCustomer.Username,
                        "Password": $scope.FrmCustomer.Password,
                    }
                    $http.post(url, param, urlconfig).then(function(response) {
                            $rootScope.customer = JSON.stringify(response.data.customer);
                            sessionStorage.setItem('customer', $rootScope.customer);
                            $("#AddNewcustomerModal").modal('hide');
                            $scope.FrmCustomer = [];
                            Swal.fire("Done", "Customer Add successfully", "success");
                            $scope.SaveClicked = false;
                            document.getElementById("AddCustomerBtnId").innerHTML = btn;
                            document.getElementById("AddCustomerBtnId").disabled = false;
                            GlobalTblScope.GetCustomerDetail();
                            window.open('ProductSection', '_self')
                        },
                        function(response) {
                            $scope.SaveClicked = false;
                            document.getElementById("AddCustomerBtnId").innerHTML = btn;
                            document.getElementById("AddCustomerBtnId").disabled = false;
                            if (response.data.status != 401) {
                                $("#AddNewcustomerModal").modal('hide');
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
            var btn = document.getElementById("AddCustomerBtnId");
            btn.disabled = true; // Initially disable the button
            if ($rootScope.oldEmail != $scope.FrmCustomer.Email || $rootScope.oldMoblile != $scope.FrmCustomer.Mobile) {
                var url = APIRootPath + "api/CheckDuplicateEmailMobile/" + $rootScope.UserUUID;
                var param = {
                    "EmailMobile": EmailMobile,
                    "Action": Action,
                    "WorkOn": 'customers'
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

        $rootScope.clearErrorMessage = function(Type) {
            if (Type == 'Email') {
                $rootScope.EmailErrorMessage = "";
            } else {
                $rootScope.MobileErrorMessage = "";
            }
        }

        /*Function For Add Industry Type Model*/
        $rootScope.AddIndustryType = function() {
            $("#AddIndustryTypeModal").modal('show');
        }
        /*Function TO get Industry*/
        $rootScope.getIndustry = function() {
            var url = APIRootPath + "api/GetIndustry/" + $rootScope.UserUUID;
            $http.get(url, urlconfig).then(
                function(response) {
                    $rootScope.industrys = response.data.industrys;
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
        /*Function Call*/
        $rootScope.getIndustry();
    });
    /*controller For Add Industry Type Model*/
    app.controller('IndustryModalCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalIndustryTypScope = $scope;
        $scope.FrmIndustry = [];
        $scope.SaveClicked = false;
        $rootScope.ErrorMsg = "";

        $rootScope.saveIndustry = function() {
            var form = document.getElementById("FrmIndustry");
            if (form.reportValidity()) {
                if (!$scope.SaveClicked) {
                    $scope.SaveClicked = true;
                    var btn = document.getElementById("saveIndustryBtnId").innerHTML;
                    document.getElementById("saveIndustryBtnId").innerHTML = "Saving...";
                    document.getElementById("saveIndustryBtnId").disabled = true;

                    var url = APIRootPath + "api/AddIndustryType/" + $rootScope.UserUUID;
                    var param = {
                        "IndustryName": $scope.FrmIndustry.IndustryName,
                    };
                    $http.post(url, param, urlconfig).then(function(response) {
                            $("#AddIndustryTypeModal").modal('hide');
                            // Swal.fire("Done", "Item saved successfully", "success");
                            $scope.SaveClicked = false;
                            document.getElementById("saveIndustryBtnId").innerHTML = btn;
                            document.getElementById("saveIndustryBtnId").disabled = false;
                            GlobalFrmScope.getIndustry();
                        },
                        function(response) {
                            $scope.SaveClicked = false;
                            document.getElementById("saveIndustryBtnId").innerHTML = btn;
                            document.getElementById("saveIndustryBtnId").disabled = false;
                            if (response.data.status != 401) {
                                $("#AddIndustryTypeModal").modal('hide');
                                $("#AddNewcustomerModal").modal('hide');
                                Swal.fire("OOPS", response.data.message, "error");
                            } else {
                                window.location.replace(APIBasePath);
                            }
                        }
                    );
                }
            }
        };

        $rootScope.DeleteIndustryType = function(IndustryTypeId) {
            $rootScope.ErrorMsg = "";
            var url = APIRootPath + "api/DeleteIndustryType/" + $rootScope.UserUUID + "/" + IndustryTypeId;
            $http.get(url, urlconfig).then(
                function(response) {
                    GlobalFrmScope.getIndustry();
                },
                function(response) {
                    if (response.data.status != 401) {
                        $rootScope.ErrorMsg = response.data.message;
                    } else {
                        window.location.replace(APIBasePath);
                    }
                }
            );
        };

        $rootScope.clearErrorMsg = function() {
            $rootScope.ErrorMsg = "";
        };
    });
</script>

</html>