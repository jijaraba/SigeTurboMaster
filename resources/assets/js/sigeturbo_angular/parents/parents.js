'use strict';

//Core
let angular = require('angular');
require('angular-resource')
require('angular-timer')


//Core
angular.module('Core', [
    'Core.services',
    'Core.factories',
    'Core.directives',
    'Core.filters'
]);
require('../core/services');
require('../core/filters');
require('../core/factories');
require('../core/directives');

angular.module('Parents', [
    'ngResource',
    'timer',
    'Core.services',
    'Core.factories',
    'Core.filters',
    'Core.directives',
    'Parents.services',
    'Parents.filters',
    'Parents.factories',
    'Parents.directives',
    'Parents.controllers',
]);

angular.module('Parents').run(['Token','sigeTurboStorage',function(Token,sigeTurboStorage){
    if (!sigeTurboStorage.getStorage('token')) {
        Token.getToken().$promise.then(
            function (data) {
                sigeTurboStorage.setStorage('user', data.user);
                sigeTurboStorage.setStorage('token', data.token);
            }
        );
    }
}]);

angular.module('Parents').config(['$httpProvider',function ($httpProvider) {
    $httpProvider.interceptors.push('httpInterceptor');
}]);


//Parents
require('./filters/main');
require('./services/main');
require('./factories/main');
require('./directives/main');
require('./controllers/main');