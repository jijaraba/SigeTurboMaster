'use strict';

/* Parents Filters */
angular.module('Parents.filters', [])
    .filter('interpolate', ['version', function (version) {
        return function (text) {
            return String(text).replace(/\%VERSION\%/mg, version);
        }
    }])
    .filter('isPayment', function () {
        return function (payment) {
            if (payment) {
                return "is-payment"
            } else {
                return "not-payment"
            }
        }
    })
    .filter('performance', function () {
        return function (rating,style) {
            if (style === 'normal'){
                switch (true){
                    case (rating >= 4.31 && rating <= 5.00):
                        return "ds-parents";
                    case (rating >= 3.71 && rating < 4.31):
                        return "da-parents";
                    case (rating >= 3.00 && rating < 3.71):
                        return "db-parents";
                    case (rating > 0.00 && rating < 3.00):
                        return "dp-parents";
                    default:
                        return "dp-parents";
                }
            }
        }
    })
    .filter('recovery', function(){
        return function(recovery){
            if (parseInt(recovery) > 0) {
                return recovery;
            } else {
                return '';
            }
        }
    })

    .filter('attendance', function(){
        return function(attendance){
            if (parseInt(attendance) > 0) {
                return parseInt(attendance);
            } else {
                return 0;
            }
        }
    })
    .filter('isPaymentParents', function () {
        return function (payment) {
            switch (payment){
                case 'Y':
                    return "is-payment";
                default:
                    return "not-payment";
            }
        }
    });