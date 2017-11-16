'use strict';

//Core
require('angular')
require('angular-resource')
require('tc-angular-chartjs')
require('ng-dialog')


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


angular.module('Dashboard', [
    'ngResource',
    'ngDialog',
    'tc.chartjs',
    'Core.services',
    'Core.factories',
    'Core.filters',
    'Core.directives',
    'Dashboard.filters',
    'Dashboard.services',
    'Dashboard.factories',
    'Dashboard.directives',
    'Dashboard.controllers',
]).constant("moment", moment);

angular.module('Dashboard').run(['$window','Token','sigeTurboStorage',function($window,Token,sigeTurboStorage){
    if (!sigeTurboStorage.getStorage('token')) {
        Token.getToken().$promise.then(
            function (data) {
                $window.sessionStorage.setItem('token', data.token);
                sigeTurboStorage.setStorage('user', data.user);
                sigeTurboStorage.setStorage('token', data.token);
            }
        );
    }
}]);

angular.module('Dashboard').config(['$httpProvider',function ($httpProvider) {
    $httpProvider.interceptors.push('httpInterceptor');
}]);


//Dashboard
require('./filters/main');
require('./services/main');
require('./factories/main');
require('./directives/main');
require('./controllers/main');