'use strict';

/* Dashboard Controllers */
angular.module('Dashboard.controllers', [])
    .controller('DashboardController', [function () {

    }])
    .controller('DashboardTeacherController', ['$log', '$scope', 'Attendance', function ($log, $scope, Attendance) {
        //Scope Data
        $scope.data = {
            labels: [],
            datasets: [
                {
                    label: '2017-2018',
                    backgroundColor: 'rgba(79,193,233,0.5)',
                    borderColor: 'rgba(79,193,233,1)',
                    borderWidth: 1,
                    pointBackgroundColor: 'rgba(79,193,233,1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(79,193,233,1)',
                    data: []
                }]
        };

        Attendance.getAttendancesAmountByDate({year: 2017}).$promise.then(
            function (attendances) {
                angular.forEach(attendances, function (attendance) {
                    $scope.data.labels.push(attendance.date);
                    $scope.data.datasets[0].data.push(attendance.amount);
                });
            }
        );

        $scope.options = { 
            responsive: true,
            elements: {
                point: {
                    radius: 2
                }
            },
            scales: {
                xAxes: [{
                    display: false,
                    stacked: false
                }],
                yAxes: [{
                    display: false
                }]
            },
            showLines: true,
            legend: {
                display: true,
                boxWidth: 20
            },
        };

    }])
    .controller('ConsentsController', ['$scope', '$log', 'ngDialog','Consenttype', function ($scope, $log,ngDialog,Consenttype) {
        $scope.registry = {
            send : false
        };
        $scope.close = function($param){
            if ($param){
                ngDialog.close() ;
                window.location = '/users/consent';
            } 
        };
        Consenttype.all({}).$promise.then(
            function (consenttypes) {
                $scope.consenttypes = consenttypes;
            },
            function (error) {
                $log.error(error);
            }
        );

        //Functions
        $scope.dialogsforms = function ($object) {
            $scope.isvalid = false;
            ////$scope.message = ($object.idconsent) ? "Editar consentimiento" : "Ingresar consetimiento";
            if($object.idconsent){
                $scope.message = 'Editar consentimiento';
                $scope.registry = $object;
                //var $view = '../directives/views/partials/consents/form.html';
            }else{
                $scope.registry = {};
                $scope.registry = {
                    send : false,
                    iduser : $object.iduser
                };
                $scope.message = 'Ingresar consetimiento';
                //var $view = '../directives/views/partials/consents/form.html';
            }
            ngDialog.open({
                template: require('../directives/views/partials/consents/form.html'),
                plain: true,
                scope: $scope,
                controller: 'ConsentsformController'
            });
        };
    }])
    .controller('ConsentsformController', ['$scope',function ($scope) {
        $scope.SaveConsent = function () {
            if (!$scope.registry.idconsent) {
                //Insert Group Director
                $scope.registry.send = $scope.isvalid;
            }
            else {
                $scope.registry.send = $scope.isvalid;
            }
        };
        
    }]);