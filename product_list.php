<!DOCTYPE html>
<html lang="en">
<title>Product List</title>

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
            <span class="text-muted fw-light">Product List</span>
        </h4>
    </div>
</div>
<div class="row" ng-controller="ProductTblCtrl" ng-model="FrmTbl">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                <div class="col-md-4">
                    <input class="form-control" type="text" name="searchText" id="searchText" placeholder="Type to search" value="" ng-model="FrmTbl.searchText" />
                </div>
                <div>
                    <button type="button" class="btn btn-primary" ng-click="AddProduct()">Add</button>
                </div>
            </h5>
            <div class="table-responsive text-nowrap" style="height: 350px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Code</th>
                            <th>Customer Name</th>
                            <th>Product Name</th>
                            <th>Version</th>
                            <th>Release Date</th>
                            <th>Valid Up To</th>
                            <th>status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr ng-repeat="product in ProductDetails | filter:FrmTbl.searchText">
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{product.Code}}</td>
                            <td>{{product.CompanyName}}</td>
                            <td>{{product.ProductName}}</td>
                            <td>{{product.Version}}</td>
                            <td>{{product.ReleaseDate | date : "dd/MM/yyyy"}}</td>
                            <td>{{product.ValidUpTo | date : "dd/MM/yyyy"}}</td>
                            <td><span class="badge  bg-{{product.IsActive == 1 ? 'success':'danger'}}" ng-click="UpdateProductStatus(product)"><i class="bx bx-{{product.IsActive == 1 ? 'check':'x'}}"></i></span></td>
                            <td>
                                <div class="row">
                                    <div class="col-1">
                                        <a class="" href="javascript:void(0);" ng-click="EditProduct(product)" title="Edit"><i class="bx bx-edit-alt me-1"></i></a>
                                    </div>
                                    <div class="col-1" ng-show="product.isexist == 0">
                                        <a class="" href="javascript:void(0);" ng-click="DeleteProduct(product)" title="Delete"><i class="bx bx-trash me-1"></i></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
ModalStart("AddNewProductModal", "xl", "Add Product", "FrmNewProduct", "FrmNewProduct", "FrmProductCtrl");
?>
<div class="row">
    <div class="mb-3 col-md-4">
        <label for="CustomerID" class="form-label">Customer</label>
        <select class="select2 form-select" ng-model="FrmNewProduct.CustomerId" id="CompanyName" required>
            <option value="">Select Customer</option>
            <option ng-repeat="Customer in customers" value="{{Customer.Id}}">{{Customer.CompanyName}}</option>
        </select>
    </div>
    <div class="mb-3 col-md-3">
        <label for="ProductName" class="form-label">Product Name</label>
        <input class="form-control" type="text" name="ProductName" id="ProductName" ng-model="FrmNewProduct.ProductName" required />
    </div>
    <div class="mb-3 col-md-2">
        <label for="Version" class="form-label">Version</label>
        <input class="form-control" type="text" name="Version" id="Version" ng-model="FrmNewProduct.Version" required />
    </div>
    <div class="mb-3 col-md-3">
        <label for="IndustryTypeId" class="form-label col-md-12">Category
            <span class="label" style="float: right;cursor: pointer;" ng-click="DeleteCategory(FrmNewProduct.CategoryId)" title="Delete"><i class="bx bx-trash"></i></i></span>
            <span class="label" style="float: right;cursor: pointer;" ng-click="NewCategoryModel()" title="Add New"><i class='bx bx-plus-circle'></i></span>
        </label>
        <select class="select2 form-select" ng-model="FrmNewProduct.CategoryId" id="CategoryId" required>
            <option value="">Select</option>
            <option ng-repeat="category in categories" value="{{category.Id}}">{{category.CategoryName}}</option>
        </select>
        <p class="text-danger text-center"><b>{{ErrorMsg}}</b></p>
    </div>
</div>
<div class="row">
    <div class="mb-3 col-md-4">
        <label for="Compatibilityinfo" class="form-label">Compatibility Info</label>
        <input type="text" class="form-control" id="Compatibilityinfo" name="Compatibilityinfo" ng-model="FrmNewProduct.Compatibilityinfo" required />
    </div>
    <div class="mb-3 col-md-8">
        <label class="form-label" for="basic-default-Description">Description</label>
        <input type="text" id="basic-default-Description" class="form-control" placeholder="" name="Description" ng-model="FrmNewProduct.Description" required />
    </div>
</div>
<div class="row">
    <div class="mb-3 col-md-3">
        <label for="ReleaseDate" class="form-label">Release Date</label>
        <input type="date" class="form-control" id="ReleaseDate" name="ReleaseDate" placeholder="" ng-model="FrmNewProduct.ReleaseDate" required />
    </div>
    <div class="mb-3 col-md-3">
        <label for="ValidUpTo" class="form-label">Valid Up To</label>
        <input class="form-control" type="date" id="ValidUpTo" name="ValidUpTo" ng-model="FrmNewProduct.ValidUpTo" required />
    </div>
</div>
<?php ModalEnd("SaveProduct()", "true", "Save", "SaveModalBtnID");
ModalStart("ProductCategoryModel", "sm", "Add Category", "FrmNewCategory", "FrmNewCategory", "FrmCategoryCtrl");
?>
<div class="row">
    <div class="mb-3 col-md-12">
        <label for="IndustryName" class="form-label">Category</label>
        <input type="text" class="form-control" id="CategoryName" placeholder=" Enter Category" ng-model="FrmNewCategory.CategoryName" required />
    </div>
</div>
<?php ModalEnd("saveCategory()", "true", "Save", "ProductCategory"); ?>
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
    var GlobalFrmProductScope = "";
    var GlobalCategoryScope = "";
    var APIRootPath = sessionStorage.getItem("APIRootPath");
    app.controller('ProductTblCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        $scope.FrmProduct = {};
        $scope.FrmTbl = {};
        GlobalTblServiceScope = $scope;
        $rootScope.UserUUID = LoginData.Uuid;
        $scope.ProductDetails = [];

        //// show product details
        $scope.GetProducts = function() {
            var url = APIRootPath + "api/GetProduct/" + $rootScope.UserUUID;
            $http.get(url, urlconfig).then(
                function(response) {
                    $scope.ProductDetails = response.data.Products;
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

        //open model for edit the product details
        $scope.EditProduct = function(product) {
            angular.copy(product, GlobalFrmProductScope.FrmNewProduct);
            document.getElementById("ReleaseDate").value = product.ReleaseDate;
            document.getElementById("ValidUpTo").value = product.ValidUpTo;
            $('#AddNewProductModal').modal('show');
        }

        $scope.AddProduct = function() {
            // angular.copy(products, $GlobalFrmProductScope.FrmProduct);
            $('#AddNewProductModal').modal('show');
        }
        //update the product Status
        $scope.UpdateProductStatus = function(product) {
            var action = "";
            if (product.IsActive == 1) {
                action = 'Deactivate';
            } else {
                action = 'Activate';
            }

            Swal.fire({
                title: 'Confirm',
                text: action + " this Product?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = APIRootPath + "api/UpdateProductStatus/" + $rootScope.UserUUID;
                    var param = {
                        "ProductId": product.Id,
                        "IsActive": product.IsActive
                    };
                    $http.post(url, param, urlconfig).then(
                        function(response) {
                            Swal.fire("Done", "Product " + action.toLowerCase() + "d successfully", "success");
                            $scope.GetProducts();
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
        //Delete Product
        $scope.DeleteProduct = function(product) {
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
                    var url = APIRootPath + "api/DeleteProduct/" + $rootScope.UserUUID + "/" + product.Id;
                    $http.get(url, urlconfig).then(
                        function(response) {
                            Swal.fire("Done", "Item deleted successfully", "success");
                            $scope.GetProducts();
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
        setInterval(GlobalTblServiceScope.GetProducts, 10000);

        //calling
        $scope.GetProducts();

    });
    app.controller('FrmProductCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalFrmProductScope = $scope;
        $scope.FrmNewProduct = {};
        $rootScope.categories = [];
        $rootScope.ErrorMsg = ""; // Initialize ErrorMsg

        // Other functions...
        $rootScope.NewCategoryModel = function() {
            $('#ProductCategoryModel').modal('show');
        }

        $scope.SaveProduct = function() {
            var form = document.getElementById("FrmNewProduct")
            if (form.reportValidity()) {
                if (!$scope.SaveClicked) {
                    $scope.SaveClicked = true;
                    var btn = document.getElementById("SaveModalBtnID").innerHTML;
                    document.getElementById("SaveModalBtnID").innerHTML = "Saving...";
                    document.getElementById("SaveModalBtnID").disabled = true;
                    var url = APIRootPath + "api/AddProduct/" + $rootScope.UserUUID;
                    var param = {
                        "ProductCode": $scope.FrmNewProduct.Code == undefined ? '' : $scope.FrmNewProduct.Code,
                        "CustomerId": $scope.FrmNewProduct.CustomerId,
                        "ProductName": $scope.FrmNewProduct.ProductName,
                        "Version": $scope.FrmNewProduct.Version,
                        "Description": $scope.FrmNewProduct.Description,
                        "CategoryId": $scope.FrmNewProduct.CategoryId,
                        "ReleaseDate": $filter('date')(new Date($scope.FrmNewProduct.ReleaseDate), 'yyyy-MM-dd'),
                        "Compatibilityinfo": $scope.FrmNewProduct.Compatibilityinfo,
                        "ValidUpTo": $filter('date')(new Date($scope.FrmNewProduct.ValidUpTo), 'yyyy-MM-dd')
                    }
                    $http.post(url, param, urlconfig).then(function(response) {
                            $('#AddNewProductModal').modal('hide');
                            Swal.fire("Done", "Item saved successfully", "success");
                            $scope.SaveClicked = false;
                            document.getElementById("SaveModalBtnID").innerHTML = btn;
                            document.getElementById("SaveModalBtnID").disabled = false;
                            $scope.FrmNewProduct = [];
                            GlobalTblServiceScope.GetProducts();
                        },
                        function(response) {
                            $scope.SaveClicked = false;
                            document.getElementById("SaveModalBtnID").innerHTML = btn;
                            document.getElementById("SaveModalBtnID").disabled = false;
                            if (response.data.status != 401) {
                                $('#AddNewProductModal').modal('hide');
                                Swal.fire("OOPS", response.data.message, "error");
                            } else {
                                window.location.replace(APIBasePath);
                            }
                        }
                    );
                }
            }
        }

        //get customer details
        $rootScope.GetCustomerDetail = function() {
            var url = APIRootPath + "api/GetCustomer/" + $rootScope.UserUUID;
            $http.get(url, urlconfig).then(
                function(response) {
                    $rootScope.customers = response.data.customers;
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

        $rootScope.GetProductsCategory = function() {
            var url = APIRootPath + "api/GetProductCategory/" + $rootScope.UserUUID;
            $http.get(url, urlconfig).then(
                function(response) {
                    $rootScope.categories = response.data.categories;
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

        //calling
        $scope.GetProductsCategory();
        $scope.GetCustomerDetail();
    });

    app.controller('FrmCategoryCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        $scope.FrmCategory = {};
        $scope.FrmCategory = [];
        $rootScope.ErrorMsg = ""; // Initialize ErrorMsg
        GlobalCategoryScope = $scope;

        $scope.saveCategory = function() {
            var form = document.getElementById("FrmNewCategory");
            if (form.reportValidity()) {
                if (!$scope.SaveClicked) {
                    $scope.SaveClicked = true;
                    var btn = document.getElementById("ProductCategory").innerHTML;
                    document.getElementById("ProductCategory").innerHTML = "Saving...";
                    document.getElementById("ProductCategory").disabled = true;

                    var url = APIRootPath + "api/AddProductCategory/" + $rootScope.UserUUID;
                    var param = {
                        "CategoryName": $scope.FrmNewCategory.CategoryName,
                    }
                    $http.post(url, param, urlconfig).then(function(response) {
                            $("#ProductCategoryModel").modal('hide');
                            // Swal.fire("Done", "Item saved successfully", "success");
                            $scope.SaveClicked = false;
                            document.getElementById("ProductCategory").innerHTML = btn;
                            document.getElementById("ProductCategory").disabled = false;
                            GlobalFrmProductScope.GetProductsCategory();
                        },
                        function(response) {
                            $scope.SaveClicked = false;
                            document.getElementById("ProductCategory").innerHTML = btn;
                            document.getElementById("ProductCategory").disabled = false;
                            if (response.data.status != 401) {
                                $("#ProductCategoryModel").modal('hide');
                                $('#AddNewProductModal').modal('hide');
                                Swal.fire("OOPS", response.data.message, "error");
                            } else {
                                window.location.replace(APIBasePath);
                            }
                        }
                    );
                }
            }
        }

        $rootScope.DeleteCategory = function(CategoryId) {
            $rootScope.ErrorMsg = "";
            var url = APIRootPath + "api/DeleteProductCategory/" + $rootScope.UserUUID + "/" + CategoryId;
            $http.get(url, urlconfig).then(
                function(response) {
                    $rootScope.GetProductsCategory();
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
    });
</script>

</html>