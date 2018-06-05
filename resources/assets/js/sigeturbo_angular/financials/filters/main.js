'use strict';

/* Financials Filters */
angular.module('Financials.filters', [])
    .filter('interpolate', ['version', function (version) {
        return function (text) {
            return String(text).replace(/VERSION/mg, version);
        };
    }])
    .filter('getValidateDate', function () {
        return function (el) {
            Date.prototype.lastDay = function () {
                var A = [];
                for (var i = 1; i <= 12; i++) {
                    A[A.length] = new Date(this.getFullYear(), i, 0).getDate();
                }
                return A;
            };
            var re = /^[0-9]{4}(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])/;
            if (el != 'undefined' && el != undefined && el != '') {
                var M = el.match(re);
                var s = el.split(/\D/);
                var d = new Date(s[0] * 1, s[1] - 1, s[2] * 1);
                var L = d.lastDay()[s[1] - 1];
                return (M && s[2] <= L && s[2].length <= 2) ? true : false;
            }
        };
    });