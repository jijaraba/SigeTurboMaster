'use strict';

/* Formation Factories */
angular.module('Core.factories', [])
    .factory('SharedService', ['$rootScope', function ($rootScope) {
        var sharedService = {};
        sharedService.message = '';
        sharedService.prepForBroadcast = function (msg) {
            this.message = msg;
            this.broadcastItem();
        };
        sharedService.broadcastItem = function () {
            $rootScope.$broadcast('handleBroadcast');
        };
        return sharedService;
    }])
    .factory('Token', ['$resource', function ($resource) {
        return $resource('/gettoken', {}, {
            getToken: {
                method: 'GET',
                params: {}
            }
        });
    }])
    .factory('httpInterceptor', ['$q', '$injector', '$log', '$window', 'sigeTurboStorage', '$location', function ($q, $injector, $log, $window, sigeTurboStorage, $location) {
        return {
            request: function (config) {

                config.headers = config.headers || {};

                config.headers = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    'Authorization': 'Bearer ' + document.querySelector('#sigeturboToken').getAttribute('data-token')
                };

                //Detect Json Content
                if (config.sigeJsonContentType == false) {
                    config.headers['Content-Type'] = undefined;
                } else {
                    config.headers['Content-Type'] = 'application/json';
                }
                return config;

            },
            responseError: function (response) {
                // Unauthorized
                if (response.status == 401) {
                    $location.url('/');
                }
                return $q.reject(response);
            }
        };
    }])
    .factory('SweetAlert', ['$rootScope', function ($rootScope) {
        var swal = window.swal;
        swal.setDefaults({confirmButtonColor: '#53BBB4'});
        var self = {
            swal: function (arg1, arg2, arg3) {
                $rootScope.$evalAsync(function () {
                    if (typeof(arg2) === 'function') {
                        swal(arg1, function (isConfirm) {
                            $rootScope.$evalAsync(function () {
                                arg2(isConfirm);
                            });
                        }, arg3);
                    } else {
                        swal(arg1, arg2, arg3);
                    }
                });
            },
            success: function (title, message) {
                $rootScope.$evalAsync(function () {
                    swal({title: title, text: message, type: 'success', html: true});
                });
            },
            error: function (title, message) {
                $rootScope.$evalAsync(function () {
                    swal({title: title, text: message, type: 'error', html: true});
                });
            },
            warning: function (title, message) {
                $rootScope.$evalAsync(function () {
                    swal({title: title, text: message, type: 'warning', html: true});
                });
            },
            info: function (title, message) {
                $rootScope.$evalAsync(function () {
                    swal({title: title, text: message, type: 'info', html: true});
                });
            }
        };
        return self;
    }])
    .factory('Group', ['$resource', function ($resource) {
        return $resource('/api/v1/groups/:groupId/:action', {groupId: '@id', action: '@action'}, {
            all: {
                method: 'GET',
                params: {groupId: ''},
                isArray: true
            }
        });
    }])
    .factory('Timer', function ($interval) {
        return function (delay) {
            var initialMs = (new Date()).getTime();
            var result = {totalMilliseconds: 0, counts: 0};
            $interval(function () {
                result.totalMilliseconds = (new Date()).getTime() - initialMs;
                result.counts++;
            }, delay);
            return result;
        };
    });
