/* eslint-disable no-console */
'use strict';

let Chart = require('chart.js');

/* Core Directives */
angular.module('Core.directives', [])
    .directive('currentTime', ['$interval', 'dateFilter', function ($interval, dateFilter) {
        return {
            restrict: 'A',
            controller: ['$scope', function ($scope) {
                $scope.format = '\'h:mm:ss a';
                $scope.stopTime = 0;
            }],
            link: function (scope, elem) {
                function updateTime() {
                    elem.text(dateFilter(new Date(), scope.format));
                }

                scope.stopTime = $interval(updateTime, 1000);
                elem.on('$destroy', function () {
                    $interval.cancel(scope.stopTime);
                });
            }
        };
    }])
    .directive('chart', [function () {
        var baseWidth = 600;
        var baseHeight = 400;
        return {
            restrict: 'E',
            template: '<canvas></canvas>',
            scope: {
                chartObject: '=value'
            },
            link: function (scope, element, attrs) {
                var canvas = element.find('canvas')[0];
                var context = canvas.getContext('2d');
                var chart;

                var options = {
                    type: attrs.type || 'Line',
                    width: attrs.width || baseWidth,
                    height: attrs.height || baseHeight,
                    percentageInnerCutout: 10
                };
                canvas.width = options.width;
                canvas.height = options.height;
                chart = new Chart(context);

                scope.$watch(function () {
                    return element.attr('type');
                }, function (value) {
                    if (!value) return;
                    options.type = value;
                    var chartType = options.type;
                    chart[chartType](scope.chartObject.data, scope.chartObject.options);
                });

                //Update when charts data changes
                scope.$watch(function () {
                    return scope.chartObject;
                }, function (value) {
                    if (!value) return;
                    var chartType = options.type;
                    chart[chartType](scope.chartObject.data, scope.chartObject.options);
                    if (scope.chartInstance) scope.chartInstance.destroy();
                    scope.chartInstance = chart[chartType](scope.chartObject.data, scope.chartObject.options);
                }, true);
            }
        };
    }])
    .directive('sigeTurboTags', [function () {
        return {
            restrict: 'AE',
            scope: {
                tags: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.tags = $scope.tags.split(',');
            }],
            template: require('./views/tags.html'),
            link: function () {
            }
        };
    }])
    .directive('sigeTurboSearchTags', ['$log', 'Group', function ($log, Group) {
        return {
            restrict: 'AE',
            scope: {
                tags: '='
            },
            controller: ['$scope', function ($scope) {

                $scope.groups = [];

                Group.query({}).$promise.then(
                    function (groups) {
                        $scope.groups = groups;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );

            }],
            template: require('./views/search_tags.html'),
            link: function () {
            }
        };
    }])
    .directive('sigeTurboPagination', [function () {
        return {
            restrict: 'AE',
            scope: {
                ngModel: '=',
                number: '=',
                total: '=',
                size: '=',
                boundary: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.firstPage = 1;
                $scope.totalPages = Math.ceil($scope.total / $scope.number);
                $scope.page = 1;
            }],
            template: require('./views/pagination.html'),
            link: function (scope) {

                scope.first = function () {
                    scope.page = 1;
                    scope.ngModel = scope.firstPage;
                };

                scope.previous = function () {
                    scope.page--;
                    if (scope.page < 1) {
                        scope.page = scope.ngModel;
                    } else {
                        scope.ngModel--;
                    }
                };

                scope.next = function () {
                    scope.page++;
                    if (scope.page > scope.totalPages) {
                        scope.page = scope.ngModel;
                    } else {
                        scope.ngModel++;
                    }

                };

                scope.last = function () {
                    scope.page = scope.totalPages;
                    scope.ngModel = scope.totalPages;
                };
            }
        };
    }])
    .directive('sigeTurboFileUpload', ['$log', 'sigeTurboUpload', function ($log, sigeTurboUpload) {
        return {
            restrict: 'AE',
            scope: {
                type: '@',
                id: '@'
            },
            controller: ['$scope', function ($scope) {
                $scope.upload = [];
            }],
            template: require('./views/upload.html'),
            link: function (scope, element) {
                element.bind('change', function (evt) {
                    scope.$apply(function () {
                        angular.forEach(evt.target.files, function (file, key) {
                            evt.target.files[key].status = 0;
                            evt.target.files[key].deleted = false;
                        });
                        scope.upload.files = evt.target.files;
                        //Upload Files
                        scope.upload();
                    });
                });
                element.bind('drop', function (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                    scope.$apply(function () {
                        angular.forEach(evt.originalEvent.dataTransfer.files, function (file, key) {
                            evt.originalEvent.dataTransfer.files[key].status = 0;
                            evt.originalEvent.dataTransfer.files[key].deleted = false;
                        });
                        scope.upload.files = evt.originalEvent.dataTransfer.files;
                        //Upload Files
                        scope.upload();
                    });
                });

                element.bind('dragover', function (evt) {
                    scope.$apply(function () {
                        evt.stopPropagation();
                        evt.preventDefault();
                        evt.originalEvent.dataTransfer.dropEffect = 'copy';
                    });
                });

                scope.delete = function ($index) {
                    scope.upload.files[$index].status = 0;
                    sigeTurboUpload.deleteFile(file, '/delete' + scope.type + '?table=' + scope.upload.files[$index].result.data.table + '&id=' + scope.upload.files[$index].result.data.id).then(
                        function () {
                            scope.upload.files[$index].status = 100;
                            scope.upload.files[$index].deleted = true;
                        },
                        function () {
                            $log.error(scope.data);
                            scope.upload.files[$index].status = -1;
                            scope.upload.files[$index].deleted = false;
                        }
                    );
                };

                //Upload Files
                scope.upload = function () {
                    angular.forEach(scope.upload.files, function (file, key) {
                        sigeTurboUpload.uploadFileToUrl(file, '/upload' + scope.type + '?' + scope.type + '=' + scope.id).then(
                            function (data) {
                                scope.upload.files[key].status = 100;
                                scope.upload.files[key].result = data;
                            },
                            function (error) {
                                $log.log(error);
                                scope.upload.files[key].status = -1;
                            }
                        );
                    });
                };

            }
        };
    }])
    .directive('sigeTurboVerifiedFileUpload', ['$log', 'sigeTurboUpload', function ($log, sigeTurboUpload) {
        return {
            restrict: 'AE',
            scope: {
                type: '@',
                isvalid: '=',
                registry: '=',
                onFinish: '&',
            },
            controller: ['$scope', function ($scope) {
                $scope.upload = [];
            }],
            template: require('./views/upload.html'),
            link: function (scope, element) {
                element.bind('change', function (evt) {
                    scope.$apply(function () {
                        angular.forEach(evt.target.files, function (file, key) {
                            evt.target.files[key].status = 0;
                            evt.target.files[key].deleted = false;
                        });
                        scope.upload.files = evt.target.files;
                        //Upload Files
                        scope.upload();
                    });
                });
                element.bind('drop', function (evt) {
                    evt.stopPropagation();
                    evt.preventDefault();
                    scope.$apply(function () {
                        angular.forEach(evt.originalEvent.dataTransfer.files, function (file, key) {
                            evt.originalEvent.dataTransfer.files[key].status = 0;
                            evt.originalEvent.dataTransfer.files[key].deleted = false;
                        });
                        scope.upload.files = evt.originalEvent.dataTransfer.files;
                        //Upload Files
                        scope.upload();
                    });
                });

                element.bind('dragover', function (evt) {
                    scope.$apply(function () {
                        evt.stopPropagation();
                        evt.preventDefault();
                        evt.originalEvent.dataTransfer.dropEffect = 'copy';
                    });
                });

                //Upload Files
                scope.upload = function () {
                    angular.forEach(scope.upload.files, function (file, key) {
                        sigeTurboUpload.uploadFileToUrl(file, '/upload' + scope.type + '?' + scope.type + '=' + ((scope.isvalid == true) ? JSON.stringify(scope.registry) : scope.isvalid))
                            .success(function (data) {
                                scope.upload.files[key].status = 100;
                                scope.upload.files[key].result = data;
                                scope.onFinish({arg1: false});
                                scope.isvalid = data.status;
                            })
                            .error(function () {
                                scope.upload.files[key].status = -1;
                            });
                    });
                };

                scope.delete = function ($index) {
                    scope.upload.files[$index].status = 0;
                    sigeTurboUpload.deleteFile(file, '/delete' + scope.type + '?table=' + scope.upload.files[$index].result.data.table + '&id=' + scope.upload.files[$index].result.data.id)
                        .success(function () {
                            scope.upload.files[$index].status = 100;
                            scope.upload.files[$index].deleted = true;
                        })
                        .error(function () {
                            $log.error(scope.data);
                            scope.upload.files[$index].status = -1;
                            scope.upload.files[$index].deleted = false;
                        });
                };

                //Find Registry
                scope.$watch('registry.send', function (newRegistry, oldRegistry) {
                    if (newRegistry !== oldRegistry) {
                        scope.upload();
                    }
                });

            }
        };
    }])
    .directive('sigeTurboVisitorsDashboardAccount', ['$log', 'Visitor', function ($log, Visitor) {
        return {
            restrict: 'AE',
            scope: {},
            controller: ['$scope', function ($scope) {
                Visitor.getVisitorsNow().$promise.then(
                    function (result) {
                        $scope.result = result;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            template: require('./views/dashboard/visitors/account.html'),
            link: function () {
            }
        };
    }])
    .directive('sigeTurboDashboardEnrollmentsActive', ['$log', 'Enrollment', function ($log, Enrollment) {
        return {
            restrict: 'AE',
            scope: {},
            controller: ['$scope', function ($scope) {
                Enrollment.getEnrollmentsByStatus({status: 'actives'}).$promise.then(
                    function (enrollments) {
                        let amount = 0;
                        if (enrollments.amount > 0) {
                            $scope.amount = enrollments.amount;
                        } else {
                            $scope.amount = amount;
                        }
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            template: require('./views/dashboard/enrollments/active.html'),
            link: function () {
            }
        };
    }])
    .directive('sigeTurboDashboardEnrollmentsInternship', ['$log', 'Enrollment', function ($log, Enrollment) {
        return {
            restrict: 'AE',
            scope: {},
            controller: ['$scope', function ($scope) {
                Enrollment.getEnrollmentsByStatus({status: 'internship'}).$promise.then(
                    function (enrollments) {
                        let amount = 0;
                        if (enrollments.amount > 0) {
                            $scope.amount = enrollments.amount;
                        } else {
                            $scope.amount = amount;
                        }
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            template: require('./views/dashboard/enrollments/internship.html'),
            link: function () {
            }
        };
    }])
    .directive('sigeTurboDashboardEnrollmentsAssistant', ['$log', 'Enrollment', function ($log, Enrollment) {
        return {
            restrict: 'AE',
            scope: {},
            controller: ['$scope', function ($scope) {
                Enrollment.getEnrollmentsByStatus({status: 'assistant'}).$promise.then(
                    function (enrollments) {
                        let amount = 0;
                        if (enrollments.amount > 0) {
                            $scope.amount = enrollments.amount;
                        } else {
                            $scope.amount = amount;
                        }
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            template: require('./views/dashboard/enrollments/assistant.html'),
            link: function () {
            }
        };
    }])
    .directive('sigeTurboDashboardEnrollmentsPending', ['$log', 'Enrollment', function ($log, Enrollment) {
        return {
            restrict: 'AE',
            scope: {},
            controller: ['$scope', function ($scope) {
                Enrollment.getEnrollmentsByStatus({status: 'pending'}).$promise.then(
                    function (enrollments) {
                        let amount = 0;
                        if (enrollments.amount > 0) {
                            $scope.amount = enrollments.amount;
                        } else {
                            $scope.amount = amount;
                        }
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            template: require('./views/dashboard/enrollments/pending.html'),
            link: function () {
            }
        };
    }])
    .directive('sigeTurboDashboardEnrollmentsRetired', ['$log', 'Enrollment', function ($log, Enrollment) {
        return {
            restrict: 'AE',
            scope: {},
            controller: ['$scope', function ($scope) {
                Enrollment.getEnrollmentsByStatus({status: 'retired'}).$promise.then(
                    function (enrollments) {
                        let amount = 0;
                        if (enrollments.amount > 0) {
                            $scope.amount = enrollments.amount;
                        } else {
                            $scope.amount = amount;
                        }
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            template: require('./views/dashboard/enrollments/retired.html'),
            link: function () {
            }
        };
    }])
    .directive('sigeTurboDashboardEnrollmentsPsychology', ['$log', 'Enrollment', function ($log, Enrollment) {
        return {
            restrict: 'AE',
            scope: {},
            controller: ['$scope', function ($scope) {
                Enrollment.getEnrollmentsByStatus({status: 'psychology'}).$promise.then(
                    function (enrollments) {
                        let amount = 0;
                        if (enrollments.amount > 0) {
                            $scope.amount = enrollments.amount;
                        } else {
                            $scope.amount = amount;
                        }
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }],
            template: require('./views/dashboard/enrollments/psychology.html'),
            link: function () {
            }
        };
    }]);