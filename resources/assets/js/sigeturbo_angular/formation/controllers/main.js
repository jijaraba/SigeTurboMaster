/* eslint-disable no-undef */
'use strict';
/* Formation Controllers */
angular.module('Formation.controllers', [])
    .controller('DashboardController', ['$scope', '$log', 'Monitoring', 'Year', function ($scope, $log, Monitoring, Year) {
        $scope.academic = [];
        $scope.performances = [];

        $scope.data = {
            labels: [],
            datasets: [
                {
                    data: [],
                    backgroundColor: []
                }]
        };

        $scope.selectYear = function (year) {
            $scope.data = {
                labels: [],
                datasets: [
                    {
                        data: [],
                        backgroundColor: []
                    }]
            };
            $scope.globalPerformances(year);
        };
        Year.query().$promise.then(
            function (years) {
                $scope.years = years;
                Year.getCurrentYear().$promise.then(
                    function (year) {
                        $scope.academic.year = year.idyear;
                        $scope.globalPerformances($scope.academic.year);
                        //Verified Pendings 

                        //TO-DO
                        /*Indicator.getIndicatorsPendingByTeacher().$promise.then(
                            function (pendings) {
                                if (pendings.length > 0) {
                                    $scope.pendings = pendings;
                                    ngDialog.open({
                                        template: require('../directives/views/partials/indicators/indicatorpending.html'),
                                        plain: true,
                                        scope: $scope
                                    });
                                }
                            },
                            function (error) {
                                $log.error(error);
                            }
                        );*/
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            },
            function (error) {
                $log.info(error);
            }
        );

        $scope.globalPerformances = function (year) {

            if (year !== undefined) {
                //Global Performances
                $scope.performances = Monitoring.getGlobalPerformances({year: year});
                $scope.total = 0;
                $scope.DP = 0;
                $scope.DB = 0;
                $scope.DA = 0;
                $scope.DS = 0;
                $scope.performances.$promise.then(
                    function (performances) {
                        angular.forEach(performances, function (performance) {
                            $scope.total = $scope.total + performance.value;
                            switch (performance.label) {
                            case 'DP':
                                $scope.DP = performance.value;
                                $scope.data.labels.push('DP');
                                $scope.data.datasets[0].data.push(performance.value);
                                $scope.data.datasets[0].backgroundColor.push(performance.color);
                                break;
                            case 'DB':
                                $scope.DB = performance.value;
                                $scope.data.labels.push('DP');
                                $scope.data.datasets[0].data.push(performance.value);
                                $scope.data.datasets[0].backgroundColor.push(performance.color);
                                break;
                            case 'DA':
                                $scope.DA = performance.value;
                                $scope.data.labels.push('DP');
                                $scope.data.datasets[0].data.push(performance.value);
                                $scope.data.datasets[0].backgroundColor.push(performance.color);
                                break;
                            case 'DS':
                                $scope.DS = performance.value;
                                $scope.data.labels.push('DP');
                                $scope.data.datasets[0].data.push(performance.value);
                                $scope.data.datasets[0].backgroundColor.push(performance.color);
                                break;
                            }
                        });
                    }
                );
            }
        };

        $scope.options = {
            responsive: true,
            legend: {
                display: false,
                boxWidth: 20
            },
        };

    }])
    .controller('IndicatorController', ['$scope', function ($scope) {
        $scope.message = 'Indicators';
    }])
    .controller('MonitoringtypeController', ['$scope', function ($scope) {
        $scope.message = 'Monitoringtype';
    }])
    .controller('MonitoringController', ['$scope', 'ASSETS_SERVER', function ($scope, ASSETS_SERVER) {
        $scope.showGrid = false;
        $scope.assets = ASSETS_SERVER;
    }])
    .controller('AttendanceController', ['$scope', function ($scope) {
        $scope.message = 'Attendance';
    }])
    .controller('AttendanceShowController', ['$scope', function ($scope) {
        $scope.message = 'Attendance';
    }])
    .controller('ObservatorController', ['$scope', function ($scope) {
        $scope.message = 'Observator';
    }])
    .controller('VoteController', ['$scope', function () {

    }])
    .controller('ReportsController', ['$scope', '$log', 'Monitoring', function ($scope, $log, Monitoring) {
        $scope.search = {};
        $scope.elementsearch = '';
        $scope.resumen = {};

        $scope.init = function (search) {
            $scope.search = search;
            Monitoring.getMonitoringsPendingsByUser({
                year: $scope.search.idyear,
                period: $scope.search.idperiod
            }).$promise.then(
                function (registries) {
                    $scope.registries = registries;
                },
                function (error) {
                    $log.error(error);
                }
            );

        };
    }])
    .controller('ContractController', ['$scope', function ($scope) {
        $scope.message = 'Contracts';
        $scope.search = {};
        $scope.init = function (search) {
            $scope.search = search;
        };
    }])
    .controller('ObservatorNewController', ['$scope', '$log', 'SweetAlert', 'Observer', function ($scope, $log, SweetAlert, Observer) {

        $scope.isDisabled = true;
        $scope.observerSave = false;

        $scope.observer = {
            'type': 3,
            'tags': 'General'
        };

        $scope.$watch('observer.type', function (newType, oldType) {
            if (newType !== oldType) {
                if (newType !== null && $scope.observer.observer !== '') {
                    $scope.isDisabled = false;
                } else {
                    $scope.isDisabled = true;
                }
            }
        });

        $scope.$watch('observer.observer', function (newObserver, oldObserver) {
            if (newObserver !== oldObserver) {
                if (newObserver !== '' && $scope.observer.type !== null) {
                    $scope.isDisabled = false;
                } else {
                    $scope.isDisabled = true;
                }
            }
        });

        $scope.observationSave = function () {
            if (!$scope.observerSave) {
                //Save Observer
                Observer.save({
                    year: $scope.observer.year,
                    group: $scope.observer.group,
                    student: $scope.observer.student,
                    type: $scope.observer.type,
                    observer: $scope.observer.observer,
                    tags: $scope.observer.tags
                }).$promise.then(
                    function (observer) {
                        $scope.observerSave = true;
                        $scope.observer.idobserver = observer.observer.idobserver;
                        SweetAlert.success('Excelente', observer.message);
                    },
                    function (error) {
                        $log.error(error);
                        $scope.observerSave = false;
                        SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                    }
                );
            }
            else {
                //Update Observer
                Observer.update({
                    idobserver: $scope.observer.idobserver,
                    year: $scope.observer.year,
                    group: $scope.observer.group,
                    student: $scope.observer.student,
                    type: $scope.observer.type,
                    observer: $scope.observer.observer,
                    tags: $scope.observer.tags
                }).$promise.then(
                    function (observer) {
                        $scope.observerSave = true;
                        SweetAlert.success('Excelente', observer.message);
                    },
                    function (error) {
                        $log.error(error);
                        $scope.observerSave = true;
                        SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                    }
                );
            }
        };

    }])
    .controller('ObservatorListController', ['$scope', function ($scope) {

        $scope.order = {
            item: 'date',
            reverse: true
        };


    }])
    .controller('AcademicManagementController', ['$scope', 'ASSETS_SERVER', '$log', 'ngDialog', 'Year', 'GroupDirector', function ($scope, ASSETS_SERVER, $log, ngDialog, Year, GroupDirector) {
        $scope.assets = ASSETS_SERVER;
        // Get years
        Year.query().$promise.then(
            function (years) {
                $scope.years = years;
            },
            function (error) {
                $log.error(error);
            }
        );
        $scope.edit = function (registry, $controller) {
            $scope.registry = angular.copy(registry);
            switch ($controller) {
            case 'GroupDirectorController':
                ngDialog.open({
                    template: require('../directives/views/partials/groupdirector/formgroupdirector.html'),
                    plain: true,
                    controller: $controller,
                    scope: $scope
                });
                break;
            case 'AreaManagerController':
                ngDialog.open({
                    template: require('../directives/views/partials/areamanager/formareamanager.html'),
                    plain: true,
                    controller: $controller,
                    scope: $scope
                });
                break;
            case 'AcademicController':
                ngDialog.open({
                    template: require('../directives/views/partials/academic/formacademic.html'),
                    plain: true,
                    controller: $controller,
                    scope: $scope
                });
                break;
            case 'MonitoringcategorybyyearController':
                ngDialog.open({
                    template: require('../directives/views/partials/monitoringcategorybyyear/formmonitoringcategorybyyear.html'),
                    plain: true,
                    controller: $controller,
                    scope: $scope
                });
                break;
            }
        };

        $scope.delete = function (idgroupdirector) {
            //Envío de Parámetros
            GroupDirector.remove({
                groupdirectorId: idgroupdirector,
            }).$promise.then(
                function () {
                    angular.element(document.getElementById('Groupdirectorlist')).scope().$$childTail.$parent.searching();
                },
                function () {

                }
            );
        };

        $scope.form = function (registry, $controller) {
            $scope.registry = (registry) ? registry : {};
            switch ($controller) {
            case 'GroupDirectorController':
                ngDialog.open({
                    template: require('../directives/views/partials/groupdirector/formgroupdirector.html'),
                    plain: true,
                    controller: $controller,
                    scope: $scope
                });
                break;
            case 'AreaManagerController':
                ngDialog.open({
                    template: require('../directives/views/partials/areamanager/formareamanager.html'),
                    plain: true,
                    controller: $controller,
                    scope: $scope
                });
                break;
            case 'AcademicController':
                ngDialog.open({
                    template: require('../directives/views/partials/academic/formacademic.html'),
                    plain: true,
                    controller: $controller,
                    scope: $scope
                });
                break;
            case 'MonitoringcategorybyyearController':
                ngDialog.open({
                    template: require('../directives/views/partials/monitoringcategorybyyear/formmonitoringcategorybyyear.html'),
                    plain: true,
                    controller: $controller,
                    scope: $scope
                });
                break;
            }
        };
    }])
    .controller('GroupDirectorController', ['$scope', '$log', 'Group', 'GroupDirector', function ($scope, $log, Group, GroupDirector) {
        $scope.message = 'Director de Grupo';
        //Get Groups
        Group.all('').$promise.then(
            function (groups) {
                $scope.groups = groups;
            },
            function (error) {
                $log.error(error);
            }
        );
        $scope.SaveGroupDirector = function () {
            if (!$scope.registry.idgroupdirector) {
                //Insert Group Director
                GroupDirector.save({
                    idyear: $scope.registry.idyear,
                    idgroup: $scope.registry.idgroup,
                    iduser: $scope.registry.iduser
                }).$promise.then(
                    function () {
                        angular.element(document.getElementById('Groupdirectorlist')).scope().$$childTail.$parent.searching();
                        angular.element(document.getElementById('GroupDirectorController')).scope().$$childTail.$parent.closeDialog();
                    },
                    function () {
                        alert('No se puede ingresar');
                    }
                );
            }
            else {
                //Update Group Director
                GroupDirector.update({
                    idgroupdirector: $scope.registry.idgroupdirector,
                    idyear: $scope.registry.idyear,
                    idgroup: $scope.registry.idgroup,
                    iduser: $scope.registry.iduser
                }).$promise.then(
                    function () {
                        angular.element(document.getElementById('Groupdirectorlist')).scope().$$childTail.$parent.searching();
                        angular.element(document.getElementById('GroupDirectorController')).scope().$$childTail.$parent.closeDialog();
                    },
                    function () {
                        alert('No se puede ingresar');
                    }
                );
            }
        };
    }])
    .controller('AreasubjectandnivelController', ['$scope', '$log', 'Subject', function ($scope, $log, Subject) {
        $scope.message = 'Subjects';
        //Get Areas Subjects And Nivels
        Subject.getSubjectWithAreasAndNivels('').$promise.then(
            function (subjectwithareasandnivels) {
                $scope.subjectwithareasandnivels = subjectwithareasandnivels;
            },
            function (error) {
                $log.error(error);
            }
        );
    }])
    .controller('AreaManagerController', ['$scope', '$log', 'Area', 'AreaManager', function ($scope, $log, Area, AreaManager) {
        $scope.message = 'Jefe de Area';
        $scope.areamanagers = {};
        //Get Groups
        Area.all('').$promise.then(
            function (areas) {
                $scope.areas = areas;
            },
            function (error) {
                $log.error(error);
            }
        );

        $scope.searchingcontor = function () {
            AreaManager.getAreamanagersByYear({
                yearId: angular.element(document.getElementById('academic')).scope().academic.year,
                areaId: angular.element(document.getElementById('academic')).scope().academic.area
            }).$promise.then(
                function (areamanagers) {
                    $scope.areamanagers = areamanagers;
                },
                function (error) {
                    $log.error(error);
                }
            );
        };


        $scope.delete = function (idareaManager) {
            //Envío de Parámetros
            AreaManager.remove({
                areamanagerId: idareaManager,
            }).$promise.then(
                function () {
                    angular.element(document.getElementById('AreaManagerController')).scope().$$childTail.$parent.searchingcontor();
                },
                function () {
                    alert('Eliminación' + JSON.stringify());
                }
            );
        };

        $scope.SaveAreamanager = function () {
            //$scope.registry = (registry) ? registry : {};
            if (!$scope.registry.idareamanager) {
                //Insert Area Manager
                AreaManager.save({
                    idyear: $scope.registry.idyear,
                    idarea: $scope.registry.idarea,
                    iduser: $scope.registry.iduser
                }).$promise.then(
                    function () {
                        angular.element(document.getElementById('AreaManagerController')).scope().$$childTail.$parent.searchingcontor();
                        angular.element(document.getElementById('AreaManagerController')).scope().$$childTail.$parent.closeDialog();
                    },
                    function () {
                        alert('No se puede actualizar');
                    }
                );
            }
            else {
                //Update Area Manager
                AreaManager.update({
                    idareamanager: $scope.registry.idareamanager,
                    idyear: $scope.registry.idyear,
                    idarea: $scope.registry.idarea,
                    iduser: $scope.registry.iduser
                }).$promise.then(
                    function () {
                        angular.element(document.getElementById('AreaManagerController')).scope().$$childTail.$parent.searchingcontor();
                        angular.element(document.getElementById('AreaManagerController')).scope().$$childTail.$parent.closeDialog();
                    },
                    function () {
                        alert('No se puede ingresar');
                    }
                );
            }
        };
    }])
    .controller('AcademicController', ['$scope', '$log', 'Period', 'Calendar', 'Academic', 'Academicrequest', function ($scope, $log, Period, Calendar, Academic, Academicrequest) {
        $scope.message = 'Calendario Académico';
        $scope.academics = {};
        //Get Periods
        Period.all('').$promise.then(
            function (periods) {
                $scope.periods = periods;
            },
            function (error) {
                $log.error(error);
            }
        );

        //Get Calendars
        Calendar.all('').$promise.then(
            function (calendars) {
                $scope.calendars = calendars;
            },
            function (error) {
                $log.error(error);
            }
        );

        $scope.searchingcontor = function () {
            Academic.getAcademicsByYear({
                yearId: angular.element(document.getElementById('academic')).scope().academic.year,
                idperiod: angular.element(document.getElementById('academic')).scope().academic.period
            }).$promise.then(
                function (academics) {
                    $scope.academics = academics;
                },
                function (error) {
                    $log.error(error);
                }
            );
        };


        $scope.delete = function (idacademic) {
            //Envío de Parámetros
            Academicrequest.remove({
                academicId: idacademic,
            }).$promise.then(
                function () {
                    angular.element(document.getElementById('AcademicController')).scope().$$childTail.$parent.searchingcontor();
                },
                function () {
                    alert('Eliminación' + JSON.stringify());
                }
            );
        };

        $scope.SaveAcademic = function () {
            //$scope.registry = (registry) ? registry : {};
            if (!$scope.registry.idacademic) {
                //Insert Area Manager
                Academicrequest.save({
                    idyear: $scope.registry.idyear,
                    idperiod: $scope.registry.idperiod,
                    idcalendar: $scope.registry.idcalendar,
                    starts: $scope.registry.starts,
                    ends: $scope.registry.ends,
                    rating: $scope.registry.rating,
                    review: $scope.registry.review,
                    print: $scope.registry.print
                }).$promise.then(
                    function () {
                        angular.element(document.getElementById('AcademicController')).scope().$$childTail.$parent.searchingcontor();
                        angular.element(document.getElementById('AcademicController')).scope().$$childTail.$parent.closeDialog();
                    },
                    function () {
                        alert('No se puede actualizar');
                    }
                );
            }
            else {
                //Update Area Manager
                Academicrequest.update({
                    idacademic: $scope.registry.idacademic,
                    idyear: $scope.registry.idyear,
                    idperiod: $scope.registry.idperiod,
                    idcalendar: $scope.registry.idcalendar,
                    starts: $scope.registry.starts,
                    ends: $scope.registry.ends,
                    rating: $scope.registry.rating,
                    review: $scope.registry.review,
                    print: $scope.registry.print
                }).$promise.then(
                    function () {
                        angular.element(document.getElementById('AcademicController')).scope().$$childTail.$parent.searchingcontor();
                        angular.element(document.getElementById('AcademicController')).scope().$$childTail.$parent.closeDialog();
                    },
                    function () {
                        alert('No se puede ingresar');
                    }
                );
            }
        };
    }])
    .controller('MonitoringcategorybyyearController', ['$scope', '$log', 'Subject', 'Monitoringcategory', 'Monitoringcategorybyyearrequest', function ($scope, $log, Subject, Monitoringcategory, Monitoringcategorybyyearrequest) {
        $scope.message = 'Categorías de Seguimiento';
        $scope.monitoringcategorybyyears = {};

        //Get Subjects
        Subject.all('').$promise.then(
            function (subjects) {
                $scope.subjects = subjects;
            },
            function (error) {
                $log.error(error);
            }
        );

        //Get Subjects
        Monitoringcategory.all('').$promise.then(
            function (monitoringcategories) {
                $scope.monitoringcategories = monitoringcategories;
            },
            function (error) {
                $log.error(error);
            }
        );

        $scope.searchingcontor = function () {
            Monitoringcategorybyyearrequest.getMonitoringcategoriesByYear({
                yearId: angular.element(document.getElementById('academic')).scope().academic.year,
                idsubject: angular.element(document.getElementById('academic')).scope().academic.subject
            }).$promise.then(
                function (monitoringcategorybyyears) {
                    $scope.monitoringcategorybyyears = monitoringcategorybyyears;
                },
                function (error) {
                    $log.error(error);
                }
            );
        };


        $scope.delete = function (idmonitoringcategorybyyear) {
            //Envío de Parámetros
            Monitoringcategorybyyearrequest.remove({
                monitoringcategorybyyearId: idmonitoringcategorybyyear,
            }).$promise.then(
                function () {
                    angular.element(document.getElementById('MonitoringcategorybyyearController')).scope().$$childTail.$parent.searchingcontor();
                },
                function () {
                }
            );
        };

        $scope.SaveMonitoringcategorybyyear = function () {
            if (!$scope.registry.idmonitoringcategorybyyear) {
                //Insert Area Manager
                Monitoringcategorybyyearrequest.save({
                    idyear: $scope.registry.idyear,
                    idsubject: $scope.registry.idsubject,
                    idmonitoringcategory: $scope.registry.idmonitoringcategory,
                    percent: $scope.registry.percent
                }).$promise.then(
                    function () {
                        angular.element(document.getElementById('MonitoringcategorybyyearController')).scope().$$childTail.$parent.searchingcontor();
                        angular.element(document.getElementById('MonitoringcategorybyyearController')).scope().$$childTail.$parent.closeDialog();
                    },
                    function () {
                        alert('No se puede ingresar');
                    }
                );
            }
            else {
                //Update Area Manager
                Monitoringcategorybyyearrequest.update({
                    idmonitoringcategorybyyear: $scope.registry.idmonitoringcategorybyyear,
                    idyear: $scope.registry.idyear,
                    idsubject: $scope.registry.idsubject,
                    idmonitoringcategory: $scope.registry.idmonitoringcategory,
                    percent: $scope.registry.percent
                }).$promise.then(
                    function () {
                        angular.element(document.getElementById('MonitoringcategorybyyearController')).scope().$$childTail.$parent.searchingcontor();
                        angular.element(document.getElementById('MonitoringcategorybyyearController')).scope().$$childTail.$parent.closeDialog();
                    },
                    function () {
                        alert('No se puede actualizar');
                    }
                );
            }
        };
    }])
    .controller('PartialController', ['$scope', 'ASSETS_SERVER', '$log', 'ngDialog', function ($scope, ASSETS_SERVER, $log, ngDialog) {
        $scope.message = 'Partial';
        $scope.assets = ASSETS_SERVER;
        $scope.select = function (user) {
            $scope.user = user;
            ngDialog.open({
                template: require('../directives/views/partials/partial/new.html'),
                plain: true,
                controller: 'PartialNewController',
                scope: $scope
            });
        };
    }])
    .controller('PartialNewController', ['$scope', '$log', 'ASSETS_SERVER', 'SweetAlert', 'Partial', function ($scope, $log, ASSETS_SERVER, SweetAlert, Partial) {
        $scope.message = 'Partial New';
        $scope.assets = ASSETS_SERVER;
        $scope.partialSave = false;
        $scope.partial = [];
        if ($scope.user.partials.length > 0) {
            Partial.get({partialId: $scope.user.partials[0].idpartialrating}).$promise.then(
                function (partial) {
                    $scope.partial = partial;
                    $scope.partialSave = true;
                },
                function (error) {
                    $log.error(error);
                    $scope.partialSave = false;
                }
            );
        }
        //Save partial
        $scope.partialRegister = function () {
            if (!$scope.partialSave) {
                Partial.save({
                    'year': $scope.academic.year,
                    'period': $scope.academic.period,
                    'group': $scope.academic.group,
                    'subject': $scope.academic.subject,
                    'nivel': $scope.academic.nivel,
                    'user': $scope.user.iduser,
                    'rating': $scope.partial.rating,
                    'description': $scope.partial.description
                }).$promise.then(
                    function (result) {
                        $scope.partialSave = true;
                        SweetAlert.success('Excelente', result.message);
                        $scope.partial.idpartialrating = result.last_insert_id;
                    },
                    function (error) {
                        $scope.partialSave = false;
                        $log.error(error);
                        SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                    }
                );
            } else {
                Partial.update({
                    'idpartial': $scope.partial.idpartialrating,
                    'year': $scope.academic.year,
                    'period': $scope.academic.period,
                    'group': $scope.academic.group,
                    'subject': $scope.academic.subject,
                    'nivel': $scope.academic.nivel,
                    'user': $scope.user.iduser,
                    'rating': $scope.partial.rating,
                    'description': $scope.partial.description
                }).$promise.then(
                    function (result) {
                        $scope.partialSave = true;
                        SweetAlert.success('Excelente', result.message);
                    },
                    function (error) {
                        $scope.partialSave = false;
                        $log.error(error);
                        SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                    }
                );
            }
        };
    }])
    .controller('DescriptivereportController', ['$scope', 'ASSETS_SERVER', '$log', 'ngDialog', function ($scope, ASSETS_SERVER, $log, ngDialog) {
        $scope.message = 'Descriptive Report';
        $scope.assets = ASSETS_SERVER;
        $scope.select = function (user) {
            $scope.user = user;
            ngDialog.open({
                template: require('../directives/views/partials/descriptivereport/new.html'),
                plain: true,
                controller: 'DescriptivereportNewController',
                className: 'ngdialog-theme-default dialogwidth600',
                scope: $scope
            });
        };
    }])
    .controller('DescriptivereportNewController', ['$scope', '$log', 'ASSETS_SERVER', 'SweetAlert', 'Descriptivereport', function ($scope, $log, ASSETS_SERVER, SweetAlert, Descriptivereport) {
        $scope.message = 'Descriptive Report New';
        $scope.assets = ASSETS_SERVER;
        $scope.descriptivereportSave = false;
        $scope.descriptivereport = [];
        if ($scope.user.descriptivereports.length > 0) {
            Descriptivereport.get({descriptivereportId: $scope.user.descriptivereports[0].iddescriptivereport}).$promise.then(
                function (descriptivereport) {
                    $scope.descriptivereport = descriptivereport;
                    $scope.descriptivereportSave = true;
                },
                function (error) {
                    $log.error(error);
                    $scope.descriptivereportSave = false;
                }
            );
        }
        //Save partial
        $scope.descriptivereportRegister = function () {
            if (!$scope.descriptivereportSave) {
                Descriptivereport.save({
                    'year': $scope.academic.year,
                    'period': $scope.academic.period,
                    'group': $scope.academic.group,
                    'subject': $scope.academic.subject,
                    'nivel': $scope.academic.nivel,
                    'user': $scope.user.iduser,
                    'description': $scope.descriptivereport.description
                }).$promise.then(
                    function (result) {
                        $scope.descriptivereportSave = true;
                        SweetAlert.success('Excelente', result.message);
                        $scope.descriptivereport.iddescriptivereport = result.last_insert_id;
                    },
                    function (error) {
                        $scope.descriptivereportSave = false;
                        $log.error(error);
                        SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                    }
                );
            } else {
                Descriptivereport.update({
                    'iddescriptivereport': $scope.descriptivereport.iddescriptivereport,
                    'year': $scope.academic.year,
                    'period': $scope.academic.period,
                    'group': $scope.academic.group,
                    'subject': $scope.academic.subject,
                    'nivel': $scope.academic.nivel,
                    'user': $scope.user.iduser,
                    'description': $scope.descriptivereport.description
                }).$promise.then(
                    function (result) {
                        $scope.descriptivereportSave = true;
                        SweetAlert.success('Excelente', result.message);
                    },
                    function (error) {
                        $scope.descriptivereportSave = false;
                        $log.error(error);
                        SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                    }
                );
            }
        };
    }])
    .controller('TaskController', [function () {

    }])
    .controller('TaskNewController', ['$scope', '$log', 'SweetAlert', 'Tasktype', 'Task', function ($scope, $log, SweetAlert, Tasktype, Task) {
        $scope.message = 'Task New';
        $scope.task = {
            type: 1,
            starts: new moment().format('YYYY-MM-DD'),
            ends: new moment().format('YYYY-MM-DD')
        };
        $scope.academic = [];
        $scope.taskSave = false;
        //TaskType
        Tasktype.query({}).$promise.then(
            function (tasktypes) {
                $scope.tasktypes = tasktypes;
            },
            function (error) {
                $log.error(error);
            }
        );
        //Functions
        $scope.Insert = function () {
            if (!$scope.taskSave) {
                Task.save({
                    'year': $scope.academic.year,
                    'period': $scope.academic.period,
                    'group': $scope.academic.group,
                    'subject': $scope.academic.subject,
                    'nivel': $scope.academic.nivel,
                    'type': $scope.task.type,
                    'name': $scope.task.name,
                    'description': $scope.task.description,
                    'starts': $scope.task.starts,
                    'ends': $scope.task.ends
                }).$promise.then(
                    function (result) {
                        $scope.taskSave = true;
                        SweetAlert.success('Excelente', result.message);
                        $scope.task.idtask = result.task.idtask;
                        document.taskForm.name.focus();
                    },
                    function (error) {
                        $scope.taskSave = false;
                        $log.error(error);
                        SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                    }
                );
            } else {
                Task.update({
                    'idtask': $scope.task.idtask,
                    'year': $scope.academic.year,
                    'period': $scope.academic.period,
                    'group': $scope.academic.group,
                    'subject': $scope.academic.subject,
                    'nivel': $scope.academic.nivel,
                    'type': $scope.task.type,
                    'name': $scope.task.name,
                    'description': $scope.task.description,
                    'starts': $scope.task.starts,
                    'ends': $scope.task.ends,
                }).$promise.then(
                    function (result) {
                        $scope.taskSave = true;
                        SweetAlert.success('Excelente', result.message);
                    },
                    function (error) {
                        $scope.taskSave = false;
                        $log.error(error);
                        SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                    }
                );
            }
        };
    }])
    .controller('TaskUpdateController', ['$scope', '$log', 'sigeTurboUpload', 'ASSETS_SERVER', 'SweetAlert', 'Tasktype', 'Task', function ($scope, $log, sigeTurboUpload, ASSETS_SERVER, SweetAlert, Tasktype, Task) {
        $scope.message = 'Task Update';
        $scope.assets = ASSETS_SERVER;
        $scope.task = {
            status: 0
        };
        $scope.academic = [];
        $scope.taskSave = false;
        $scope.taskFiles = false;
        $scope.approvedResult = 'Aprobando ...';

        $scope.init = function (task) {

            $scope.taskID = task;

            //Find Task
            Task.get({'taskId': $scope.taskID}).$promise.then(
                function (task) {
                    $scope.task.year = task.idyear;
                    $scope.task.period = task.idperiod;
                    $scope.task.group = task.idgroup;
                    $scope.task.subject = task.idsubject;
                    $scope.task.nivel = task.idnivel;
                    $scope.task.idtask = task.idtask;
                    $scope.task.type = task.idtasktype;
                    $scope.task.name = task.name;
                    $scope.task.description = task.description;
                    $scope.task.starts = task.starts;
                    $scope.task.ends = task.ends;
                    $scope.task.status = task.status;
                    $scope.task.statusOld = task.status;
                    $scope.task.taskfiles = task.taskfiles;
                    if ($scope.task.taskfiles.length > 0) {
                        $scope.taskFiles = true;
                    }
                    $scope.taskSave = true;
                    if (task.status) {
                        $scope.approvedResult = 'Aprobada';
                    }
                },
                function (error) {
                    $log.error(error);
                    $scope.taskSave = false;
                }
            );

        };

        //TaskType
        Tasktype.query({}).$promise.then(
            function (tasktypes) {
                $scope.tasktypes = tasktypes;
            },
            function (error) {
                $log.error(error);
            }
        );
        //Functions
        $scope.Update = function () {
            Task.update({
                'idtask': $scope.task.idtask,
                'year': $scope.academic.year,
                'period': $scope.academic.period,
                'group': $scope.academic.group,
                'subject': $scope.academic.subject,
                'nivel': $scope.academic.nivel,
                'type': $scope.task.type,
                'name': $scope.task.name,
                'description': $scope.task.description,
                'starts': $scope.task.starts,
                'ends': $scope.task.ends,
            }).$promise.then(
                function (result) {
                    $scope.taskSave = true;
                    SweetAlert.success('Excelente', result.message);
                },
                function (error) {
                    $scope.taskSave = false;
                    $log.error(error);
                    SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                }
            );
        };
        $scope.delete = function ($index) {
            $scope.task.taskfiles[$index].deleted = false;
            $scope.task.taskfiles[$index].status = 0;
            sigeTurboUpload.deleteFile($scope.task.taskfiles[$index].file, '/deletetask/?table=taskfiles&id=' + $scope.task.taskfiles[$index].idtaskfile)
                .success(function () {
                    $scope.task.taskfiles[$index].deleted = true;
                    $scope.task.taskfiles[$index].status = 100;
                })
                .error(function () {
                    $scope.task.taskfiles[$index].deleted = false;
                    $scope.task.taskfiles[$index].status = -1;
                });
        };

        $scope.$watch('task.status', function (newStatus, oldStatus) {
            if (parseInt(newStatus) !== parseInt(oldStatus)) {
                if (parseInt(newStatus) == 1 && parseInt($scope.task.statusOld) !== 1) {
                    SweetAlert.swal({
                        title: '¿Está seguro?',
                        text: 'Una vez active la tarea quedará visible para los padres de familia y se activa el servicio de envío de correo',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#53BBB4',
                        confirmButtonText: 'Aprobar',
                        closeOnConfirm: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            Task.setApproved({task: $scope.task.idtask, group: $scope.task.group}).$promise.then(
                                function (data) {
                                    swal('¡Aprobada!', data.message, 'success');
                                    $scope.task.status = 1;
                                    $scope.approvedResult = 'Aprobada';
                                },
                                function () {
                                    swal.close();
                                }
                            );
                        }

                    });
                }
            }
        });

    }])
    .controller('StatisticsController', ['$scope', 'Statistics', function ($scope, Statistics) {
        $scope.message = 'Estadísticas';
        //Academic
        $scope.academic = {
            year: 2017,
            period: 1
        };
        //Global Performances
        $scope.performances = Statistics.getGlobalPerformances({
            year: $scope.academic.year,
            period: $scope.academic.period
        });
        //Scope Data
        $scope.data = {
            labels: [],
            datasets: [
                {
                    data: [],
                    backgroundColor: []
                }]
        };

        $scope.total = 0;
        $scope.performances.$promise.then(
            function (performances) {
                angular.forEach(performances, function (performance) {
                    $scope.total = $scope.total + performance.value;
                    switch (performance.label) {
                    case 'DP':
                        $scope.DP = performance.value;
                        $scope.data.labels.push('DP');
                        $scope.data.datasets[0].data.push(performance.value);
                        $scope.data.datasets[0].backgroundColor.push(performance.color);
                        break;
                    case 'DB':
                        $scope.DB = performance.value;
                        $scope.data.labels.push('DB');
                        $scope.data.datasets[0].data.push(performance.value);
                        $scope.data.datasets[0].backgroundColor.push(performance.color);
                        break;
                    case 'DA':
                        $scope.DA = performance.value;
                        $scope.data.labels.push('DA');
                        $scope.data.datasets[0].data.push(performance.value);
                        $scope.data.datasets[0].backgroundColor.push(performance.color);
                        break;
                    case 'DS':
                        $scope.DS = performance.value;
                        $scope.data.labels.push('DS');
                        $scope.data.datasets[0].data.push(performance.value);
                        $scope.data.datasets[0].backgroundColor.push(performance.color);
                        break;
                    }
                });
            }
        );
        //Searching New Year AND Period
        $scope.change = function (year, period) {
            //Scope Data
            $scope.data = {
                labels: [],
                datasets: [
                    {
                        data: [],
                        backgroundColor: []
                    }]
            };
            //Global Performances
            $scope.performances = Statistics.getGlobalPerformances({year: year, period: period});
            $scope.monitorings = {
                data: $scope.performances
            };
            $scope.total = 0;
            $scope.performances.$promise.then(
                function (performances) {
                    angular.forEach(performances, function (performance) {
                        $scope.total = $scope.total + performance.value;
                        switch (performance.label) {
                        case 'DP':
                            $scope.DP = performance.value;
                            $scope.data.labels.push('DP');
                            $scope.data.datasets[0].data.push(performance.value);
                            $scope.data.datasets[0].backgroundColor.push(performance.color);
                            break;
                        case 'DB':
                            $scope.DB = performance.value;
                            $scope.data.labels.push('DB');
                            $scope.data.datasets[0].data.push(performance.value);
                            $scope.data.datasets[0].backgroundColor.push(performance.color);
                            break;
                        case 'DA':
                            $scope.DA = performance.value;
                            $scope.data.labels.push('DA');
                            $scope.data.datasets[0].data.push(performance.value);
                            $scope.data.datasets[0].backgroundColor.push(performance.color);
                            break;
                        case 'DS':
                            $scope.DS = performance.value;
                            $scope.data.labels.push('DS');
                            $scope.data.datasets[0].data.push(performance.value);
                            $scope.data.datasets[0].backgroundColor.push(performance.color);
                            break;
                        }
                    });
                }
            );
        };

        $scope.options = {
            responsive: true,
            legend: {
                display: false,
                boxWidth: 20
            },
        };
    }])
    .controller('StatisticsGroupController', ['$scope', '$log', 'Statistics', function ($scope, $log, Statistics) {

        //Academic
        $scope.academic = {
            year: 2017,
            period: 1
        };

        $scope.groups = [];

        Statistics.getGlobalPerformancesByGroup({
            year: $scope.academic.year,
            period: $scope.academic.period
        }).$promise.then(
            function (groups) {
                angular.forEach(groups, function (group) {
                    //Scope Data
                    var data = {
                        group: group.name,
                        labels: [],
                        datasets: [
                            {
                                data: [],
                                backgroundColor: []
                            }]
                    };
                    angular.forEach(group.data, function (performance) {
                        switch (performance.label) {
                        case 'DP':
                            data.labels.push('DP');
                            data.datasets[0].data.push(performance.value);
                            data.datasets[0].backgroundColor.push(performance.color);
                            break;
                        case 'DB':
                            data.labels.push('DB');
                            data.datasets[0].data.push(performance.value);
                            data.datasets[0].backgroundColor.push(performance.color);
                            break;
                        case 'DA':
                            data.labels.push('DA');
                            data.datasets[0].data.push(performance.value);
                            data.datasets[0].backgroundColor.push(performance.color);
                            break;
                        case 'DS':
                            data.labels.push('DS');
                            data.datasets[0].data.push(performance.value);
                            data.datasets[0].backgroundColor.push(performance.color);
                            break;
                        }
                    });
                    $scope.groups.push(data);
                });

            },
            function (error) {
                $log.error(error);
            }
        );

        //Searching New Year AND Period
        $scope.change = function (year, period) {
            $scope.groups = [];
            Statistics.getGlobalPerformancesByGroup({
                year: year,
                period: period
            }).$promise.then(
                function (groups) {
                    angular.forEach(groups, function (group) {
                        //Scope Data
                        var data = {
                            group: group.name,
                            labels: [],
                            datasets: [
                                {
                                    data: [],
                                    backgroundColor: []
                                }]
                        };
                        angular.forEach(group.data, function (performance) {
                            switch (performance.label) {
                            case 'DP':
                                data.labels.push('DP');
                                data.datasets[0].data.push(performance.value);
                                data.datasets[0].backgroundColor.push(performance.color);
                                break;
                            case 'DB':
                                data.labels.push('DB');
                                data.datasets[0].data.push(performance.value);
                                data.datasets[0].backgroundColor.push(performance.color);
                                break;
                            case 'DA':
                                data.labels.push('DA');
                                data.datasets[0].data.push(performance.value);
                                data.datasets[0].backgroundColor.push(performance.color);
                                break;
                            case 'DS':
                                data.labels.push('DS');
                                data.datasets[0].data.push(performance.value);
                                data.datasets[0].backgroundColor.push(performance.color);
                                break;
                            }
                        });
                        $scope.groups.push(data);
                    });
                },
                function (error) {
                    $log.error(error);
                }
            );
        };

        $scope.options = {
            responsive: true,
            legend: {
                display: true,
                boxWidth: 20
            },
        };

    }])
    .controller('StatisticsSubjectController', ['$scope', '$log', 'Statistics', function ($scope, $log, Statistics) {

        //Academic
        $scope.academic = {
            year: 2017,
            period: 1
        };

        $scope.subjects = [];

        Statistics.getGlobalPerformancesBySubject({
            year: $scope.academic.year,
            period: $scope.academic.period
        }).$promise.then(
            function (subjects) {
                angular.forEach(subjects, function (subject) {
                    //Scope Data
                    var data = {
                        shortname: subject.shortname,
                        labels: [],
                        datasets: [
                            {
                                data: [],
                                backgroundColor: []
                            }]
                    };
                    angular.forEach(subject.data, function (performance) {
                        switch (performance.label) {
                        case 'DP':
                            data.labels.push('DP');
                            data.datasets[0].data.push(performance.value);
                            data.datasets[0].backgroundColor.push(performance.color);
                            break;
                        case 'DB':
                            data.labels.push('DB');
                            data.datasets[0].data.push(performance.value);
                            data.datasets[0].backgroundColor.push(performance.color);
                            break;
                        case 'DA':
                            data.labels.push('DA');
                            data.datasets[0].data.push(performance.value);
                            data.datasets[0].backgroundColor.push(performance.color);
                            break;
                        case 'DS':
                            data.labels.push('DS');
                            data.datasets[0].data.push(performance.value);
                            data.datasets[0].backgroundColor.push(performance.color);
                            break;
                        }
                    });
                    $scope.subjects.push(data);
                });
            },
            function (error) {
                $log.error(error);
            }
        );

        //Searching New Year AND Period
        $scope.change = function (year, period) {
            $scope.subjects = [];
            Statistics.getGlobalPerformancesBySubject({
                year: year,
                period: period
            }).$promise.then(
                function (subjects) {
                    angular.forEach(subjects, function (subject) {
                        //Scope Data
                        var data = {
                            shortname: subject.shortname,
                            labels: [],
                            datasets: [
                                {
                                    data: [],
                                    backgroundColor: []
                                }]
                        };
                        angular.forEach(subject.data, function (performance) {
                            switch (performance.label) {
                            case 'DP':
                                data.labels.push('DP');
                                data.datasets[0].data.push(performance.value);
                                data.datasets[0].backgroundColor.push(performance.color);
                                break;
                            case 'DB':
                                data.labels.push('DB');
                                data.datasets[0].data.push(performance.value);
                                data.datasets[0].backgroundColor.push(performance.color);
                                break;
                            case 'DA':
                                data.labels.push('DA');
                                data.datasets[0].data.push(performance.value);
                                data.datasets[0].backgroundColor.push(performance.color);
                                break;
                            case 'DS':
                                data.labels.push('DS');
                                data.datasets[0].data.push(performance.value);
                                data.datasets[0].backgroundColor.push(performance.color);
                                break;
                            }
                        });
                        $scope.subjects.push(data);
                    });
                },
                function (error) {
                    $log.error(error);
                }
            );
        };

        $scope.options = {
            responsive: true,
            legend: {
                display: true,
                boxWidth: 20
            },
        };

    }])
    .controller('StatisticsAreaController', ['$scope', '$log', 'Statistics', function ($scope, $log, Statistics) {
        //Academic
        $scope.academic = {
            year: 2016,
            period: 1
        };

        $scope.areas = [];

        Statistics.getGlobalPerformancesByArea({
            year: $scope.academic.year,
            period: $scope.academic.period
        }).$promise.then(
            function (areas) {
                angular.forEach(areas, function (area) {
                    //Scope Data
                    var data = {
                        shortname: area.shortname,
                        labels: [],
                        datasets: [
                            {
                                data: [],
                                backgroundColor: []
                            }]
                    };
                    angular.forEach(area.data, function (performance) {
                        switch (performance.label) {
                        case 'DP':
                            data.labels.push('DP');
                            data.datasets[0].data.push(performance.value);
                            data.datasets[0].backgroundColor.push(performance.color);
                            break;
                        case 'DB':
                            data.labels.push('DB');
                            data.datasets[0].data.push(performance.value);
                            data.datasets[0].backgroundColor.push(performance.color);
                            break;
                        case 'DA':
                            data.labels.push('DA');
                            data.datasets[0].data.push(performance.value);
                            data.datasets[0].backgroundColor.push(performance.color);
                            break;
                        case 'DS':
                            data.labels.push('DS');
                            data.datasets[0].data.push(performance.value);
                            data.datasets[0].backgroundColor.push(performance.color);
                            break;
                        }
                    });
                    $scope.areas.push(data);
                });
            },
            function (error) {
                $log.error(error);
            }
        );

        //Searching New Year AND Period
        $scope.change = function (year, period) {
            $scope.areas = [];
            Statistics.getGlobalPerformancesByArea({
                year: year,
                period: period
            }).$promise.then(
                function (areas) {
                    angular.forEach(areas, function (area) {
                        //Scope Data
                        var data = {
                            shortname: area.shortname,
                            labels: [],
                            datasets: [
                                {
                                    data: [],
                                    backgroundColor: []
                                }]
                        };
                        angular.forEach(area.data, function (performance) {
                            switch (performance.label) {
                            case 'DP':
                                data.labels.push('DP');
                                data.datasets[0].data.push(performance.value);
                                data.datasets[0].backgroundColor.push(performance.color);
                                break;
                            case 'DB':
                                data.labels.push('DB');
                                data.datasets[0].data.push(performance.value);
                                data.datasets[0].backgroundColor.push(performance.color);
                                break;
                            case 'DA':
                                data.labels.push('DA');
                                data.datasets[0].data.push(performance.value);
                                data.datasets[0].backgroundColor.push(performance.color);
                                break;
                            case 'DS':
                                data.labels.push('DS');
                                data.datasets[0].data.push(performance.value);
                                data.datasets[0].backgroundColor.push(performance.color);
                                break;
                            }
                        });
                        $scope.areas.push(data);
                    });
                },
                function (error) {
                    $log.error(error);
                }
            );
        };

        $scope.options = {
            responsive: true,
            legend: {
                display: true,
                boxWidth: 20
            },
        };

    }]);