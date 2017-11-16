'use strict';

/* Communications Directives */
angular.module('Communications.directives', [])
    .directive('appVersion', ['version', function (version) {
        return function (scope, elm, attrs) {
            elm.text(version);
        };
    }])
    .directive('sigeTurboCommunicationSearch', ['$log',function ($log) {
        return {
            restrict: 'AE',
            scope: {
                ngModel: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.search = $scope.ngModel;
                $scope.resource= {
                    name: ''
                }
            }],
            template: require('./views/global/search.html'),
            link: function ($scope, element, attrs) {
                $scope.showSearch = false;
                //var container_search = element.find("#container_search");
                element.bind("click", function () {
                    $scope.showSearch = true;
                });
                $scope.$watch('search',function(newSearch,oldSearch){
                    if (newSearch !== oldSearch) {
                        if ($scope.resource.name !== '' || $scope.resource.name !== undefined) {

                        }
                        $scope.ngModel = newSearch;
                    }
                });
            }
        }
    }]);
