'use strict';

/* Guest Controllers */
angular.module('Guest.controllers', [])
    .controller('TaskController', ['$scope', '$log', 'ngDialog', function ($scope, $log, ngDialog) {
        ngDialog.open({
            template: require('../directives/views/partials/tasks/message.html'),
            plain: true,
            scope: $scope
        });
    }])
    .controller('TaskDetailController', [function () {

    }])
    .controller('PaymentsGuestController', ['$scope', '$log', 'ngDialog', 'Family', function ($scope, $log, ngDialog, Family) {

        ngDialog.open({
            template: require('../directives/views/partials/costs/message.html'),
            plain: true,
            scope: $scope
        });

        //Scope
        $scope.search = {};
        $scope.options = {
            gateway: true,
            bank: false,
            aspans: false,
        };
        $scope.showOption = function (option) {
            switch (option) {
                case 1:
                    $scope.options = {
                        gateway: true,
                        bank: false,
                        aspans: false,
                    };
                    break;
                case 2:
                    $scope.options = {
                        gateway: false,
                        bank: true,
                        aspans: false,
                    };
                    break;
                case 3:
                    $scope.options = {
                        gateway: false,
                        bank: false,
                        aspans: true,
                    };
                    break;
            }
        };

        //Verified Empty Text
        $scope.isEmpty = function (str) {
            return typeof str == 'string' && !str.trim() || typeof str == 'undefined' || str === null;
        };

        $scope.searchFamily = function () {
            if (!$scope.isEmpty($scope.search.family)) {
                Family.getFamilyByName({search: $scope.search.family}).$promise.then(
                    function (result) {
                        if (result.name) {
                            $scope.search.family = 'Su código es: ' + result.idfamily;
                        } else {
                            $scope.search.family = 'No existe la familia';
                        }
                    },
                    function (error) {
                        $log.info(error);
                    }
                );
            }
        };

    }]);