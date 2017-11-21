'use strict';
import moment from 'moment';

/* Admissions Directives */
angular.module('Admissions.directives', [])
    .directive('appVersion', ['version', function (version) {
        return function (scope, elm) {
            elm.text(version);
        };
    }])
    .directive('sigeTurboStudentVerifyCelular', ['$log', 'User', 'SweetAlert', function ($log, User, SweetAlert) {
        return {
            restrict: 'AE',
            scope: {
                ngModel: '=',
                confirmed: '@',
                user: '@',
            },
            controller: ['$scope', function ($scope) {
                //Scope
                $scope.showForm = false;
                $scope.data = {};
                $scope.celularEnable = true;
                $scope.celularSendEnable = true;
                if (parseInt($scope.confirmed) == 0) {
                    $scope.celularEnable = false;
                }
            }],
            template: require('./views/student/verify/celular.html'),
            link: function ($scope) {
                //Verify Celular
                $scope.verifyCelular = function () {
                    if (parseInt($scope.confirmed) == 0) {
                        User.verifyCelular({celular: $scope.ngModel}).$promise.then(
                            function (result) {
                                if (result.exists) {
                                    SweetAlert.swal({
                                        title: '¿Desea verificarlo?',
                                        text: result.message,
                                        type: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#53BBB4',
                                        confirmButtonText: 'Verificar',
                                        closeOnConfirm: true
                                    },
                                    function (isConfirm) {
                                        if (isConfirm) {
                                            $scope.showForm = true;
                                        } else {
                                            $scope.showForm = false;
                                        }
                                    });
                                } else {
                                    $scope.showForm = true;
                                }
                            },
                            function (error) {
                                SweetAlert.error('Error', 'Se presentó un error al verificar la información: ' + error);
                            }
                        );
                    } else {
                        SweetAlert.swal({
                            title: '¿Desea cambiarlo?',
                            text: 'El número ' + $scope.ngModel + ' ya fue verificado.',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#53BBB4',
                            confirmButtonText: 'Cambiar',
                            closeOnConfirm: true
                        },
                        function (isConfirm) {
                            if (isConfirm) {
                                $scope.celularEnable = false;
                                $scope.confirmed = 0;
                            }
                        });
                    }
                };

                //Send SMS
                $scope.sendCelularMessage = function () {
                    $scope.data.passcode = 'Sending ...';
                    if ($scope.celularSendEnable == true) {
                        User.verifyCelularMessage({user: $scope.user, celular: $scope.ngModel}).$promise.then(
                            function (result) {
                                $log.info(result);
                                $scope.celularSendEnable == false;
                                $scope.data.passcode = 'Sent';
                            },
                            function (error) {
                                $log.error(error);
                                $scope.celularSendEnable == true;
                            }
                        );
                    }
                };

                //Save Celular By Passcode
                $scope.saveCelularByPasscode = function () {
                    User.saveCelularByPasscode({
                        user: $scope.user,
                        celular: $scope.ngModel,
                        passcode: $scope.data.passcode
                    }).$promise.then(
                        function () {
                            $scope.showForm = false;
                            $scope.confirmed = 1;
                        },
                        function () {
                            $scope.showForm = true;
                            $scope.confirmed = 0;
                        }
                    );
                };

                //Save Celular By Certification
                $scope.saveCelularByCertification = function () {
                    User.saveCelularByCertification({
                        user: $scope.user,
                        celular: $scope.ngModel
                    }).$promise.then(
                        function () {
                            $scope.showForm = false;
                            $scope.confirmed = 1;
                        },
                        function () {
                            $scope.showForm = true;
                            $scope.confirmed = 0;
                        }
                    );
                };

                //Close
                $scope.close = function () {
                    $scope.showForm = false;
                };

            }
        };
    }])
    .directive('sigeTurboStudentVerifyEmail', ['$log', 'User', 'SweetAlert', function ($log, User, SweetAlert) {
        return {
            restrict: 'AE',
            scope: {
                ngModel: '=',
                confirmed: '@',
                user: '@',
            },
            controller: ['$scope', function ($scope) {
                //Scope
                $scope.showForm = false;
                $scope.data = {};
                $scope.emailEnable = true;
                if (parseInt($scope.confirmed) == 0) {
                    $scope.emailEnable = false;
                }
            }],
            template: require('./views/student/verify/email.html'),
            link: function ($scope) {
                //Verify Email
                $scope.verifyEmail = function () {
                    if (parseInt($scope.confirmed) == 0) {
                        User.verifyEmail({email: $scope.ngModel}).$promise.then(
                            function (result) {
                                if (result.exists) {
                                    SweetAlert.swal({
                                        title: '¿Desea verificarlo?',
                                        text: result.message,
                                        type: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#53BBB4',
                                        confirmButtonText: 'Verificar',
                                        closeOnConfirm: true
                                    },
                                    function (isConfirm) {
                                        if (isConfirm) {
                                            $scope.showForm = true;
                                        } else {
                                            $scope.showForm = false;
                                        }
                                    });
                                } else {
                                    $scope.showForm = true;
                                }
                            },
                            function (error) {
                                SweetAlert.error('Error', 'Se presentó un error al verificar la información: ' + error);
                            }
                        );
                    } else {
                        SweetAlert.swal({
                            title: '¿Desea cambiarlo?',
                            text: 'El correo ' + $scope.ngModel + ' ya fue verificado.',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#53BBB4',
                            confirmButtonText: 'Cambiar',
                            closeOnConfirm: true
                        },
                        function (isConfirm) {
                            if (isConfirm) {
                                $scope.emailEnable = false;
                                $scope.confirmed = 0;
                            }
                        });
                    }
                };

                //Send Email
                $scope.sendEmailMessage = function () {
                    User.verifyEmailMessage({user: $scope.user, email: $scope.ngModel}).$promise.then(
                        function (result) {
                            $log.info(result);
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );
                };

                //Save Email By Passcode
                $scope.saveEmailByPasscode = function () {
                    User.saveEmailByPasscode({
                        user: $scope.user,
                        email: $scope.ngModel,
                        passcode: $scope.data.passcode
                    }).$promise.then(
                        function () {
                            $scope.showForm = false;
                            $scope.confirmed = 1;
                        },
                        function () {
                            $scope.showForm = true;
                            $scope.confirmed = 0;
                        }
                    );
                };

                //Save Email By Certification
                $scope.saveEmailByCertification = function () {
                    User.saveEmailByCertification({
                        user: $scope.user,
                        email: $scope.ngModel
                    }).$promise.then(
                        function () {
                            $scope.showForm = false;
                            $scope.confirmed = 1;
                        },
                        function () {
                            $scope.showForm = true;
                            $scope.confirmed = 0;
                        }
                    );
                };

                //Close
                $scope.close = function () {
                    $scope.showForm = false;
                };

            }
        };
    }])
    .directive('sigeTurboEnrollments', ['$log', 'Enrollment', function ($log, Enrollment) {
        return {
            restrict: 'AE',
            scope: {
                student: '@'
            },
            controller: ['$scope', function ($scope) {
                Enrollment.getEnrollmentsByStudent({'student': $scope.student}).$promise.then(
                    function (enrollments) {
                        $scope.enrollments = enrollments;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );

            }],
            template: require('./views/enrollment/list.html'),
            link: function () {
            }
        };
    }])
    .directive('sigeTurboEnrollment', ['$log', 'SweetAlert', 'ASSETS_SERVER', 'Group', 'Enrollment', function ($log, SweetAlert, ASSETS_SERVER, Group, Enrollment) {
        return {
            restrict: 'AE',
            scope: {
                enrollment: '='
            },
            controller: ['$scope', 'Year', 'Statusschooltype', function ($scope, Year, Statusschooltype) {
                //Scope
                $scope.assets = ASSETS_SERVER;
                $scope.showItems = false;
                $scope.showItemsTitle = 'Show';
                // Get Years
                Year.query().$promise.then(
                    function (years) {
                        $scope.years = years;
                        //Get Groups
                        Group.getGroupsByYearAndPeriod({
                            year: $scope.enrollment.idyear,
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
                    function (statusschooltypes) {
                        $scope.statusschooltypes = statusschooltypes;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );

                //Show Items Extended
                $scope.showItemsExtended = function () {
                    $scope.showItems = !$scope.showItems;
                    if ($scope.showItems) {
                        $scope.showItemsTitle = 'Hide';
                    } else {
                        $scope.showItemsTitle = 'Show';
                    }
                };

            }],
            template: require('./views/enrollment/enrollment.html'),
            link: function ($scope) {

                //Change Reentry
                $scope.$watch('enrollment.idyear', function (newYear, oldYear) {
                    if (newYear != oldYear) {
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

                //Change Reentry
                $scope.$watch('enrollment.reentry', function (newReentry) {
                    if (newReentry == 'Y') {
                        $scope.enrollment.reentry = true;
                    } else if (newReentry == 'N') {
                        $scope.enrollment.reentry = false;
                    }
                });

                //Change Inclusion
                $scope.$watch('enrollment.inclusion', function (newInclusion) {
                    if (newInclusion == 'Y') {
                        $scope.enrollment.inclusion = true;
                    } else if (newInclusion == 'N') {
                        $scope.enrollment.inclusion = false;
                    }
                });

                //Change Fieldtrip
                $scope.$watch('enrollment.fieldtrip', function (newFieldtrip) {
                    if (newFieldtrip == 'Y') {
                        $scope.enrollment.fieldtrip = true;
                    } else if (newFieldtrip == 'N') {
                        $scope.enrollment.fieldtrip = false;
                    }
                });

                //Change Isapprovedyear
                $scope.$watch('enrollment.isapprovedyear', function (newIsapprovedyear) {
                    if (newIsapprovedyear == 'Y') {
                        $scope.enrollment.isapprovedyear = true;
                    } else if (newIsapprovedyear == 'N') {
                        $scope.enrollment.isapprovedyear = false;
                    }
                });

                //Change StatusType
                $scope.$watch('enrollment.idstatusschooltype', function (newStatus, oldStatus) {
                    if (newStatus != oldStatus) {
                        $scope.enrollment.statusdate = moment().add($scope.statusschooltypes[newStatus - 1].duration, 'days').format('YYYY-MM-DD');
                        if (parseInt(newStatus) == 4) {
                            $scope.showItems = true;
                            $scope.showItemsTitle = 'Hide';
                        } else {
                            $scope.showItems = false;
                            $scope.showItemsTitle = 'Show';
                        }
                    }
                });

                //Update Enrollment
                $scope.updateEnrollment = function () {

                    Enrollment.update({
                        idenrollment: $scope.enrollment.idenrollment,
                        year: $scope.enrollment.idyear,
                        group: $scope.enrollment.idgroup,
                        register: $scope.enrollment.register,
                        status: $scope.enrollment.idstatusschooltype,
                        statusdate: $scope.enrollment.statusdate,
                        scholarship: parseFloat($scope.enrollment.scholarship),
                        reentry: $scope.enrollment.reentry,
                        inclusion: $scope.enrollment.inclusion,
                        fieldtrip: $scope.enrollment.fieldtrip,
                        isapprovedyear: $scope.enrollment.isapprovedyear,
                        observation: ($scope.enrollment.observation == '') ? null : $scope.enrollment.observation,
                    }).$promise.then(
                        function (enrollment) {
                            SweetAlert.success('Excelente', enrollment.message);
                        },
                        function (error) {
                            SweetAlert.error('Error', 'Se ha presentado un error al guardar la información: ' + error);
                        }
                    );
                };

            }
        };
    }])
    .directive('sigeTurboEnrollmentNew', ['$log', 'SweetAlert', 'ASSETS_SERVER', 'Group', 'Enrollment', '$window', function ($log, SweetAlert, ASSETS_SERVER, Group, Enrollment, $window) {
        return {
            restrict: 'AE',
            scope: {
                user: '=',
                year: '=',
            },
            controller: ['$scope', 'Year', 'Statusschooltype', function ($scope, Year, Statusschooltype) {

                //Scope
                $scope.assets = ASSETS_SERVER;
                $scope.enrollment = {
                    student: $scope.user,
                    register: moment().format('YYYY-MM-DD'),
                    scholarship: '0.00',
                    reentry: false,
                    inclusion: false
                };

                // Get Years
                Year.query().$promise.then(
                    function (years) {
                        $scope.years = years;
                        $scope.enrollment.idyear = 2017;
                        //Get Groups
                        Group.getGroupsByYearAndPeriod({
                            year: $scope.year,
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
                    function (statusschooltypes) {
                        $scope.statusschooltypes = statusschooltypes;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            template: require('./views/enrollment/new.html'),
            link: function ($scope) {

                //Change Reentry
                $scope.$watch('enrollment.idyear', function (newYear, oldYear) {
                    if (newYear != oldYear) {
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

                //Change StatusType
                $scope.$watch('enrollment.idstatusschooltype', function (newStatus, oldStatus) {
                    if (newStatus != oldStatus) {
                        if (newStatus != null && newStatus != undefined) {
                            $scope.enrollment.statusdate = moment().add($scope.statusschooltypes[newStatus - 1].duration, 'days').format('YYYY-MM-DD');
                        } else {
                            $scope.enrollment.statusdate = undefined;
                        }
                    }
                });

                //new Enrollment
                $scope.newEnrollment = function () {

                    if ($scope.enrollment.idenrollment == undefined) {

                        SweetAlert.swal({
                            title: '¿Está seguro?',
                            text: 'Una vez asigne al estudiante la Admisión se genera un cobro por concepto de Matrícula y Pensión. Solo Aplica para el estado: PREMATRICULADO',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#53BBB4',
                            confirmButtonText: 'Asignar',
                            closeOnConfirm: false
                        },
                        function (isConfirm) {
                            if (isConfirm) {
                                //Save Enrollment
                                Enrollment.save({
                                    year: $scope.enrollment.idyear,
                                    group: $scope.enrollment.idgroup,
                                    student: $scope.user,
                                    register: $scope.enrollment.register,
                                    status: $scope.enrollment.idstatusschooltype,
                                    statusdate: $scope.enrollment.statusdate,
                                    scholarship: 0,
                                    reentry: $scope.enrollment.reentry,
                                    inclusion: $scope.enrollment.inclusion
                                }).$promise.then(
                                    function (result) {
                                        $scope.enrollment.idenrollment = result.enrollment.idenrollment;
                                        SweetAlert.success('Excelente', result.message);
                                        //Reload
                                        $window.location.reload()
                                    },
                                    function () {
                                        SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                                    }
                                );
                            }

                        });

                    } else {
                        //Update Enrollment
                        Enrollment.update({
                            idenrollment: $scope.enrollment.idenrollment,
                            year: $scope.enrollment.idyear,
                            group: $scope.enrollment.idgroup,
                            register: $scope.enrollment.register,
                            status: $scope.enrollment.idstatusschooltype,
                            statusdate: $scope.enrollment.statusdate,
                            scholarship: 0,
                            reentry: $scope.enrollment.reentry,
                            inclusion: $scope.enrollment.inclusion
                        }).$promise.then(
                            function (enrollment) {
                                SweetAlert.success('Excelente', enrollment.message);
                            },
                            function (error) {
                                SweetAlert.error('Error', 'Se ha presentado un error al guardar la información: ' + error);
                            }
                        );
                    }
                };

            }
        };
    }])
    .directive('sigeTurboAdmissionSearch', ['$log', 'Year', 'Group', 'Statusschooltype', function ($log, Year, Group, Statusschooltype) {
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
            template: require('./views/global/admission/search.html'),
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
    .directive('sigeTurboAdmissionSearchUser', ['$log', 'Category', function ($log, Category) {
        return {
            restrict: 'AE',
            scope: {
                search: '=',
                result: '=',
            },
            controller: ['$scope', function ($scope) {
                $scope.showSearch = false;
                //Get Status
                Category.query({}).$promise.then(
                    function (categories) {
                        $scope.categories = categories;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            template: require('./views/global/admission/searchuser.html'),
            link: function ($scope) {
                //Verified Empty Text
                $scope.isEmpty = function (str) {
                    return typeof str == 'string' && !str.trim() || typeof str == 'undefined' || str === null;
                };
                //Search
                $scope.searchForm = function () {
                    $scope.showSearch = true;
                };
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
                //Watch Code
                $scope.$watch('search.celular', function (newCelular) {
                    if (isNaN(newCelular)) {
                        $scope.search.celular = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.celular = newCelular;
                        $scope.result = JSON.stringify($scope.search);
                    }
                });
                //Watch Category
                $scope.$watch('search.category', function (newCategory) {
                    $scope.search.category = newCategory;
                    $scope.result = JSON.stringify($scope.search);
                });
            }
        };
    }])
    .directive('sigeTurboAdmissionsFamilyAssign', ['$log', 'Family', 'ASSETS_SERVER', function ($log, Family, ASSETS_SERVER) {
        return {
            restrict: 'AE',
            scope: {
                family: '=',
                family_name: '@',
            },
            controller: ['$scope', function ($scope) {
                //Scope
                $scope.assets = ASSETS_SERVER;
                $scope.showFamilies = true;

                Family.getFamilies({}).$promise.then(
                    function (families) {
                        $scope.families = families;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );

                $scope.close = function () {
                    $scope.showFamilies = false;
                };

            }],
            template: require('./views/families/select.html'),
            link: function (scope) {
                //Verified Empty Text
                scope.isEmpty = function (str) {
                    return typeof str == 'string' && !str.trim() || typeof str == 'undefined' || str === null;
                };

                scope.selectFamily = function (family) {
                    scope.family_name = family.name;
                    scope.family = family;
                    scope.showFamilies = false;
                };

                scope.$watch('family_name', function (newFamily) {
                    if (newFamily != undefined || !scope.isEmpty(newFamily)) {
                        scope.showFamilies = true;
                    }
                });
            }
        };
    }])
    .directive('sigeTurboAdmissionSearchStudent', [function () {
        return {
            restrict: 'AE',
            scope: {
                search: '=',
                result: '=',
            },
            controller: ['$scope', function ($scope) {
                $scope.showSearch = false;
                //Close
                $scope.close = function () {
                    $scope.showSearch = false;
                };
            }],
            template: require('./views/global/admission/searchallstudents.html'),
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
                $scope.$watch('search.mostrar', function (newRating) {
                    if (newRating == '') {
                        $scope.search.mostrar = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.mostrar = newRating;
                        $scope.result = JSON.stringify($scope.search);
                    }
                });

                //Watch User 
                $scope.$watch('search.iduser', function (newUser, oldUser) {
                    if (newUser != oldUser) {
                        if (newUser == '' || newUser == null || newUser == null) {
                            $scope.search.iduser = '';
                            $scope.result = JSON.stringify($scope.search);
                        } else {
                            if (typeof oldUser != 'object') {
                                $scope.search.iduser = newUser;
                            } else {
                                $scope.search.iduser = newUser.iduser;
                                $scope.search.idyear = newUser.Lastyear;
                            }
                            $scope.result = JSON.stringify($scope.search);
                        }
                    }
                });

                //Watch Year
                $scope.$watch('search.idyear', function (newYear) {
                    if (isNaN(newYear)) {
                        $scope.search.idyear = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.idyear = parseInt(newYear);
                        $scope.result = JSON.stringify($scope.search);
                    }
                });
            }
        };
    }])
    .directive('sigeTurboTransportSearch', [function () {
        return {
            restrict: 'AE',
            scope: {
                search: '=',
                result: '=',
            },
            controller: ['$scope', function ($scope) {
                $scope.showSearch = false;
                //Close
                $scope.close = function () {
                    $scope.showSearch = false;
                };
                $scope.search.iduser = '';
            }],
            template: require('./views/global/transport/search.html'),
            link: function ($scope) {
                //Verified Empty Text
                $scope.isEmpty = function (str) {
                    return typeof str == 'string' && !str.trim() || typeof str == 'undefined' || str === null;
                };
                //Search
                $scope.searchForm = function () {
                    $scope.showSearch = true;
                };
                //Watch Firstname
                $scope.$watch('search.idroute', function (newCode) {
                    if ($scope.isEmpty(newCode)) {
                        $scope.search.idroute = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.idroute = newCode;
                        $scope.result = JSON.stringify($scope.search);
                    }
                });
                //Watch Lastname
                $scope.$watch('search.name', function (newName) {
                    if ($scope.isEmpty(newName)) {
                        $scope.search.name = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.name = newName;
                        $scope.result = JSON.stringify($scope.search);
                    }
                });
                //Watch User
                $scope.$watch('search.iduser', function (newUser, oldUser) {
                    if (newUser != oldUser) {
                        if ($scope.isEmpty(newUser)) {
                            $scope.search.iduser = undefined;
                            $scope.result = JSON.stringify($scope.search);
                        } else {
                            if (typeof oldUser != 'object') {
                                $scope.search.iduser = newUser.iduser;
                                $scope.result = JSON.stringify($scope.search);

                            }
                        }
                    }
                });
            }
        };
    }])
    .directive('sigeTurboAdmissionsRouteActual', ['$controller', '$filter', function ($controller, $filter) {
        return {
            restrict: 'AE',
            scope: {
                vehicles: '=',
                conveyors: '=',
                routeactual: '@',
            },
            controller: ['$scope', function ($scope) {
                $scope.launch = function ($object) {
                    if ($object) {
                        $scope.route = $object;
                        $scope.vehicleactual = $scope.actuals('idvehicle', 'idvehicle', $scope.vehicles);
                        $scope.conveyorctual = $scope.actuals('idconveyor', 'idconveyor', $scope.conveyors);
                        $scope.companionactual = $scope.actuals('idconveyor', 'idcompanion', $scope.conveyors);
                    } else $scope.route = $scope.$eval($scope.routeactual);
                };
                $scope.launch();
                $scope.actuals = function ($propierty, $propiertyroute, $array) {
                    return $filter('getByProperty')($propierty, $scope.route[$propiertyroute], $array);
                };
            }],
            template: require('./views/transports/routeinformation.html'),
            link: function (scope, element, attr, controller) {
                $controller('TransportsController', {
                    $scope: scope,
                    $element: element,
                    $attr: attr,
                    controller: controller
                });
                scope.editform = function (form, $items, $id) {
                    var $name = '';
                    var $title = '';
                    switch (form) {
                    case 'conveyor':
                        $name = 'idconveyor';
                        $title = 'Editar Conductor';
                        break;
                    case 'vehicle':
                        $name = 'idvehicle';
                        $title = 'Editar Vehículo';
                        break;
                    case 'route':
                        $name = 'idroute';
                        $title = 'Editar Ruta';
                        break;
                    }
                    var item = (form == 'route') ? $items : $filter('getByProperty')($name, $id, $items);
                    scope.dialogsforms(form, $title, item);
                };

                scope.$watch('vehicles', function (newVehicle) {
                    if ((newVehicle != undefined && newVehicle != '') && (typeof newVehicle == 'object')) {
                        scope.vehicleactual = scope.actuals('idvehicle', 'idvehicle', scope.vehicles);
                    }
                });

                scope.$watch('conveyors', function (newConveyor) {
                    if ((newConveyor != undefined && newConveyor != '') && (typeof newConveyor == 'object')) {
                        scope.conveyorctual = scope.actuals('idconveyor', 'idconveyor', scope.conveyors);
                        scope.companionactual = scope.actuals('idconveyor', 'idcompanion', scope.conveyors);
                    }
                });
            }
        };
    }])
    .directive('sigeTurboAdmissionsTransportRoute', ['$log', 'SweetAlert', 'Route', 'ngDialog', '$window', function ($log, SweetAlert, Route, ngDialog, $window) {
        return {
            restrict: 'AE',
            scope: {
                route: '=',
                vehicles: '=',
                conveyors: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.routeform = angular.copy($scope.route); //Independización del Array para que no se dañe el orginal si no hay POST | Actaulizacion o Modificación
            }],
            template: require('./views/transports/route.html'),
            link: function (scope) {
                scope.SaveRoute = function () {
                    if (scope.route.idroute) {
                        Route.update(scope.routeform).$promise.then(
                            function (result) {
                                scope.route.idvehicle = scope.routeform.idvehicle;
                                scope.route.idconveyor = scope.routeform.idconveyor;
                                scope.route.idcompanion = scope.routeform.idcompanion;
                                scope.route.name = scope.routeform.name;
                                scope.route.hour = scope.routeform.hour;
                                SweetAlert.success('Excelente', result.message);
                                angular.element(document.getElementById('routeinformation')).scope().$$childTail.$$prevSibling.launch(scope.route);
                                ngDialog.close();
                            },
                            function (error) {
                                $log.error(error);
                                SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                            }
                        );
                    } else {
                        Route.save(scope.routeform).$promise.then(
                            function (result) {
                                SweetAlert.success('Excelente', result.message);
                                ngDialog.close();
                                //search = {lastpage:true,page:1};
                                $window.location.href = '/admissions/transports?search=' + encodeURIComponent(JSON.stringify({
                                    'lastpage': true,
                                    'name': null,
                                    'iduser': null,
                                    'idroute': null
                                })).replace(/[!'()]/g, escape).replace(/\*/g, '%2A') + '&page=' + 1;
                            },
                            function (error) {
                                $log.error(error);
                                SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                            }
                        );
                    }
                };
            }
        };
    }])
    .directive('sigeTurboAdmissionsUsersbyroute', ['ASSETS_SERVER', '$controller', function (ASSETS_SERVER, $controller) {
        return {
            restrict: 'AE',
            scope: {
                usersinroute: '@',
            },
            controller: ['$scope', function ($scope) {
                $scope.assets = ASSETS_SERVER;
                $scope.launch = function ($array) {
                    (!$array) ? $scope.usersbyroute = $scope.$eval($scope.usersinroute) : $scope.usersbyroute = $array;
                };
                $scope.launch();
            }],
            template: require('./views/users/usersbyroute.html'),
            link: function (scope, element, attr, controller) {
                $controller('TransportsController', {
                    $scope: scope,
                    $element: element,
                    $attr: attr,
                    controller: controller
                });
            }
        };
    }])
    .directive('sigeTurboAdmissionsUserAssign', ['$log', 'User', 'Routebyuser', 'SweetAlert', 'ASSETS_SERVER', 'ngDialog', '$controller', '$filter', function ($log, User, Routebyuser, SweetAlert, ASSETS_SERVER, ngDialog, $controller, $filter) {
        return {
            restrict: 'AE',
            scope: {
                destination: '@',
                route: '=',
                user: '=',
                user_name: '@',
                widthdefault: '@',
                showusers: '@',
                userdefault: '='
            },
            controller: ['$scope', function ($scope) {
                //Scope
                $scope.assets = ASSETS_SERVER;
                $scope.showUsers = true;
                User[$scope.showusers]({}).$promise.then(
                    function (users) {
                        $scope.users = users;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );

                $scope.close = function () {
                    $scope.showUsers = false;
                };

            }],
            template: require('./views/users/select.html'),
            link: function (scope, element, attr, controller) {
                $controller('TransportsController', {
                    $scope: scope,
                    $element: element,
                    $attr: attr,
                    controller: controller
                });

                //Verified Empty Text
                scope.isEmpty = function (str) {
                    return typeof str == 'string' && !str.trim() || typeof str == 'undefined' || str === null;
                };

                scope.AddUser = function (user) {
                    scope.user_name = (user == null || Object.keys(user).length == 0) ? '' : user.firstname + ' ' + user.lastname;
                    scope.user = user;
                    scope.showUsers = false;
                };

                scope.AddToRoute = function (iduser, idroute) {
                    Routebyuser.save({
                        'user': iduser,
                        'route': idroute
                    }).$promise.then(
                        function (result) {
                            SweetAlert.success('Excelente', result.message);
                            scope.showUsers = false;
                            angular.element(document.getElementById('usersinthisroute')).scope().$$childTail.$$prevSibling.launch(result.routebyuserRepository);
                            /*Acceder al metodo de la directiva sigeTurboAdmissionsUsersbyroute ya que no tiene asociación con esta directiva */
                            ngDialog.close();
                        },
                        function (error) {
                            $log.error(error);
                            SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                        }
                    );
                };

                scope.$watch('user_name', function (newFamily) {
                    if (newFamily != undefined || !scope.isEmpty(newFamily)) {
                        scope.showUsers = true;

                    }
                    if (newFamily == undefined || scope.isEmpty(newFamily)) {
                        scope.userdefault = undefined;
                        scope.AddUser({});
                    }
                });
                scope.$watch('userdefault', function (newUser, oldUser) {
                    if ((newUser != undefined || !scope.isEmpty(newUser)) || (newUser != oldUser)) {
                        var usershow = $filter('getByProperty')('iduser', newUser, scope.users);
                        scope.AddUser(usershow);
                        scope.showUsers = false;
                    }
                });
            }
        };
    }])
    .directive('sigeTurboAdmissionsTransportConvenyor', ['$log', 'SweetAlert', 'Conveyor', 'ngDialog', function ($log, SweetAlert, Conveyor, ngDialog) {
        return {
            restrict: 'AE',
            scope: {
                conveyor: '=',
                conveyors: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.conveyorform = angular.copy($scope.conveyor); //Independización del Array para que no se dañe el orginal si no hay POST | Actaulizacion o Modificación
            }],
            template: require('./views/transports/convenyor.html'),
            link: function (scope) {
                scope.SaveConvenyor = function () {
                    if (scope.conveyor.idconveyor) {
                        //Update Conveyor
                        Conveyor.update(scope.conveyorform).$promise.then(
                            function (result) {
                                scope.conveyor.firstname = scope.conveyorform.firstname;
                                scope.conveyor.lastname = scope.conveyorform.lastname;
                                scope.conveyor.celular = scope.conveyorform.celular;
                                SweetAlert.success('Excelente', result.message);
                                ngDialog.close();
                            },
                            function (error) {
                                $log.error(error);
                                SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                            }
                        );
                    } else {
                        Conveyor.save(scope.conveyorform).$promise.then(
                            function (result) {
                                scope.conveyorform.idconveyor = result.idconveyor;
                                SweetAlert.success('Excelente', result.message);
                                ngDialog.close();
                                scope.conveyors.push(scope.conveyorform);
                            },
                            function (error) {
                                $log.error(error);
                                SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                            }
                        );
                    }
                };
            }
        };
    }])
    .directive('sigeTurboAdmissionsTransportVehicle', ['$log', 'SweetAlert', 'Vehicle', 'ngDialog', function ($log, SweetAlert, Vehicle, ngDialog) {
        return {
            restrict: 'AE',
            scope: {
                vehicle: '=',
                vehicles: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.vehicleform = angular.copy($scope.vehicle); //Independización del Array para que no se dañe el orginal si no hay POST| Actaulizacion o Modificación
            }],
            template: require('./views/transports/vehicle.html'),
            link: function (scope) {
                scope.SaveVehicle = function () {
                    if (scope.vehicle.idvehicle) {
                        //Update Vehicle
                        Vehicle.update(scope.vehicleform).$promise.then(
                            function (result) {
                                scope.vehicle.plate = scope.vehicleform.plate;
                                scope.vehicle.type = scope.vehicleform.type;
                                SweetAlert.success('Excelente', result.message);
                                ngDialog.close();
                            },
                            function (error) {
                                $log.error(error);
                                SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                            }
                        );
                    } else {
                        Vehicle.save(scope.vehicleform).$promise.then(
                            function (result) {
                                scope.vehicleform.idvehicle = result.idvehicle;
                                SweetAlert.success('Excelente', result.message);
                                ngDialog.close();
                                scope.vehicles.push(scope.vehicleform);
                            },
                            function (error) {
                                $log.error(error);
                                SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                            }
                        );
                    }
                };
            }
        };
    }])
    .directive('sigeTurboAdmissionExport', ['$log', 'ASSETS_SERVER', 'Export', function ($log, ASSETS_SERVER, Export) {
        return {
            restrict: 'AE',
            scope: {
                year: '@'
            },
            controller: ['$scope', function ($scope) {
                $scope.showDownload = false;
                $scope.assets = ASSETS_SERVER;
            }],
            template: require('./views/global/admission/export.html'),
            link: function ($scope) {
                $scope.export = function (filename, format) {
                    $scope.showDownload = false;
                    Export.getEnrollmentsReport({
                        'filename': filename,
                        'format': format,
                        'year': $scope.year
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
    .directive('sigeTurboAdmissionsRecoveryFinal', ['$log', 'SweetAlert', 'Quantitativerecoveryfinalarea', 'Area', 'Year', 'Group', '$window', function ($log, SweetAlert, Quantitativerecoveryfinalarea, Area, Year, Group, $window) {
        return {
            restrict: 'AE',
            scope: {
                recovery: '@',
                search: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.provenances = [{'idprovenance': 1, 'name': 'Interna'}, {'idprovenance': 2, 'name': 'Externa'}];
                // Get Years
                Year.query().$promise.then(
                    function (years) {
                        $scope.years = years;
                        //Get Groups
                        Group.all('').$promise.then(
                            function (groups) {
                                $scope.groups = groups;
                                //Get Areas
                                Area.all('').$promise.then(
                                    function (areas) {
                                        $scope.areas = areas;
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
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            template: require('./views/quantitativerecoveryfinalarea/save1290.html'),
            link: function (scope) {
                //Watch User
                scope.$watch('recovery', function (newRecovery, oldRecovery) {
                    if (newRecovery != oldRecovery || newRecovery === oldRecovery) {
                        scope.recoveryfinalform = angular.copy(JSON.parse(scope.recovery)); //Independización del Array para que no se dañe el orginal si no hay POST | Actaulizacion o Modificación
                    }
                });
                scope.SaveQuantitativerecoveryfinalarea = function () {
                    if (JSON.parse(scope.recovery)['idquantitativerecoveryfinalarea']) {//ESTA CONDICION CON EL PARSE JASON ES PORQUE LLEGA CONVERTIDO COMO0 STRING
                        Quantitativerecoveryfinalarea.update(scope.recoveryfinalform).$promise.then(
                            function (result) {
                                SweetAlert.success('Excelente', result.message);
                                $window.location.href = '/admissions/getrecoveriesbyuser?search=' + encodeURIComponent(JSON.stringify(scope.search)).replace(/[!'()]/g, escape).replace(/\*/g, '%2A') + '&page=' + scope.search.page;
                            },
                            function (error) {
                                $log.error(error);
                                SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                            }
                        );
                    } else {
                        Quantitativerecoveryfinalarea.save(scope.recoveryfinalform).$promise.then(
                            function (result) {
                                SweetAlert.success('Excelente', result.message);
                                //search = {lastpage:true,page:1};
                                $window.location.href = '/admissions/getrecoveriesbyuser?search=' + encodeURIComponent(JSON.stringify(scope.search)).replace(/[!'()]/g, escape).replace(/\*/g, '%2A') + '&page=' + scope.search.page;
                            },
                            function (error) {
                                $log.error(error);
                                SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                            }
                        );
                    }
                };

            }
        };
    }])
    .directive('sigeTurboAdmissionsRecoveryFinalQualitative', ['$log', 'SweetAlert', 'Qualitativerecoveryfinalarea', 'Area', 'Year', 'Group', '$window', function ($log, SweetAlert, Qualitativerecoveryfinalarea, Area, Year, Group, $window) {
        return {
            restrict: 'AE',
            scope: {
                recoveryquali: '@',
                search: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.provenances = [{'idprovenance': 1, 'name': 'Interna'}, {'idprovenance': 2, 'name': 'Externa'}];
                $scope.assessments = [{'idassessment': 1, 'name': 'Excelente'}, {
                    'idassessment': 2,
                    'name': 'Sobresaliente'
                }, {'idassessment': 3, 'name': 'Aceptable'}, {
                    'idassessment': 4,
                    'name': 'Insuficiente'
                }, {'idassessment': 5, 'name': 'Deficiente'}];
                // Get Years
                Year.query().$promise.then(
                    function (years) {
                        $scope.years = years;
                        //Get Groups
                        Group.all('').$promise.then(
                            function (groups) {
                                $scope.groups = groups;
                                //Get Areas
                                Area.all('').$promise.then(
                                    function (areas) {
                                        $scope.areas = areas;
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
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            template: require('./views/quantitativerecoveryfinalarea/save0230.html'),
            link: function (scope) {
                //Watch User
                scope.$watch('recoveryquali', function (newRecovery, oldRecovery) {
                    if (newRecovery != oldRecovery || newRecovery === oldRecovery) {
                        scope.recoveryfinalform = angular.copy(JSON.parse(scope.recoveryquali)); //Independización del Array para que no se dañe el orginal si no hay POST | Actaulizacion o Modificación
                    }
                });
                scope.SaveQualitativerecoveryfinalarea = function () {
                    if (JSON.parse(scope.recoveryquali)['idqualitativerecoveryfinalarea']) {//ESTA CONDICION CON EL PARSE JASON ES PORQUE LLEGA CONVERTIDO COMO0 STRING
                        Qualitativerecoveryfinalarea.update(scope.recoveryfinalform).$promise.then(
                            function (result) {
                                SweetAlert.success('Excelente', result.message);
                                $window.location.href = '/admissions/getrecoveriesbyuser?search=' + encodeURIComponent(JSON.stringify(scope.search)).replace(/[!'()]/g, escape).replace(/\*/g, '%2A') + '&page=' + scope.search.page;
                            },
                            function (error) {
                                $log.error(error);
                                SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                            }
                        );
                    } else {
                        Qualitativerecoveryfinalarea.save(scope.recoveryfinalform).$promise.then(
                            function (result) {
                                SweetAlert.success('Excelente', result.message);
                                //search = {lastpage:true,page:1};
                                $window.location.href = '/admissions/getrecoveriesbyuser?search=' + encodeURIComponent(JSON.stringify(scope.search)).replace(/[!'()]/g, escape).replace(/\*/g, '%2A') + '&page=' + scope.search.page;
                            },
                            function (error) {
                                $log.error(error);
                                SweetAlert.error('Error', 'Se ha presentado un error al guardar la información');
                            }
                        );
                    }
                };

            }
        };
    }])
    .directive('sigeTurboAdmissionsAssignOrSelectedStudents', ['$log', 'User', 'SweetAlert', 'ASSETS_SERVER', '$filter', function ($log, User, SweetAlert, ASSETS_SERVER, $filter) {
        return {
            restrict: 'AE',
            scope: {
                destination: '@',
                route: '=',
                user: '=',
                user_name: '@',
                widthdefault: '@',
                showusers: '@',
                userdefault: '='
            },
            controller: ['$scope', function ($scope) {
                //Scope
                $scope.assets = ASSETS_SERVER;
                $scope.showUsers = true;
                User[$scope.showusers]({}).$promise.then(
                    function (users) {
                        $scope.users = users;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );

                $scope.close = function () {
                    $scope.showUsers = false;
                };

            }],
            template: require('./views/student/select.html'),
            link: function (scope) {

                //Verified Empty Text
                scope.isEmpty = function (str) {
                    return typeof str == 'string' && !str.trim() || typeof str == 'undefined' || str === null;
                };

                scope.AddUser = function (user) {
                    scope.user_name = (user == null || Object.keys(user).length == 0) ? '' : user.firstname + ' ' + user.lastname;
                    scope.user = user;
                    scope.showUsers = false;
                };

                scope.$watch('user_name', function (newUser) {
                    if (newUser != undefined || !scope.isEmpty(newUser)) {
                        scope.showUsers = true;
                    }
                    if (newUser == undefined || scope.isEmpty(newUser)) {
                        scope.userdefault = undefined;
                        scope.AddUser({});
                    }
                });
                scope.$watch('userdefault', function (newUser, oldUser) {
                    if ((newUser != undefined || !scope.isEmpty(newUser)) || (newUser != oldUser)) {
                        var usershow = $filter('getByProperty')('iduser', newUser, scope.users);
                        scope.AddUser(usershow);
                        scope.showUsers = false;
                    }
                });
            }
        };
    }])
    .directive('sigeTurboAdmissionsAssignOrSelectedStudentsRecoveriesSearch', ['$log', 'User', 'SweetAlert', 'ASSETS_SERVER', '$filter', function ($log, User, SweetAlert, ASSETS_SERVER, $filter) {
        return {
            restrict: 'AE',
            scope: {
                destination: '@',
                route: '=',
                user: '=',
                user_name: '@',
                widthdefault: '@',
                showusers: '@',
                userdefault: '='
            },
            controller: ['$scope', function ($scope) {
                //Scope
                $scope.assets = ASSETS_SERVER;
                $scope.showUsers = true;
                User[$scope.showusers]({}).$promise.then(
                    function (users) {
                        $scope.users = users;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );

                $scope.close = function () {
                    $scope.showUsers = false;
                };

            }],
            template: require('./views/student/select.html'),
            link: function (scope) {

                scope.$watch('users', function (newUsers) {
                    if (newUsers != undefined) {
                        scope.$watch('userdefault', function (newUser) {
                            if ((newUser != undefined && typeof newUser != 'object')) {
                                var usershow = $filter('getByProperty')('iduser', newUser, scope.users);
                                scope.AddUser(usershow);
                                scope.showUsers = false;
                            }
                        });
                        scope.$watch('user_name', function (newUser) {
                            if (newUser != undefined || !scope.isEmpty(newUser)) {
                                scope.showUsers = true;
                            }
                            if (newUser == undefined || scope.isEmpty(newUser)) {
                                scope.userdefault = undefined;
                                scope.AddUser({});
                            }
                        });
                        //Verified Empty Text
                        scope.isEmpty = function (str) {
                            return typeof str == 'string' && !str.trim() || typeof str == 'undefined' || str === null;
                        };

                        scope.AddUser = function (user) {
                            scope.user_name = (user == null || Object.keys(user).length == 0) ? '' : user.firstname + ' ' + user.lastname;
                            scope.user = user;
                            scope.showUsers = false;
                        };
                    }
                });
            }
        };
    }]);