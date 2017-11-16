'use strict';

/* Financials Factories */
angular.module('Financials.factories', [])
    .factory('User', ['$resource', function ($resource) {
        return $resource('/api/v1/users/:userId/:action', {userId: '@id', action: '@action'}, {
            all: {
                method: 'GET',
                params: {userId: ''},
                isArray: true
            }
        });
    }])
    .factory('Bank', ['$resource', function ($resource) {
        return $resource('/api/v1/banks/:bankId/:action', {
            bankId: '@bankId',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {bankId: ''},
                isArray: true
            }
        });
    }])
    .factory('Costcenter', ['$resource', function ($resource) {
        return $resource('/api/v1/costcenters/:costcenterId/:action', {
            costcenterId: '@costcenterId',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {costcenterId: ''},
                isArray: true
            },
            getCostcenterByStudent: {
                method: 'GET',
                params: {action: 'getcostcenterbystudent'},
                isArray: false
            },
            update: {
                method: 'PUT'
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
            getEnrollmentsLatestByStudent: {
                method: 'GET',
                params: {action: 'getenrollmentslatestbystudent'}
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
    .factory('Export', ['$resource', function ($resource) {
        return $resource('/api/v1/exports/:action', {
            action: '@action'
        }, {
            getPaymentsReport: {
                method: 'GET',
                params: {action: 'payments/reports'}
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
    .factory('Transaction', ['$resource', function ($resource) {
        return $resource('/api/v1/transactions/:transactionId/:action', {
            transactionId: '@transactionId',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {transactionId: ''},
                isArray: true
            },
            getTransactionsByPayment: {
                method: 'GET',
                params: {action: 'gettransactionsbypayment'},
                isArray: true
            },
            findVoucherInTransactions: {
                method: 'GET',
                params: {action: 'findvoucherintransactions'}
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('TransactionType', ['$resource', function ($resource) {
        return $resource('/api/v1/transactiontypes/:transactiontypeId/:action', {
            transactiontypeId: '@transactiontypeId',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {transactiontypeId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('VoucherType', ['$resource', function ($resource) {
        return $resource('/api/v1/vouchertypes/:vouchertypeId/:action', {
            vouchertypeId: '@vouchertypeId',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {vouchertypeId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('VoucherConsecutive', ['$resource', function ($resource) {
        return $resource('/api/v1/voucherconsecutives/:voucherconsecutiveId/:action', {
            voucherconsecutiveId: '@voucherconsecutiveId',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {voucherconsecutiveId: ''},
                isArray: true
            },
            getVoucherConsecutiveByCode: {
                method: 'GET',
                params: {action: 'getvoucherconsecutivebycode'}
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Payment', ['$resource', function ($resource) {
        return $resource('/api/v1/payments/:paymentId/:studentId/:action', {paymentId: '@id', action: '@action'}, {
            setPaymentIndividual: {
                method: 'POST',
                params: {action: 'setpaymentindividual'}
            },
            setPaymentIndividualNew: {
                method: 'POST',
                params: {action: 'setpaymentindividualnew'}
            },
            setPaymentMassive: {
                method: 'POST',
                params: {action: 'setpaymentmassive'}
            },
            verifyPaymentPending: {
                method: 'POST',
                params: {action: 'verifypaymentpending'}
            },
            updatePaymentShort: {
                method: 'POST',
                params: {action: 'updatepaymentshort'}
            },
            getPaymentsByStudent: {
                method: 'GET',
                params: {action: 'getpaymentsbyuserwithtransactions'},
                isArray: true
            },
            getPaymentsPendings: {
                method: 'GET',
                params: {action: 'getpaymentspendings'},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Responsibleparent', ['$resource', function ($resource) {
        return $resource('/api/v1/responsibleparents/:responsibleparentId/:action', {
            responsibleparentId: '@responsibleparentId',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {responsibleparentId: ''},
                isArray: true
            },
            getResponsibleparentByStudent: {
                method: 'GET',
                params: {action: 'getresponsibleparentbystudent'},
                isArray: false
            },
            update: {
                method: 'PUT'
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
    }]);