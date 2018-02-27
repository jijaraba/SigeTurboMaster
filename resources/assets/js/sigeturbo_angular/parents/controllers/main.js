'use strict';

/* Parents Controllers */
angular.module('Parents.controllers', [])
    .controller('DashboardController', ["$log", "$scope", "Payment", 'sigeTurboStorage', function ($log, $scope, Payment, sigeTurboStorage) {
        $scope.message = "Dashboard";
        $scope.payment = "Estado de Pagos";
        $scope.isPayment = true;
        $scope.paymentMessage = "Al Día";

        //Get Payments By User
        Payment.getPaymentsByUser({
            user: sigeTurboStorage.getStorage('user'),
            pending: true
        }).$promise.then(
            function (payments) {
                $scope.payments = payments;
                if ($scope.payments.length > 0) {
                    $scope.isPayment = false;
                    $scope.paymentMessage = "Pendientes (" + $scope.payments.length + ")";
                } else {
                    $scope.isPayment = true;
                    $scope.paymentMessage = "Al Día";
                }
            },
            function (error) {
                $log.error(error);
            }
        );
    }])
    .controller('HomeworkController', ['$scope', '$log', 'Task', 'sigeTurboStorage', 'ASSETS_SERVER', function ($scope, $log, Task, sigeTurboStorage, ASSETS_SERVER) {
        $scope.assets = ASSETS_SERVER;
        $scope.message = "Tasks";
        $scope.showTasks = false;

        //Search Tasks
        $scope.search = function (user) {
            //Tasks
            Task.getTasksByUser({
                user: user,
            }).$promise.then(
                function (tasks) {
                    $scope.tasks = tasks;
                    if (tasks.length > 0) {
                        $scope.showTasks = true;
                    } else {
                        $scope.showTasks = false;
                    }
                },
                function (error) {
                    $log.error(error);
                }
            );
        }
    }])
    .controller('MonitoringsController', ['$log', '$scope', 'Monitoring', 'Points', 'sigeTurboStorage', 'SweetAlert', function ($log, $scope, Monitoring, Points, sigeTurboStorage, SweetAlert) {

        $scope.showMonitoring = false;
        //Academic
        $scope.academic = {
            year: 2017,
            period: 2,
            user: null
        }
        $scope.years = [];
        $scope.periods = [];

        $scope.init = function () {

            //Years
            $scope.years = [
                {'idyear': 2017, name: '2017-2018'},
                {'idyear': 2016, name: '2016-2017'},
                {'idyear': 2015, name: '2015-2016'},
                {'idyear': 2014, name: '2014-2015'}
            ];

            //Periods
            $scope.periods = [
                {'idperiod': 1, name: 'Primer Periodo'},
                {'idperiod': 2, name: 'Segundo Periodo'},
                {'idperiod': 3, name: 'Tercer Periodo'}
            ];

        }

        //Select User
        $scope.select = function (user) {
            Points.getPoints({}).$promise.then(
                function (points) {
                    $log.info(points);
                    $scope.academic.user = user;
                    $scope.search();
                },
                function (error) {
                    $log.error(error);
                }
            );
        }

        //Change
        $scope.search = function () {
            if ($scope.academic.user != null) {
                Monitoring.getMonitoringsByUser({
                    year: $scope.academic.year,
                    period: $scope.academic.period,
                    group: 'null',
                    user: $scope.academic.user
                }).$promise.then(
                    function (monitorings) {
                        if (monitorings.length) {
                            $scope.showMonitoring = true;
                            $scope.monitorings = monitorings;
                        } else {
                            $scope.showMonitoring = false;
                            SweetAlert.warning("Error", "No se encontraron seguimientos para los parámetros seleccionados");
                        }
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            } else {
                SweetAlert.warning("Error", "Debe seleccionar un estudiante para visualizar el seguimiento académico");
            }
        }
    }])
    .controller('UpdateinfoController', ['$log', '$scope', 'sigeTurboStorage', 'Virtual', 'Religion', 'Identificationtype', 'Bloodtype', 'SweetAlert', function ($log, $scope, sigeTurboStorage, Virtual, Religion, Identificationtype, Bloodtype, SweetAlert) {

        $scope.message = "Update";
        $scope.user = '';
        $scope.showMember = false;
        $scope.exists = false;
        $scope.title = 'Ingresar';
        $scope.virtual = [];
        $scope.student = false;


        $scope.select = function (user) {
            $scope.user = user;
        }

        $scope.$watch('user', function (newUser, oldUser) {
            if (newUser != '') {
                if (newUser !== oldUser) {
                    $scope.showMember = true;

                    //Find Preregistration
                    Virtual.getByUser({user: newUser.iduser}).$promise.then(
                        function (virtual) {

                            if (virtual.length > 0) {
                                $scope.exists = true;
                                $scope.title = 'Actualizar'
                                $scope.virtual = virtual[0];
                            } else {
                                $scope.exists = false;
                                $scope.title = 'Ingresar'
                                $scope.virtual = [];
                                $scope.virtual.iduser = newUser.iduser;
                                $scope.virtual.idfamily = newUser.idfamily;
                                $scope.virtual.idcategory = newUser.idcategory;
                                $scope.virtual.firstname = newUser.firstname;
                                $scope.virtual.lastname = newUser.lastname;
                                $scope.virtual.email = newUser.email;
                            }

                            if ($scope.virtual.idcategory == 13) {
                                $scope.student = true;
                            } else {
                                $scope.student = false;
                            }

                            //Religion
                            Religion.query({}).$promise.then(
                                function (religions) {
                                    $scope.religions = religions;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );

                            //Identificationtypes
                            Identificationtype.query({}).$promise.then(
                                function (identificationtypes) {
                                    $scope.identificationtypes = identificationtypes;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );

                            //Bloodtypes
                            Bloodtype.query({}).$promise.then(
                                function (bloodtypes) {
                                    $scope.bloodtypes = bloodtypes;
                                },
                                function (error) {
                                    $log.error(error);
                                }
                            );

                        },
                        function (error) {
                            $log.error(error);
                        }
                    );

                }
            }
        });

        $scope.save = function () {
            //Verificar si existe el registro
            if ($scope.exists) {

                //Actualizar Registro
                Virtual.update({
                    id: $scope.virtual.idpreregistration,
                    user: $scope.virtual.iduser,
                    idfamily: $scope.virtual.idfamily,
                    idcategory: $scope.virtual.idcategory,
                    firstname: $scope.virtual.firstname,
                    lastname: $scope.virtual.lastname,
                    identificationtype: $scope.virtual.ididentificationtype,
                    identification: $scope.virtual.identification,
                    expedition: $scope.virtual.expedition,
                    religion: $scope.virtual.idreligion,
                    address: $scope.virtual.address,
                    district: $scope.virtual.district,
                    town: $scope.virtual.town,
                    email: $scope.virtual.email,
                    phone: $scope.virtual.phone,
                    celular: $scope.virtual.celular,
                    idbloodtype: ($scope.virtual.idbloodtype != undefined) ? $scope.virtual.idbloodtype : 1,
                    eps: ($scope.virtual.eps != undefined) ? $scope.virtual.eps : null,
                    prepaidmedical: ($scope.virtual.prepaidmedical != undefined) ? $scope.virtual.prepaidmedical : null,
                    policynumber: ($scope.virtual.policynumber != undefined) ? $scope.virtual.policynumber : null,
                    medicaltreatment: ($scope.virtual.medicaltreatment != undefined) ? $scope.virtual.medicaltreatment : 'N',
                    medicaltreatmentdescription: ($scope.virtual.medicaltreatmentdescription != undefined) ? $scope.virtual.medicaltreatmentdescription : null,
                    equaltreatment: ($scope.virtual.equaltreatment != undefined) ? $scope.virtual.equaltreatment : 'N',
                    takemedication: ($scope.virtual.takemedication != undefined) ? $scope.virtual.takemedication : 'N',
                    medicationdescription: ($scope.virtual.medicationdescription != undefined) ? $scope.virtual.medicationdescription : null,
                    whytakemedication: ($scope.virtual.whytakemedication != undefined) ? $scope.virtual.whytakemedication : null,
                    dose: ($scope.virtual.dose != undefined) ? $scope.virtual.dose : null,
                    isallergic: ($scope.virtual.isallergic != undefined) ? $scope.virtual.isallergic : 'N',
                    sufferedillness: ($scope.virtual.sufferedillness != undefined) ? $scope.virtual.sufferedillness : 'N',
                    specifyallergic: ($scope.virtual.specifyallergic != undefined) ? $scope.virtual.specifyallergic : null,
                    sufferedillnessdescription: ($scope.virtual.sufferedillnessdescription != undefined) ? $scope.virtual.sufferedillnessdescription : null,
                    doctorname: ($scope.virtual.doctorname != undefined) ? $scope.virtual.doctorname : null,
                    doctorphone: ($scope.virtual.doctorphone != undefined) ? $scope.virtual.doctorphone : null,
                    psychologicalsupport: ($scope.virtual.psychologicalsupport != undefined) ? $scope.virtual.psychologicalsupport : 'N',
                    observation: ($scope.virtual.observation != undefined) ? $scope.virtual.observation : null,
                    educationaloutput: ($scope.virtual.educationaloutput != undefined) ? $scope.virtual.educationaloutput : 'N',
                    responsible: ($scope.virtual.responsible != undefined) ? $scope.virtual.responsible : null,
                    profession: ($scope.virtual.profession != undefined) ? $scope.virtual.profession : null,
                    occupation: ($scope.virtual.occupation != undefined) ? $scope.virtual.occupation : null,
                    company: ($scope.virtual.company != undefined) ? $scope.virtual.company : null,
                    phonecompany: ($scope.virtual.phonecompany != undefined) ? $scope.virtual.phonecompany : null
                }).$promise.then(
                    function (data) {
                        $scope.exists = true;
                        $scope.title = 'Actualizar';
                        SweetAlert.success("Excelente", data.message);
                    },
                    function (error) {
                        $log.error(error);
                        SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                    }
                );

            } else {
                //Ingresar Registro
                Virtual.save({
                    user: $scope.virtual.iduser,
                    idfamily: $scope.virtual.idfamily,
                    idcategory: $scope.virtual.idcategory,
                    firstname: $scope.virtual.firstname,
                    lastname: $scope.virtual.lastname,
                    identificationtype: $scope.virtual.ididentificationtype,
                    identification: $scope.virtual.identification,
                    expedition: $scope.virtual.expedition,
                    religion: $scope.virtual.idreligion,
                    address: $scope.virtual.address,
                    district: $scope.virtual.district,
                    town: $scope.virtual.town,
                    email: $scope.virtual.email,
                    phone: $scope.virtual.phone,
                    celular: $scope.virtual.celular,
                    idbloodtype: ($scope.virtual.idbloodtype != undefined) ? $scope.virtual.idbloodtype : 1,
                    eps: ($scope.virtual.eps != undefined) ? $scope.virtual.eps : null,
                    prepaidmedical: ($scope.virtual.prepaidmedical != undefined) ? $scope.virtual.prepaidmedical : null,
                    policynumber: ($scope.virtual.policynumber != undefined) ? $scope.virtual.policynumber : null,
                    medicaltreatment: ($scope.virtual.medicaltreatment != undefined) ? $scope.virtual.medicaltreatment : 'N',
                    medicaltreatmentdescription: ($scope.virtual.medicaltreatmentdescription != undefined) ? $scope.virtual.medicaltreatmentdescription : null,
                    equaltreatment: ($scope.virtual.equaltreatment != undefined) ? $scope.virtual.equaltreatment : 'N',
                    takemedication: ($scope.virtual.takemedication != undefined) ? $scope.virtual.takemedication : 'N',
                    medicationdescription: ($scope.virtual.medicationdescription != undefined) ? $scope.virtual.medicationdescription : null,
                    whytakemedication: ($scope.virtual.whytakemedication != undefined) ? $scope.virtual.whytakemedication : null,
                    dose: ($scope.virtual.dose != undefined) ? $scope.virtual.dose : null,
                    isallergic: ($scope.virtual.isallergic != undefined) ? $scope.virtual.isallergic : 'N',
                    sufferedillness: ($scope.virtual.sufferedillness != undefined) ? $scope.virtual.sufferedillness : 'N',
                    specifyallergic: ($scope.virtual.specifyallergic != undefined) ? $scope.virtual.specifyallergic : null,
                    sufferedillnessdescription: ($scope.virtual.sufferedillnessdescription != undefined) ? $scope.virtual.sufferedillnessdescription : null,
                    doctorname: ($scope.virtual.doctorname != undefined) ? $scope.virtual.doctorname : null,
                    doctorphone: ($scope.virtual.doctorphone != undefined) ? $scope.virtual.doctorphone : null,
                    psychologicalsupport: ($scope.virtual.psychologicalsupport != undefined) ? $scope.virtual.psychologicalsupport : 'N',
                    observation: ($scope.virtual.observation != undefined) ? $scope.virtual.observation : null,
                    educationaloutput: ($scope.virtual.educationaloutput != undefined) ? $scope.virtual.educationaloutput : 'N',
                    responsible: ($scope.virtual.responsible != undefined) ? $scope.virtual.responsible : null,
                    profession: ($scope.virtual.profession != undefined) ? $scope.virtual.profession : null,
                    occupation: ($scope.virtual.occupation != undefined) ? $scope.virtual.occupation : null,
                    company: ($scope.virtual.company != undefined) ? $scope.virtual.company : null,
                    phonecompany: ($scope.virtual.phonecompany != undefined) ? $scope.virtual.phonecompany : null
                }).$promise.then(
                    function (data) {
                        $scope.exists = true;
                        $scope.title = 'Actualizar'
                        $scope.virtual.idpreregistration = data.last_insert_id;
                        SweetAlert.swal({
                            title: "Excelente",
                            text: data.message,
                            type: 'success',
                            closeOnConfirm: false
                        }, function () {
                            SweetAlert.swal({
                                title: "En hora buena",
                                text: "¡Ya puede consultar los seguimientos académicos!",
                                imageUrl: "/img/badges/badge.png"
                            })
                        });
                    },
                    function (error) {
                        $log.error(error);
                        SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                    }
                );

            }

        }
    }])
    .controller('PaymentsController', ['$log', '$scope', function ($log, $scope) {

    }])
    .controller('ReportsController', ['$log', '$scope', function ($log, $scope) {


    }])
    .controller('PaymentsRespondController', ['$log', '$scope', function ($log, $scope) {
        //Scope
        $scope.payment = [];
        $scope.init = function (payment) {
            $scope.payment = payment;
        }
    }])
    .controller('PaymentsCheckoutController', ['$log', '$scope', function ($log, $scope) {
        //Scope
        $scope.payment = [];
        $scope.transactionID = '';
        $scope.init = function (payment, transaction) {
            $scope.payment = payment;
            $scope.transactionID = transaction;
        }
    }]);