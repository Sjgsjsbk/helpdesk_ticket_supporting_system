<!DOCTYPE html>
<html lang="en">
<title>Tickets Information</title>

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
navbarStart();
MainContentStart(); //main content Start
pageContainerStart();
?>
<div class="row" style="height: 25px;">
    <div class="d-flex justify-content-between align-items-center w-100">
        <h4 class="fw-bold">
            <span class="text-muted fw-light">Ticket Detail</span>
        </h4>
        <a id="backButton" class="fw-bold" href="#">
            <button type="button" class="btn btn-dark">Back</button>
        </a>
    </div>
</div>
<div class="row" ng-controller="TicketCtrl" style="padding-top: 10px;">
    <div class="accordion mt-3" id="accordionExample">
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
                            <h6 class="card-title">Company </h6>
                            <div class="card-subtitle text-muted">{{FrmTicket.CompanyName}}</div>
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
                        <div class="mb-3 col-md-3" ng-show="FrmTicket.UpdatedOn!=''">
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
                            <div class="card-subtitle text-muted ">{{FrmTicket.AgentName}}</div>
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
                            <div class="card-subtitle text-muted "> <a class="badge bg-primary" style="cursor: pointer;" ng-href="{{DownloadUrl(FrmTicket.Filepath)}}" target="_blank">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="row" ng-show="ShowAgent==1">
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
                            <div class="card-subtitle badge bg-primary">{{agentDetails[0].AgentCode}}</div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <h6 class="card-title">Name</h6>
                            <div class="card-subtitle badge bg-primary ">{{agentDetails[0].AgentFullName}}</div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <h6 class="card-title">Mobile No</h6>
                            <div class="card-subtitle badge bg-primary ">{{agentDetails[0].Mobile }}</div>
                        </div>
                        <div class="mb-3 col-md-3">
                            <h6 class="card-title">Email</h6>
                            <div class="card-subtitle badge bg-primary">{{agentDetails[0].Email}}</div>
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
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{Query.Code}}<label style="font-size:x-large; color:green" ng-show="{{Query.QuerryResponse==1}}"><b><sup><i class='bx bx-comment-detail'></i></sup></b></label></td>
                                    <td>
                                        <span ng-if="(Query.QueryById == 0)||Query.QueryRemark==''&& Query.ResponseRemark">{{Query.ResponseRemark | limitTo: 50}}</span>
                                        <span ng-if="(Query.QueryById != 0) || Query.QueryRemark && Query.ResponseRemark==''">{{Query.QueryRemark | limitTo: 50}}</span>
                                        <span ng-If="Query.ResponseRemark==0 && Query.QueryRemark==0">Attachment</span>
                                    </td>
                                    <td>
                                        <span ng-if="Query.QueryById == 0 && Query.FormattedResponseOn !='00-00-0000'">{{Query.FormattedResponseOn}}</span>
                                        <span ng-if="Query.QueryById != 0 && Query.FormattedQueryOn !='00-00-0000'">{{Query.FormattedQueryOn}}</span>
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
                                                <a class="" href="" ng-click="showQueryDetail(Query);UpdateQueryStatus(Query)" title="Details"><i class='bx bx-info-circle me-1'></i></a>
                                            </div>
                                            <div class="col-1" ng-if="Query.ResponseFileName!=0">
                                                <a class="" ng-href="{{DownloadUrl(Query.ResponseFileName)}}" title="View" target="_blank"><i class='bx bx-book-content'></i></a>
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
</div>
<?php
ModalStart("ShowQueryDetailModal", "lg", "Query / Response", "FrmQuery", "FrmQuery", "QueryCtrl", "SubmitResponse()");
?>
<!-- Query Remark Section -->
<div class="row" ng-if="FrmQuery.QueryRemark">
    <div class="mb-3 col-md-6">
        <label for="date" class="form-label">Date</label>
        <input type="text" class="form-control" ng-model="FrmQuery.FormattedQueryOn" readonly />
    </div>
    <div class="mb-3 col-md-6">
        <label for="queryBy" class="form-label">Query By</label>
        <input type="text" class="form-control" ng-model="CustomerFullName" readonly />
    </div>
    <div class="mb-3 col-md-12">
        <label for="queryRemark" class="form-label">Query</label>
        <textarea class="form-control" ng-model="FrmQuery.QueryRemark" readonly></textarea>
    </div>
    <div class="mb-3 col-md-4" ng-if="FrmQuery.QueryFileName">
        <label class="form-label">Query Attachment</label><br />
        <a class="badge bg-primary" ng-href="{{DownloadUrl(FrmQuery.QueryFileName)}}" target="_blank" style="cursor: pointer;">View</a>
    </div>
    <hr />
</div>

<!-- Response Remark Section -->
<div class="row" ng-if="FrmQuery.ResponseById">
    <div class="mb-3 col-md-6">
        <label for="responseDate" class="form-label">Response Date</label>
        <input type="text" class="form-control" ng-model="FrmQuery.FormattedResponseOn" readonly />
    </div>
    <div class="mb-3 col-md-6">
        <label for="responseBy" class="form-label">Response By</label>
        <input type="text" class="form-control" ng-model="FrmQuery.AgentName" readonly />
    </div>
    <div class="mb-3 col-md-12">
        <label for="responseRemark" class="form-label">Response Remark</label>
        <textarea class="form-control" ng-model="FrmQuery.ResponseRemark" readonly></textarea>
    </div>
    <div class="mb-3 col-md-4" ng-if="FrmQuery.ResponseFileName">
        <label class="form-label">Response Attachment</label><br />
        <a class="badge bg-primary" ng-href="{{DownloadUrl(FrmQuery.ResponseFileName)}}" target="_blank" style="cursor: pointer;">View</a>
    </div>
</div>

<?php
ModalEnd("false", "false", "SaveResponsBtn", "");
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
    var APIRootPath = sessionStorage.getItem("APIRootPath")
    app.controller('TicketCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        $scope.FrmTicket = {};
        $scope.FrmTicket = JSON.parse(sessionStorage.getItem("Ticket"));
        document.getElementById('backButton').href = "Tickets/" + $scope.FrmTicket.TicketCategoryId;
        if ($scope.FrmTicket.UpdatedOn == undefined) {
            $scope.FrmTicket.UpdatedOn = false;
        }
        // var baseUrl = 'http://localhost/helpdeskAPI/';
        $rootScope.UserUUID = LoginData.Uuid;
        $rootScope.CustomerFullName = "";
        $rootScope.AgentFullName = "";
        $rootScope.LinkedToId = LoginData.LinkedToId;

        // $rootScope.FileUrl = 'http://localhost/helpdeskAPI/';
        $rootScope.DownloadUrl = function(fileName) {
            return APIRootPath + fileName;
        };

        $scope.getCustomerAndProductDetails = function() {
            var url = APIRootPath + "api/GetCustomerAndProduct/" + $rootScope.UserUUID + "/" + $scope.FrmTicket.CustomerId + "/" + $scope.FrmTicket.ProductId;
            $http.get(url, urlconfig).then(
                function(response) {
                    $scope.FrmDetails = response.data.Details;
                    $rootScope.CustomerFullName = response.data.Details[0].CustomerFullName;
                    // alert($scope.FrmDetails[0].CustomerName);
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

        $scope.GetAgentDetails = function() {
            if ($scope.FrmTicket.ProcessedById != 0) {
                var url = APIRootPath + "api/GetAgentDetails/" + $rootScope.UserUUID + "/" + $scope.FrmTicket.ProcessedById;
                $http.get(url, urlconfig).then(
                    function(response) {
                        $scope.agentDetails = response.data.agents;
                        $rootScope.AgentFullName = response.data.agents[0].AgentFullName
                        $scope.ShowAgent = ($scope.agentDetails.length != 0) ? 1 : 0;
                        // alert($scope.agentDetails[0].AgentFullName);
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
            var url = APIRootPath + "api/GetQueryResponse/" + $rootScope.UserUUID + "/" + $scope.FrmTicket.Id;
            $http.get(url, urlconfig).then(
                function(response) {
                    $scope.QueryDetails = response.data.Query;
                    $scope.ShowBtn = ($scope.QueryDetails.length != 0) ? 1 : 0;
                    $scope.ResponseCout = $scope.QueryDetails.filter(Ticket => Ticket.ResponseById == 0).length;
                    $scope.QueryCode = $scope.QueryDetails.filter(Ticket => Ticket.TicketId == $scope.FrmTicket.Id);
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
                $rootScope.CustomerFullName = GlobalFrmQueryScope.FrmQuery.CustomerName;

            } else if (GlobalFrmQueryScope.FrmQuery.CustomerUserName) {
                $rootScope.CustomerFullName = GlobalFrmQueryScope.FrmQuery.CustomerUserName;
            }
            $rootScope.AgentFullName = GlobalFrmQueryScope.FrmQuery.AgentName;
            $('#ShowQueryDetailModal').modal('show');
        }
        // $scope.getDownloadUrl = function(fileName) {
        //     return baseUrl + fileName;
        // };

        $scope.getCustomerAndProductDetails();
        $scope.GetAgentDetails();
        $scope.GetQueryRespons();

        setInterval($scope.GetQueryRespons, 10000);

    });
    app.controller('QueryCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalFrmQueryScope = $scope;
        // var baseUrl = "http://localhost/helpdesk/API/";
        $scope.FrmQuery = [];
        // $scope.downloadFile = function(fileName) {
        //     return baseUrl + fileName;

        // };

    });
</script>

</html>