<!DOCTYPE html>
<html lang="en">
<title>My Product</title>

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
            <span class="text-muted fw-light">Products</span>
        </h4>
    </div>
</div>
<div class="row" ng-controller="ProductCtrl">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header d-flex justify-content-between align-items-center">Products
                <!-- <button type="button" class="btn btn-primary">Raise Ticket</button> -->
            </h5>
            <div class="table-responsive text-nowrap" style="height: 350px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Release Date </th>
                            <th>Valid Up To</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr ng-repeat="Product in ProductsDetails">
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{Product.Code}}</td>
                            <td>{{Product.ProductName}}</td>
                            <td>{{Product.ReleaseDate | date : "dd/MM/yyyy"}}</td>
                            <td>{{Product.ValidUpTo | date : "dd/MM/yyyy"}}</td>
                            <td><span class="badge  bg-{{Product.IsActive == 1 ? 'success':'danger'}}"><i class="bx bx-{{Product.IsActive == 1 ? 'check':'x'}}"></i></span></td>
                            <td>
                                <a class="" href="javascript:void(0);" ng-click="ShowDetails(Product)" title="Details"><i class="bx bx-info-circle me-1 me-1"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
ModalStart("ShowDetailProductModal", "lg", "Product Details", "FrmProduct", "FrmProduct", "ShowProductCtrl", "");
?>
<div class="row">
    <div class="mb-3 col-md-4">
        <label for="ProductID" class="form-label">Product ID</label>
        <input class="form-control" type="text" ng-model="FrmProduct.Code" readonly />
    </div>
    <div class="mb-3 col-md-4">
        <label for="ProductName" class="form-label">Product Name</label>
        <input class="form-control" type="text" ng-model="FrmProduct.ProductName" readonly />
    </div>
    <div class="mb-3 col-md-4">
        <label for="Version" class="form-label">Version</label>
        <input class="form-control" type="text" ng-model="FrmProduct.Version" readonly />
    </div>
    <div class="mb-3  col-md-12">
        <label class="form-label" for="basic-default-Description">Description</label>
        <textarea class="form-control" type="text" ng-model="FrmProduct.Description" readonly></textarea>
    </div>
    <div class="mb-3 col-md-12">
        <label for="Compatibilityinfo" class="form-label">Compatibility info</label>
        <input class="form-control" type="text" ng-model="FrmProduct.Compatibilityinfo" readonly>
    </div>
    <div class="mb-3 col-md-4">
        <label for="Releasedate" class="form-label">Release date</label>
        <input class="form-control" type="text" ng-model="FrmProduct.ReleaseDate | date : 'dd/MM/yyyy'" readonly />
    </div>
    <div class="mb-3 col-md-4">
        <label for="Validupto" class="form-label">Valid-up-to</label>
        <input class="form-control" type="text" ng-model="FrmProduct.ValidUpTo | date : 'dd/MM/yyyy'" readonly />
    </div>
</div>
<?php
ModalEnd("SaveItem()", "false", "");
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
    app.controller('ProductCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalTblScope = $scope;
        $scope.FrmProduct = {};
        $scope.FrmTicket = {};
        $scope.ProductsDetails = [];
        $rootScope.UserUUID = LoginData.Uuid;
        $rootScope.LinkedToId = LoginData.LinkedToId;

        $scope.GetCustomeProducts = function() {
            var url = APIRootPath + "api/GetCustomerProduct/" + $rootScope.UserUUID + "/" + $rootScope.LinkedToId;
            $http.get(url, urlconfig).then(
                function(response) {
                    $scope.ProductsDetails = response.data.Products;
                    if ($rootScope.ProductStatus != null) {
                        $scope.ProductsDetails = $scope.ProductsDetails.filter(Product => Product.IsActive == $rootScope.ProductStatus && Product.CustomerId == $rootScope.LinkedToId);
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

        $scope.ShowDetails = function(Product) {
            angular.copy(Product, GlobalShwDetailScope.FrmProduct);
            $('#ShowDetailProductModal').modal('show');
        }

        setInterval($scope.GetCustomeProducts, 10000);

        function getURLParameter(IsActive) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(IsActive);
        }
        // Get the 'IsActive' parameter
        $rootScope.ProductStatus = getURLParameter('IsActive');
        $scope.GetCustomeProducts();
    });
    // controller for ticket detail
    app.controller('ShowProductCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalShwDetailScope = $scope;
        $scope.FrmProduct = {};
    });
</script>
</html>