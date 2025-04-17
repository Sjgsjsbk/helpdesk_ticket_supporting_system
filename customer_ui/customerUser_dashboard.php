<!DOCTYPE html>
<html lang="en">
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
include 'customer_ui/customer_pagesection.php';
// include 'customer_Detail.php';
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
sideBarEnd(); //sidebar End

MainContainer_2Start();

navbarStart(); //navbar start

MainContentStart(); //main content Start
pageContainerStart();
?>
<form action="" ng-controller="DashBoardCtrl">
    <div class="col-12" style="padding-bottom: 20px;">
        <div class="card">
            <div class="card-body" style="padding-bottom:6px;">
                <div class="row">
                    <div class="mb- col-md-4">
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon11">
                                <i class="bx bx-search fs-4 lh-0"></i>
                            </span>
                            <input class="form-control" type="text" name="searchText" id="searchText" placeholder="Type to search" value="" ng-model="searchText" aria-describedby="basic-addon11" require />
                        </div>
                    </div>
                    <div class="mb-3 col-md-2">
                        <a href="" class="menu-link" ng-click="ShowGoToticketModel()">
                            <button type="button" class="btn btn-primary">Search</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 order-1">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card">
                        <a href="<?php print $_SESSION["DocRoot"]; ?>UserTicket/1?status=1" class="menu-link">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="<?php print $_SESSION["DocRoot"]; ?>assets/img/icons/unicons/file-import-solid-72.png" alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Raised Tickets</span>
                                <h5 class="card-title mb-2">{{RaisedCount}}</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card">
                        <a href="<?php print $_SESSION["DocRoot"]; ?>UserTicket/1?status=2" class="menu-link">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="<?php print $_SESSION["DocRoot"]; ?>assets/img/icons/unicons/briefcase-solid-72.png" alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Process Tickets</span>
                                <h5 class="card-title mb-2">{{ProcessingCount}}</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card">
                        <a href="<?php print $_SESSION["DocRoot"]; ?>UserTicket/1?status=3" class="menu-link">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="<?php print $_SESSION["DocRoot"]; ?>assets/img/icons/unicons/support-regular-72.png" alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Query-Response</span>
                                <h5 class="card-title mb-2">{{QueryReopensCount}}</h5>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mb-4">
                    <div class="card">
                        <a href="<?php print $_SESSION["DocRoot"]; ?>UserTicket/1?status=4" class="menu-link">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="<?php print $_SESSION["DocRoot"]; ?>assets/img/icons/unicons/calendar-check-solid-72.png" alt="Credit Card" class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Closed Tickets</span>
                                <h5 class="card-title mb-2">{{ClosedCount}}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
</div>
<?php
ModalStart("GotoTicketModal", "xl", "Ticket", "FrmGotoTicket", "FrmGotoTicket", "FrmGotoTicketCtrl", "");
?>
<div class="table-responsive text-nowrap" style="height: 350px; overflow-y: auto;">
    <table class="table">
        <thead>
            <tr class="text-nowrap">
                <th>Ticket Code</th>
                <th>Created By</th>
                <th>Client</th>
                <th>Subject</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            <tr ng-repeat="Ticket in FillterTicketList | orderBy:['-PriorityId','-RaisedOn'] | filter:FillterText">
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
                <td>
                    <a href="<?php print $_SESSION['DocRoot']; ?>Ticketlist/{{Ticket.TicketCategoryId}}?Code={{Ticket.Code}}&status={{Ticket.StatusId}}" title="Details">
                        <i class='bx bx-info-circle me-1'></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<?php
ModalEnd("", "false", "Save", "GotoTicketbtn");
form_With_Icon();
profileSection();
pageTable();
pageContainerEnd();
pageFooter();

MainContentEnd(); //main content end

MainContainer_2End();
LayoutContainerEnd();
LayoutWrapperEnd();
pageEnd();
?>
<script>
    var GlobalTblScope = "";
    var GlobalUpdateModelScope = "";
    var GlobalIndustryTypScope = "";
    var FrmGotoTicketScope = "";
    var APIRootPath = sessionStorage.getItem("APIRootPath");
    app.controller('DashBoardCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        $scope.TotalCustomer = "";
        $scope.customers = "";
        $scope.ProductsDetails = [];
        $rootScope.CustomerName = LoginData.CustomerUser.Name;
        $rootScope.ProfileUrl = LoginData.CustomerUser.CustomerUserProfile;
        $rootScope.MappedCustromerId = LoginData.CustomerUser.UserMappedToId;
        $rootScope.CustomerUserId = LoginData.Id;
        $rootScope.UserUUID = LoginData.Uuid;
        $rootScope.LinkedToId = LoginData.LinkedToId;
        $rootScope.UserTypeId = LoginData.UserType.Id;
        $scope.TotalTicket = 0;
        $scope.RaisedCount = 0;
        $scope.ProcessingCount = 0;
        $scope.QueryReopensCount = 0;
        $scope.ClosedCount = 0;

        $scope.GetTicketCounts = function(){
            var url = APIRootPath + "api/tickets/getTIcketCounts/"+$rootScope.UserUUID +"/" + $rootScope.LinkedToId +"/" + $rootScope.UserTypeId + "/" + $rootScope.MappedCustromerId;
            $http.get(url,urlconfig).then(
                function(response){
                    $scope.ticketCounts = response.data.ticketsCounts[0];
                    $scope.TotalTicket = $scope.ticketCounts.TotalTicket;
                    $scope.RaisedCount = $scope.ticketCounts.TicketRaised;
                    $scope.AssignedCount = $scope.ticketCounts.TicketAssigned;
                    $scope.ProcessingCount = $scope.ticketCounts.TicketProcessing;
                    $scope.QueryReopensCount = $scope.ticketCounts.TicketQuery;
                    $scope.ClosedCount = $scope.ticketCounts.TicketClosed;
                },
                function(response){
                    if (response.data.status != 401) {
                        Swal.fire("OOPS", response.data.message, "error");
                    } else {
                        window.location.replace(APIBasePath);
                    }
                }
            )
        }
        $scope.GetTicketCounts();

        $scope.GetTickets = function() {
            var url = APIRootPath + "api/tickets/get_TicketForSearch/" + $rootScope.UserUUID +"/" + $rootScope.LinkedToId +"/" + $rootScope.UserTypeId + "/" + $rootScope.MappedCustromerId;
            $http.get(url, urlconfig).then(
                function(response) {
                    $scope.ticketsDetails = response.data.tickets;
                    FrmGotoTicketScope.FillterTicketList = $scope.ticketsDetails;
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

        $rootScope.ShowGoToticketModel = function() {
            if ($scope.searchText) {
                FrmGotoTicketScope.FillterText = $scope.searchText;
                $('#GotoTicketModal').modal('show');
            } else {
                Swal.fire("OOPS", "Please type something to search", "info");
            }
        }

        $scope.refreshAll = function() {
            $scope.GetTicketCounts();
            $scope.GetTickets();
        }
        $scope.showProduct = function(Item) {
            window.open('MyProducts?IsActive=' + Item, '_self')
        }
        setInterval($scope.refreshAll, 10000);
        $scope.GetTickets();
    });
    app.controller('FrmGotoTicketCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        FrmGotoTicketScope = $scope;
        $scope.FillterTicketList = [];
        $scope.FillterText = ""
    });
</script>

</html>