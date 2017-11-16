'use strict';

/* Admissions Factories */
angular.module('Admissions.factories', [])
    .factory('User', ['$resource', function ($resource) {
        return $resource('/api/v1/users/:userId/:action', {userId: '@id', action: '@action'}, {
            all: {
                method: 'GET',
                params: {userId: ''},
                isArray: true
            },
            getPersonalAcademic: {
                method: 'GET',
                params: {
                    action: 'getpersonalacademic'
                },
                isArray: true
            },
            getAllStudents: {
                method: 'GET',
                params: {
                    action: 'getallstudents'
                },
                isArray: true
            },
            getLatestCode: {
                method: 'GET',
                params: {action: 'getlatestcode'}
            },
            verifyCelular: {
                method: 'POST',
                params: {action: 'verifycelular'}
            },
            verifyCelularMessage: {
                method: 'POST',
                params: {action: 'verifycelularmessage'}
            },
            saveCelularByPasscode: {
                method: 'POST',
                params: {action: 'savecelularbypasscode'}
            },
            saveCelularByCertification: {
                method: 'POST',
                params: {action: 'savecelularbycertification'}
            },
            verifyEmail: {
                method: 'POST',
                params: {action: 'verifyemail'}
            },
            verifyEmailMessage: {
                method: 'POST',
                params: {action: 'verifyemailmessage'}
            },
            saveEmailByPasscode: {
                method: 'POST',
                params: {action: 'saveemailbypasscode'}
            },
            saveEmailByCertification: {
                method: 'POST',
                params: {action: 'saveemailbycertification'}
            }
        });
    }])
    .factory('Year', ['$resource', function ($resource) {
        return $resource('/api/v1/years/:yearId/:action', {yearId: '@id', action: '@action'}, {
            all: {
                method: 'GET',
                params: {yearId: ''},
                isArray: true
            },
            getCurrentYear: {
                method: 'GET',
                params: {action: 'getcurrentyear'}
            }

        });
    }])
    .factory('Group', ['$resource', function ($resource) {
        return $resource('/api/v1/groups/:groupId/:action', {
            groupId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {groupId: ''},
                isArray: true
            },
            getGroupsByYearAndPeriod: {
                method: 'GET',
                params: {action: 'getgroupsbyyearandperiod'},
                isArray: true
            }
        });
    }])
    .factory('Area', ['$resource', function ($resource) {
        return $resource('/api/v1/areas/:areaId/:action', {
            areaId: '@idarea',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {areaId: ''},
                isArray: true
            }
        });
    }])
    .factory('Routebyuser', ['$resource', function ($resource) {
        return $resource('/api/v1/routebyusers/:routebyuserId/:action', {
            routebyuserId: '@idroutebyuser',
            action: '@action'
        });
    }])
    .factory('Conveyor', ['$resource', function ($resource) {
        return $resource('/api/v1/conveyors/:conveyorId/:action', {
            conveyorId: '@idconveyor',
            action: '@action'
        },{
            all: {
                method: 'GET',
                params: {conveyorId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Vehicle', ['$resource', function ($resource) {
        return $resource('/api/v1/vehicles/:vehicleId/:action', {
            vehicleId: '@idvehicle',
            action: '@action'
        },{
            all: {
                method: 'GET',
                params: {vehicleId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Route', ['$resource', function ($resource) {
        return $resource('/api/v1/routes/:routeId/:action', {
            routeId: '@idroute',
            action: '@action'
        },{
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Export', ['$resource', function ($resource) {
        return $resource('/api/v1/exports/:action', {
            action: '@action'
        }, {
            getEnrollmentsReport: {
                method: 'GET',
                params: {action: 'students/enrollments'}
            }
        });
    }])
    .factory('Statusschooltype', ['$resource', function ($resource) {
        return $resource('/api/v1/statusschooltypes/:statusschooltypeId/:action', {
            statusschooltypeId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {statusschooltypeId: ''},
                isArray: true
            }
        });
    }])
    .factory('Category', ['$resource', function ($resource) {
        return $resource('/api/v1/categories/:categoryId/:action', {
            categoryId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {categoryId: ''},
                isArray: true
            }
        });
    }])
    .factory('Enrollment', ['$resource', function ($resource) {
        return $resource('/api/v1/enrollments/:enrollmentId/:action', {
            enrollmentId: '@idenrollment',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {enrollmentId: ''},
                isArray: true
            },
            getEnrollmentsByStudent: {
                method: 'GET',
                params: {action: 'getenrollmentsbystudent'},
                isArray: true
            },
            getEnrollmentsLatestByStudentWithCost: {
                method: 'GET',
                params: {action: 'getenrollmentslatestbystudentwithcost'}
            },
            getEnrollmentsByStatus: {
                method: 'GET',
                params: {action: 'getenrollmentsbystatus'}
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    //Families
    .factory('Family', ['$resource', function ($resource) {
        return $resource('/api/v1/families/:familyId/:action', {familyId: '@id', action: '@action'}, {
            getFamilies: {
                method: 'GET',
                params: {action: 'searchfamilies'},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Quantitativerecoveryfinalarea', ['$resource', function ($resource) {
        return $resource('/api/v1/quantitativerecoveryfinalareas/:quantitativerecoveryfinalareaId/:action', {
            quantitativerecoveryfinalareaId: '@idquantitativerecoveryfinalarea',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {quantitativerecoveryfinalareaId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Qualitativerecoveryfinalarea', ['$resource', function ($resource) {
        return $resource('/api/v1/qualitativerecoveryfinalareas/:qualitativerecoveryfinalareaId/:action', {
            qualitativerecoveryfinalareaId: '@idqualitativerecoveryfinalarea',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {qualitativerecoveryfinalareaId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }]);