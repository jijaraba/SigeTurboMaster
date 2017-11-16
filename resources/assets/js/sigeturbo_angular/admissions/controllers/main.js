'use strict';

/* Admissions Controllers */
angular.module('Admissions.controllers', [])
    .controller('DashboardController', ["$log", "$scope", function ($log, $scope) {

    }])
    .controller('DashboardAdmissionsEnrollmentsController', ["$log", "$scope", function ($log, $scope) {
        $scope.data = {
            labels: ['Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
            datasets: [
                {
                    label: '2014-2015',
                    backgroundColor: 'rgba(69,175,168,0.5)',
                    borderColor: 'rgba(69,175,168,1)',
                    borderWidth: 1,
                    data: [61, 101, 128, 22, 3, 7, 5, 36, 9, 5, 2, 3]
                },
                {
                    label: '2015-2016',
                    backgroundColor: 'rgba(79,193,233,0.5)',
                    borderColor: 'rgba(79,193,233,1)',
                    borderWidth: 1,
                    data: [42, 151, 119, 34, 8, 8, 3, 28, 15, 7, 13, 2]
                },
                {
                    label: '2016-2017', 
                    backgroundColor: 'rgba(63,138,191,0.5)',
                    borderColor: 'rgba(63,138,191,1)',
                    borderWidth: 1,
                    data: [63, 135, 197, 17, 10, 6, 7, 31, 19, 5, 4, 4]
                },
                {
                    label: '2017-2018', 
                    backgroundColor: 'rgba(255,205,86,0.5)',
                    borderColor: 'rgba(255,205,86,1)',
                    borderWidth: 1,
                    data: [318, 58, 67, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }
            ]
        };
        $scope.options = {
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
            legendCallback: function (chart) {
                var text = [];
                text.push('');
                for (var i = 0; i < chart.data.datasets.length; i++) {
                    text.push('');
                    if (chart.data.datasets[i].label) {
                        text.push(chart.data.datasets[i].label);
                    }
                    text.push('');
                }
                text.push('');

                return text.join("");
            },

            // Need to override these to give a nice default
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var result = [];
                        var datasetIndex;
                        for (datasetIndex = 0; datasetIndex < data.datasets.length; datasetIndex++) {
                            result.push(data.datasets[datasetIndex].label + ': ' + data.datasets[datasetIndex].data[tooltipItem.index]);
                        }
                        return result;
                    }
                }
            }
        };
        $scope.onChartClick = function (event) {
            console.log(event);
        };
    }])
    .controller('StudentsController', ["$log", "$scope", function ($log, $scope) {
        //Scope
        $scope.search = {};
        $scope.init = function (search) {
            $scope.search = search;
        };
        $scope.result = {};

    }])
    .controller('StudentsCreateController', ["$log", "$scope", 'User', function ($log, $scope, User) {
        $scope.student = {
            user: '',
            category: '13',
        }

        User.getLatestCode({}).$promise.then(
            function (result) {
                $scope.student.user = result.code;
            },
            function (error) {
                $log.error(error);
            }
        );
    }])
    .controller('StudentsUpdateController', ["$log", "$scope", 'User', function ($log, $scope, User) {

        //Scope
        $scope.items = {
            'family': false,
            'identificationdata': false,
            'healthdata': false,
            'schooldata': false,
            'origindata': false,
            'alumnusdata': false,
        };
        $scope.student = {
            user: '',
        };
        $scope.showFamilyForm = false;
        $scope.showEnrollmentForm = false;

        //Functions
        $scope.changeItem = function (item) {
            switch (item) {
                case 1:
                    $scope.items = {
                        'family': true,
                        'identificationdata': false,
                        'healthdata': false,
                        'schooldata': false,
                        'origindata': false,
                        'alumnusdata': false,
                        'responsibleparentdata': false,                        
                    };
                    break;
                case 2:
                    $scope.items = {
                        'family': false,
                        'identificationdata': true,
                        'healthdata': false,
                        'schooldata': false,
                        'origindata': false,
                        'alumnusdata': false,
                        'responsibleparentdata': false,                        
                    };
                    break;
                case 3:
                    $scope.items = {
                        'family': false,
                        'identificationdata': false,
                        'healthdata': true,
                        'schooldata': false,
                        'origindata': false,
                        'alumnusdata': false,
                        'responsibleparentdata': false,                        
                    };
                    break;
                case 4:
                    $scope.items = {
                        'family': false,
                        'identificationdata': false,
                        'healthdata': false,
                        'schooldata': true,
                        'origindata': false,
                        'alumnusdata': false,
                        'responsibleparentdata': false,                        
                    };
                    break;
                case 5:
                    $scope.items = {
                        'family': false,
                        'identificationdata': false,
                        'healthdata': false,
                        'schooldata': false,
                        'origindata': true,
                        'alumnusdata': false,
                        'responsibleparentdata': false,                        
                    };
                    break;
                case 6:
                    $scope.items = {
                        'family': false,
                        'identificationdata': false,
                        'healthdata': false,
                        'schooldata': false,
                        'origindata': false,
                        'alumnusdata': true,
                        'responsibleparentdata': false,
                    };
                    break;
                case 7:
                    $scope.items = {
                        'family': false,
                        'identificationdata': false,
                        'healthdata': false,
                        'schooldata': false,
                        'origindata': false,
                        'alumnusdata': false,
                        'responsibleparentdata': true,
                    };
                    break;
            }
        };

        //Init
        $scope.init = function (student, item) {
            $scope.showFamilyForm = true;
            $scope.showEnrollmentForm = true;
            $scope.changeItem(item)
        };


    }])
    .controller('TransportsController', ["$log", "$scope", "ngDialog","Route", "Routebyuser","Vehicle","Conveyor",  "SweetAlert", function ($log, $scope, ngDialog,Route, Routebyuser,Vehicle,Conveyor, SweetAlert) {
        //Scope
        $scope.routeactual = {};
        $scope.init = function (search) {
            $scope.search = search;
        };
        $scope.result = {};
        $scope.vehicles=[];
        $scope.conveyors=[];

        Vehicle.all('').$promise.then(
            function (vehicles) {
                $scope.vehicles = vehicles;
            },
            function (error) {
                $log.error(error);
            }
        );
        Conveyor.all('').$promise.then(
            function (conveyors) {
                $scope.conveyors = conveyors;
            },
            function (error) {
                $log.error(error);
            }
        );

        //Functions
        $scope.dialogsforms = function (item,message,/*Define si es edición*/$array) {
            $scope.item = item;
            $scope.message = message;
            $scope.objectform = ($array) ? $array : (item == 'user') ? $scope.routeactual : {};
            ngDialog.open({
                template: require('../directives/views/transports/dialog.html'),
                plain: true,
                controller: 'DialogsController',
                scope: $scope
            });
        };

        $scope.deleteuserbyroute = function($iduser,$index){
            Routebyuser.delete({
                    routebyuserId: $iduser
                }).$promise.then(
                function (result) {
                    SweetAlert.success("Excelente", result.message);
                    $scope.usersbyroute.splice($index, 1);
                },
                function (error) {
                    $log.error(error);
                    SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                }
            );
        }

    }])
    .controller('DialogsController', ['$scope', function ($scope) { }])
    .controller('PaymentsCreateController', ["$log", "$scope", function ($log, $scope) {}])
    .controller('QuantitaiverecoveryfinalareasController', ["$log", "$scope", 'SweetAlert', "Quantitativerecoveryfinalarea","$window", function ($log, $scope, SweetAlert, Quantitativerecoveryfinalarea,$window) {
        //Scope
        $scope.newrecovery = {};
        $scope.actual = {};
        $scope.showfornew = false;
        $scope.showforedit = false;
        $scope.show0230= false;
        $scope.show1290= false;

        //Init
        $scope.search = {};
        $scope.init = function (search) {
            $scope.search = search;
           // alert("En controlador : "+JSON.stringify(search));
        };
        $scope.result = {};

        //Functions
        $scope.changeItem = function (item,$arreglo) {
            $scope.actual = {};
            $scope.newrecovery = {};
            switch (item) {
                case 1:
                    if($arreglo.tablesource == 'qualitativeratingfinalareas'){
                        $scope.show0230= true;
                        $scope.show1290= false;
                    }else{
                        $scope.show1290= true;
                        $scope.show0230= false;
                    }
                    $scope.showfornew = true;
                    break;
                case 2:
                    if($arreglo.idquantitativerecoveryfinalarea){
                        $scope.show1290= true;
                        $scope.show0230= false;
                        $scope.newrecovery.idquantitativerecoveryfinalarea =  $arreglo.idquantitativerecoveryfinalarea;
                        $scope.newrecovery.rating =  $arreglo.rating;
                    }
                    if($arreglo.idqualitativerecoveryfinalarea){
                        $scope.show0230= true;
                        $scope.show1290= false;
                        $scope.newrecovery.idqualitativerecoveryfinalarea =  $arreglo.idqualitativerecoveryfinalarea;
                        $scope.newrecovery.idassessment =  $arreglo.idassessment;
                    }
                    $scope.newrecovery.idyear =  $arreglo.idyear;
                    $scope.newrecovery.idteacher =  $arreglo.idteacher;
                    $scope.newrecovery.act =  $arreglo.act;
                    $scope.newrecovery.observation =  $arreglo.observation;
                    $scope.newrecovery.recovery_at =  $arreglo.recovery_at;
                    $scope.showforedit = true;
                break;
            }
            $scope.newrecovery.idprovenance =  $arreglo.idprovenance;
            $scope.newrecovery.idgroup =  $arreglo.idgroup;
            $scope.newrecovery.idarea =  $arreglo.idarea;
            $scope.newrecovery.iduser =  $arreglo.iduser;
        };

        $scope.clearform = function () {
            $scope.newrecovery = {
                idyear: '',
                idgroup: '',
                idarea: '',
                iduser: '',
                rating:'',
                act: '',
                observation:'',
                recovery_at:''
            };
        };

        $scope.insert = function () {
            Quantitativerecoveryfinalarea.save({
                    'idyear': $scope.newrecovery.idyear,
                    'idgroup': $scope.newrecovery.idgroup,
                    'idprovenance': $scope.newrecovery.idprovenance,
                    'idarea': $scope.newrecovery.idarea,
                    'iduser': $scope.newrecovery.iduser,
                    'rating': $scope.newrecovery.rating,
                    'act': $scope.newrecovery.act,
                    'observation': $scope.newrecovery.observation,
                    'recovery_at': $scope.newrecovery.recovery_at
                }).$promise.then(
                    function (result) {
                        SweetAlert.success("Excelente", result.message);
                        $scope.showfornew = false;
                        $scope.clearform();
                        $window.location.href = "/admissions/quantitativerecoveryfinalareas?search="+encodeURIComponent(JSON.stringify($scope.search)).replace(/[!'()]/g, escape).replace(/\*/g, "%2A")+"&page="+$scope.search.page
                    },
                    function (error) {
                        $log.error(error);
                        SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                    }
                );
        };

        $scope.save = function () {
            Quantitativerecoveryfinalarea.update({
                    'idquantitativerecoveryfinalarea': $scope.actual.idquantitativerecoveryfinalarea,
                    'idyear': $scope.newrecovery.idyear,
                    'idgroup': $scope.newrecovery.idgroup,
                    'idprovenance': $scope.newrecovery.idprovenance,
                    'idarea': $scope.newrecovery.idarea,
                    'iduser': $scope.newrecovery.iduser,
                    'rating': $scope.newrecovery.rating,
                    'act': $scope.newrecovery.act,
                    'observation': $scope.newrecovery.observation,
                    'recovery_at': $scope.newrecovery.recovery_at
                }).$promise.then(
                    function (result) {
                        SweetAlert.success("Excelente", result.message);
                        $scope.showforedit = false;
                        $scope.clearform();
                    },
                    function (error) {
                        $log.error(error);
                        SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                    }
                );
        };
    }])
    .controller('FamiliesAssignController', ["$log", "$scope", function ($log, $scope) {
        //Scope
        $scope.family = {}
        $scope.family_name = ''
        $scope.init = function (family) {
            $scope.family_name = family;
        };
    }]);
