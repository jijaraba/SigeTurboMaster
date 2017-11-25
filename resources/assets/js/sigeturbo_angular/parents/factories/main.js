'use strict';

/* Parents Factories */
angular.module('Parents.factories', [])
//Religions
    .factory('Religion', ['$resource', function ($resource) {
        return $resource('/api/v1/religions/:religionId/:action', {
            religionId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                isArray: true
            }
        });
    }])
    //Identificationtype
    .factory('Identificationtype', ['$resource', function ($resource) {
        return $resource('/api/v1/identificationtypes/:identificationtypeId/:action', {
            identificationtypeId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                isArray: true
            }
        });
    }])
    //Bloodtype
    .factory('Bloodtype', ['$resource', function ($resource) {
        return $resource('/api/v1/bloodtypes/:idbloodtypeId/:action', {
            bloodtypeId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                isArray: true
            }
        });
    }])
    //Userfamily
    .factory('Userfamily', ['$resource', function ($resource) {
        return $resource('/api/v1/userfamilies/:userfamilyId/:action', {
            userfamilyId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                isArray: true
            },
            getUsersByFamily: {
                method: 'GET',
                params: {action: 'getusersbyfamily'},
                isArray: true
            },
        });
    }])
    //Virtual
    .factory('Virtual', ['$resource', function ($resource) {
        return $resource('/api/v1/preregistrations/:preregistrationId/:action', {
            preregistrationId: '@id',
            action: '@action'
        }, {
            getByUser: {
                method: 'GET',
                params: {action: 'getpreregistrationbyuser'},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    //Payments
    .factory('Payment', ['$resource', function ($resource) {
        return $resource('/api/v1/payments/:paymentId/:action', {paymentId: '@id', action: '@action'}, {
            getPaymentsByUser: {
                method: 'GET',
                params: {action: 'getpaymentsbyuser'},
                isArray: true
            },
            setPaymentMethod: {
                method: 'GET',
                params: {action: 'setpaymentmethod'},
            },
            setPaymentAgreement: {
                method: 'GET',
                params: {action: 'setpaymentagreement'}
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    //Tasks
    .factory('Task', ['$resource', function ($resource) {
        return $resource('/api/v1/tasks/:taskId/:action', {taskId: '@id', action: '@action'}, {
            getTasksByUser: {
                method: 'GET',
                params: {action: 'gettasksbyuser'},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    //Points
    .factory('Points', ['$resource', function ($resource) {
        return $resource('/api/v1/points/:action/:token', {action: '@action'}, {
            getPoints: {
                method: 'GET',
                params: {action: 'getpoints'}
            }
        });
    }])
    //Monitoring
    .factory('Monitoring', ['$resource', function ($resource) {
        return $resource('/api/v1/monitorings/:monitoringId/:action', {
            monitoringId: '@id',
            action: '@action'
        }, {
            getMonitoringsByUser: {
                method: 'GET',
                params: {action: 'getmonitoringsbyuserforparents'},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Export', ['$resource', function ($resource) {
        return $resource('/api/v1/exports/:action', {
            action: '@action'
        }, {
            getReport: {
                method: 'GET',
                params: {action: 'reports/partials'}
            }
        });
    }])
    .factory('Report', ['$resource', function ($resource) {
        return $resource('/api/v1/reports/:action', {
            action: '@action'
        }, {
            getReportEnabled: {
                method: 'GET',
                params: {action: 'getreportenabled'}
            }
        });
    }]);