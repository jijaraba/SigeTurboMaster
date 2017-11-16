'use strict';

/* Core Filters */
angular.module('Core.filters', []).filter('interpolate', ['version', function (version) {
    return function (text) {
        return String(text).replace(/\%VERSION\%/mg, version);
    }
}])
    .filter('size', function () {
        return function (size) {
            function round(value, decimals) {
                return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
            }

            return round((size / 1024), 1) + " KB";
        }
    })
    .filter('fileStatus', function () {
        return function (status) {
            switch (status) {
                case 0:
                    return 'loading'
                    break;
                case 100:
                    return 'success'
                    break;
                case -1:
                    return 'fail'
                    break;
                case undefined:
                    return ''
                    break;
                default:
                    return 'loading'
            }
        }
    })
    .filter('purchaseEvaluation', function () {
        return function (evaluation) {
            var result = 'bad';
            if (evaluation < 0.75) {
                result = 'bad';
            } else if (evaluation >= 0.75 && evaluation < 0.85) {
                result = 'regular';
            } else if (evaluation >= 0.85 && evaluation < 0.95) {
                result = 'good';
            } else {
                result = 'excellent';
            }
            return result;
        }
    })
    .filter('fileDeleted', function () {
        return function (deleted) {
            switch (deleted) {
                case true:
                    return 'deleted'
                    break;
                case false:
                    return ''
                    break;
                default:
                    return ''
            }
        }
    })
    .filter('days', ['$filter', function ($filter) {
        return function (days) {
            var text = '1 day';
            if (days > 1) {
                text = days + ' days';
            }
            return text;
        }
    }])
    .filter('monthName', ['$filter', function ($filter) {
        return function (month) {
            switch (month) {
                case 'January':
                    return 'Enero'
                    break;
                case 'February':
                    return 'Febrero'
                    break;
                case 'March':
                    return 'Marzo'
                    break;
                case 'April':
                    return 'Abril'
                    break;
                case 'May':
                    return 'Mayo'
                    break;
                case 'June':
                    return 'Junio'
                    break;
                case 'July':
                    return 'Julio'
                    break;
                case 'August':
                    return 'Agosto'
                    break;
                case 'September':
                    return 'Septiembre'
                    break;
                case 'October':
                    return 'Octubre'
                    break;
                case 'November':
                    return 'Noviembre'
                    break;
                case 'December':
                    return 'Diciembre'
                    break;
                default:
                    return ''
            }
        }
    }])
    .filter('taskType', ['$filter', function ($filter) {
        return function (type) {
            switch (type) {
                case 1:
                    return 'task'
                    break;
                case 2:
                    return 'plan'
                    break;
                case 3:
                    return 'test'
                    break;
                default :
                    return 'task'
            }
        }
    }])
    .filter('paymentType', ['$filter', function ($filter) {
        return function (type) {
            switch (type) {
                case 1:
                    return 'MATRÍCULA'
                    break;
                case 2:
                    return 'PENSIÓN'
                    break;
                case 3:
                    return 'EXTRACURRICULAR'
                    break;
                case 4:
                    return 'NIVELACIÓN'
                    break;
                default :
                    return 'PENSIÓN'
            }
        }
    }])
    .filter('scale', function () {
        return function (rating, group) {
            if (group < 21) {
                switch (true) {
                    case (rating >= 4.31 && rating <= 5.00):
                        return "DS";
                    case (rating >= 3.71 && rating < 4.31):
                        return "DA";
                    case (rating >= 3.00 && rating < 3.71):
                        return "DB";
                    case (rating > 0.00 && rating < 3.00):
                        return "DP";
                    default:
                        return "DP";
                }
            } else {
                return rating;
            }
        }
    })
    .filter('percentage', ['$filter', function ($filter) {
        return function (input, decimals) {
            return $filter('number')(input * 100, decimals) + '%';
        };
    }])
    .filter('subtotal', ['$filter', function ($filter) {
        return function (details) {
            var subtotal = 0;
            angular.forEach(details, function (detail) {
                subtotal += detail.total
            });
            return subtotal;
        }
    }])
    .filter('discount', ['$filter', function ($filter) {
        return function (details, discount) {
            var total = 0;
            angular.forEach(details, function (detail) {
                total += detail.total
            });
            return total * discount;
        }
    }])
    .filter('vat', ['$filter', function ($filter) {
        return function (details, discount) {
            var vat = 0;
            angular.forEach(details, function (detail) {
                vat += (detail.total - (detail.total * discount)) * parseFloat(detail.vat)
            });
            return vat;
        }
    }])
    .filter('total', ['$filter', function ($filter) {
        return function (details, discount) {
            discount = parseFloat(discount);
            return ($filter('subtotal')(details) - $filter('discount')(details, discount)) + $filter('vat')(details, discount);
        }
    }])
    .filter('infoConfirmed', ['$filter', function ($filter) {
        return function (confirmed) {
            var result = 'not-verified'
            if (parseInt(confirmed) == 1) {
                result = 'verified'
            }
            return result;
        }
    }])
    .filter('sigeGroupBy', function () {
        return function (data, key) {
            if (!(data && key)) return;
            var result = {};
            for (var i = 0; i < data.length; i++) {
                if (!result[data[i][key]])
                    result[data[i][key]] = [];
                result[data[i][key]].push(data[i])
            }
            return result;
        };
    })
    .filter('enableElement', function () {
        return function (value) {
            if (value) {
                return "enabled";
            } else {
                return "disabled";
            }
        };
    });
