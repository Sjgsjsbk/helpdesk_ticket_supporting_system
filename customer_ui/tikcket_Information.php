<!DOCTYPE html>
<html lang="en">
<link rel="icon" type="image/x-icon" href="assets/img/avatars/SS_LOGO.jpg" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tickets Information</title>
<!-- <head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="path/to/your/styles.css">
</head> -->

<body>
    <?php
    include 'customer_ui/customer_pagesection.php';
    pageHeader();
    LayoutWrapperStart();
    LayoutContainerStart();
    sideBarStart();
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
    MainContentStart();
    pageContainerStart();
    ?>
    <div ng-controller="TicketCtrl">
        <div class="row" style="height: 25px;">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h4 class="fw-bold">
                    <span class="text-muted fw-light">Details</span>
                </h4>
                <a id="backButton" class="fw-bold" ng-href="{{BackButton()}}">
                    <button type="button" class="btn btn-dark">Back</button>
                </a>
            </div>
        </div>
        <div class="accordion mt-3" id="accordionExample" style="padding-top: 10px;" ng-repeat="t in TicketInfo">
            <div class="card accordion-item active">
                <h2 class="accordion-header" id="headingOne">
                    <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                        Ticket Info
                    </button>
                </h2>
                <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <!-- Customer Details -->
                        <div class="divider text-start">
                            <div class="divider-text" style="font-size:medium;">Customer Details</div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <h6 class="card-title">Name</h6>
                                <div class="card-subtitle text-muted">{{t.CustomerFullName}}</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <h6 class="card-title">Mobile No</h6>
                                <div class="card-subtitle text-muted">{{t.CustomerMobile}}</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <h6 class="card-title">Email</h6>
                                <div class="card-subtitle text-muted">{{t.CustomerEmail}}</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <h6 class="card-title">Company Name</h6>
                                <div class="card-subtitle text-muted">{{t.CompanyName}}</div>
                            </div>
                        </div>

                        <!-- Ticket Created By -->
                        <div class="row" ng-show="t.CustomerUserFullName">
                            <div class="divider text-start">
                                <div class="divider-text" style="font-size:medium;">Ticket Created By</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <h6 class="card-title">Name</h6>
                                <div class="card-subtitle text-muted">{{t.CustomerUserFullName}}</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <h6 class="card-title">Mobile No</h6>
                                <div class="card-subtitle text-muted">{{t.CustomerUserMobile}}</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <h6 class="card-title">Email</h6>
                                <div class="card-subtitle text-muted">{{t.CustomerUserEmail}}</div>
                            </div>
                        </div>

                        <!-- Ticket & Product Details -->
                        <div class="divider text-start">
                            <div class="divider-text" style="font-size:medium;">Ticket & Product Details</div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <h6 class="card-title">Ticket Code</h6>
                                <div class="card-subtitle text-muted">{{t.Code}}</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <h6 class="card-title">Ticket Date</h6>
                                <div class="card-subtitle text-muted">{{t.RaisedOn}}</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <h6 class="card-title">Ticket Status</h6>
                                <div class="card-subtitle text-muted">
                                    {{t.StatusId == 1 ? 'Raised' : (t.StatusId == 2 ? 'Processing' : (t.StatusId == 3 ? 'Query Response' : 'Closed'))}}
                                </div>
                            </div>
                            <div class="mb-3 col-md-3" ng-show="t.UpdatedOn">
                                <h6 class="card-title">Updated On</h6>
                                <div class="card-subtitle text-muted">{{t.UpdatedOn}}</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <h6 class="card-title">Product Name</h6>
                                <div class="card-subtitle text-muted">{{t.customerProduct}}</div>
                            </div>
                            <div class="mb-3 col-md-3" ng-show="t.ProcessingOn && t.StatusId != '1'">
                                <h6 class="card-title">Processing On</h6>
                                <div class="card-subtitle text-muted">{{t.ProcessingOn}}</div>
                            </div>
                            <div class="mb-3 col-md-3" ng-show="t.ProcessedById != 0 && t.StatusId != '1'">
                                <h6 class="card-title">Processed By</h6>
                                <div class="card-subtitle text-muted">{{t.AgentName}}</div>
                            </div>
                        </div>

                        <!-- Subject & Description -->
                        <div class="divider text-start">
                            <div class="divider-text" style="font-size:medium;">Subject & Description</div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <h6 class="card-title">Subject</h6>
                                <div class="card-subtitle text-muted">{{t.Subject}}</div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <h6 class="card-title">Description
                                    <a href="" ng-click="ShowEditDescriptionModal(t)" title="Edit"><i class="bx bxs-edit"></i></a>
                                </h6>
                                <div class="card-subtitle text-muted">{{t.Description}}</div>
                            </div>
                        </div>

                        <!-- Ticket Attachments -->
                        <div class="row" ng-show="t.Filepath">
                            <div class="divider text-start">
                                <div class="divider-text" style="font-size:medium;">Ticket Attachments</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <h6 class="card-title">Attachment</h6>
                                <div class="card-subtitle text-muted">
                                    <a class="badge bg-primary" ng-href="{{getDownloadUrl(t.Filepath)}}" target="_blank">View</a>
                                </div>
                            </div>
                        </div>

                        <!-- Agent Details -->
                        <div class="row" ng-show="t.AgentCode && t.StatusId != '1'">
                            <div class="divider text-start">
                                <div class="divider-text" style="font-size:medium;">Agent Details</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <h6 class="card-title">Agent Code</h6>
                                <div class="card-subtitle badge bg-primary">{{t.AgentCode}}</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <h6 class="card-title">Name</h6>
                                <div class="card-subtitle badge bg-primary">{{t.AgentName}}</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <h6 class="card-title">Mobile No</h6>
                                <div class="card-subtitle badge bg-primary">{{t.AgentMobile}}</div>
                            </div>
                            <div class="mb-3 col-md-3">
                                <h6 class="card-title">Email</h6>
                                <div class="card-subtitle badge bg-primary">{{t.AgentEmail}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card accordion-item" ng-show="{{t.StatusId  == 1 ? 'false' : 'true'}}">
                <h2 class="accordion-header" id="headingTwo">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                        Query / Response
                    </button>
                </h2>
                <div id="accordionTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="col-md-12" style="display: flex; justify-content: end;" ng-show="ShowBtn === 0 || ResponseCout === 0">
                            <span class="badge bg-primary" style="float: right; cursor: pointer;" ng-show="HideBtn!= 4" ng-click="QueryModel()">Add Query</span>
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
                                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i>{{Query.Code}}<label style="font-size:x-large; color:red" ng-show="{{Query.QuerryResponse==2}}"><b><sup><i class='bx bx-comment-detail'></i></sup></b></label></td>
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
                                                {{ Query.QuerryResponse == 1 ? 'Open' : 'Closed' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="row" style="padding-left: 20%;">
                                                <div class="col-1">
                                                    <a class="" href="" ng-click="showQueryDetail(Query);UpdateQueryStatus(Query)" title="Details"><i class='bx bx-info-circle me-1'></i></a>
                                                </div>
                                                <div class="col-1" ng-if="Query.ResponseFileName!=0">
                                                    <a class="" ng-href="{{getDownloadUrl(Query.ResponseFileName)}}" title="View" target="_blank"><i class='bx bx-book-content'></i></a>
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
    <!-- Query details are shown only when no response is sent by the agent -->
    <div class="row" ng-if="FrmQuery.ResponseById == 0">
        <!-- Query Details -->
        <div class="mb-3 col-md-6">
            <label for="ResponseDate" class="form-label">Date</label>
            <input type="text" class="form-control" ng-model="FrmQuery.FormattedQueryOn" readonly />
        </div>
        <div class="mb-3 col-md-6">
            <label for="Remark" class="form-label">Query By</label>
            <input type="text" class="form-control" ng-model="CustomerFullName" readonly />
        </div>
        <div class="mb-3 col-md-12">
            <label for="ResponseRemark" class="form-label">Query</label>
            <textarea class="form-control" ng-model="FrmQuery.QueryRemark" readonly></textarea>
        </div>
        <div class="mb-3 col-md-3" ng-if="FrmQuery.QueryFileName">
            <label class="form-label">Query Attachment</label><br />
            <a class="badge bg-primary" ng-href="{{getDownloadUrl(FrmQuery.QueryFileName)}}" target="_blank">View</a>
        </div>
    </div>

    <!-- Query and response details are shown when the response is sent by the agent -->
    <div class="row" ng-if="FrmQuery.ResponseById != 0">
        <!-- Query Details -->
        <div class="row" ng-if="FrmQuery.QueryRemark">
            <div class="mb-3 col-md-6">
                <label for="date" class="form-label">Date</label>
                <input type="text" class="form-control" ng-model="FrmQuery.FormattedQueryOn" readonly />
            </div>
            <div class="mb-3 col-md-6">
                <label for="Remark" class="form-label">Query By</label>
                <input type="text" class="form-control" ng-model="CustomerFullName" readonly />
            </div>
            <div class="mb-3 col-md-12">
                <label for="Remark" class="form-label">Query</label>
                <textarea class="form-control" ng-model="FrmQuery.QueryRemark" readonly></textarea>
            </div>
            <div class="mb-3 col-md-4" ng-if="FrmQuery.QueryFileName">
                <label class="form-label">Query Attachment</label><br />
                <a class="badge bg-primary" ng-href="{{getDownloadUrl(FrmQuery.QueryFileName)}}" target="_blank">View</a>
            </div>
            <hr />
        </div>

        <!-- Response Details -->
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="ResponseDate" class="form-label">Response Date</label>
                <input type="text" class="form-control" ng-model="FrmQuery.FormattedResponseOn" readonly />
            </div>
            <div class="mb-3 col-md-6">
                <label for="ResponseBy" class="form-label">Response By</label>
                <input type="text" class="form-control" ng-model="FrmQuery.AgentName" readonly />
            </div>
            <div class="mb-3 col-md-12">
                <label for="ResponseRemark" class="form-label">Response</label>
                <textarea class="form-control" ng-model="FrmQuery.ResponseRemark" readonly></textarea>
            </div>
            <div class="mb-3 col-md-3" ng-if="FrmQuery.ResponseFileName">
                <label class="form-label">Response Attachment</label><br />
                <a class="badge bg-primary" ng-href="{{getDownloadUrl(FrmQuery.ResponseFileName)}}" target="_blank">View</a>
            </div>
        </div>
    </div>

    <!-- Remark indicating agent response initiation when no query is sent -->
    <div class="row" ng-if="!FrmQuery.QueryRemark && !FrmQuery.QueryFileName">
        <hr />
        <div class="mb-3 col-md-12">
            <label for="QueryRemark" class="form-label">Query Remark</label>
            <textarea class="form-control" ng-model="FrmQuery.QueryRemarks" id="QueryRemarks" required></textarea>
        </div>
        <div class="col-md-6">
            <label for="FormFile" class="form-label">Attachment</label>
            <input class="form-control" type="file" id="FormFiles" ng-model="FrmQuery.FormFile" onchange="checkFile(this.id)" />
        </div>
    </div>

    <?php
    ModalEnd("false", "Save", "SaveResponsBtn");
    ModalStart("ShowQueryModal", "md", "Query / Response", "FrmQuery2", "FrmQuery2", "Querymodalctrl", "SubmitQuery()");
    ?>
    <div class="row">
        <div class="mb-3 col-md-12">
            <label for="Response  Remark" class="form-label">Query</label>
            <textarea class="form-control" ng-model="FrmQuery2.QueryRemark" id="QueryRemark" style="height: 38.94px;" required></textarea>
        </div>
        <div class="mb-3 col-md-12">
            <label for="FormFile" class="form-label">Attachment</label>
            <input class="form-control" type="file" id="FormFile" ng-model="FrmQuery2.FormFile" onchange="checkFile(this.id)">
            <p class="text-muted mb-0">Allowed JPG, PNG, PDF , XLSX or DOC File</p>
        </div>
    </div>
    <?php
    ModalEnd("true", "Save", "SaveBtnID");
    ModalStart("ShowEditDescriptionModal", "md", "<i class='bx bxs-edit'></i>Edit", "FrmEditModal", "FrmEditModal", "editModalCrtl", "EditDescription()");
    ?>
    <div class="row">
        <div class="mb-3 col-md-12">
            <label for="Response  Remark" class="form-label">Description</label>
            <textarea class="form-control" ng-model="FrmEditModal.Description" id="NewDescription" style="height: 38.94px;" required></textarea>
        </div>
    </div>
    <?php
    ModalEnd("true", "Save", "Edit_BtnId");
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
    </div>
    <script>
        var GlobalTblScope = "";
        var GlobalFrmScope = "";
        var GlobalEditScope = "";
        var GlobalTblrootScope = "";
        var Attachment = "";
        var APIRootPath = sessionStorage.getItem("APIRootPath");

        function checkFile(Id) 
        {
            var fileInput = $('#' + Id)[0].files[0];
            if (fileInput.type != "image/jpeg" && fileInput.type != "image/png" && fileInput.type != "application/pdf" && fileInput.type != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" && fileInput.type != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") 
            {
                Swal.fire("Warning", "Accept only .jpg, .png, .pdf, .docx, .xlsx files", "warning");
                document.getElementById(Id).value = "";
                $('#ShowQueryModal').modal('hide');
            } 
            else 
            {
                GlobalFrmScope.FrmQuery2.FormFile = fileInput;
            }
        };

        app.controller('TicketCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
            $rootScope.FrmTicket = {};
            GlobalTblScope = $scope;
            GlobalTblrootScope = $rootScope;
            $rootScope.CustomerFullName = "";
            $rootScope.ticketDetails = JSON.parse(sessionStorage.getItem("Ticket"))
            $rootScope.TicketInfo = JSON.parse(sessionStorage.getItem("Ticket"));
            $rootScope.HideBtn = $rootScope.ticketDetails.StatusId;
            $rootScope.CustomerEmail = "";
            $rootScope.AgentEmail = "";
            $rootScope.UserUUID = LoginData.Uuid;
            $rootScope.loginUser = LoginData.Id;
            $rootScope.LinkedToId = LoginData.LinkedToId;
            $rootScope.ResponseBy = {};
            $scope.BackButton = function() {
                if (LoginData.UserType.Id == 3) {
                    return document.getElementById('backButton').href = "Ticketlist/" + $scope.ticketDetails.TicketCategoryId;
                } else {
                    return document.getElementById('backButton').href = "UserTicket/" + $scope.ticketDetails.TicketCategoryId;
                }
            }

            $rootScope.getDownloadUrl = function(fileName) 
            {
                return APIRootPath + fileName;
            }

            $scope.getTicketDetail = function() 
            {
                var url = APIRootPath + "api/GetTicketDetail/" + $rootScope.UserUUID + "/" + $scope.ticketDetails.Id + "/" + $scope.ticketDetails.Code;
                $http.get(url, urlconfig).then(
                    function(response) {
                        $rootScope.TicketInfo = response.data.ticket;
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

            $scope.getCustomerAndProductDetails = function() 
            {
                var url = APIRootPath + "api/GetCustomerAndProduct/" + $rootScope.UserUUID + "/" + $scope.ticketDetails.CustomerId + "/" + $scope.ticketDetails.ProductId;
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

            $scope.showQueryDetail = function(Query) 
            {
                angular.copy(Query, GlobalFrmQueryScope.FrmQuery);
                if (GlobalFrmQueryScope.FrmQuery.CustomerName) 
                {
                    $rootScope.CustomerFullName = GlobalFrmQueryScope.FrmQuery.CustomerName;
                } 
                else if (GlobalFrmQueryScope.FrmQuery.CustomerUserName)
                {
                    $rootScope.CustomerFullName = GlobalFrmQueryScope.FrmQuery.CustomerUserName;
                }
                $('#ShowQueryDetailModal').modal('show');
            }

            $scope.QueryModel = function() 
            {
                $('#ShowQueryModal').modal('show');
            }

            $scope.ShowEditDescriptionModal = function(Ticket) 
            {
                angular.copy(Ticket, GlobalEditScope.FrmEditModal)
                $('#ShowEditDescriptionModal').modal('show');
            }

            $rootScope.GetQueryRespons = function() 
            {
                var url = APIRootPath + "api/GetQueryResponse/" + $rootScope.UserUUID + "/" + $rootScope.ticketDetails.Id;
                $http.get(url, urlconfig).then(
                    function(response) 
                    {
                        $rootScope.QueryDetails = response.data.Query;
                        $rootScope.ShowBtn = ($scope.QueryDetails.length != 0) ? 1 : 0;
                        $rootScope.ResponseCout = $scope.QueryDetails.filter(Ticket => Ticket.ResponseById == 0).length;
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

            $scope.UpdateQueryStatus = function(Query) 
            {
                if (Query.QuerryResponse == 2) 
                {
                    if (!$scope.SaveClicked) {
                        $scope.SaveClicked = true;
                        var url = APIRootPath + "api/UpdateQueryStatus/" + $rootScope.UserUUID;
                        var param = {
                            "QueryId": Query.Id,
                            "QueryCode": Query.Code,
                            "TicketId": $rootScope.FrmTicket.Id,
                        }
                        $http.post(url, param, urlconfig).then(function(response) {
                                $scope.SaveClicked = false;
                                GlobalTblScope.GetQueryRespons();
                            },
                            function(response) 
                            {
                                $scope.SaveClicked = false;
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
                }
            }

            $scope.getStatusColor = function(status) 
            {
                if (status === '0') 
                {
                    return 'success';
                } 
                else if (status === '2') 
                {
                    return 'success';
                } 
                else 
                {
                    return 'primary';
                }
            };

            setInterval(GlobalTblScope.GetQueryRespons, 10000);

            // Function Calls
            // $scope.getCustomerAndProductDetails();
            $scope.getTicketDetail();
            $scope.GetQueryRespons();
        });

        app.controller('QueryCtrl', function($scope, $rootScope, $http, $timeout, $filter) 
        {
            GlobalFrmQueryScope = $scope;
            $rootScope.UserUUID = LoginData.Uuid;
            $rootScope.FrmTicket = JSON.parse(sessionStorage.getItem("Ticket"));
            $rootScope.LinkedToId = LoginData.LinkedToId;
            $rootScope.UserTypeId = LoginData.UserType.Id;
            $rootScope.Name = LoginData.Customer.Name;
            $scope.FrmQuery = {};
        });

        app.controller('Querymodalctrl', function($scope, $rootScope, $http, $timeout, $filter) {
            GlobalFrmScope = $scope;
            $scope.FrmQuery2 = [];

            $scope.SubmitQuery = function() {
                var form = document.getElementById("FrmQuery2");
                if (form.reportValidity()) {
                    var form = document.getElementById("FrmQuery2");
                    var btn = document.getElementById("SaveBtnID").innerHTML;
                    if (form.reportValidity() && !$scope.SaveClicked) 
                    {
                        $scope.SaveClicked = true;
                        document.getElementById("SaveBtnID").innerHTML = "&nbsp;Saving...";
                        var myFormData = new FormData();

                        myFormData.append("UserUUID", $rootScope.UserUUID);
                        myFormData.append("UserTypeId", $rootScope.UserTypeId);
                        myFormData.append("TicketId", $rootScope.FrmTicket.Id);
                        myFormData.append("TicketCode", $rootScope.FrmTicket.Code);
                        myFormData.append("Remark", $scope.FrmQuery2.QueryRemark);
                        myFormData.append("FormFile", $scope.FrmQuery2.FormFile);
                        myFormData.append("AgentName", $rootScope.ResponseBy);
                        myFormData.append("AgentEmail", $rootScope.AgentEmail);
                        myFormData.append("CustomerFullName", $rootScope.FrmTicket.CustomerFullName == undefined ? '' : $rootScope.FrmTicket.CustomerFullName);
                        myFormData.append("CustomerEmail", $rootScope.FrmTicket.CustomerEmail == undefined ? '' : $rootScope.FrmTicket.CustomerEmail);
                        myFormData.append("CustomerUserFullName", $rootScope.FrmTicket.CustomerUserFullName == undefined ? '' : $rootScope.FrmTicket.CustomerUserFullName);
                        myFormData.append("CustomerUserEmail", $rootScope.FrmTicket.CustomerUserEmail == undefined ? '' : $rootScope.FrmTicket.CustomerUserEmail);

                        var url = APIRootPath + "api/SubmitQuery";
                        $http.post(url, myFormData, fileconfig).then(
                            function(response) {
                                $('#ShowQueryModal').modal('hide');
                                Swal.fire("Done", "Ticket submit successfully", "success");
                                $scope.SaveClicked = false;
                                document.getElementById("SaveBtnID").innerHTML = btn;
                                GlobalTblScope.GetQueryRespons();
                                $('#FormFile').val("");

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
        app.controller('editModalCrtl', function($scope, $rootScope, $http, $timeout, $filter) {
            GlobalEditScope = $scope;
            $scope.FrmEditModal = [];

            $scope.EditDescription = function() {
                var form = document.getElementById("FrmEditModal");
                if (form.reportValidity()) {
                    if (!$scope.SaveClicked) {
                        $scope.SaveClicked = true;
                        var btn = document.getElementById("Edit_BtnId").innerHTML;
                        document.getElementById("Edit_BtnId").innerHTML = "Saving...";
                        document.getElementById("Edit_BtnId").disabled = true;
                        var url = APIRootPath + "api/EditTicketDescription/" + $rootScope.UserUUID;
                        var param = {
                            "Code": $scope.FrmEditModal.Code == undefined ? '' : $scope.FrmEditModal.Code,
                            "Id": $scope.FrmEditModal.Id == undefined ? '' : $scope.FrmEditModal.Id,
                            "Description": $scope.FrmEditModal.Description,
                        }
                        $http.post(url, param, urlconfig).then(function(response) {
                                Swal.fire("Done", "The description has been successfully updated", "success");
                                $("#ShowEditDescriptionModal").modal('hide');
                                GlobalTblScope.getTicketDetail();
                                $scope.SaveClicked = false;
                                document.getElementById("Edit_BtnId").innerHTML = btn;
                                document.getElementById("Edit_BtnId").disabled = false;
                            },
                            function(response) {
                                $("#ShowEditDescriptionModal").modal('hide');
                                $scope.SaveClicked = false;
                                document.getElementById("Edit_BtnId").innerHTML = btn;
                                document.getElementById("Edit_BtnId").disabled = false;
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

        });
    </script>
</body>

</html>