'use strict';

/* Communications Factories */
angular.module('Communications.factories', [])
    //WeeklyEvaluation
    .factory('Weeklyevaluation', ['$resource', 'sigeTurboStorage', function ($resource, sigeTurboStorage) {
        return $resource('/api/v1/weeklyevaluations/:weeklyevaluationId/:action/:token', {
            weeklyevaluationId: '@id',
            action: '@action',
            token: '@token'
        }, {
            all: {
                method: 'GET',
                isArray: true
            },
            getEvaluations: {
                method: 'GET',
                params: {action: 'getevaluations', token: sigeTurboStorage.getStorage('token')},
                isArray: true
            },
            update: {
                method: 'PUT'
            }

        });
    }])
    .factory('User', ['$resource', 'sigeTurboStorage', function ($resource, sigeTurboStorage) {
        return $resource('/api/v1/users/:userId/:action/:token', {
            userId: '@id',
            action: '@action',
            token: '@token'
        }, {
            get: {
                params: {userId: sigeTurboStorage.getStorage('user')},
            }
        });
    }]);