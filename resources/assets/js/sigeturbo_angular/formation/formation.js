'use strict';
//Core
let angular = require('angular');
require('angular-resource');
require('angular-sanitize');
require('angular-filter');
require('ng-dialog');
require('tc-angular-chartjs');


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


angular.module('Formation', [
    'ngResource',
    'tc.chartjs',
    'ngSanitize',
    'ngDialog',
    'angular.filter',
    'Core.services',
    'Core.factories',
    'Core.filters',
    'Core.directives',
    'Formation.services',
    'Formation.filters',
    'Formation.factories',
    'Formation.directives',
    'Formation.controllers',
]);


angular.module('Formation').config(['$httpProvider', function ($httpProvider) {
    $httpProvider.interceptors.push('httpInterceptor');
    $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
}]);

//Formation
require('./filters/main');
require('./services/main');
require('./factories/main');
require('./directives/main');
require('./controllers/main');