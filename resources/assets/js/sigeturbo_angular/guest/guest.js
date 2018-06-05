'use strict';

//Core
let angular = require('angular');
require('angular-resource')
require('ng-dialog')


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


angular.module('Guest', [
    'ngResource',
    'ngDialog',
    'Core.services',
    'Core.factories',
    'Core.filters',
    'Core.directives',
    'Guest.services',
    'Guest.filters',
    'Guest.factories',
    'Guest.directives',
    'Guest.controllers',
]);


//Guest
require('./filters/main');
require('./services/main');
require('./factories/main');
require('./directives/main');
require('./controllers/main');