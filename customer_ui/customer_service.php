<!DOCTYPE html>
<html lang="en">
<title>Service List</title>
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
navbarStart();
MainContentStart(); //main content Start
pageContainerStart();
?>
<div class="row">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold">
            <span class="text-muted fw-light">Services</span>
        </h4>
    </div>
</div>
<div class="row" ng-controller="ctmServiceCtrl">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Services</h5>
            <div class="table-responsive text-nowrap" style="height: 350px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Service Code</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>ServiceName </th>
                            <th>Created on</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr ng-repeat="Service in servicesDetails">
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{Service.Code}}</td>
                            <td>{{Service.CompanyName}}</td>
                            <td>{{Service.Product}}</td>
                            <td>{{Service.ServiceName}}</td>
                            <td>{{Service.FormattedCreatedOn | date : "dd/MM/yyyy, h:mm a"}}</td>
                            <td> <a class="" href="javascript:void(0);" ng-click="ShowDeatail(Service)" title="Details"><i class='bx bx-info-circle me-1'></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    ModalStart("ShowDeatail", "lg", "Service Details", "FrmDetails", "FrmDetails", "servviceCtrl", "");
    ?>
    <div class="row">
        <div class="mb-3 col-md-3">
            <label for="ProductID" class="form-label">Product Code</label>
            <input class="form-control" type="text" ng-model="FrmDetails.Code" readonly />
        </div>
        <div class="mb-3 col-md-3">
            <label for="ProductName" class="form-label">Product Name</label>
            <input class="form-control" type="text" ng-model="FrmDetails.Product" readonly />
        </div>
        <div class="mb-3 col-md-3">
            <label for="Version" class="form-label">Version</label>
            <input class="form-control" type="text" ng-model="FrmDetails.Version" readonly />
        </div>
        <div class="mb-3  col-md-3">
            <label class="form-label" for="basic-default-Description">Service Name</label>
            <input class="form-control" type="text" ng-model="FrmDetails.ServiceName" readonly />
        </div>
        <div class="mb-3  col-md-12">
            <label class="form-label" for="basic-default-Description">Description</label>
            <textarea class="form-control" type="text" ng-model="FrmDetails.Description" readonly></textarea>
        </div>
        <div class="mb-3 col-md-4">
            <label for="Releasedate" class="form-label">Service On</label>
            <input class="form-control" type="text" ng-model="FrmDetails.FormattedCreatedOn" readonly />
        </div>
    </div>
    <?php
    ModalEnd("SaveItem()", "false", "");
    ?>
</div>
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
    var GlobalTblItemsScope = "";
    var APIRootPath = sessionStorage.getItem("APIRootPath");
    app.controller('ctmServiceCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalTblItemsScope = $scope;
        $rootScope.UserUUID = LoginData.Uuid;
        $rootScope.LinkedToId = LoginData.LinkedToId;
        $scope.Items = [];
        $scope.SearchData = '';
        $scope.FrmDetails = {};
        $scope.Frmservice = {};

        $scope.GetService = function() {
            var url = APIRootPath + "api/GetCustomerService/" + $rootScope.UserUUID + "/" + $rootScope.LinkedToId;
            $http.get(url, urlconfig).then(
                function(response) {
                    $scope.servicesDetails = response.data.services;
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

        $scope.GetService();
        //edit services 
        $scope.editServices = function(Service) {
            angular.copy(Service, $scope.Frmservice);
            $('#ServiceModal').modal('show');
        }
        $scope.ShowDeatail = function(Service) {
            angular.copy(Service, $scope.FrmDetails);
            $('#ShowDeatail').modal('show');
        }

        setInterval($scope.GetService, 10000);

    });
    app.controller('servviceCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        
    });
</script>
</html>