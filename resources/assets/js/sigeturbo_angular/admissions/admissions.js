'use strict';

//Core
let angular = require('angular');
require('angular-resource');
require('angular-filter');
require('tc-angular-chartjs');
require('angular-sanitize');
require('ng-dialog');


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


angular.module('Admissions', [
    'ngResource',
    'tc.chartjs',
    'ngDialog',
    'ngSanitize',
    'angular.filter',
    'Core.services',
    'Core.factories',
    'Core.filters',
    'Core.directives',
    'Admissions.filters',
    'Admissions.services',
    'Admissions.factories',
    'Admissions.directives',
    'Admissions.controllers',
]);

angular.module('Admissions').config(['$httpProvider',function ($httpProvider) {
    $httpProvider.interceptors.push('httpInterceptor');
}]);


//Admissions
require('./filters/main');
require('./services/main');
require('./factories/main');
require('./directives/main');
require('./controllers/main');