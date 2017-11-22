'use strict';

//Core
let angular = require('angular');
require('angular-resource')


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


angular.module('Communications', [
    'ngResource',
    'Core.services',
    'Core.factories',
    'Core.filters',
    'Core.directives',
    'Communications.filters',
    'Communications.services',
    'Communications.factories',
    'Communications.directives',
    'Communications.controllers',
]);

angular.module('Communications').config(['$httpProvider',function ($httpProvider) {
    $httpProvider.interceptors.push('httpInterceptor');
}]);


//Communications
require('./filters/main');
require('./services/main');
require('./factories/main');
require('./directives/main');
require('./controllers/main');