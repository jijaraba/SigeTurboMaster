'use strict';

/* Dashboard Directives */
angular.module('Dashboard.directives', [])
    .directive('appVersion', ['version', function (version) {
        return function (scope, elm) {
            elm.text(version);
        };
    }]);