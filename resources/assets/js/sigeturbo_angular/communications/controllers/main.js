'use strict';

/* Communications Controllers */
angular.module('Communications.controllers', [])
    .controller('DashboardController', ['$scope', function ($scope) {
        $scope.message = "Dashboard";
    }])
    .controller('WeeklyevaluationController', ['$scope', '$log', function ($scope, $log) {

    }])
    .controller('WeeklyevaluationNewController', ['$scope', '$log', 'ASSETS_SERVER', 'SweetAlert', 'User', 'Weeklyevaluation', function ($scope, $log, ASSETS_SERVER, SweetAlert, User, Weeklyevaluation) {
        $scope.evaluationStatus = "Insert";
        $scope.evaluation = [];
        $scope.evaluationSave = false;
        $scope.assets = ASSETS_SERVER;

        $scope.Insert = function () {
            if (!$scope.evaluationSave) {
                Weeklyevaluation.save({comment: $scope.evaluation.comment}).$promise.then(
                    function (result) {

                        $scope.evaluationSave = true;
                        $scope.evaluationStatus = "Save";
                        $scope.evaluation.idweeklyevaluation = result.weeklyevaluation.idweeklyevaluation;

                        SweetAlert.swal({
                            title: "Excelente",
                            text: result.message, 
                            type: 'success',
                            closeOnConfirm: false
                        }, function () {
                            if (result.points.show) {

                                //Set Notifications
                                var notification = $('#notifications_count')
                                var count = parseInt(notification.text())
                                notification.text(++count)

                                //Set Points
                                var points = $('#points_counter')
                                var count = parseInt(points.text())
                                points.text(count + result.points.value)

                                SweetAlert.swal({
                                    title: "En hora buena",
                                    text: result.points.message,
                                    imageUrl: "/img/badges/badge.png",
                                    html: true
                                });
                            }

                        });

                    },
                    function (error) {
                        $log.error(error);
                        SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                        $scope.evaluationSave = false
                        $scope.evaluationStatus = "Insert";
                    }
                );
            } else {
                Weeklyevaluation.update({
                    id: $scope.evaluation.idweeklyevaluation,
                    comment: $scope.evaluation.comment
                }).$promise.then(
                    function (result) {
                        $log.info(result);
                        SweetAlert.success("Excelente", result.message);
                        $scope.evaluationSave = true;
                    },
                    function (error) {
                        $log.error(error);
                        SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                        $scope.evaluationSave = true;
                    }
                );
            }

        }

    }])
    .controller('WeeklyevaluationUpdateController', ['$scope', '$log', 'SweetAlert', 'Weeklyevaluation', function ($scope, $log, SweetAlert, Weeklyevaluation) {
        $scope.message = "Actualizar Evaluación";
        $scope.evaluationStatus = "Save";
        $scope.evaluation = [];

        $scope.init = function (evaluation) {
            $scope.evaluation = evaluation;
        }

        $scope.Update = function () {
            Weeklyevaluation.update({
                id: $scope.evaluation.idweeklyevaluation,
                comment: $scope.evaluation.comment
            }).$promise.then(
                function (result) {
                    $log.info(result);
                    SweetAlert.success("Excelente", result.message);
                },
                function (error) {
                    $log.error(error);
                    SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                }
            );
        }

    }]);