<!DOCTYPE html>
<html lang="en">
<title>Edit Ticket</title>

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
<form ng-controller="TicketCtrl" novalidate id="FrmTicketId" ng-model="FrmTicket" ng-submit="EditTicket()">
    <div class="row" style="padding-bottom: 10px;">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold">
                <span class="text-muted fw-light">Edit Ticket</span>
            </h4>
            <a id="backButton" class="fw-bold" ng-href="{{BackButton()}}">
                <button type="button" class="btn btn-dark">Back</button>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="Product" class="form-label col-md-12">Product
                            </label>
                            <select class="select2 form-select" ng-model="FrmTicket.ProductId" id="ProductId" ng-options="Product.Id as Product.ProductName for Product in ProductsDetails" required>
                                <option value="">Select Product</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="Category" class="form-label col-md-12">Ticket Category
                            </label>
                            <select class="select2 form-select" ng-model="FrmTicket.TicketCategoryId" id="Category" ng-options="Category.Id as Category.Name for Category in ticketCategory" required>
                                <option value="">Select Category</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="Priority" class="form-label col-md-12">Priority
                            </label>
                            <select class="select2 form-select" ng-model="FrmTicket.PriorityId" id="PriorityId" ng-options="Priority.Id as Priority.Name for Priority in PriorityDetails" required>
                                <option value="">Select Priority</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="Subject">Subject</label>
                            <input type="text" id="Subject" class="form-control" name="Subject" placeholder="" required ng-model="FrmTicket.Subject" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="Description">Description</label>
                            <input type="text" id="Description" name="Description" class="form-control" required placeholder="" ng-model="FrmTicket.Description" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="Attachment">Attachment</label>
                            <input class="form-control" type="file" id="FormFile" ng-model="FrmTicket.FormFile" onchange="checkFile(this.id)">
                            <p class="text-muted mb-0">Allowed JPG, PNG, PDF , XLSX or DOC File</p>
                        </div>
                        <div class="row justify-content-end">
                            <div class="mb-3 col-md-1" style="margin-right: 10px;">
                                <button type="submit" class="btn btn-primary" id="SaveTicketBtn" ng-click="EditTicket()">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
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
    var GlobalFrmScope = "";
    var GlobalEditscopeScope = "";
    var GlobalShwDetailScope = "";

    function checkFile(Id) {
        var fileInput = $('#' + Id)[0].files[0];
        if (fileInput.type != "image/jpeg" && fileInput.type != "image/png" && fileInput.type != "application/pdf" && fileInput.type != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" && fileInput.type != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
            Swal.fire("Warning", "Accept only .jpg, .png, .pdf, .docx, .xlsx files", "warning");
            document.getElementById(Id).value = "";
        } else {
            GlobalFrmScope.FrmTicket.FormFile = fileInput;
        }
    }
    var APIRootPath = sessionStorage.getItem("APIRootPath");
    app.controller('TicketCtrl', function($scope, $rootScope, $http, $timeout, $filter) {

        GlobalFrmScope = $scope;
        if (LoginData.UserType.Id == 3) {
            $rootScope.CustomerName = LoginData.Customer.Name;
            $rootScope.LinkedToId = LoginData.LinkedToId;
            $rootScope.UserType = LoginData.UserType.Id
        } else {
            $rootScope.CustomerName = LoginData.CustomerUser.Name;
            $rootScope.ProfileUrl = LoginData.CustomerUser.CustomerUserProfile;
            $rootScope.LinkedToId = LoginData.CustomerUser.UserMappedToId;
            $rootScope.UserType = LoginData.UserType.Id
        }

        $scope.BackButton = function() {
            if (LoginData.UserType.Id == 3) {
                return document.getElementById('backButton').href = "/helpdesk/Ticketlist/" + $scope.FrmTicket.TicketCategoryId;
            } else {
                return document.getElementById('backButton').href = "/helpdesk/UserTicket/" + $scope.FrmTicket.TicketCategoryId;
            }
        }
        
        $scope.FrmTicket = [];
        $rootScope.CustomerName = LoginData.Customer.Name;
        $scope.FrmTicket = JSON.parse(sessionStorage.getItem("Ticket"));
        $rootScope.UserUUID = LoginData.Uuid;
        // $rootScope.LinkedToId = LoginData.LinkedToId;

        $scope.FrmTicket.TicketDate = new Date();

        $scope.getCustomerActiveProductsList = function() {
            var url = APIRootPath + "api/GetCustomerActiveProduct/" + $rootScope.UserUUID + "/" + $rootScope.LinkedToId;
            $http.get(url, urlconfig).then(
                function(response) {
                    $scope.ProductsDetails = response.data.Products;
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

        $scope.getCustomerActiveProductsList();

        $scope.EditTicket = function() {
            var form = document.getElementById("FrmTicketId");
            if (form.reportValidity()) {
                var form = document.getElementById("FrmTicketId");
                var btn = document.getElementById("SaveTicketBtn").innerHTML;
                if (form.reportValidity() && !$scope.SaveClicked) {
                    $scope.SaveClicked = true;
                    document.getElementById("SaveTicketBtn").innerHTML = "&nbsp;Saving...";
                    var myFormData = new FormData();
                    myFormData.append("UserUUID", $rootScope.UserUUID);
                    myFormData.append("CustomerId", $rootScope.LinkedToId);
                    myFormData.append("TicketCode", $scope.FrmTicket.Code);
                    myFormData.append("TickeId", $scope.FrmTicket.Id);
                    myFormData.append("ProductId", $scope.FrmTicket.ProductId);
                    myFormData.append("ticket_Category", $scope.FrmTicket.TicketCategoryId);
                    myFormData.append("Priority", $scope.FrmTicket.PriorityId);
                    myFormData.append("Subject", $scope.FrmTicket.Subject);
                    myFormData.append("Description", $scope.FrmTicket.Description);
                    myFormData.append("FormFile", $scope.FrmTicket.FormFile);
                    myFormData.append("CustomerName", $rootScope.CustomerName);
                    var url = APIRootPath + "api/SaveTicket";
                    $http.post(url, myFormData, fileconfig).then(
                        function(response) {
                            Swal.fire("Done", "Ticket submit successfully", "success");
                            $scope.SaveClicked = false;
                            document.getElementById("SaveTicketBtn").innerHTML = btn;
                            // window.open('Ticketlist', '_self')
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
        $scope.getPriority = function() {
            var url = APIRootPath + "api/GetPriority/" + $rootScope.UserUUID;
            $http.get(url, urlconfig).then(
                function(response) {
                    $scope.PriorityDetails = response.data.PriorityStatus;
                },
                function(response) {
                    if (response.data.status != 401) {
                        Swal.fire("OOPS", response.data.message, "error");
                    } else {
                        window.location.replace(APIBasePath);
                    }
                }
            );
        };
        $scope.getPriority();
        $scope.getTicketCategory = function() {
            var url = APIRootPath + "api/GetTicketCategory/" + $rootScope.UserUUID;
            $http.get(url, urlconfig).then(
                function(response) {
                    $scope.ticketCategory = response.data.ticketcategory;
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
        $scope.getTicketCategory();
    });
</script>

</html>