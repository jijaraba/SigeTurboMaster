'use strict';

/* Resources Directives */
angular.module('Resources.directives', [])
    .directive('appVersion', ['version', function (version) {
        return function (scope, elm) {
            elm.text(version);
        };
    }])
    .directive('sigeTurboPurchaseDetail', ['$log', 'Detail', function ($log, Detail) {
        return {
            restrict: 'AE',
            scope: {
                detail: "="
            },
            controller: ['$scope', function ($scope) {
                $scope.update = function () {
                    Detail.update({
                        iddetail: $scope.detail.iddetail,
                        purchase: $scope.detail.idpurchase,
                        product: $scope.detail.idproduct,
                        quantity: $scope.detail.quantity,
                        cost: $scope.detail.cost
                    }).$promise.then(
                        function (data) {
                            $log.info(data);
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );
                }
            }],
            template: require('./views/detail/update.html'),
            link: function (scope) {
                scope.detail.total = scope.detail.cost * scope.detail.quantity;
                scope.$watch('detail.quantity', function (newQuantity, oldQuantity) {
                    if (newQuantity !== oldQuantity) {
                        scope.detail.total = 0;
                        scope.detail.total = scope.detail.cost * scope.detail.quantity;
                    }
                });
                scope.$watch('detail.cost', function (newCost, oldCost) {
                    if (newCost !== oldCost) {
                        scope.detail.total = 0;
                        scope.detail.total = scope.detail.cost * scope.detail.quantity;
                    }
                });
            }
        };
    }])
    .directive('sigeTurboPurchaseEvaluation', ['$log', 'Evaluationpurchase', 'SweetAlert', function ($log, Evaluationpurchase, SweetAlert) {
        return {
            restrict: 'AE',
            scope: {
                purchase: "@",
                status: "="
            },
            controller: ['$scope', function ($scope) {

                $scope.showEvaluation = true;
                $scope.enabledEvaluation = 1;
                $scope.evaluationpurchase = []

                $scope.evaluationpurchase = {
                    opportunity: 0,
                    quality: 0,
                    service: 0,
                    total: 0,
                };

                //Find Previous Evaluation
                Evaluationpurchase.getEvaluationByPurchase({purchase: $scope.purchase}).$promise.then(
                    function (data) {
                        if (data.idevaluationpurchase) {
                            $scope.showEvaluation = false;
                            $scope.evaluationpurchase = data;
                        }
                    },
                    function (error) {
                        $log.error(error);
                    }
                );

                $scope.evaluation = function () {
                    if ($scope.evaluationpurchase.total > 0) {
                        Evaluationpurchase.save({
                            idpurchase: $scope.purchase,
                            opportunity: $scope.evaluationpurchase.opportunity,
                            quality: $scope.evaluationpurchase.quality,
                            service: $scope.evaluationpurchase.service,
                            total: $scope.evaluationpurchase.total,
                            observation: $scope.evaluationpurchase.observation,
                            status: $scope.status
                        }).$promise.then(
                            function (data) {
                                $scope.showEvaluation = false;
                                SweetAlert.success("Excelente", data.message);
                                //Change Status
                                $scope.status = '4';
                            },
                            function (error) {
                                $log.error(error);
                                SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                            }
                        );
                    }
                }
            }],
            template: require('./views/evaluationpurchase/evaluation.html'),
            link: function (scope) {
                scope.total = function () {
                    scope.evaluationpurchase.total = ((parseFloat(scope.evaluationpurchase.opportunity) + parseFloat(scope.evaluationpurchase.quality) + parseFloat(scope.evaluationpurchase.service)) / 3) / 5;
                    if (scope.evaluationpurchase.total > 0) {
                        scope.enabledEvaluation = 0;
                    }
                }

                scope.$watch('evaluationpurchase.opportunity', function (newOpportunity, oldOpportunity) {
                    if (newOpportunity !== oldOpportunity) {
                        if (newOpportunity < 0 || newOpportunity > 5) {
                            scope.evaluationpurchase.opportunity = 0;
                        }
                    }
                });

                scope.$watch('evaluationpurchase.quality', function (newQuality, oldQuality) {
                    if (newQuality !== oldQuality) {
                        if (newQuality < 0 || newQuality > 5) {
                            scope.evaluationpurchase.quality = 0;
                        }
                    }
                });

                scope.$watch('evaluationpurchase.service', function (newService, oldService) {
                    if (newService !== oldService) {
                        if (newService < 0 || newService > 5) {
                            scope.evaluationpurchase.service = 0;
                        }
                    }
                });

            }
        };
    }])
    .directive('sigeTurboPurchaseProductSelect', ['$log', 'Product', function ($log, Product) {
        return {
            restrict: 'AE',
            scope: {
                ngModel: "="
            },
            controller: ['$scope', function ($scope) {
                $scope.showSearch = true;
                Product.query({}).$promise.then(
                    function (products) {
                        $scope.products = products;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
                $scope.search = function () {
                    $scope.ngModel = $scope.product_code;

                }
            }],
            template: require('./views/product/select.html'),
            link: function (scope) {
                scope.showSearch = true;
                scope.$watch('product_code', function (newValue, oldValue) {
                    if (newValue === '' || newValue === undefined) {
                        scope.showSearch = true;
                    } else {
                        scope.showSearch = false;
                    }
                })
                scope.selectProduct = function (code) {
                    scope.product_code = code;
                    scope.ngModel = code;
                }

            }
        };
    }])
    .directive('sigeTurboVisitorCheckin', ['$log', 'Visitor', function ($log, Visitor) {
        return {
            restrict: 'AE',
            scope: {
                vhour: "@",
                visitor: "@",
                checkin: "@",
                checkout: "@",
            },
            controller: ['$scope', function ($scope) {
                $log.info($scope.vhour);
                $scope.buttonText = $scope.vhour;
                $scope.buttonStatus = false;
                $scope.ClassNormal = true;
                $scope.ClassCheckin = false;
                $scope.ClassCheckout = false;
                if ($scope.checkin !== '' && $scope.checkin !== undefined) {
                    $scope.buttonStatus = true;
                    $scope.buttonText = $scope.checkin;
                    $scope.ClassNormal = false;
                    $scope.ClassCheckin = true;
                    $scope.ClassCheckout = false;
                }
                if ($scope.checkout !== '' && $scope.checkout !== undefined) {
                    $scope.buttonStatus = true;
                    $scope.buttonText = $scope.checkout;
                    $scope.ClassNormal = false;
                    $scope.ClassCheckin = false;
                    $scope.ClassCheckout = true;
                }
            }],
            template: require('./views/visitor/checkin.html'),
            link: function (scope) {
                scope.checkIn = function () {
                    if (scope.buttonStatus && scope.ClassCheckin) {
                        Visitor.checkOut({visitor: scope.visitor}).$promise.then(
                            function (result) {
                                scope.buttonText = result.visitor.checkout;
                                scope.buttonStatus = true;
                                scope.ClassNormal = false;
                                scope.ClassCheckin = false;
                                scope.ClassCheckout = true;
                            },
                            function (error) {
                                $log.error(error);
                                scope.buttonText = 'Entrada';
                                scope.buttonStatus = false;
                                scope.ClassNormal = false;
                                scope.ClassCheckin = true;
                                scope.ClassCheckout = false;
                            }
                        );
                    } else {
                        Visitor.checkIn({visitor: scope.visitor}).$promise.then(
                            function (result) {
                                scope.buttonText = result.visitor.checkin;
                                scope.buttonStatus = true;
                                scope.ClassNormal = false;
                                scope.ClassCheckin = true;
                                scope.ClassCheckout = false;
                            },
                            function (error) {
                                $log.error(error);
                                scope.buttonText = 'Entrada';
                                scope.buttonStatus = false;
                                scope.ClassNormal = true;
                                scope.ClassCheckin = false;
                                scope.ClassCheckout = false;
                            }
                        );
                    }
                }
            }
        };
    }])
    .directive('sigeTurboAssetsSearch', ['$log', 'Ubication', 'Inventorytype', function ($log, Ubication, Inventorytype) {
        return {
            restrict: 'AE',
            scope: {
                search: '=',
                result: '=',
            },
            controller: ['$scope', function ($scope) {
                $scope.showSearch = false;

                // Get Ubications
                Ubication.getUbications({}).$promise.then(
                    function (ubications) {
                        $scope.ubications = ubications;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );

                //Get Inventory types
                Inventorytype.query({}).$promise.then(
                    function (inventories) {
                        $scope.inventories = inventories;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );


            }],
            template: require('./views/global/assets/search.html'),
            link: function ($scope, element, attrs) {

                //Verified Empty Text
                $scope.isEmpty = function (str) {
                    return typeof str == 'string' && !str.trim() || typeof str == 'undefined' || str === null;
                }


                //Search
                $scope.searchForm = function () {
                    $scope.showSearch = true;
                }
                //Watch Year
                $scope.$watch('search.ubication', function (newUbication) {
                    if (isNaN(newUbication)) {
                        $scope.search.ubication = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.ubication = parseInt(newUbication);
                        $scope.result = JSON.stringify($scope.search);
                    }
                });

                //Watch Inventory Type
                $scope.$watch('search.inventory', function (newInventory) {
                    if (isNaN(newInventory)) {
                        $scope.search.inventory = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.inventory = parseInt(newInventory);
                        $scope.result = JSON.stringify($scope.search);
                    }
                });
                //Watch Code
                $scope.$watch('search.code', function (newCode) {
                    if (isNaN(newCode)) {
                        $scope.search.code = undefined;
                        $scope.result = JSON.stringify($scope.search);
                    } else {
                        $scope.search.code = newCode;
                        $scope.result = JSON.stringify($scope.search);
                    }
                });
                //Watch Name
                $scope.$watch('search.name', function (newName) {
                    $scope.search.name = newName;
                    $scope.result = JSON.stringify($scope.search);
                });

            }
        }
    }]);