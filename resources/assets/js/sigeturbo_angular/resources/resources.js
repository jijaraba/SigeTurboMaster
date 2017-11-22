'use strict';

//Core
require('angular')
require('angular-resource')
require('angular-timer')


//Core
angular.module('Core', [
    'Core.services',
    'Core.factories',
    'Core.directives',
    'Core.filters'
]);
require('../core/filters');
require('../core/services');
require('../core/factories');
require('../core/directives');


angular.module('Resources', [
    'ngResource',
    'timer',
    'Core.services',
    'Core.factories',
    'Core.filters',
    'Core.directives',
    'Resources.filters',
    'Resources.services',
    'Resources.factories',
    'Resources.directives',
    'Resources.controllers',
]);

angular.module('Resources').run(['Token', 'sigeTurboStorage', function (Token, sigeTurboStorage) {
    if (!sigeTurboStorage.getStorage('token')) {
        Token.getToken().$promise.then(
            function (data) {
                sigeTurboStorage.setStorage('user', data.user);
                sigeTurboStorage.setStorage('token', data.token);
            }
        );
    }
}]);

angular.module('Resources').config(['$httpProvider', function ($httpProvider) {
    $httpProvider.interceptors.push('httpInterceptor');
}]);


//Resources
require('./filters/main');
require('./services/main');
require('./factories/main');
require('./directives/main');
require('./controllers/main');