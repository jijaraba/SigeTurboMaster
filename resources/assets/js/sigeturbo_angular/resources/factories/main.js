'use strict';

/* Resources Factories */
angular.module('Resources.factories', [])
    .factory('Purchase', ['$resource', function ($resource) {
        return $resource('/api/v1/purchases/:purchaseId/:action/', {
            purchaseId: '@idpurchase',
            action: '@action'
        }, {
            generateCode: {
                method: 'GET',
                params: {action: 'generatecode'}
            },
            getDiscount: {
                method: 'GET',
                params: {action: 'getdiscount'},
                isArray: true
            },
            update: {
                method: 'PUT'
            },
            updateStatus: {
                method: 'POST',
                params: {action: 'statusupdate'},
            }
        });
    }])
    .factory('Evaluationpurchase', ['$resource', function ($resource) {
        return $resource('/api/v1/evaluationpurchases/:evaluationpurchaseId/:action', {
            evaluationpurchaseId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {evaluationpurchaseId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            },
            getEvaluationByPurchase: {
                method: 'GET',
                params: {action: 'getevaluationbypurchase'},
                isArray: false
            }
        });
    }])
    .factory('Product', ['$resource', function ($resource) {
        return $resource('/api/v1/products/:productId/:action', {
            productId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {productId: ''},
                isArray: true
            },
            getCode: {
                method: 'GET',
                params: {action: 'searchbycode'}
            }
        });
    }])
    .factory('Provider', ['$resource', function ($resource) {
        return $resource('/api/v1/providers/:providerId/:action', {
            providerId: '@id',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {providerId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Detail', ['$resource', function ($resource) {
        return $resource('/api/v1/details/:detailId/:action/:token', {
            detailId: '@iddetail',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {detailId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Ubication', ['$resource', function ($resource) {
        return $resource('/api/v1/ubications/:ubicationId/:action/:token', {
            detailId: '@idubication',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {ubicationId: ''},
                isArray: true
            },
            getUbications: {
                method: 'GET',
                params: {action: 'getubications'},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Inventorytype', ['$resource', function ($resource) {
        return $resource('/api/v1/inventorytypes/:inventorytypeId/:action/:token', {
            detailId: '@idinventorytype',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {inventoryId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            }
        });
    }])
    .factory('Visitor', ['$resource', function ($resource) {
        return $resource('/api/v1/visitors/:idvisitor/:action', {
            idvisitor: '@idvisitor',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {idvisitor: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            },
            generateCode: {
                method: 'GET',
                params: {action: 'generatecode'}
            },
            checkIn: {
                method: 'GET',
                params: {action: 'checkin'}
            },
            checkOut: {
                method: 'GET',
                params: {action: 'checkout'}
            },
            getVisitorsNow: {
                method: 'GET',
                params: {action: 'getvisitorsnow'}
            }
        });
    }])
    .factory('Asset', ['$resource', function ($resource) {
        return $resource('/api/v1/assets/:assetId/:action', {
            assetId: '@idasset',
            action: '@action'
        }, {
            all: {
                method: 'GET',
                params: {assetId: ''},
                isArray: true
            },
            update: {
                method: 'PUT'
            },
            getAssets: {
                method: 'GET',
                params: {action: 'getassets'},
                isArray: true
            },
            setVerified: {
                method: 'GET',
                params: {action: 'setverified'}
            }
        });
    }]);