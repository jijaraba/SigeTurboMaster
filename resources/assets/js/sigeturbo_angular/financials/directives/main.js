/* eslint-disable no-undef */
'use strict';

/* Financials Directives */
angular.module('Financials.directives', [])
    .directive('appVersion', ['version', function (version) {
        return function (scope, elm) {
            elm.text(version);
        };
    }])
    .directive('sigeTurboFinancialsExport', ['$log', 'ASSETS_SERVER', 'Export', function ($log, ASSETS_SERVER, Export) {
        return {
            restrict: 'AE',
            scope: {
                payment: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.showDownload = false;
                $scope.assets = ASSETS_SERVER;
            }],
            template: require('./views/global/financials/export.html'),
            link: function ($scope) {
                $scope.export = function (filename, format) {
                    $scope.showDownload = false;
                    Export.getPaymentsReport({
                        'filename': filename,
                        'format': format,
                        'payment': $scope.payment
                    }).$promise.then(
                        function (result) {
                            $scope.showDownload = true;
                            $scope.download = $scope.assets + '/export/' + result.file;
                        },
                        function (error) {
                            $log.error(error);
                            $scope.showDownload = false;
                        }
                    );
                };
            }
        };
    }])
    .directive('sigeTurboFinancialsSearch', ['$log', 'Year', 'Group', 'Statusschooltype', function ($log, Year, Group, Statusschooltype) {
        return {
            restrict: 'AE',
            scope: {
                search: '=',
                result: '=',
            },
            controller: ['$scope', function ($scope) {
                $scope.showSearch = false;

                // Get Years
                Year.query().$promise.then(
                    function (years) {
                        $scope.years = years;
                        //Get Groups
                        Group.getGroupsByYearAndPeriod({
                            year: $scope.search.year,
                            period: 1
                        }).$promise.then(
                            function (groups) {
                                $scope.groups = groups;
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

                //Get Status
                Statusschooltype.query({}).$promise.then(
                    function (statuses) {
                        $scope.statuses = statuses;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );


            }],
            template: require('./views/global/financials/search.html'),
            link: function ($scope) {

                //Verified Empty Text
                $scope.isEmpty = function (str) {
                    return typeof str == 'string' && !str.trim() || typeof str == 'undefined' || str === null;
                };


                //Search
                $scope.searchForm = function () {
                    $scope.showSearch = true;
                };
                //Watch Year
                $scope.$watch('search.year', function (newYear) {
                    if (isNaN(newYear)) {
                        $scope.search.year = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.year = parseInt(newYear);
                        $scope.result = JSON.stringify($scope.search);
                        //Get Groups
                        Group.getGroupsByYearAndPeriod({
                            year: newYear,
                            period: 1
                        }).$promise.then(
                            function (groups) {
                                $scope.groups = groups;
                            },
                            function (error) {
                                $log.error(error);
                            }
                        );
                    }
                });

                //Watch Group
                $scope.$watch('search.group', function (newGroup) {
                    if (isNaN(newGroup)) {
                        $scope.search.group = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.group = parseInt(newGroup);
                        $scope.result = JSON.stringify($scope.search);
                    }
                });
                //Watch Firstname
                $scope.$watch('search.firstname', function (newFirstname) {
                    if ($scope.isEmpty(newFirstname)) {
                        $scope.search.firstname = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.firstname = newFirstname;
                        $scope.result = JSON.stringify($scope.search);
                    }
                });
                //Watch Lastname
                $scope.$watch('search.lastname', function (newLastname) {
                    if ($scope.isEmpty(newLastname)) {
                        $scope.search.lastname = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.lastname = newLastname;
                        $scope.result = JSON.stringify($scope.search);
                    }
                });
                //Watch Code
                $scope.$watch('search.code', function (newCode) {
                    if (isNaN(newCode)) {
                        $scope.search.code = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.code = newCode;
                        $scope.result = JSON.stringify($scope.search);
                    }
                });
                //Watch Status
                $scope.$watch('search.status', function (newStatus) {
                    $scope.search.status = newStatus;
                    $scope.result = JSON.stringify($scope.search);
                });

            }
        };
    }])
    .directive('sigeTurboFinancialsPayments', ['$log', 'Payment', function ($log, Payment) {
        return {
            restrict: 'AE',
            scope: {
                student: '='
            },
            controller: ['$scope', function ($scope) {
                Payment.getPaymentsByStudent({'studentId': $scope.student}).$promise.then(
                    function (payments) {
                        $scope.payments = payments;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );

            }],
            template: require('./views/payments/lists.html'),
            link: function (scope, element) {

                //Show Payment
                scope.showPayment = function (payment) {
                    element.find('#show_payment_' + payment).show();
                };
            }
        };
    }])
    .directive('sigeTurboPaymentsPayment', ['$log', 'ASSETS_SERVER', 'SweetAlert', 'Payment', function ($log, ASSETS_SERVER, SweetAlert, Payment) {
        return {
            restrict: 'AE',
            require: '^sigeTurboPaymentsCalendar',
            scope: {
                payment: '=',
                banks: '=',
                serverdate: '@',
            },
            controller: ['$scope', function ($scope) {

                $scope.load = 'no';
                $scope.assets = ASSETS_SERVER;
                var dateCurrent = moment($scope.serverdate, 'YYYY-MM-DD').format('YYYY-MM-DD');
                $scope.data = {
                    voucher: $scope.payment.voucher,
                    observation: $scope.payment.observation
                };

                $scope.data['date'] = ($scope.payment.payment_at == null || $scope.payment.payment_at == '') ? dateCurrent : moment($scope.payment.payment_at, 'YYYY-MM-DD').format('YYYY-MM-DD');

                //Config Value By Default
                var dateDiscountPayment = moment($scope.payment.date1, 'YYYY-MM-DD').format('YYYY-MM-DD');
                var dateNormalPayment = moment($scope.payment.date2, 'YYYY-MM-DD').format('YYYY-MM-DD');
                var dateshortPayment = moment($scope.payment.date1, 'YYYY-MM-DD').format('YYYY-MM');
                var dateshortCurrent = moment($scope.serverdate, 'YYYY-MM-DD').format('YYYY-MM');


                if ($scope.payment.realValue == null) {
                    if (dateshortPayment <= dateshortCurrent) {
                        if (dateDiscountPayment >= dateCurrent) {
                            //Payment With Discount
                            $scope.data.method = 'discount';
                            $scope.data.value = $scope.payment.value1;
                        } else if (dateNormalPayment >= dateCurrent) {
                            //Payment Normal
                            $scope.data.method = 'normal';
                            $scope.data.value = $scope.payment.value2;
                        } else {
                            //Payment With Rate
                            $scope.data.method = 'rate';
                            $scope.data.value = $scope.payment.value3;
                        }
                    } else {
                        //Payment With Discount
                        $scope.data.method = 'discount';
                        $scope.data.value = $scope.payment.value1;
                    }
                } else {
                    //Payment With Discount
                    $scope.data.method = $scope.payment.method;
                    $scope.data.value = $scope.payment.realValue;
                }


            }],
            template: require('./views/payments/payment.html'),
            link: function ($scope) {

                //Verify Payment Pending
                $scope.verifyPaymentPending = function (payment) {
                    Payment.verifyPaymentPending({payment: payment.idpayment}).$promise.then(
                        function (result) {
                            if (result.payment.aprobado === 'A') {
                                payment.approved = 'A';
                                SweetAlert.success('Excelente', result.message);
                            } else if (result.payment.aprobado === 'P') {
                                payment.approved = 'P';
                                SweetAlert.error('Error', result.message);
                            } else if (result.payment.aprobado === 'R' || result.payment.aprobado === null) {
                                payment.approved = 'R';
                                SweetAlert.error('Error', result.message);
                            }
                        },
                        function () {
                            SweetAlert.error('Error', 'No se pudo verificar el pago');
                            $log.info(payment);
                        }
                    );
                };

                $scope.showOptions = function (payment) {
                    angular.element('#calendar_options_' + payment).fadeIn('fast');
                };

                //Short Form
                $scope.showShort = function (payment) {
                    angular.element('#calendar_short_' + payment).fadeIn('fast');
                    angular.element('#calendar_options_' + payment).fadeOut('fast');
                };
                $scope.closeShort = function (payment) {
                    angular.element('#calendar_short_' + payment).fadeOut('fast');
                };


                //Long Form
                $scope.showLong = function (payment) {
                    angular.element('#calendar_long_' + payment).fadeIn('fast');
                    angular.element('#calendar_options_' + payment).fadeOut('fast');
                    $scope.load = 'yes';
                };
                $scope.closeLong = function (payment) {
                    angular.element('#calendar_long_' + payment).fadeOut('fast');
                };

                $scope.updatePayment = function (payment) {
                    Payment.updatePaymentShort({
                        'payment': payment.idpayment,
                        'bank': $scope.data.bank,
                        'voucher': $scope.data.voucher,
                        'method': $scope.data.method,
                        'value': $scope.data.value,
                        'date': $scope.data.date,
                        'observation': $scope.data.observation,
                    }).$promise.then(
                        function (result) {
                            SweetAlert.success('Excelente', result.message);
                            payment.approved = 'A';
                            payment.idbank = $scope.data.bank;
                        },
                        function (error) {
                            $log.error(error);
                            SweetAlert.error('Error', 'Error al procesar la operación');
                        }
                    );
                };

            }
        };
    }])
    .directive('sigeTurboPaymentsCreate', ['$log', 'ASSETS_SERVER', 'SweetAlert', 'Enrollment', 'Payment', function ($log, ASSETS_SERVER, SweetAlert, Enrollment, Payment) {
        return {
            restrict: 'AE',
            scope: {},
            controller: ['$scope', function ($scope) {

                //Scope
                $scope.assets = ASSETS_SERVER;
                $scope.showMassive = false;
                $scope.showIndividual = false;
                $scope.studentWithScholarship = false;
                $scope.payment = {};
                $scope.concepttypes = [
                    {type: 1, name: 'MATRÍCULA'},
                    {type: 2, name: 'PENSIÓN'},
                    {type: 3, name: 'EXTRACURRICULAR'},
                    {type: 4, name: 'NIVELACIÓN'},
                ];
                $scope.user = {};

                moment.locale('es', {
                    months: [
                        'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO',
                        'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
                    ]
                });

                $scope.months = moment.months('es');
                $scope.enableIndividualButton = 1;
                $scope.enableExample = false;

                //Functions
                $scope.showMethod = function (method) {
                    switch (method) {
                    case 1:
                        $scope.showMassive = true;
                        $scope.showIndividual = false;
                        break;
                    case 2:
                        $scope.showMassive = false;
                        $scope.showIndividual = true;
                        break;
                    }
                };

                //Save Payment Individual
                $scope.paymentSaveIndividual = function () {
                    Payment.setPaymentIndividualNew({
                        'student': $scope.payment.student,
                        'concept': $scope.payment.concept,
                        'date1': $scope.payment.date1,
                        'value1': $scope.payment.value1,
                        'date2': $scope.payment.date2,
                        'value2': $scope.payment.value2,
                        'date3': $scope.payment.date3,
                        'value3': $scope.payment.value3,
                        'date4': $scope.payment.date4,
                        'value4': $scope.payment.value4,
                        'year': $scope.payment.year,
                        'month': $scope.payment.month,
                        'month_name': $scope.months[parseInt($scope.payment.month - 1)],
                        'firstname': $scope.payment.firstname,
                        'lastname': $scope.payment.lastname,
                        'gender': $scope.payment.gender,
                        'scholarship': $scope.payment.scholarship,
                        'type': $scope.payment.type
                    }).$promise.then(
                        function (payment) {
                            SweetAlert.success('Excelente', payment.message);
                        },
                        function () {
                            SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                        }
                    );
                };

                //Save Payment Massive
                $scope.paymentSaveMassive = function () {

                    SweetAlert.swal({
                        title: '¿Está seguro?',
                        text: 'La generación masiva de pagos crea un pago con el concepto seleccionado para cada unos de los estudiantes registrados en ese momento y envía un correo electrónico a cada padre de familia',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#53BBB4',
                        confirmButtonText: 'Generar',
                        closeOnConfirm: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            //Save Massive Payment
                            Payment.setPaymentMassive({
                                'concept': $scope.payment.concept,
                                'date1': $scope.payment.date1,
                                'date2': $scope.payment.date2,
                                'date3': $scope.payment.date3,
                                'date4': $scope.payment.date4,
                                'academic': $scope.payment.academic,
                                'year': $scope.payment.year,
                                'month': $scope.payment.month,
                                'month_name': $scope.months[parseInt($scope.payment.month - 1)],
                                'type': $scope.payment.type,
                                'exclude': ($scope.payment.exclude) ? $scope.payment.exclude : 0,
                            }).$promise.then(
                                function (payment) {
                                    SweetAlert.success('Excelente', payment.message + ' (' + payment.count + ')');
                                },
                                function () {
                                    SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                                }
                            );
                        }
                    });

                };

            }],
            template: require('./views/payments/create.html'),
            link: function ($scope) {

                var currentYear = new moment().locale('es').format('YYYY');
                var currentMonth = new moment().format('MM');

                $scope.payment.year = currentYear;
                $scope.payment.month = currentMonth;
                $scope.payment.concept = 'PENSIÓN';


                //Verified Empty Text
                $scope.isEmpty = function (str) {
                    return typeof str == 'string' && !str.trim() || typeof str == 'undefined' || str === null;
                };

                //Search Student
                $scope.searchStudent = function () {
                    if ($scope.payment.student != undefined && $scope.payment.student != '' && parseInt($scope.payment.student) != 0) {
                        Enrollment.getEnrollmentsLatestByStudentWithCost({
                            student: $scope.payment.student,
                            year: $scope.payment.academic,
                            type: $scope.payment.type
                        }).$promise.then(
                            function (user) {
                                if (!$scope.isEmpty(user.iduser)) {
                                    //User Info
                                    $scope.user = user;
                                    //Payment
                                    $scope.payment.iduser = user.iduser;
                                    $scope.payment.firstname = user.firstname;
                                    $scope.payment.lastname = user.lastname;
                                    //Calculate Value
                                    if (parseInt($scope.payment.type) == 1) {
                                        $scope.payment.value1 = user.enrollment_discount;
                                        $scope.payment.value2 = user.enrollment;
                                        $scope.payment.value3 = user.enrollment_expired;
                                        $scope.payment.value4 = user.enrollment;
                                    } else {
                                        $scope.payment.value1 = user.pension_discount - (user.pension_discount * parseFloat(user.scholarship));
                                        $scope.payment.value2 = user.pension_normal - (user.pension_normal * parseFloat(user.scholarship));
                                        $scope.payment.value3 = user.pension_expired - (user.pension_expired * parseFloat(user.scholarship));
                                        $scope.payment.value4 = user.pension_normal - (user.pension_normal * parseFloat(user.scholarship));
                                    }
                                    $scope.payment.gender = user.idgender;
                                    $scope.payment.scholarship = parseFloat(user.scholarship);
                                    //Scholarship
                                    if (parseFloat(user.scholarship) == 1) {
                                        SweetAlert.warning('Advertencia', 'Estudiante con Beca del ' + (user.scholarship * 100) + '%.');
                                    }
                                    if (parseFloat(user.scholarship) > 0) {
                                        $scope.studentWithScholarship = true;
                                    } else {
                                        $scope.studentWithScholarship = false;
                                    }
                                    $scope.enableExample = true;
                                    $scope.enableIndividualButton = 0;
                                    //Change Values
                                    $scope.payment.date1 = new moment([currentYear, parseInt(currentMonth - 1), 10]).format('YYYY-MM-DD');
                                    //Days In Month
                                    var currentDay = moment([currentYear, currentMonth], 'YYYY-MM').daysInMonth();
                                    $scope.payment.date2 = new moment([currentYear, parseInt(currentMonth - 1), currentDay]).format('YYYY-MM-DD');
                                    $scope.payment.date3 = new moment([currentYear, parseInt(currentMonth - 1), currentDay]).format('YYYY-MM-DD');
                                    $scope.payment.date4 = new moment([currentYear, parseInt(currentMonth - 1), currentDay]).format('YYYY-MM-DD');
                                    //Example
                                    if ($scope.enableExample == true) {
                                        if (parseInt($scope.payment.type) == 2) {
                                            if ($scope.studentWithScholarship == true) {
                                                $scope.payment.result = $scope.payment.concept + ' ' + $scope.months[parseInt(currentMonth - 1)] + ' CON BECA DEL ' + ($scope.payment.scholarship * 100) + '% ' + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                                            } else {
                                                $scope.payment.result = $scope.payment.concept + ' ' + $scope.months[parseInt(currentMonth - 1)] + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                                            }
                                        } else if (parseInt($scope.payment.type) == 1) {
                                            $scope.payment.result = $scope.payment.concept + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                                        } else {
                                            $scope.payment.result = $scope.payment.concept + ' ' + $scope.months[parseInt(currentMonth - 1)] + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                                        }
                                    }
                                } else {
                                    SweetAlert.error('Error', 'No existe el estudiante indicado');
                                    $scope.enableIndividualButton = 1;
                                }
                            },
                            function () {
                                $scope.enableIndividualButton = 1;
                            }
                        );
                    }
                };

                //Type
                $scope.$watch('payment.type', function (newType) {
                    if (newType !== undefined) {

                        //Asignar Valor
                        if (parseInt(newType) == 2) {
                            $scope.payment.concept = 'PENSIÓN';
                            $scope.payment.value1 = $scope.user.pension_discount - ($scope.user.pension_discount * parseFloat($scope.user.scholarship));
                            $scope.payment.value2 = $scope.user.pension_normal - ($scope.user.pension_normal * parseFloat($scope.user.scholarship));
                            $scope.payment.value3 = $scope.user.pension_expired - ($scope.user.pension_expired * parseFloat($scope.user.scholarship));
                            $scope.payment.value4 = $scope.user.pension_normal - ($scope.user.pension_normal * parseFloat($scope.user.scholarship));
                        } else if (parseInt(newType) == 1) {
                            $scope.payment.concept = 'MATRÍCULA';
                            $scope.payment.value1 = $scope.user.enrollment;
                            $scope.payment.value2 = $scope.user.enrollment;
                            $scope.payment.value3 = $scope.user.enrollment_expired;
                            $scope.payment.value4 = $scope.user.enrollment;
                        } else {
                            $scope.payment.concept = $scope.concepttypes[newType - 1].name;
                            $scope.payment.value1 = 0;
                            $scope.payment.value2 = 0;
                            $scope.payment.value3 = 0;
                            $scope.payment.value4 = 0;
                        }
                        //Example
                        if ($scope.enableExample == true) {
                            if (parseInt($scope.payment.type) == 2) {
                                if ($scope.studentWithScholarship == true) {
                                    $scope.payment.result = $scope.payment.concept + ' ' + $scope.months[parseInt(currentMonth - 1)] + ' CON BECA DEL ' + ($scope.payment.scholarship * 100) + '% ' + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                                } else {
                                    $scope.payment.result = $scope.payment.concept + ' ' + $scope.months[parseInt(currentMonth - 1)] + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                                }
                            } else if (parseInt($scope.payment.type) == 1) {
                                $scope.payment.result = $scope.payment.concept + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                            } else {
                                $scope.payment.result = $scope.payment.concept + ' ' + $scope.months[parseInt(currentMonth - 1)] + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                            }
                        }
                    }
                });

                //Concept
                $scope.$watch('payment.concept', function (newConcept) {
                    if (newConcept !== undefined && !$scope.isEmpty(newConcept)) {
                        //Example
                        if ($scope.enableExample == true) {
                            if (parseInt($scope.payment.type) == 2) {
                                if ($scope.studentWithScholarship == true) {
                                    $scope.payment.result = $scope.payment.concept + ' ' + $scope.months[parseInt(currentMonth - 1)] + ' CON BECA DEL ' + ($scope.payment.scholarship * 100) + '% ' + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                                } else {
                                    $scope.payment.result = $scope.payment.concept + ' ' + $scope.months[parseInt(currentMonth - 1)] + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                                }
                            } else if (parseInt($scope.payment.type) == 1) {
                                $scope.payment.result = $scope.payment.concept + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                            } else {
                                $scope.payment.result = $scope.payment.concept + ' ' + $scope.months[parseInt(currentMonth - 1)] + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                            }
                        }
                    } else {
                        if (parseInt($scope.payment.type) == 2) {
                            $scope.payment.concept = 'PENSIÓN';
                        } else {
                            $scope.payment.concept = 'MATRÍCULA';
                        }
                    }
                });

                //Year
                $scope.$watch('payment.year', function (newYear) {
                    if (newYear !== undefined) {
                        currentYear = newYear;
                    }

                    $scope.payment.date1 = new moment([currentYear, parseInt(currentMonth - 1), 10]).format('YYYY-MM-DD');
                    //Days In Month
                    var currentDay = moment([currentYear, currentMonth], 'YYYY-MM').daysInMonth();
                    $scope.payment.date2 = new moment([currentYear, parseInt(currentMonth - 1), currentDay]).format('YYYY-MM-DD');
                    $scope.payment.date3 = new moment([currentYear, parseInt(currentMonth - 1), currentDay]).format('YYYY-MM-DD');
                    $scope.payment.date4 = new moment([currentYear, parseInt(currentMonth - 1), currentDay]).format('YYYY-MM-DD');
                    //Example
                    if ($scope.enableExample == true) {
                        if (parseInt($scope.payment.type) == 2) {
                            if ($scope.studentWithScholarship == true) {
                                $scope.payment.result = $scope.payment.concept + ' ' + $scope.months[parseInt(currentMonth - 1)] + ' CON BECA DEL ' + ($scope.payment.scholarship * 100) + '% ' + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                            } else {
                                $scope.payment.result = $scope.payment.concept + ' ' + $scope.months[parseInt(currentMonth - 1)] + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                            }
                        } else if (parseInt($scope.payment.type) == 1) {
                            $scope.payment.result = $scope.payment.concept + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                        } else {
                            $scope.payment.result = $scope.payment.concept + ' ' + $scope.months[parseInt(currentMonth - 1)] + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                        }
                    }
                });

                //Month
                $scope.$watch('payment.month', function (newMonth) {
                    if (newMonth !== undefined) {
                        currentMonth = newMonth;
                    }
                    $scope.payment.date1 = new moment([currentYear, parseInt(currentMonth - 1), 10]).format('YYYY-MM-DD');
                    //Days In Month
                    var currentDay = moment([currentYear, currentMonth], 'YYYY-MM').daysInMonth();
                    $scope.payment.date2 = new moment([currentYear, parseInt(currentMonth - 1), currentDay]).format('YYYY-MM-DD');
                    $scope.payment.date3 = new moment([currentYear, parseInt(currentMonth - 1), currentDay]).format('YYYY-MM-DD');
                    $scope.payment.date4 = new moment([currentYear, parseInt(currentMonth - 1), currentDay]).format('YYYY-MM-DD');
                    //Example
                    if ($scope.enableExample == true) {
                        if (parseInt($scope.payment.type) == 2) {
                            if ($scope.studentWithScholarship == true) {
                                $scope.payment.result = $scope.payment.concept + ' ' + $scope.months[parseInt(currentMonth - 1)] + ' CON BECA DEL ' + ($scope.payment.scholarship * 100) + '% ' + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                            } else {
                                $scope.payment.result = $scope.payment.concept + ' ' + $scope.months[parseInt(currentMonth - 1)] + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                            }
                        } else if (parseInt($scope.payment.type) == 1) {
                            $scope.payment.result = $scope.payment.concept + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                        } else {
                            $scope.payment.result = $scope.payment.concept + ' ' + $scope.months[parseInt(currentMonth - 1)] + ' (' + $scope.payment.student + ' - ' + $scope.payment.firstname.toUpperCase() + ')';
                        }
                    }
                });

            }
        };
    }])
    .directive('sigeTurboFinancialsTransactions', ['$log', 'Transaction', 'TransactionType', function ($log, Transaction, TransactionType) {
        return {
            restrict: 'AE',
            scope: {
                payment: '=',
                load: '='
            },
            controller: ['$scope', function ($scope) {

                //Get Transactions BY Payment
                $scope.getTransactions = function () {
                    Transaction.getTransactionsByPayment({'payment': $scope.payment.idpayment}).$promise.then(
                        function (transactions) {
                            //Credits
                            $scope.credits = 0;
                            $scope.debits = 0;
                            $scope.transactions = transactions;
                            angular.forEach($scope.transactions, function (transaction) {
                                if (transaction.idtransactiontype === 1) {
                                    $scope.credits = $scope.credits + transaction.value;
                                }
                                if (transaction.idtransactiontype === 2) {
                                    $scope.debits = $scope.debits + transaction.value;
                                }
                            });
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );
                };

                //Get Transaction Types
                TransactionType.query({}).$promise.then(
                    function (transactiontypes) {
                        $scope.transactiontypes = transactiontypes;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );

                //Reload Transactions By Payment
                this.reload = function () {
                    Transaction.getTransactionsByPayment({'payment': $scope.payment.idpayment}).$promise.then(
                        function (transactions) {
                            //Credits
                            $scope.credits = 0;
                            $scope.debits = 0;
                            $scope.transactions = transactions;
                            angular.forEach($scope.transactions, function (transaction) {
                                if (transaction.idtransactiontype === 1) {
                                    $scope.credits = $scope.credits + transaction.value;
                                }
                                if (transaction.idtransactiontype === 2) {
                                    $scope.debits = $scope.debits + transaction.value;
                                }
                            });
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );
                };
            }],
            template: require('./views/payments/transactions/lists.html'),
            link: function (scope) {
                //Watch Year
                scope.$watch('load', function (newLoad) {
                    if (newLoad == 'yes') {
                        scope.getTransactions();
                    }
                });
            }
        };
    }])
    .directive('sigeTurboFinancialsTransactionEdit', ['$log', 'Transaction', 'SweetAlert', 'ASSETS_SERVER', function ($log, Transaction, SweetAlert, ASSETS_SERVER) {
        return {
            restrict: 'AE',
            require: '^sigeTurboFinancialsTransactions',
            scope: {
                transaction: '=',
                transactiontypes: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.assets = ASSETS_SERVER;
            }],
            template: require('./views/payments/transactions/edit.html'),
            link: function (scope, element, attrs, controllerTransactions) {


                //Update Transaction
                scope.updateTransaction = function () {
                    Transaction.update({
                        transactionId: scope.transaction.idtransaction,
                        vouchertype: scope.transaction.vouchertype,
                        accounttype: scope.transaction.accounttype,
                        transactiontype: scope.transaction.idtransactiontype,
                        costcenter: scope.transaction.costcenter,
                        document: scope.transaction.document,
                        description: scope.transaction.description,
                        value: scope.transaction.value,
                        nit: scope.transaction.nit,
                        date: scope.transaction.date,
                    }).$promise.then(
                        function () {
                            element.find('#transaction_' + scope.transaction.idtransaction).addClass('success');
                            controllerTransactions.reload();
                        },
                        function () {
                            element.find('#transaction_' + scope.transaction.idtransaction).addClass('wrong');
                            SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                        }
                    );
                };

                //Delete Transaction
                scope.deleteTransaction = function () {
                    Transaction.delete({
                        transactionId: scope.transaction.idtransaction
                    }).$promise.then(
                        function () {
                            controllerTransactions.reload();
                        },
                        function () {
                            SweetAlert.error('Error', 'Se ha presentado un error al borrar la información');
                        }
                    );
                };

            }
        };
    }])
    .directive('sigeTurboFinancialsTransactionNew', ['$log', 'Transaction', 'TransactionType', 'VoucherConsecutive', 'Responsibleparent', 'Costcenter', 'Enrollment', 'SweetAlert', 'ASSETS_SERVER', function ($log, Transaction, TransactionType, VoucherConsecutive, Responsibleparent, Costcenter, Enrollment, SweetAlert, ASSETS_SERVER) {
        return {
            restrict: 'AE',
            require: '^sigeTurboFinancialsTransactions',
            scope: {
                payment: '=',
                transactiontypes: '='
            },
            controller: ['$scope', function ($scope) {

                $scope.assets = ASSETS_SERVER;

                TransactionType.query({}).$promise.then(
                    function (transactiontypes) {
                        $scope.transactiontypes = transactiontypes;
                    },
                    function (error) {
                        $log.error(error);

                    }
                );

                //Transaction
                $scope.transaction = {
                    date: moment().format('YYYY-MM-DD')
                };

                //Responsible
                Responsibleparent.getResponsibleparentByStudent({'student': $scope.payment.iduser}).$promise.then(
                    function (responsible) {
                        $scope.transaction.nit = responsible.responsible;
                    },
                    function (error) {
                        $log.error(error);

                    }
                );

                //Change Voucher
                $scope.changeVoucher = function (code) {


                    Transaction.findVoucherInTransactions({
                        'payment': $scope.payment.idpayment, 'code': code
                    }).$promise.then(
                        function (transaction) {
                            if (transaction.document) {
                                $scope.transaction.document = transaction.document;
                            } else {
                                //Generate New Consecutive
                                VoucherConsecutive.getVoucherConsecutiveByCode({'code': code}).$promise.then(
                                    function (voucherconsecutive) {
                                        $scope.transaction.document = voucherconsecutive.consecutive;
                                    },
                                    function (error) {
                                        $log.error(error);
                                    }
                                );
                            }
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );


                };

                //Enrollment By Student
                Enrollment.getEnrollmentsLatestByStudent({'student': $scope.payment.iduser}).$promise.then(
                    function (enrollment) {
                        switch (enrollment.idgroup) {
                        case 1:
                        case 2:
                        case 3:
                        case 4:
                        case 5:
                        case 6:
                        case 7:
                        case 8:
                        case 9:
                        case 10:
                            $scope.transaction.costcenter = 10;
                            break;
                        case 11:
                        case 12:
                        case 13:
                        case 14:
                        case 15:
                        case 16:
                        case 17:
                        case 18:
                        case 19:
                        case 20:
                            $scope.transaction.costcenter = 20;
                            break;
                        case 21:
                        case 22:
                        case 23:
                        case 24:
                        case 25:
                        case 26:
                        case 27:
                        case 28:
                            $scope.transaction.costcenter = 30;
                            break;
                        case 29:
                        case 30:
                        case 31:
                        case 32:
                            $scope.transaction.costcenter = 40;
                            break;
                        default:
                            $scope.transaction.costcenter = 50;
                        }
                    },
                    function (error) {
                        $log.error(error);

                    }
                );


            }],
            template: require('./views/payments/transactions/new.html'),
            link: function (scope, element, attrs, controllerTransactions) {

                //New Transaction
                scope.newTransaction = function () {
                    Transaction.save({
                        payment: scope.payment.idpayment,
                        user: scope.payment.iduser,
                        vouchertype: scope.transaction.vouchertype,
                        accounttype: scope.transaction.accounttype,
                        transactiontype: scope.transaction.idtransactiontype,
                        costcenter: scope.transaction.costcenter,
                        document: scope.transaction.document,
                        description: scope.transaction.description,
                        value: scope.transaction.value,
                        nit: scope.transaction.nit,
                        date: scope.transaction.date,
                        realdate: scope.payment.realdate,
                    }).$promise.then(
                        function () {
                            controllerTransactions.reload();
                        },
                        function () {
                            SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                        }
                    );
                };

            }
        };
    }])
    .directive('sigeTurboPaymentsCalendar', ['$log', 'ASSETS_SERVER', 'SweetAlert', 'Bank', function ($log, ASSETS_SERVER, SweetAlert, Bank) {
        return {
            restrict: 'AE',
            scope: {
                payments: '=',
                serverdate: '@',
            },
            controller: ['$scope', function ($scope) {

                $scope.assets = ASSETS_SERVER;
                $scope.data = {};

                //Get All Banks
                Bank.query({}).$promise.then(
                    function (banks) {
                        $scope.banks = banks;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            template: require('./views/payments/calendar.html'),
            link: function () {

            }
        };
    }
    ])
    .directive('sigeTurboPaymentSearch', ['$log', 'Year', function ($log, Year) {
        return {
            restrict: 'AE',
            scope: {
                search: '=',
                result: '=',
            },
            controller: ['$scope', function ($scope) {
                $scope.showSearch = false;

                $scope.pendings = [
                    {'idpending': 1, 'name': 'N.A'},
                    {'idpending': 2, 'name': '2'},
                    {'idpending': 3, 'name': '3'},
                    {'idpending': 4, 'name': '4'},
                ];

                // Get Years
                Year.query().$promise.then(
                    function (years) {
                        $scope.years = years;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );

            }],
            template: require('./views/global/payment/search.html'),
            link: function ($scope) {

                //Verified Empty Text
                $scope.isEmpty = function (str) {
                    return typeof str == 'string' && !str.trim() || typeof str == 'undefined' || str === null;
                };

                //Search
                $scope.searchForm = function () {
                    $scope.showSearch = true;
                };
                //Watch Year
                $scope.$watch('search.year', function (newYear) {
                    if (isNaN(newYear)) {
                        $scope.search.year = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.year = parseInt(newYear);
                        $scope.result = JSON.stringify($scope.search);
                    }
                });
                //Watch Pending
                $scope.$watch('search.pending', function (newPending) {
                    if (isNaN(newPending)) {
                        $scope.search.pending = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.pending = parseInt(newPending);
                        $scope.result = JSON.stringify($scope.search);
                    }
                });
                //Watch Code
                $scope.$watch('search.code', function (newCode) {
                    if ($scope.isEmpty(newCode)) {
                        $scope.search.code = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.code = newCode;
                        $scope.result = JSON.stringify($scope.search);
                    }
                });
                //Watch Code
                $scope.$watch('search.code_est', function (newCode) {
                    if ($scope.isEmpty(newCode)) {
                        $scope.search.code_est = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.code_est = newCode;
                        $scope.result = JSON.stringify($scope.search);
                    }
                });
                //Watch Family
                $scope.$watch('search.family', function (newFamily) {
                    if ($scope.isEmpty(newFamily)) {
                        $scope.search.family = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.family = newFamily;
                        $scope.result = JSON.stringify($scope.search);
                    }
                });

            }
        };
    }]);
