<!DOCTYPE html>
<html lang="en">
<title>Tickets</title>
<?php
include 'pagesection.php';
include_once("util/Util.php");
pageHeader();
?>
<link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/fontawesome/css/all.min.css" />
<link rel="stylesheet" href="<?php print $_SESSION["DocRoot"]; ?>assets/css/chat_ui.css" />
<?php
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
form_With_Icon();
?>
<!-- Header and Refres counter -->
<div class="row" ng-controller="TicketCtrl" ng-model="FrmTbl">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold">
            <span class="text-muted fw-light">{{TicketCategorName}} Ticket List</span>
        </h4>
        <div>
            <div class="bx bx-refresh bx-spin text-primary" role="status" style="font-size: 25px;">
                <span class="visually-hidden">Loading...</span>
            </div>
            <span class="badge bg-warning">
                00:00:{{ RefreshCounter < 10 ? '0' + RefreshCounter : RefreshCounter }}
            </span>
        </div>
    </div>
    <!-- filters customer or customer product -->
    <div class="col-12" style="padding-bottom: 20px;">
        <div class="card">
            <div class="card-body" style="padding-bottom:15px; justify-content: space-evenly;">
                <div class="row">
                    <div class="mb-3 col-md-3">
                        <label for="IndustryTypeId" class="form-label col-md-12">Customer
                        </label>
                        <select class="select2 form-select" ng-model="FrmTbl.CustomerId" ng-change="TicketFillter();GetProducts()" required>
                            <option value="" selected>All Customer</option>
                            <option ng-repeat="customer in customers" value="{{customer.Id}}">{{customer.CompanyName}}</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="IndustryTypeId" class="form-label col-md-12">Product
                        </label>
                        <select class="select2 form-select" ng-model="FrmTbl.ProductId" ng-change="TicketFillter()" required>
                            <option value="" selected>All Products</option>
                            <option ng-repeat="Product in ProductDetails" value="{{Product.Id}}">{{Product.ProductName}}</option>
                        </select>
                    </div>
                    <!-- <div class="col-md-3 nav-item d-flex align-items-center" style="padding-top: 20px;">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input class="form-control" type="text" name="searchText" id="searchText" placeholder="Type to search" value="" ng-model="searchText" />
                    </div> -->
                    <div class="mb-3 col-md-3" style="padding-top: 28px;">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon11">
                                <i class="bx bx-search fs-4 lh-0"></i>
                            </span>
                            <input class="form-control" type="text" name="searchText" id="searchText" placeholder="Type to search" value="" ng-model="searchText" aria-describedby="basic-addon11" />
                        </div>
                    </div>
                    <!-- Notification panel -->
                    <div class="mb-3 col-md-3 d-flex justify-content-end align-items-center" style="padding-top: 35px;">
                        <div>
                            <div class="form-label text-center">
                                <i class='bx bx-bell bx-tada' data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasEnd" style="font-size:20px;"></i>
                                <label class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{filteredNotificationsLength + raisedtickets.length}}</label>
                            </div>
                            <div
                                class="offcanvas offcanvas-end"
                                tabindex="-1"
                                id="offcanvasEnd"
                                aria-labelledby="offcanvasEndLabel">
                                <div class="offcanvas-header">
                                    <h5 id="offcanvasEndLabel" class="offcanvas-title">Notification </h5>
                                    <button
                                        type="button"
                                        class="btn-close text-reset"
                                        data-bs-dismiss="offcanvas"
                                        aria-label="Close">
                                    </button>
                                </div>
                                <div class="offcanvas-header" style="padding-top: 28px;">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon11">
                                            <i class="bx bx-search fs-4 lh-0"></i>
                                        </span>
                                        <input class="form-control" type="text" name="searchTextNotificaton" id="searchTextNotificaton" placeholder="Type to search" value="" ng-model="searchTextNotificaton" aria-describedby="basic-addon11" />
                                    </div>
                                </div>
                                <div class="offcanvas-body my-auto mx-0 ">
                                    <div class="toast-container" ng-repeat="notification in notificationList | filter: filterNotifications | filter : searchTextNotificaton" style="padding-top: 5px;">
                                        <div class="bs-toast toast fade show" style="cursor: pointer;" role="alert" aria-live="assertive" aria-atomic="true" ng-click="GetQueryRespons(notification)">
                                            <div class="toast-header" style="display:flex;">
                                                <i class="bx bx-bell me-2"></i>
                                                <div class="me-auto fw-semibold">{{notification.Code}}</div><br>
                                                <div class="badge rounded-pill bg-label-primary" ng-show="!notification.CustomerUserFullName">{{notification.CustomerFullName}}</div>
                                                <div class="badge rounded-pill bg-label-primary" ng-show="notification.CustomerUserFullName">{{notification.CustomerUserFullName}}</div>
                                            </div>
                                            <hr>
                                            <div class="toast-body">
                                                {{notification.QueryRemark | limitTo: 35}}
                                            </div>
                                            <div class="toast-body">
                                                <small>{{ notification.QueryOn | date:'dd-MM-yyyy HH:mm:ss' }}</small>
                                            </div>
                                        </div>
                                        <div class="bs-toast toast fade show" style="cursor: pointer;" role="alert" aria-live="assertive" aria-atomic="true" ng-click="GetQueryRespons(notification)" ng-if="notification.StatusId == 1 && (notification.TicketCategoryId >= 1 && notification.TicketCategoryId <= 4)">
                                            <div class="toast-header">
                                                <i class="bx bx-bell me-2"></i>
                                                <div class="me-auto fw-semibold">{{notification.Code}}</div>
                                                <small>{{notification.RaisedOn | date:"MMM dd, yyyy 'at' hh:mm a"}}</small>
                                            </div>
                                            <div class="toast-body">
                                                {{notification.Subject}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="toast-container" ng-repeat="t in raisedtickets | filter : searchTextNotificaton" style="padding-top: 5px;">
                                        <div class="bs-toast toast fade show" ng-click="showTicket(t.TicketCategoryId,t.Code)" style="cursor: pointer;" role="alert" aria-live="assertive" aria-atomic="true" ng-if="t.StatusId == 1 && (t.TicketCategoryId >= 1 && t.TicketCategoryId <= 4)">
                                            <div class="toast-header" style="display:flex;">
                                                <i class="bx bx-bell me-2"></i>
                                                <div class="me-auto fw-semibold">{{t.Code}}</div>
                                                <div class="badge rounded-pill bg-label-primary" ng-show="!t.CustomerUserFullName">{{t.CustomerFullName}}</div>
                                                <div class="badge rounded-pill bg-label-primary" ng-show="t.CustomerUserFullName">{{t.CustomerUserFullName}}</div>
                                            </div>
                                            <div class="toast-header">
                                                <small class="me-auto" ng-if="t.TicketCategoryId == 1">New Development Ticket</small>
                                                <small class="me-auto" ng-if="t.TicketCategoryId == 2">New Service Ticket</small>
                                                <small class="me-auto" ng-if="t.TicketCategoryId == 3">New Bug Fix Ticket</small>
                                                <small class="me-auto" ng-if="t.TicketCategoryId == 4">New Update Ticket</small>
                                            </div>
                                            <hr>
                                            <div class="toast-body" style="padding-bottom: 0px;">
                                                <div class="me-auto fw-semibold">{{t.Subject | limitTo: 35}}</div>
                                            </div>
                                            <div class="toast-body" style="padding-bottom: 0px;">
                                                <small>{{t.RaisedOn | date:"MMM dd, yyyy 'at' hh:mm a"}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ticket Tabs -->
    <div class="col-12">
        <!-- <h6 class="text-muted">Raise</h6> -->
        <div class="nav-align-top mb-4">
            <ul class="nav nav-pills mb-3" role="tablist">
                <li class="nav-item">
                    <button type="button" ng-click="GetTickets('Raised');StoreStatusValue('Raised')" id="Raised" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-Query" aria-controls="navs-pills-top-Query" aria-selected="true">
                        Raised
                        <label class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{RaisedCount}}</label>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" ng-click="GetTickets('Assigned');StoreStatusValue('Assigned')" id="Assigned" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-Query" aria-controls="navs-pills-top-Query" aria-selected="false">
                        Assigned
                        <label class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{AssignedCount}}</label>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" ng-click="GetTickets('Processing');StoreStatusValue('Processing')" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-Query" aria-controls="navs-pills-top-Query" id="Processing" aria-selected="false">
                        Processing
                        <label class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{ProcessingCount}}</label>
                    </button>
                </li>
                <!-- <li class="nav-item">
                    <button type="button" class="nav-link" ng-click="GetTickets('Query Response');StoreStatusValue('Query Response')" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-Query" aria-controls="navs-pills-top-Query" aria-selected="false">
                        Query Response
                        <label class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{QueryReopensCount }}</label>
                    </button>
                </li> -->
                <li class="nav-item">
                    <button type="button" ng-click="GetTickets('Closed');StoreStatusValue('Closed')" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-Query" aria-controls="navs-pills-top-Query" id="Closed" aria-selected="false">
                        Complete
                        <label class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{ClosedCount}}</label>
                    </button>
                </li>
            </ul>
            <!-- Ticket Table -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-top-Query" role="tabpanel">
                    <div class="table-responsive text-nowrap" style="height: 350px; overflow-y: auto;">
                        <table class="table">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>Ticket Code</th>
                                    <th>Created By</th>
                                    <th>Client</th>
                                    <th>Subject</th>
                                    <th>Raised On </th>
                                    <th>{{StatusValue == 'Processing' || StatusValue == 'Query Response' ? 'Query / Response' : 'Status'}}</th>
                                    <th>Priority</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr ng-repeat="Ticket in ticketsDetails | orderBy:['-PriorityId','-RaisedOn'] | filter:searchText">
                                    <!-- <td><i class="me-3"></i>{{Ticket.Code}}</td> -->
                                    <td>
                                        <div>
                                            <i class="bx bxs-envelope me-3"></i>{{Ticket.Code}}<label ng-if="Ticket.Is_Read == 1 || Ticket.Is_Read == 2" ng-style="{'font-size': 'x-large', 'color': Ticket.Is_Read == 1 ? 'lawngreen' : 'red'}"> <b><sup><i class='bx bx-comment-detail'></i></sup></b></label>
                                            <span class="text-success" ng-if="Ticket.Is_OtpSent == 1 && Ticket.StatusId == 2">
                                                <i class="fa-solid fa-envelope-circle-check" title="OTP sent to customer to close the ticket"></i>
                                            </span>
                                        </div>
                                        <div ng-show="Ticket.AgentName">
                                            <i class='bx bx-user me-3'></i><label>{{Ticket.AgentName}}</label>
                                        </div>
                                    </td>
                                    <td ng-show="!Ticket.CustomerUserFullName">
                                        <i class="me-3"></i>{{Ticket.CustomerFullName}}
                                    </td>
                                    <td ng-show="Ticket.CustomerUserFullName">
                                        <i class="me-3"></i>{{Ticket.CustomerUserFullName}}
                                    </td>
                                    <td><i class="me-3"></i>{{Ticket.CustomerFullName}}</td>
                                    <td>{{Ticket.Subject | limitTo: 50}}</td>
                                    <td>{{Ticket.RaisedOn}}</td>
                                    <td>
                                        <span ng-show="Ticket.StatusId != 2 && Ticket.StatusId != 3" class="badge bg-{{getStatusColor(Ticket.StatusId)}}">
                                            {{Ticket.StatusId == 1 ? 'Raised' : (Ticket.StatusId == 4 ? 'Closed' : null)}}
                                        </span>
                                        <div ng-if="Ticket.StatusId == 2 || Ticket.StatusId == 3" style="display: flex; align-items: center; margin-left: 10px;">
                                            <div ng-init="combinedRemark = Ticket.QueryRemark && Ticket.ResponseRemark || Ticket.QueryRemark || Ticket.ResponseRemark || 'comment....'" style="flex-grow: 1;">
                                                <span class="badge bg-secondary" ng-click="GetQueryRespons(Ticket)" style="white-space: nowrap;cursor: pointer;">{{combinedRemark | limitTo: 10 }}</span>
                                            </div>
                                            <div style="display: flex; align-items: center; margin-left: 10px;">
                                                <span class="badge badge-center bg-primary" ng-show='!Ticket.QueryRemark && !Ticket.ResponseRemark'>
                                                    <i class='bx bx-reply' style='font-size: 20px; cursor: pointer;' title="Comment" ng-click="GetQueryRespons(Ticket)"></i>
                                                </span>
                                                <span class="badge badge-center bg-primary" ng-show='Ticket.QueryRemark && !Ticket.ResponseRemark' style="margin-left: 10px;">
                                                    <i class='bx bx-reply bx-flip-horizontal' style='font-size: 20px; cursor: pointer;' ng-click="GetQueryRespons(Ticket)" title="Reply"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="text-align: center;"><span class="badge bg-{{getPriorityIdColor(Ticket.PriorityId)}} me-1">{{Ticket.PriorityId == 1 ? 'Low' : (Ticket.PriorityId == 2 ? 'Medium' : 'High')}}</span></td>
                                    <td>
                                        <a class="" href="" ng-click="ShowDetails(Ticket)" title="Details"><i class='bx bx-info-circle me-1'></i></a>
                                        <a class="" href="" ng-show="Ticket.StatusId==1 && Ticket.ProcessedById==0" ng-click="getAgents(Ticket.Code,Ticket.Id,Ticket.CustomerId)" title="Assign Ticket"><i class='bx bx-paperclip me-1'></i></a>
                                        <a ng-show="Ticket.StatusId==4" class="" href="" ng-click="GetTicket_Log(Ticket.Id,Ticket.Code)" title="Ticket Log"><i class='bx bxs-download me-1'></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Notification toast -->
    <div class="toast-container">
        <div id="showToastPlacement" class="bs-toast toast toast-placement-ex m-2 fade bg-primary bottom-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
            <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                You have new notifications!
            </div>
        </div>
    </div>
</div>
<!-- Assing Agent Modal -->
<?php
ModalStart("assignAgentModal", "sm", "Assing Agent", "FrmAssingAgent", "FrmAssingAgent", "assignAgentModalCtrl");
?>
<div class="row">
    <div class="mb-3 col-md-12">
        <label for="SelectAgent" class="form-label">Select Agent</label>
        <select class="select2 form-select" ng-model="FrmAssingAgent.agentUserId" ng-options="agent.UserID as agent.AgentName for agent in agentslist" required>
            <option value="" selected>Select agent</option>
        </select>
    </div>
</div>
<?php
ModalEnd("assingAgent()", "true", "Save", "assingAgentBtnId");
?>
<!-- Chat ui modal (Query/Response) -->
<?php
ModalStart("ShowQueryResponseDetailModal", "dialog-scrollable modal-lg", "Query / Response", "FrmQuery", "FrmQuery", "assignAgentModalCtrl");
?>
<div class="chat-container">
    <div ng-repeat="Query in QueryDetails | orderBy: ['QueryOn', 'ResponseOn']">

        <!-- User 2 (Customer) Chat -->
        <div class="chat-row user-2" ng-if="Query.QueryRemark">
            <div class="chat-bubble user-2-bubble">
                <span class="chatName">{{Query.CustomerName || Query.CustomerUserName || 'Customer'}}</span>
                <p>{{Query.QueryRemark}}</p>
                <span class="time">{{Query.FormattedQueryOn}}</span>
            </div>
        </div>
        <!-- User 2 (Customer) Attachment -->
        <div class="chat-row user-2" ng-if="Query.QueryFileName && Query.QueryFileName !== '0'">
            <div class="chat-bubble user-2-bubble">
                <label class="form-label">Attachment</label><br />
                <a class="card-img-top" ng-href="{{getDownloadUrl(Query.QueryFileName)}}" target="_blank">
                    <img ng-if="Query.QueryFileName && isImageFile(Query.QueryFileName)" class="card-img-top" src="{{getDownloadUrl(Query.QueryFileName)}}" alt="Image">
                    <i ng-if="Query.QueryFileName.endsWith('.docx')" class="fas fa-file-word" style="font-size: 40px; color: #0072C6;"></i>
                    <i ng-if="Query.QueryFileName.endsWith('.xlsx')" class="fas fa-file-excel" style="font-size: 40px; color: #217346;"></i>
                    <i ng-if="Query.QueryFileName.endsWith('.pdf')" class="fas fa-file-pdf" style="font-size: 40px; color: #D9534F;"></i>
                </a>
                <span class="time">{{Query.FormattedQueryOn}}</span>
            </div>
        </div>

        <!-- User 1 (Agent) Chat -->
        <div class="chat-row user-1" ng-if="Query.ResponseRemark && Query.QueryById !== 0">
            <div class="chat-bubble user-1-bubble">
                <span class="chatName">{{Query.AgentName || 'Agent'}}</span>
                <p>{{Query.ResponseRemark}}</p>
                <span class="time">{{Query.FormattedResponseOn}}</span>
            </div>
        </div>
        <!-- User 1 (Agent) Attachment -->
        <div class="chat-row user-1" ng-if="Query.ResponseFileName && Query.ResponseFileName !== '0'">
            <div class="chat-bubble user-1-bubble">
                <label class="form-label">Attachment</label><br />
                <a class="card-img-top" ng-href="{{getDownloadUrl(Query.ResponseFileName)}}" target="_blank">
                    <img ng-if="Query.ResponseFileName && isImageFile(Query.ResponseFileName)" class="card-img-top" src="{{getDownloadUrl(Query.ResponseFileName)}}" alt="Image">
                    <i ng-if="Query.ResponseFileName.endsWith('.docx')" class="fas fa-file-word" style="font-size: 40px; color: #0072C6;"></i>
                    <i ng-if="Query.ResponseFileName.endsWith('.xlsx')" class="fas fa-file-excel" style="font-size: 40px; color: #217346;"></i>
                    <i ng-if="Query.ResponseFileName.endsWith('.pdf')" class="fas fa-file-pdf" style="font-size: 40px; color: #D9534F;"></i>
                </a>
                <span class="time">{{Query.FormattedResponseOn}}</span>
            </div>
        </div>
    </div>

    <!-- Chat Input -->
    <div class="chat-input-container">
        <input type="text" class="chat-input" ng-model="FrmQuery.QueryRemark" name="remark" placeholder="Type a message...">
        <input class="form-control" type="file" id="formFiles" name="formFiles" onchange="checkFile(this.id)" style="display:none;">
        <label for="formFiles" class="attachment-icon" title="Allowed JPG, PNG, PDF, XLSX or DOC File">
            <i class='bx bx-paperclip' style='color:#ffffff; font-size: 20px; cursor: pointer;'></i>
        </label>
        <button class="send-button" ng-if="ShowBtn==3" ng-click="SubmitResponse()" type="submit" id="SaveBtnID">
            <i class='bx bx-send' style='color:#ffffff'></i>
        </button>
        <button class="send-button" ng-if="ShowBtn==2" ng-click="SubmitQuery()" type="submit" id="SaveBtnID">
            <i class='bx bx-send' style='color:#ffffff'></i>
        </button>
    </div>
</div>

<?php
ModalEnd("SubmitQuery()", "false", "Save", "SaveBtnID");
?>
<!-- Place this in your main template or layout file -->
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
    let GlobalFrmAgentScope = "";
    var GlobalFileScope = "";
    var CategoryId = <?php echo json_encode(trim($params['Id'])); ?>;

    function checkFile(Id) {
        var fileInput = $('#' + Id)[0].files[0];
        if (fileInput.type != "image/jpeg" && fileInput.type != "image/png" && fileInput.type != "application/pdf" && fileInput.type != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" && fileInput.type != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
            Swal.fire({
                title: "Warning",
                text: "Accept only .jpg, .png, .pdf, .docx, .xlsx files",
                icon: "warning",
                willOpen: () => {
                    // Adjust z-index to ensure it's above the modal
                    const swalContainer = document.querySelector('.swal2-container');
                    if (swalContainer) {
                        swalContainer.style.zIndex = '2000'; // Higher than typical modal z-index
                    }
                }
            });

            document.getElementById(Id).value = "";
            $('#ShowQueryDetailModal').modal('hide');
        } else {

            Swal.fire({
                title: "Done",
                text: "File attached successfully",
                icon: "success",
                willOpen: () => {
                    // Adjust z-index to ensure it's above the modal
                    const swalContainer = document.querySelector('.swal2-container');
                    if (swalContainer) {
                        swalContainer.style.zIndex = '2000'; // Higher than typical modal z-index
                    }
                }
            });
            GlobalFileScope.FileData = fileInput;
        }
    }
    var APIRootPath = sessionStorage.getItem("APIRootPath")
    app.controller('TicketCtrl', function($scope, $rootScope, $http, $timeout, $filter, $interval, $location) {
        GlobalFrmScope = $scope;
        $rootScope.StatusValue = 'Raised';
        GlobalFrmrootScope = $rootScope;
        $rootScope.UserUUID = LoginData.Uuid;
        $rootScope.LinkedToId = LoginData.LinkedToId;
        $rootScope.UserTypeId = LoginData.UserType.Id;
        $rootScope.FrmTicket = {};
        $scope.FrmTbl = {};
        $scope.FrmShowTicket = {};
        $rootScope.agentslist = {};
        var ProcessingTat = 0;
        var ClosingTat = 0;
        $rootScope.RefreshCounter = 0;
        GlobalFrmScope.ticketStatusId = 0;
        $rootScope.ticketsDetails = [];
        $rootScope.FrmQuery = [];
        $rootScope.FileData = '';
        GlobalFileScope = $rootScope;
        $rootScope.QueryDetails = [];
        $rootScope.notificationList = [];
        $rootScope.TicketCategorName = "";
        $scope.filteredNotificationsLength = 0;
        $scope.oldNotificationCount = 0;
        var oldDevelopmentTicketCount = 0;
        var oldServiceTicketCount = 0;
        var oldBugFixTicketCount = 0;
        var oldUpDateTicketCount = 0;
        var developmentTicket = [];
        var serviceTicket = [];
        var bugFixTicket = [];
        var upDateTicket = [];
        var fullUrl = $location.absUrl();
        // Extract the ticket code using regular expression
        var ticketCode = fullUrl.match(/T-\d+/) || '';
        $scope.searchText = ticketCode[0];

        $scope.init = function() {
            // Get the status from URL parameters
            var urlParams = new URLSearchParams(window.location.search);
            var status = urlParams.get('status');
            // Check if status is 'Complete' and activate the appropriate tab
            if (status != 'Query Response' && status != null) 
            {
                $rootScope.StatusValue = status;
                document.getElementById(status).click();
            } else if (status == 'Query Response' && status != null)
            {
                $rootScope.StatusValue = 'Processing';
                document.getElementById('Processing').click();
            }
        };

        // Call the init function when the controller loads
        $scope.init();


        $scope.calculateFilteredNotifications = function() {
            $scope.filteredNotificationsLength = ($filter('filter')($rootScope.notificationList, $scope.filterNotifications)).length;
            if ($scope.filteredNotificationsLength > $scope.oldNotificationCount) 
            {
                $scope.oldNotificationCount = $scope.filteredNotificationsLength;
                $scope.showToast();
            }
        };
        // Watch for changes in notificationList or filter
        $scope.$watchGroup(['notificationList', 'filterNotifications'], function() 
        {
            $scope.calculateFilteredNotifications();
        });

        $scope.showToast = function() 
        {
            var toastElement = document.getElementById('showToastPlacement');
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        };

        if (CategoryId == 1)
         {
            $rootScope.TicketCategorName = "New-Development";
        } else if (CategoryId == 2) 
        {
            $rootScope.TicketCategorName = "Service";
        } else if (CategoryId == 3) 
        {
            $rootScope.TicketCategorName = "Bug-Fix";
        } else if (CategoryId == 4) 
        {
            $rootScope.TicketCategorName = "Update";
        }

        $rootScope.getDownloadUrl = function(fileName) 
        {
            return APIRootPath + fileName;
        };

        $scope.handleModal = function(Ticket) 
        {
            if (!Ticket.QueryRemark && !Ticket.ResponseRemark) 
            {
                $scope.showCommentModal(Ticket);
            } else 
            {
                $scope.showReplyCommentModal(Ticket);
            }
        }

        $scope.showTicket = function(Id, Code)
         {
            var url = APIRootPath + "api/updateNotificationStatus/" + $rootScope.UserUUID + "/" + Id + "/" + Code;
            $http.get(url, urlconfig).then(
                function(response) 
                {
                    $scope.getNewRaisedTicketList();
                    window.open('<?php print $_SESSION["DocRoot"]; ?>Tickets/' + Id + "?" + Code, '_self');
                },
                function(response)
                 {
                    if (response.data.status != 401) 
                    {
                        Swal.fire("OOPS", response.data.message, "error");
                    } else 
                    {
                        window.location.replace(APIBasePath);
                    }
                }
            );
        };

        $scope.GetTabTicketCounts = function() {
            var url = APIRootPath + "api/items/getTabTicketCount/" + $rootScope.UserUUID + "/" +   $rootScope.UserTypeId  + "/" + CategoryId;
            $http.get(url,urlconfig).then(
                function(response)
                {
                    $scope.ticketCounts = response.data.ticketsCounts[0];
                    $scope.TotalTicket = $scope.ticketCounts.TotalTicket;
                    $rootScope.RaisedCount = $scope.ticketCounts.TicketRaised;
                    $rootScope.AssignedCount = $scope.ticketCounts.TicketAssigned;
                    $rootScope.ProcessingCount = $scope.ticketCounts.TicketProcessing;
                    $rootScope.QueryReopensCount = $scope.ticketCounts.TicketQuery;
                    $rootScope.ClosedCount = $scope.ticketCounts.TicketClosed;
                    $rootScope.ProcessingCount = parseInt($rootScope.QueryReopensCount) + parseInt($rootScope.ProcessingCount);
                },
                function(response)
                {
                    if (response.data.status != 401) 
                    {
                        Swal.fire("OOPS", response.data.message, "error");
                    } else 
                    {
                        window.location.replace(APIBasePath);
                    }
                }
            )
        };
        $scope.GetTabTicketCounts();
        $scope.GetCustomerDetail = function() 
        {
            var url = APIRootPath + "api/GetCustomer/" + $rootScope.UserUUID;
            $http.get(url, urlconfig).then(
                function(response) 
                {
                    $scope.customers = response.data.customers;
                    // alert(JSON.stringify($scope.customers));
                },
                function(response)
                 {
                    if (response.data.status != 401)
                    {
                        Swal.fire("OOPS", response.data.message, "error");
                    } else 
                    {
                        window.location.replace(APIBasePath);
                    }
                }
            );
        }

        $scope.GetProducts = function() {
            if ($scope.FrmTbl.CustomerId != undefined)
             {
                var url = APIRootPath + "api/GetCustomerProduct/" + $rootScope.UserUUID + "/" + $scope.FrmTbl.CustomerId;
                $http.get(url, urlconfig).then(
                    function(response) 
                    {
                        $scope.ProductDetails = response.data.Products;

                    },
                    function(response) 
                    {
                        if (response.data.status != 401) {
                            Swal.fire("OOPS", response.data.message, "error");
                        } else {
                            window.location.replace(APIBasePath);
                        }
                    }
                );
            }
        }

        $rootScope.GetTickets = function(TicketStatus)
         {
            var url = APIRootPath + "api/tickets/GetTicket/" + $rootScope.UserUUID + "/" +TicketStatus + "/" + CategoryId;
            $http.get(url, urlconfig).then(
                function(response) 
                {
                    $rootScope.ticketsDetails = response.data.tickets;
                    $rootScope.notificationList = response.data.tickets;
                    $scope.Tickets = $rootScope.ticketsDetails;
                    $rootScope.ticketsDetails = $scope.Tickets.filter(Ticket => Ticket.TicketStatus == TicketStatus && Ticket.TicketCategoryId == CategoryId);
                    GlobalFrmScope.RaisedTickets = $rootScope.ticketsDetails;
                    $scope.TicketFillter();
                },
                function(response)
                 {
                    if (response.data.status != 401)
                    {
                        Swal.fire("OOPS", response.data.message, "error");
                    } else 
                    {
                        window.location.replace(APIBasePath);
                    }
                }
            );
        }

        $rootScope.raisedtickets = [];
        $scope.getNewRaisedTicketList = function() 
        {
            var url = APIRootPath + "api/getNewRaisedTicketList/" + $rootScope.UserUUID;
            $http.get(url, urlconfig).then(
                function(response) {
                    $rootScope.raisedtickets = response.data.raisedticket;
                    // console.log($rootScope.raisedtickets);
                    if ($rootScope.raisedtickets.length > 0) 
                    {
                        developmentTicket = $rootScope.raisedtickets.filter(Ticket => Ticket.StatusId == 1 && Ticket.TicketCategoryId == 1);
                        serviceTicket = $rootScope.raisedtickets.filter(Ticket => Ticket.StatusId == 1 && Ticket.TicketCategoryId == 2);
                        bugFixTicket = $rootScope.raisedtickets.filter(Ticket => Ticket.StatusId == 1 && Ticket.TicketCategoryId == 3);
                        upDateTicket = $rootScope.raisedtickets.filter(Ticket => Ticket.StatusId == 1 && Ticket.TicketCategoryId == 4);

                        if (developmentTicket.length > oldDevelopmentTicketCount) 
                        {
                            // Broadcast a global notification
                            $rootScope.$broadcast('newTicketRaised', {
                                message: "New development ticket raised"
                            });
                            oldDevelopmentTicketCount = developmentTicket.length; // Update old count
                        }

                        if (serviceTicket.length > oldServiceTicketCount) 
                        {
                            $rootScope.$broadcast('newTicketRaised', {
                                message: "New service ticket raised"
                            });
                            oldServiceTicketCount = serviceTicket.length; // Update old count
                        }

                        if (bugFixTicket.length > oldBugFixTicketCount)
                        {
                            $rootScope.$broadcast('newTicketRaised', {
                                message: "New bug fix ticket raised"
                            });
                            oldBugFixTicketCount = bugFixTicket.length; // Update old count
                        }

                        if (upDateTicket.length > oldUpDateTicketCount) 
                        {
                            $rootScope.$broadcast('newTicketRaised', {
                                message: "New update ticket raised"
                            });
                            oldUpDateTicketCount = upDateTicket.length; // Update old count
                        }
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

        $scope.TicketFillter = function() {
            if ($scope.FrmTbl.CustomerId != undefined && $scope.FrmTbl.ProductId != undefined && $rootScope.StatusValue != undefined) 
            {
                $rootScope.ticketsDetails = $scope.Tickets.filter(Ticket => Ticket.ProductId == $scope.FrmTbl.ProductId && Ticket.TicketStatus == $rootScope.StatusValue && Ticket.CustomerId == $scope.FrmTbl.CustomerId && Ticket.TicketCategoryId == CategoryId);
            } 
            else if ($scope.FrmTbl.CustomerId != undefined) 
            {
                $rootScope.ticketsDetails = $scope.Tickets.filter(Ticket => Ticket.CustomerId == $scope.FrmTbl.CustomerId && Ticket.TicketStatus == $rootScope.StatusValue && Ticket.TicketCategoryId == CategoryId);
            } 
            else if ($scope.FrmTbl.ProductId != undefined) 
            {
                $rootScope.ticketsDetails = $scope.Tickets.filter(Ticket => Ticket.ProductId == $scope.FrmTbl.ProductId && Ticket.TicketStatus == $rootScope.StatusValue && Ticket.TicketCategoryId == CategoryId);
            }
             else if ($rootScope.StatusValue != undefined)
             {
                if ($rootScope.StatusValue == 'Processing')
                 {
                    $rootScope.ticketsDetails = $scope.Tickets.filter(Ticket => (Ticket.TicketStatus == $rootScope.StatusValue || Ticket.TicketStatus == 'Query Response') && Ticket.TicketCategoryId == CategoryId);
                } 
                else 
                {
                    $rootScope.ticketsDetails = $scope.Tickets.filter(Ticket => Ticket.TicketStatus == $rootScope.StatusValue && Ticket.TicketCategoryId == CategoryId);
                }
            } 
            else
            {
                $rootScope.ticketsDetails = $scope.Tickets;
            }
        };

        $scope.ShowDetails = function(Ticket) 
        {
            angular.copy(Ticket, $scope.FrmShowTicket);
            sessionStorage.setItem('Ticket', JSON.stringify($scope.FrmShowTicket));
            window.open('<?php print $_SESSION["DocRoot"]; ?>TikcketInformation', '_self')
        }

        // setInterval($scope.GetTickets, 10000);
        // $scope.assignAgentModal = function() {

        // }
        //calling
        $scope.StoreStatusValue = function(Value)
        {
            $rootScope.StatusValue = Value;
            $scope.searchText = "";
        }

        var obj = "";
        obj = $interval(function() {
            if (parseInt($rootScope.RefreshCounter) == 0) 
            {
                $scope.GetCustomerDetail();
                $rootScope.GetTickets($rootScope.StatusValue);
                $rootScope.RefreshCounter = 10;
                $rootScope.LastUpdatedOn = new Date();
                $scope.getNewRaisedTicketList();
                $scope.GetTabTicketCounts();
                // $scope.getnotificaton();
            } else 
            {
                $rootScope.RefreshCounter = parseInt($rootScope.RefreshCounter) - 1;
            }
        }, 1000);


        $scope.GetTicket_Log = function(TicketId, TicketCode) 
        {
            var url = APIRootPath + "api/GetTicketLog/" + $rootScope.UserUUID + "/" + TicketId;
            $http.get(url, urlconfig).then(
                function(response) {
                    $rootScope.Ticket_log = response.data.TicketData;
                    ExportData(TicketCode + "_ticket-log.xlsx", $rootScope.Ticket_log);
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

        $rootScope.getAgents = function(Ticket_Code, Ticket_ID, Customer_Id) 
        {
            var url = APIRootPath + "api/GetAgents/" + $rootScope.UserUUID;
            $http.get(url, urlconfig).then(
                function(response) {
                    $rootScope.agentslist = response.data.agents;
                    GlobalFrmAgentScope.FrmAssingAgent.assingTicketCode = Ticket_Code;
                    GlobalFrmAgentScope.FrmAssingAgent.assingTicketId = Ticket_ID;
                    GlobalFrmAgentScope.FrmAssingAgent.Customer_ID = Customer_Id;
                    $("#assignAgentModal").modal('show');
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

        function ExportData(fileName, data) 
        {
            var ws = XLSX.utils.json_to_sheet(data);
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Ticket History");
            XLSX.writeFile(wb, fileName);
        }
        // $scope.getTatDetails();
        $scope.getStatusColor = function(status) 
        {
            switch (status) {
                case '1':
                    return 'primary';
                    // case '2':
                    //     return 'warning';
                    // case '3':
                    //     return 'secondary';
                case '4':
                    return 'success';
                    // Default color if status is not recognized
            }
        };
        $scope.getPriorityIdColor = function(Priority) 
        {
            switch (Priority) {
                case '1':
                    return 'info';
                case '2':
                    return 'warning';
                case '3':
                    return 'danger';
                    // Default color if status is not recognized
            }
        };

        $scope.getQueryStatusColor = function(status) 
        {
            if (status === '0') {
                return 'success';
            } else if (status === '2') {
                return 'success';
            } else {
                return 'primary';
            }
        };

        $scope.ShowQueryResponseDetailModal = function(Ticket) 
        {
            angular.copy(Ticket, $rootScope.FrmQuery);
            $rootScope.isQuery = $rootScope.FrmQuery.QueryRemark;
            $rootScope.isResponse = $rootScope.FrmQuery.ResponseRemark;
            $rootScope.FrmQuery.QueryRemark = "";
            $('#ShowQueryResponseDetailModal').modal('show');
        }


        $scope.GetQueryRespons = function(Ticket) 
        {
            var url = APIRootPath + "api/GetQueryResponse/" + $rootScope.UserUUID + "/" + Ticket.Id;
            $http.get(url, urlconfig).then(
                function(response) {
                    $rootScope.QueryDetails = response.data.Query;
                    $rootScope.ShowBtn = Ticket.StatusId;
                    $scope.ResponseCout = $rootScope.QueryDetails.filter(Ticket => Ticket.ResponseById == 0).length;
                    $scope.QueryCode = $rootScope.QueryDetails.filter(Ticket => Ticket.TicketId == $scope.FrmTicket.Id);
                    $('#offcanvasEnd').offcanvas('hide');
                    $scope.ShowQueryResponseDetailModal(Ticket);
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
        $scope.filterNotifications = function(notification) 
        {
            return notification.QueryRemark && notification.ResponseRemark == '' &&
                new Date(notification.QueryOn) > new Date(Date.now() - 24 * 60 * 60 * 1000);
        };
    });
    app.controller('assignAgentModalCtrl', function($scope, $rootScope, $http, $timeout, $filter) 
    {
        $scope.FrmAssingAgent = [];
        GlobalFrmAgentScope = $scope;
        $scope.assingAgent = function() {
            var form = document.getElementById("FrmAssingAgent");
            if (form.reportValidity()) 
            {
                if (!$scope.SaveClicked) 
                {
                    $scope.SaveClicked = true;
                    var btn = document.getElementById("assingAgentBtnId").innerHTML;
                    document.getElementById("assingAgentBtnId").innerHTML = "Saving...";
                    document.getElementById("assingAgentBtnId").disabled = true;

                    var url = APIRootPath + "api/AssingAgent/" + $rootScope.UserUUID;
                    var param = 
                    {
                        "agentUserId": $scope.FrmAssingAgent.agentUserId,
                        "assingedTicketCode": GlobalFrmAgentScope.FrmAssingAgent.assingTicketCode,
                        "assingedTicketId": GlobalFrmAgentScope.FrmAssingAgent.assingTicketId,
                        "Customer_ID": GlobalFrmAgentScope.FrmAssingAgent.Customer_ID
                    }
                    $http.post(url, param, urlconfig).then(function(response) 
                        {
                            $("#assignAgentModal").modal('hide');
                            Swal.fire("Done", "Agent Assing successfully", "success");
                            $scope.SaveClicked = false;
                            document.getElementById("assingAgentBtnId").innerHTML = btn;
                            document.getElementById("assingAgentBtnId").disabled = false;
                            $rootScope.GetTickets($rootScope.StatusValue);
                        },
                        function(response) 
                        {
                            $scope.SaveClicked = false;
                            document.getElementById("assingAgentBtnId").innerHTML = btn;
                            document.getElementById("assingAgentBtnId").disabled = false;
                            if (response.data.status != 401) {
                                $("#assignAgentModal").modal('hide');
                                Swal.fire("OOPS", response.data.message, "error");
                            } else {
                                window.location.replace(APIBasePath);
                            }
                        }
                    );

                }
            }
        }

        $scope.SubmitQuery = function() 
        {
            var form = document.getElementById("FrmQuery");
            if (form.reportValidity()) 
            {
                var form = document.getElementById("FrmQuery");
                var btn = document.getElementById("SaveBtnID").innerHTML;
                if (form.reportValidity() && !$scope.SaveClicked) 
                {
                    $scope.SaveClicked = true;
                    document.getElementById("SaveBtnID").innerHTML = "&nbsp;<i class='fa-duotone fa-solid fa-spinner fa-spin-pulse' style='color:#ffffff'><span class='visually-hidden'>Loading...</span></i>";
                    var myFormData = new FormData();

                    myFormData.append("UserUUID", $rootScope.UserUUID);
                    myFormData.append("UserTypeId", $rootScope.UserTypeId);
                    myFormData.append("TicketId", $rootScope.FrmQuery.Id);
                    myFormData.append("TicketCode", $rootScope.FrmQuery.Code);
                    myFormData.append("Remark", $rootScope.FrmQuery.QueryRemark);
                    myFormData.append("FormFile", $rootScope.FileData);
                    myFormData.append("AgentName", $rootScope.FrmQuery.AgentName);
                    myFormData.append("AgentEmail", $rootScope.FrmQuery.AgentEmail);
                    myFormData.append("CustomerFullName", $rootScope.FrmQuery.CustomerFullName == undefined ? '' : $rootScope.FrmQuery.CustomerFullName);
                    myFormData.append("CustomerEmail", $rootScope.FrmQuery.CustomerEmail == undefined ? '' : $rootScope.FrmQuery.CustomerEmail);
                    myFormData.append("CustomerUserFullName", $rootScope.FrmQuery.CustomerUserFullName == undefined ? '' : $rootScope.FrmQuery.CustomerUserFullName);
                    myFormData.append("CustomerUserEmail", $rootScope.FrmQuery.CustomerUserEmail == undefined ? '' : $rootScope.FrmQuery.CustomerUserEmail);

                    var url = APIRootPath + "api/SubmitQuery";
                    $http.post(url, myFormData, fileconfig).then(
                        function(response) 
                        {
                            $scope.FrmTicket = [];
                            $('#ShowQueryResponseDetailModal').modal('hide');
                            Swal.fire("Done", "Query submit successfully", "success");
                            $scope.SaveClicked = false;
                            document.getElementById("SaveBtnID").innerHTML = btn;
                            $rootScope.GetTickets($rootScope.StatusValue);
                            $('#formFiles').val("");
                            // location.reload();
                        },
                        function(response) 
                        {
                            $scope.SaveClicked = false;
                            document.getElementById("SaveBtnID").innerHTML = btn;
                            if (response.data.status != 401) {
                                $('#ShowQueryResponseDetailModal').modal('hide');
                                Swal.fire("OOPS", response.data.message, "error");
                            } else {
                                window.location.replace(APIBasePath);
                            }
                        }
                    );
                }
            }
        }

        $scope.SubmitResponse = function() 
        {
            var form = document.getElementById("FrmQuery");
            if (form.reportValidity()) 
            {
                var form = document.getElementById("FrmQuery");
                var btn = document.getElementById("SaveBtnID").innerHTML;
                if (form.reportValidity() && !$scope.SaveClicked) 
                {
                    $scope.SaveClicked = true;
                    document.getElementById("SaveBtnID").innerHTML = "&nbsp;<i class='fa-duotone fa-solid fa-spinner fa-spin-pulse' style='color:#ffffff'><span class='visually-hidden'>Loading...</span></i>";
                    var myFormData = new FormData();
                    myFormData.append("UserUUID", $rootScope.UserUUID);
                    myFormData.append("UserTypeId", $rootScope.UserTypeId);
                    myFormData.append("QueryCode", $rootScope.FrmQuery.QueryCode);
                    myFormData.append("TicketId", $rootScope.FrmQuery.TicketId);
                    myFormData.append("Remark", $rootScope.FrmQuery.QueryRemark);
                    myFormData.append("FormFile", $rootScope.FileData);
                    myFormData.append("TicketCode", $rootScope.FrmQuery.Code);
                    myFormData.append("AgentName", $rootScope.FrmQuery.AgentName);
                    myFormData.append("AgentEmail", $rootScope.FrmQuery.AgentEmail);
                    myFormData.append("CustomerFullName", $rootScope.FrmQuery.CustomerFullName == undefined ? '' : $rootScope.FrmQuery.CustomerFullName);
                    myFormData.append("CustomerEmail", $rootScope.FrmQuery.CustomerEmail == undefined ? '' : $rootScope.FrmQuery.CustomerEmail);
                    myFormData.append("CustomerUserFullName", $rootScope.FrmQuery.CustomerUserFullName == undefined ? '' : $rootScope.FrmQuery.CustomerUserFullName);
                    myFormData.append("CustomerUserEmail", $rootScope.FrmQuery.CustomerUserEmail == undefined ? '' : $rootScope.FrmQuery.CustomerUserEmail);

                    var url = APIRootPath + "api/SubmitResponse";
                    $http.post(url, myFormData, fileconfig).then(function(response) {
                            $('#ShowQueryResponseDetailModal').modal('hide');
                            Swal.fire("Done", "Response submit successfully", "success");
                            $scope.SaveClicked = false;
                            $rootScope.GetTickets($rootScope.StatusValue);
                            document.getElementById("SaveBtnID").innerHTML = btn;
                            $('#formFiles').val("");

                            // window.open('Ticket_list', '_self')
                        },
                        function(response) 
                        {
                            $scope.SaveClicked = false;
                            document.getElementById("SaveBtnID").innerHTML = btn;
                            if (response.data.status != 401) 
                            {
                                $('#ShowQueryResponseDetailModal').modal('hide');
                                Swal.fire("OOPS", response.data.message, "error");
                                // $rootScope.GetTickets($rootScope.StatusValue);
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

        $rootScope.isImageFile = function(fileName) 
        {
            if (!fileName) return false;
            const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];
            const fileExtension = fileName.split('.').pop().toLowerCase();
            return imageExtensions.includes(fileExtension);
        };
    })
</script>

</html>