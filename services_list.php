<!DOCTYPE html>
<html lang="en">
<title>Service List</title>
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
//nabar ENd
MainContentStart(); //main content Start
pageContainerStart();
?>
<div class="row">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold">
            <span class="text-muted fw-light">Service List</span>
        </h4>
    </div>
</div>
<div class="row" ng-controller="serviceTblCtrl">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                <div class="col-md-4">
                    <input class="form-control" type="text" name="searchText" id="searchText" placeholder="Type to search" value="" ng-model="searchText" />
                </div>
                <div>
                    <button type="button" class="btn btn-primary" ng-click="addNewService()">Add</button>
                </div>
            </h5>
            <div class="table-responsive text-nowrap" style="height: 350px; overflow-y: auto;">
                <table class="table" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Service Code</th>
                            <th>Customer</th>
                            <th>Product </th>
                            <th>Service Name </th>
                            <th>Created On</th>
                            <!-- <th>Updated On </th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr ng-repeat="Service in servicesDetails | filter:searchText">
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{Service.Code}}</td>
                            <td>{{Service.CompanyName}}</td>
                            <td>{{Service.Product}}</td>
                            <td>{{Service.ServiceName}}</td>
                            <td>{{Service.CreatedOn | date : "dd-MM-yyyy"}}</td>
                            <!-- <td>{{Service.UpdatedOn | date : "dd-MM-yyyy"}}</td> -->
                            <td>
                                <a class="" href="javascript:void(0);" ng-click="editServices(Service)" title="Edit"><i class="bx bx-edit-alt me-1"></i></a>
                                <a class="" href="javascript:void(0);" ng-click="DeleteService(Service)" title="Delete"><i class="bx bx-trash me-1"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Adding New Service -->
<?php ModalStart("FrmserviceModal", "lg", "Add Service", "FrmNewservice", "FrmNewservice", "FrmAddNewServiceCrtl"); ?>
<div class="row">
    <div class="mb-3 col-md-4">
        <label for="CustomerID" class="form-label">Customer</label>
        <select class="select2 form-select" ng-model="FrmNewservice.CustomerId" ng-change="GetProducts(FrmNewservice.CustomerId)" id="CustomerId" required>
            <option value="">Select Customer</option>
            <option ng-repeat="Customer in customers" value="{{Customer.Id}}">{{Customer.CompanyName}}</option>
        </select>
    </div>
    <div class="mb-3 col-md-4">
        <label for="ProductID" class="form-label">Product</label>
        <select class="select2 form-select" ng-model="FrmNewservice.ProductId" id="ProductId" required>
            <option value="">Select Product ID</option>
            <option ng-repeat="Product in ProductDetails" value="{{Product.Id}}">{{Product.ProductName}}</option>
        </select>
    </div>
    <div class="mb-3 col-md-4">
        <label for="ServiceName" class="form-label">Service Name</label>
        <input class="form-control" type="text" ng-model="FrmNewservice.ServiceName" id="ServiceName" required />
    </div>
</div>
<div class="row">
    <div class="mb-3 col-md-8">
        <label class="form-label" for="basic-default-Description">Description</label>
        <input type="text" id="basic-default-Description" class="form-control" ng-model="FrmNewservice.Description" id="Description" required />
    </div>
    <div class="mb-3 col-md-4">
        <label class="form-label" for="Price">Price</label>
        <div class="input-group input-group-merge">
            <input type="text" class="form-control" pattern="[0-9]*" inputmode="numeric" placeholder="" ng-model="FrmNewservice.Price" id="Price" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
        </div>
    </div>
</div>
<?Php
ModalEnd("AddNewServicec()", "true", "Save", "AddNewServiceModalId");
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
    var GlobalTblServiceScope = "";
    var APIRootPath = sessionStorage.getItem("APIRootPath");
    app.controller('serviceTblCtrl', function($scope, $rootScope, $http, $filter) {
        $scope.servicesDetails = []; // Initialize the array
        GlobalTblServiceScope = $scope;
        $rootScope.UserUUID = LoginData.Uuid;

        $scope.GetServiceItems = function() {
            var url = APIRootPath + "api/GetServices/" + $rootScope.UserUUID;
            $http.get(url, urlconfig).then(
                function(response) {
                    $scope.servicesDetails = response.data.services;
                },
                function(response) {
                    window.location.replace(APIBasePath);
                }
            );
        }

        $rootScope.editServices = function(Service) {
            angular.copy(Service, GlobalFrmServiceScope.FrmNewservice);
            document.getElementById("ProductId").value = Service.ProductId;
            $rootScope.GetProducts(Service.CustomerId);
            $('#FrmserviceModal').modal('show');
        }

        $scope.addNewService = function() {
            GlobalFrmServiceScope.FrmNewservice = [];
            $('#FrmserviceModal').modal('show');
        }

        //detete service 
        $scope.DeleteService = function(Service) {
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
                    var url = APIRootPath + "api/DeleteService/" + $rootScope.UserUUID + "/" + Service.Id;
                    $http.get(url, urlconfig).then(
                        function(response) {
                            Swal.fire("Done", "Item deleted successfully", "success");
                            GlobalTblServiceScope.GetServiceItems();
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
        setInterval(GlobalTblServiceScope.GetServiceItems, 10000);

        //calling
        $scope.GetServiceItems();

    });
    //Controller for Save New Service
    app.controller('FrmAddNewServiceCrtl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalFrmServiceScope = $scope;
        $scope.FrmNewservice = [];
        $scope.currentDate = $filter('date')(new Date(), 'yyyy-MM-dd');
        //get custome id

        $rootScope.GetCustomerDetail = function() {
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

        //Add a new service

        $scope.AddNewServicec = function() {
            var form = document.getElementById("FrmNewservice");
            if (form.reportValidity()) {
                if (!$scope.SaveClicked) {
                    $scope.SaveClicked = true;
                    var url = APIRootPath + "api/AddService/" + $rootScope.UserUUID;
                    var param = {
                        "ServiceCode": $scope.FrmNewservice.Code == undefined ? '' : $scope.FrmNewservice.Code,
                        "ProductId": $scope.FrmNewservice.ProductId,
                        "CustomerId": $scope.FrmNewservice.CustomerId,
                        "ServiceName": $scope.FrmNewservice.ServiceName,
                        "Description": $scope.FrmNewservice.Description,
                        "Price": $scope.FrmNewservice.Price,
                    }
                    $http.post(url, param, urlconfig).then(function(response) {
                            $('#FrmserviceModal').modal('hide');
                            Swal.fire("Done", "Item saved successfully", "success");
                            $scope.SaveClicked = false;
                            $scope.FrmNewservice = [];
                            GlobalTblServiceScope.GetServiceItems();
                            // location.reload()
                        },
                        function(response) {
                            $scope.SaveClicked = false;
                            if (response.data.status != 401) {
                                $('#FrmserviceModal').modal('hide');
                                Swal.fire("OOPS", response.data.message, "error");
                            } else {
                                window.location.replace(APIBasePath);
                            }
                        }
                    );

                }
            }

        }
        $rootScope.GetProducts = function(CustomerId) {
            var url = APIRootPath + "api/GetCustomerProduct/" + $rootScope.UserUUID + "/" + CustomerId;
            $http.get(url, urlconfig).then(
                function(response) {
                    $rootScope.ProductDetails = response.data.Products;
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
        //caling
        $scope.GetCustomerDetail();
    });
</script>

</html>