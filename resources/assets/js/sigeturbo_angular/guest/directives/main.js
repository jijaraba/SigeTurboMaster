'use strict';

/* Guest Directives */
angular.module('Guest.directives', [])
    .directive('appVersion', ['version', function (version) {
        return function (scope, elm) {
            elm.text(version);
        };
    }]);