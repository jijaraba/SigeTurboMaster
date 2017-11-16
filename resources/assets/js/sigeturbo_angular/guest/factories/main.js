'use strict';

/* Guest Factories */
angular.module('Guest.factories', [])
    .factory('Task', ['$resource', function ($resource) {
        return $resource('/api/v1/tasks/:tasksId/:action', {userId: '@id', action: '@action'}, {
            all: {
                method: 'GET',
                params: {taskId: ''},
                isArray: true
            }
        });
    }])
    .factory('Family', ['$resource', function ($resource) {
        return $resource('/api/v2/families/:familyId/:action', {familyId: '@id', action: '@action'}, {
            all: {
                method: 'GET',
                params: {taskId: ''},
                isArray: true
            },
            getFamilyByName: {
                method: 'GET',
                params: {action: 'searchfamilybyname'}
            }
        });
    }]);