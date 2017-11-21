'use strict';
//Core
let angular = require('angular');
let moment = require('moment');
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
require('../core/filters');
require('../core/services');
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
    'Formation.filters',
    'Formation.services',
    'Formation.factories',
    'Formation.directives',
    'Formation.controllers',
]).constant('moment', moment);


angular.module('Formation').config(['$httpProvider', function ($httpProvider) {
    $httpProvider.interceptors.push('httpInterceptor');
}]);

//Formation
require('./filters/main');
require('./services/main');
require('./factories/main');
require('./directives/main');
require('./controllers/main');