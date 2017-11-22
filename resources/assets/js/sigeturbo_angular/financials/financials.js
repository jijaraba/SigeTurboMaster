'use strict';

//Core
let angular = require('angular');
require('angular-resource')
require('angular-sanitize')
require('angular-filter')
require('tc-angular-chartjs')


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


angular.module('Financials', [
    'ngResource',
    'tc.chartjs',
    'ngSanitize',
    'angular.filter',
    'Core.services',
    'Core.factories',
    'Core.filters',
    'Core.directives',
    'Financials.filters',
    'Financials.services',
    'Financials.factories',
    'Financials.directives',
    'Financials.controllers',
]);

angular.module('Financials').config(['$httpProvider', function ($httpProvider) {
    $httpProvider.interceptors.push('httpInterceptor');
}]);


//Admissions
require('./filters/main');
require('./services/main');
require('./factories/main');
require('./directives/main');
require('./controllers/main');
