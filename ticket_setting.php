<!DOCTYPE html>
<html lang="en">
<title>Tickets</title>

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
<div class="row">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold">
            <span class="text-muted fw-light">Tickets Tat Setting</span>
        </h4>
    </div>
</div>
<form ng-controller="TicketTatCtrl" ng-model="FrmTat" id="FrmTat">
    <div class="card">
        <div class="card-body" style="padding-bottom:15px; justify-content: space-evenly;">
            <div class="row" style="width:auto;">
                <div class="mb-3 col-md-5">
                    <label for="IndustryTypeId" class="form-label col-md-12">Process TAT
                    </label>
                    <input class="form-control" type="text" ng-model="FrmTat.ProcessingTat" id="ProcessingTat" required />
                </div>
                <div class="mb-3 col-md-5">
                    <label for="IndustryTypeId" class="form-label col-md-12">Closing Tat
                    </label>
                    <input class="form-control" type="text" ng-model="FrmTat.ClosingTat" id="ClosingTat" required />
                </div>
                <div class="mb-3 col-md-2" style=" margin-top: 2.7%;">
                    <button type="submit" id="Savetatbtn" class="btn btn-primary " ng-click="SaveTat()">Submit</button>
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
    var APIRootPath = sessionStorage.getItem("APIRootPath");
    app.controller('TicketTatCtrl', function($scope, $rootScope, $http, $timeout, $filter) {
        GlobalFrmScope = $scope;
        $rootScope.UserUUID = LoginData.Uuid;
        $scope.FrmTat = {};
        $scope.TatDetails = [];

        $scope.SaveTat = function() {
            var form = document.getElementById("FrmTat");
            if (form.reportValidity()) {
                if (!$scope.SaveClicked) {
                    $scope.SaveClicked = true;
                    var btn = document.getElementById("Savetatbtn").innerHTML;
                    document.getElementById("Savetatbtn").innerHTML = "Saving...";
                    document.getElementById("Savetatbtn").disabled = true;
                    var url = APIRootPath + "api/SaveTatDetails/" + $rootScope.UserUUID;
                    var tatId = '';
                    if ($scope.TatDetails && $scope.TatDetails.length > 0 && $scope.TatDetails[0].Id !== undefined) {
                        tatId = $scope.TatDetails[0].Id;
                    }
                    var param = {
                        "ProcessTat": $scope.FrmTat.ProcessingTat,
                        "ClosingTat": $scope.FrmTat.ClosingTat,
                        "TadtId": tatId
                    };

                    $http.post(url, param, urlconfig).then(
                        function(response) {
                            Swal.fire("Done", "Item saved successfully", "success");
                            $scope.SaveClicked = false;
                            document.getElementById("Savetatbtn").innerHTML = btn;
                            document.getElementById("Savetatbtn").disabled = false;
                            // location.reload();
                        },
                        function(response) {
                            $scope.SaveClicked = false;
                            document.getElementById("Savetatbtn").innerHTML = btn;
                            document.getElementById("Savetatbtn").disabled = false;
                            if (response.data.status != 401) {
                                Swal.fire("OOPS", response.data.message, "error");
                            } else {
                                window.location.replace(APIBasePath);
                            }
                        }
                    );
                }
            }

        };

        $scope.getTatDetails = function() {
            var url = APIRootPath + "api/GetTatDetails/" + $rootScope.UserUUID;
            $http.get(url, urlconfig).then(
                function(response) {
                    $scope.TatDetails = response.data.Tats;
                    if ($scope.TatDetails && $scope.TatDetails.length > 0) {
                        $scope.FrmTat.ProcessingTat = $scope.TatDetails[0].ProcessingTat || '';
                        $scope.FrmTat.ClosingTat = $scope.TatDetails[0].ClosingTat || '';
                    } else {
                        $scope.FrmTat.ProcessingTat = '';
                        $scope.FrmTat.ClosingTat = '';
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
        $scope.getTatDetails();
    });
</script>

</html>