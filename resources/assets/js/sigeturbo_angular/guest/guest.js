'use strict';

//Core
let angular = require('angular');
let moment = require('moment');
require('angular-resource')
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


angular.module('Guest', [
    'ngResource',
    'ngDialog',
    'Core.services',
    'Core.factories',
    'Core.filters',
    'Core.directives',
    'Guest.filters',
    'Guest.services',
    'Guest.factories',
    'Guest.directives',
    'Guest.controllers',
]).constant('moment', moment);


//Guest
require('./filters/main');
require('./services/main');
require('./factories/main');
require('./directives/main');
require('./controllers/main');