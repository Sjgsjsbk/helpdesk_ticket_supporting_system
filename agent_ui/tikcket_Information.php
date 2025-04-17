<!DOCTYPE html>
<html lang="en">
<title>Tickets Information</title>

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
<div class="row" style="height: 25px;">
    <div class="d-flex justify-content-between align-items-center w-100">
        <h4 class="fw-bold">
            <span class="text-muted fw-light">Details</span>
        </h4>
        <a id="backButton" class="fw-bold" href="#">
            <button type="button" class="btn btn-dark">Back</button>
        </a>
    </div>
</div>
<div class="accordion mt-3" id="accordionExample" ng-controller="TicketCtrl" style="padding-top: 10px;">
    <div class="card accordion-item active">
        <h2 class="accordion-header" id="headingOne">
            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="ture" aria-controls="accordionOne">
                Ticket Info
            </button>
        </h2>
        <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row justify-content space-evenly">
                    <div>
                        <div class="divider text-start">
                            <div class="divider-text" style="font-size:medium;">Customer Details</div>
                        </div>
                    </div>
                    <!-- <span class="">Primary</span> -->
                    <!-- <div class="mb-3 col-md-3">
                        <h6 class="card-title">Code</h6>
                        <div class="card-subtitle text-muted mb-4">{{FrmDetails[0].CustomerCode}}</div>
                    </div> -->
                    <div class="mb-3 col-md-3">
                        <h6 class="card-title">Name</h6>
                        <div class="card-subtitle text-muted mb-4">{{FrmTicket.CustomerFullName}}</div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <h6 class="card-title">Mobile No</h6>
                        <div class="card-subtitle text-muted mb-4">{{FrmTicket.CustomerMobile}}</div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <h6 class="card-title">Email</h6>
                        <div class="card-subtitle text-muted mb-4">{{FrmTicket.CustomerEmail}}</div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <h6 class="card-title">Company</h6>
                        <div class="card-subtitle text-muted ">{{FrmTicket.CompanyName}}</div>
                    </div>
                </div>
                <div class="row justify-content space-evenly" ng-show="FrmTicket.CustomerUserFullName">
                    <div>
                        <div class="divider text-start">
                            <div class="divider-text" style="font-size:medium;">Ticket Created By</div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <h6 class="card-title">Name</h6>
                        <div class="card-subtitle text-muted mb-4">{{FrmTicket.CustomerUserFullName}}</div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <h6 class="card-title">Mobile No</h6>
                        <div class="card-subtitle text-muted mb-4">{{FrmTicket.CustomerUserMobile}}</div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <h6 class="card-title">Email</h6>
                        <div class="card-subtitle text-muted mb-4">{{FrmTicket.CustomerUserEmail}}</div>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <div class="divider text-start">
                            <div class="divider-text" style="font-size:medium;">
                                Ticket & Product Details
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 col-md-3">
                        <h6 class="card-title">Ticket Code</h6>
                        <div class="card-subtitle text-muted mb-4">{{FrmTicket.Code}}</div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <h6 class="card-title">Ticket Date</h6>
                        <div class="card-subtitle text-muted mb-4">{{FrmTicket.RaisedOn}}</div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <h6 class="card-title">Ticket Status</h6>

                        <div class="card-subtitle text-muted mb-4"> {{FrmTicket.StatusId == 1 ? 'Raised' :(FrmTicket.StatusId == 2 ? 'Processing' : (FrmTicket.StatusId == 3 ? 'Query Response' : 'Closed'))}}</div>
                    </div>
                    <div class="mb-3 col-md-3 " ng-show="FrmTicket.UpdatedOn!=''">
                        <h6 class="card-title">Updated On</h6>
                        <div class="card-subtitle text-muted mb-4">{{FrmTicket.UpdatedOn}}</div>
                    </div>
                    <!-- <div class="mb-3 col-md-3">
                        <h6 class="card-title">Product Code</h6>
                        <div class="card-subtitle text-muted ">{{FrmDetails[0].ProductCode}}</div>
                    </div> -->
                    <div class="mb-3 col-md-3">
                        <h6 class="card-title">Product Name</h6>
                        <div class="card-subtitle text-muted ">{{FrmTicket.customerProduct}}</div>
                    </div>
                    <div class="mb-3 col-md-3" ng-show="FrmTicket.ProcessingOn!='' && FrmTicket.StatusId !='1'">
                        <h6 class="card-title">Processing On</h6>
                        <div class="card-subtitle text-muted ">{{FrmTicket.ProcessingOn}}</div>
                    </div>
                    <div class="mb-3 col-md-3" ng-show="FrmTicket.ProcessedById!=0 && FrmTicket.StatusId !='1'">
                        <h6 class="card-title">Processed By</h6>
                        <div class="card-subtitle text-muted ">{{ResponseBy}}</div>
                    </div>
                </div>
                <div class="row">
                    <div>
                        <div class="divider text-start">
                            <div class="divider-text" style="font-size:medium;">
                                Subject & Description
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <h6 class="card-title">Subject</h6>
                        <div class="card-subtitle text-muted ">{{FrmTicket.Subject}}</div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <h6 class="card-title">Description</h6>
                        <div class="card-subtitle text-muted ">{{FrmTicket.Description}}</div>
                    </div>
                </div>
                <div class="row" ng-show="FrmTicket.Filepath !=0">
                    <div>
                        <div class="divider text-start">
                            <div class="divider-text" style="font-size:medium;">
                                Ticket Attachments
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <h6 class="card-title">Attachment</h6>
                        <div class="card-subtitle text-muted "> <a class="badge bg-primary" style="cursor: pointer;" ng-href="{{getDownloadUrl(FrmTicket.Filepath)}}" target="_blank">View</a>
                        </div>
                    </div>
                </div>
                <div class="row" ng-show="ShowAgent==1 && FrmTicket.StatusId !='1'">
                    <div>
                        <div class="divider text-start">
                            <div class="divider-text" style="font-size:medium;">
                                Agent Details
                            </div>
                        </div>
                    </div>
                    <!-- <span class="">Primary</span> -->
                    <div class="mb-3 col-md-3">
                        <h6 class="card-title">Agent Code</h6>
                        <div class="card-subtitle  badge bg-primary">{{agentDetails[0].AgentCode}}</div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <h6 class="card-title">Name</h6>
                        <div class="card-subtitle  badge bg-primary">{{agentDetails[0].AgentFullName}}</div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <h6 class="card-title">Mobile No</h6>
                        <div class="card-subtitle  badge bg-primary">{{agentDetails[0].Mobile }}</div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <h6 class="card-title">Email</h6>
                        <div class="card-subtitle  badge bg-primary">{{agentDetails[0].Email}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card accordion-item" ng-show="{{FrmTicket.StatusId  == 1 ? 'false' : 'true'}} ">
        <h2 class="accordion-header" id="headingTwo">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                Query / Response
            </button>
        </h2>
        <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="col-md-12" style="display: flex; justify-content: end;" ng-show="ShowBtn == 0 || ResponseCout == 0">
                    <span class="badge bg-primary" style="float: right; cursor: pointer;" ng-show="HideBtn!=4" ng-click="QueryModel()">Add Response</span>
                </div>
                <div class="table-responsive text-nowrap" style="height: 350px; overflow-y: auto;">
                    <table class="table" style="text-align: center;">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Remark</th>
                                <th>Sent On </th>
                                <th>Sent By</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr ng-repeat="Query in QueryDetails | orderBy:['-Id','FormattedQueryOn']">
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{Query.Code}}<label style="font-size:x-large; color:lawngreen" ng-show="{{Query.QuerryResponse==1}}"><b><sup><i class='bx bx-comment-detail'></i></sup></b></label></td>
                                <td>
                                    <span ng-if="!Query.QueryById || (!Query.QueryRemark && Query.ResponseRemark)">
                                        {{ Query.ResponseRemark | limitTo: 50 }}
                                    </span>
                                    <span ng-if="Query.QueryById || (Query.QueryRemark && !Query.ResponseRemark)">
                                        {{ Query.QueryRemark | limitTo: 50 }}
                                    </span>
                                    <span ng-if="!Query.ResponseRemark && !Query.QueryRemark">
                                        Attachment
                                    </span>
                                </td>
                                <td>
                                    <span ng-if="Query.QueryById == 0 && Query.FormattedResponseOn !='00-00-0000'">{{Query.FormattedResponseOn}}</span>
                                    <span ng-if="Query.QueryById != 0 && Query.FormattedQueryOn !='00-00-0000	'">{{Query.FormattedQueryOn}}</span>
                                </td>
                                <td>
                                    <span ng-if="Query.QueryRemark == 0">{{Query.AgentName}} </span>
                                    <span ng-if="Query.QueryRemark != 0 && Query.CustomerName != null">{{Query.CustomerName}}</span>
                                    <span ng-if="Query.QueryRemark != 0 && Query.CustomerUserName != null">{{Query.CustomerUserName}}</span>
                                </td>
                                <td>
                                    <span class="badge bg-{{getStatusColor(Query.QuerryResponse)}} me-1">
                                        {{ Query.QuerryResponse == 1  ? 'Open' : 'Closed' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="row" style="padding-left: 20%;">
                                        <div class="col-1">
                                            <a class="" href="" ng-click="showQueryDetail(Query)" title="Details"><i class='bx bx-info-circle me-1'></i></a>
                                        </div>
                                        <div class="col-1" ng-if="Query.QueryFileName !=0">
                                            <a class="" ng-href="{{getDownloadUrl(Query.QueryFileName)}}" title="View" target="_blank"><i class='bx bx-book-content'></i></a>
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
</div>
<?php
ModalStart("ShowQueryDetailModal", "lg", "Query / Response", "FrmQuery", "FrmQuery", "QueryCtrl", "SubmitResponse()");
?>
<div class="row" ng-if="FrmQuery.QueryRemark">
    <!-- Query Details -->
    <div class="mb-3 col-6">
        <label for="date" class="form-label">Date</label>
        <input type="text" class="form-control" ng-model="FrmQuery.FormattedQueryOn" readonly />
    </div>
    <div class="mb-3 col-6">
        <label for="Remark" class="form-label">Query By</label>
        <input type="text" class="form-control" ng-model="CustomerFullName" readonly />
    </div>
    <div class="mb-3 col-12">
        <label for="Remark" class="form-label">Query</label>
        <textarea class="form-control" ng-model="FrmQuery.QueryRemark" readonly></textarea>
    </div>
    <div class="mb-3 col-3" ng-if="FrmQuery.QueryFileName">
        <label class="form-label">Query Attachment</label><br />
        <a class="badge bg-primary" ng-href="{{getDownloadUrl(FrmQuery.QueryFileName)}}" target="_blank">View</a>
    </div>
    <hr />
</div>

<!-- Response Details -->
<div class="row">
    <div class="mb-3 col-6" ng-if="FrmQuery.ResponseById">
        <label for="date" class="form-label">Date</label>
        <input type="text" class="form-control" ng-model="FrmQuery.FormattedResponseOn" readonly />
    </div>
    <div class="mb-3 col-6" ng-if="FrmQuery.ResponseById">
        <label for="ResponseBy" class="form-label">Response By</label>
        <input type="text" class="form-control" ng-model="FrmQuery.AgentName" readonly />
    </div>
    <div class="mb-3 col-12">
        <label for="ResponseRemark" class="form-label">Response</label>
        <textarea class="form-control" ng-model="FrmQuery.ResponseRemark"
            ng-readonly="FrmQuery.ResponseById"
            required></textarea>
    </div>
    <div class="mb-3 col-5" ng-if="!FrmQuery.ResponseById">
        <label for="FormFile" class="form-label">Query Attachment</label>
        <input class="form-control" type="file" id="FormFile" onchange="checkFile(this.id)" />
        <p class="text-muted mb-0">Allowed JPG, PNG, PDF, XLSX, or DOC files</p>
    </div>
    <div class="mb-3 col-4" ng-if="FrmQuery.ResponseFileName">
        <label class="form-label">Response Attachment</label><br />
        <a class="badge bg-primary" ng-href="{{getDownloadUrl(FrmQuery.ResponseFileName)}}" target="_blank">View</a>
    </div>
</div>

<!-- Additional Query Remark Section -->
<!-- <div class="row" ng-if="!FrmQuery.QueryRemark">
    <div class="mb-3 col-12">
        <label for="Remark" class="form-label">Query</label>
        <textarea class="form-control" ng-model="FrmQuery.QueryRemark" readonly></textarea>
    </div>
    <div class="mb-3 col-5" ng-if="FrmQuery.QueryFileName">
        <label class="form-label">Response Attachment</label><br />
        <a class="badge bg-primary" ng-href="{{getDownloadUrl(FrmQuery.QueryFileName)}}" target="_blank">View</a>
    </div>
</div> -->

<?php
ModalEnd("", "FrmQuery.ResponseById ==0 ? true : false", "SaveResponsBtn", "Save");
ModalStart("ShowQueryModal", "md", "Query / Response", "FrmQuery2", "FrmQuery2", "Querymodalctrl", "SubmitQuery()");
?>
<div class="row">
    <div class="mb-3 col-md-12">
        <label for="Response  Remark" class="form-label">Query</label>
        <textarea class="form-control" ng-model="FrmQuery2.QueryRemark" id="QueryRemark" required></textarea>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <label for="FormFile" class="form-label">Attachment</label>
        <input class="form-control" type="file" id="formFiles" ng-model="FrmQuery2.FormFile" onchange="checkFileFormat(this.id)">
        <p class="text-muted mb-0">Allowed JPG, PNG, PDF , XLSX or DOC File</p>
    </div>
</div>
<?php
ModalEnd("", "true", "SaveBtnID", "Save");
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
    var GlobalFrmQueryScope = "";
    var Attachment = "";

    function checkFile(Id) {
        var fileInput = $('#' + Id)[0].files[0];
        if (fileInput.type != "image/jpeg" && fileInput.type != "image/png" && fileInput.type != "application/pdf" && fileInput.type != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" && fileInput.type != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
            Swal.fire("Warning", "Accept only .jpg, .png, .pdf, .docx, .xlsx files", "warning");
            document.getElementById(Id).value = "";
            $('#ShowQueryDetailModal').modal('hide');
        } else {
            GlobalFrmQueryScope.FrmQuery.FormFile = fileInput;
        }
    }

    function checkFileFormat(Id) {
        var fileInput = $('#' + Id)[0].files[0];
        if (fileInput.type != "image/jpeg" && fileInput.type != "image/png" && fileInput.type != "application/pdf" && fileInput.type != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" && fileInput.type != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
            Swal.fire("Warning", "Accept only .jpg, .png, .pdf, .docx, .xlsx files", "warning");
            document.getElementById(Id).value = "";
            $('#ShowQueryModal').modal('hide');
        } else {
            GlobalFrmScope.FrmQuery2.FormFile = fileInput;
        }
    };
    var APIRootPath = sessionStorage.getItem("APIRootPath");
    app.controller('TicketCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalTblScope = $scope;
        $scope.FrmDetails = [];
        $rootScope.CustomerFullName = "";
        $rootScope.CustomerEmail = "";
        $rootScope.AgentEmail = "";
        $scope.ResponseById = {};
        $rootScope.FrmTicket = JSON.parse(sessionStorage.getItem("Ticket"));
        $rootScope.HideBtn = $rootScope.FrmTicket.StatusId;
        // $rootScope.baseUrl = 'http://localhost/helpdeskAPI/';
        $rootScope.UserUUID = LoginData.Uuid;
        $rootScope.LinkedToId = LoginData.LinkedToId;
        document.getElementById('backButton').href = "AgentTickets/" + $scope.FrmTicket.TicketCategoryId;
        $scope.getCustomerAndProductDetails = function() {
            var url = APIRootPath + "api/GetCustomerAndProduct/" + $rootScope.UserUUID + "/" + $rootScope.FrmTicket.CustomerId + "/" + $rootScope.FrmTicket.ProductId;
            $http.get(url, urlconfig).then(
                function(response) {
                    $scope.FrmDetails = response.data.Details;
                    $rootScope.CustomerFullName = $scope.FrmDetails[0].CustomerFullName;
                    $rootScope.CustomerEmail = $scope.FrmDetails[0].CustomerEmail;
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

        $rootScope.GetAgentDetails = function() {
            if ($rootScope.FrmTicket.ProcessedById != 0) {
                var url = APIRootPath + "api/GetAgentDetails/" + $rootScope.UserUUID + "/" + $rootScope.FrmTicket.ProcessedById;
                $http.get(url, urlconfig).then(
                    function(response) {
                        $scope.agentDetails = response.data.agents;
                        $rootScope.ShowAgent = ($scope.agentDetails.length != 0) ? 1 : 0;
                        $rootScope.ResponseById = ($scope.agentDetails.length != 0) ? $scope.agentDetails[0].AgentCode : 0;
                        $rootScope.ResponseBy = ($scope.agentDetails.length != 0) ? $scope.agentDetails[0].AgentFullName : 0;
                        $rootScope.AgentEmail = $scope.agentDetails[0].Email;
                        $scope.GetQueryRespons();
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
        }

        $scope.GetQueryRespons = function() {
            var url = APIRootPath + "api/GetQueryResponse/" + $rootScope.UserUUID + "/" + $rootScope.FrmTicket.Id;
            $http.get(url, urlconfig).then(
                function(response) {
                    $scope.QueryDetails = response.data.Query;
                    $scope.ShowBtn = ($scope.QueryDetails.length != 0) ? 1 : 0;
                    $scope.ResponseCout = $scope.QueryDetails.filter(Ticket => Ticket.ResponseById == 0).length;
                    $scope.QueryCode = $scope.QueryDetails.filter(Ticket => Ticket.TicketId == $rootScope.FrmTicket.Id);
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

        $scope.getStatusColor = function(status) {
            if (status === '0') {
                return 'success';
            } else if (status === '2') {
                return 'success';
            } else {
                return 'primary';
            }
        };
        $scope.showQueryDetail = function(Query) {
            angular.copy(Query, GlobalFrmQueryScope.FrmQuery);
            if (GlobalFrmQueryScope.FrmQuery.CustomerName) {
                $rootScope.CustomerFullName = GlobalFrmQueryScope.FrmQuery.CustomerName;
            } else if (GlobalFrmQueryScope.FrmQuery.CustomerUserName) {
                $rootScope.CustomerFullName = GlobalFrmQueryScope.FrmQuery.CustomerUserName;
            }
            $('#ShowQueryDetailModal').modal('show');
        }

        $scope.QueryModel = function() {
            $('#ShowQueryModal').modal('show');
            GlobalFrmScope.FrmQuery2 = [];
        }

        $rootScope.getDownloadUrl = function(fileName) {
            return APIRootPath + fileName;
        };
        // $rootScope.DownloadUrl = function(fileName) {
        //     return $rootScope.FileUrl + fileName;
        // };
        //Function call 
        $scope.getCustomerAndProductDetails();
        $scope.GetAgentDetails();
    });

    app.controller('QueryCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalFrmQueryScope = $scope;
        $rootScope.UserUUID = LoginData.Uuid;
        $rootScope.FrmTicket = JSON.parse(sessionStorage.getItem("Ticket"));
        $rootScope.LinkedToId = LoginData.LinkedToId;
        $rootScope.UserTypeId = LoginData.UserType.Id;
        $rootScope.Name = LoginData.Customer.Name;
        $scope.FrmQuery = [];

        $scope.SubmitResponse = function() {
            var form = document.getElementById("FrmQuery");
            if (form.reportValidity()) {
                var form = document.getElementById("FrmQuery");
                var btn = document.getElementById("SaveResponsBtn").innerHTML;
                if (form.reportValidity() && !$scope.SaveClicked) {
                    $scope.SaveClicked = true;
                    document.getElementById("SaveResponsBtn").innerHTML = "&nbsp;Saving...";
                    var myFormData = new FormData();
                    myFormData.append("UserUUID", $rootScope.UserUUID);
                    myFormData.append("UserTypeId", $rootScope.UserTypeId);
                    myFormData.append("QueryCode", GlobalFrmQueryScope.FrmQuery.Code);
                    myFormData.append("TicketId", $rootScope.FrmTicket.Id);
                    myFormData.append("Remark", $scope.FrmQuery.ResponseRemark);
                    myFormData.append("FormFile", GlobalFrmQueryScope.FrmQuery.FormFile);
                    myFormData.append("TicketCode", $rootScope.FrmTicket.Code);
                    myFormData.append("AgentName", $rootScope.ResponseBy);
                    myFormData.append("AgentEmail", $rootScope.AgentEmail);
                    myFormData.append("CustomerFullName", $rootScope.FrmTicket.CustomerFullName == undefined ? '' : $rootScope.FrmTicket.CustomerFullName);
                    myFormData.append("CustomerEmail", $rootScope.FrmTicket.CustomerEmail == undefined ? '' : $rootScope.FrmTicket.CustomerEmail);
                    myFormData.append("CustomerUserFullName", $rootScope.FrmTicket.CustomerUserFullName == undefined ? '' : $rootScope.FrmTicket.CustomerUserFullName);
                    myFormData.append("CustomerUserEmail", $rootScope.FrmTicket.CustomerUserEmail == undefined ? '' : $rootScope.FrmTicket.CustomerUserEmail);

                    var url = APIRootPath + "api/SubmitResponse";
                    $http.post(url, myFormData, fileconfig).then(function(response) {
                            $('#ShowQueryDetailModal').modal('hide');
                            Swal.fire("Done", "Ticket submit successfully", "success");
                            $scope.SaveClicked = false;
                            GlobalTblScope.GetQueryRespons();
                            document.getElementById("SaveResponsBtn").innerHTML = btn;
                            $('#FormFile').val("");

                            // window.open('Ticket_list', '_self')
                        },
                        function(response) {
                            $scope.SaveClicked = false;
                            document.getElementById("SaveResponsBtn").innerHTML = btn;
                            if (response.data.status != 401) {
                                $('#ShowQueryDetailModal').modal('hide');
                                Swal.fire("OOPS", response.data.message, "error");
                                GlobalTblScope.GetQueryRespons();
                            } else {
                                window.location.replace(APIBasePath);
                            }
                        }
                    );

                }
            }

        }
        // Pass the function reference to setInterval without the parentheses
        setInterval(GlobalTblScope.GetQueryRespons, 10000);
    });

    app.controller('Querymodalctrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalFrmScope = $scope;
        $scope.FrmQuery2 = [];

        $scope.SubmitQuery = function() {
            var form = document.getElementById("FrmQuery2");
            if (form.reportValidity()) {
                var form = document.getElementById("FrmQuery2");
                var btn = document.getElementById("SaveBtnID").innerHTML;
                if (form.reportValidity() && !$scope.SaveClicked) {
                    $scope.SaveClicked = true;
                    document.getElementById("SaveBtnID").innerHTML = "&nbsp;Saving...";
                    var myFormData = new FormData();

                    myFormData.append("UserUUID", $rootScope.UserUUID);
                    myFormData.append("UserTypeId", $rootScope.UserTypeId);
                    myFormData.append("TicketId", $rootScope.FrmTicket.Id);
                    myFormData.append("TicketCode", $rootScope.FrmTicket.Code);
                    myFormData.append("Remark", $scope.FrmQuery2.QueryRemark);
                    myFormData.append("FormFile", GlobalFrmScope.FrmQuery2.FormFile);
                    myFormData.append("AgentName", $rootScope.ResponseBy);
                    myFormData.append("AgentEmail", $rootScope.AgentEmail);
                    myFormData.append("CustomerFullName", $rootScope.FrmTicket.CustomerFullName == undefined ? '' : $rootScope.FrmTicket.CustomerFullName);
                    myFormData.append("CustomerEmail", $rootScope.FrmTicket.CustomerEmail == undefined ? '' : $rootScope.FrmTicket.CustomerEmail);
                    myFormData.append("CustomerUserFullName", $rootScope.FrmTicket.CustomerUserFullName == undefined ? '' : $rootScope.FrmTicket.CustomerUserFullName);
                    myFormData.append("CustomerUserEmail", $rootScope.FrmTicket.CustomerUserEmail == undefined ? '' : $rootScope.FrmTicket.CustomerUserEmail);

                    var url = APIRootPath + "api/SubmitQuery";
                    $http.post(url, myFormData, fileconfig).then(
                        function(response) {
                            $scope.FrmTicket = [];
                            $('#ShowQueryModal').modal('hide');
                            Swal.fire("Done", "Ticket submit successfully", "success");
                            $scope.SaveClicked = false;
                            document.getElementById("SaveBtnID").innerHTML = btn;
                            GlobalTblScope.GetQueryRespons();
                            $('#formFiles').val("");
                            // location.reload();
                        },
                        function(response) {
                            $scope.SaveClicked = false;
                            document.getElementById("SaveBtnID").innerHTML = btn;
                            if (response.data.status != 401) {
                                $('#ShowQueryModal').modal('hide');
                                Swal.fire("OOPS", response.data.message, "error");
                                GlobalTblScope.GetQueryRespons();
                            } else {
                                window.location.replace(APIBasePath);
                            }
                        }
                    );
                }
            }
        }
    });
</script>

</html>