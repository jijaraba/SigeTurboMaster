'use strict';

/* Resources Controllers */
angular.module('Resources.controllers', [])
    .controller('DashboardController', ["$log", "$scope", function ($log, $scope) {

    }])
    .controller('ProviderController', ["$log", "$scope", function ($log, $scope) {

    }])
    .controller('ProviderUpdateController', ["$log", "$scope", 'SweetAlert', 'Provider', function ($log, $scope, SweetAlert, Provider) {
        $scope.provider = [];
        $scope.init = function (provider) {
            $scope.provider = provider;
        }

        $scope.updateProvider = function () {
            Provider.update({
                'id': $scope.provider.idprovider,
                'nit': $scope.provider.nit,
                'name': $scope.provider.name,
                'phone': $scope.provider.phone,
                'fax': $scope.provider.fax,
                'leadtime': parseInt($scope.provider.leadtime),
                'paymentform': parseInt($scope.provider.paymentform),
                'evaluation': parseFloat($scope.provider.evaluation),
                'web': $scope.provider.web,
                'warranty': $scope.provider.warranty,
                'date': $scope.provider.date,
                'observation': ($scope.provider.observation) ? $scope.provider.observation : null,
                'email': ($scope.provider.email) ? $scope.provider.email : null,
                'contact': ($scope.provider.contact) ? $scope.provider.contact : null,
                'services': ($scope.provider.services) ? $scope.provider.services : null,
                'address': ($scope.provider.address) ? $scope.provider.address : null,
            }).$promise.then(
                function (provider) {
                    SweetAlert.success("Excelente", provider.message); 
                },
                function (error) {
                    $log.error(error);
                }
            );

        }

    }]) 
    .controller('PurchaseController', ["$log", "$scope", function ($log, $scope) {

    }])
    .controller('PurchaseNewController', ["$log", "$scope", 'Purchase', function ($log, $scope, Purchase) {
        //Scope
        $scope.purchaseSave = false;
        $scope.purchase = {
            code: '',
            discount: 0,
            leadtime: 1
        }
        //Generate Code
        Purchase.generateCode({}).$promise.then(
            function (result) {
                $scope.purchase.code = result.code;
            },
            function (error) {
                $log.error(error);
            }
        );
        //Functions
        $scope.register = function () {
            if (!$scope.purchaseSave) {
                $scope.purchaseSave = true;
                Purchase.save({
                    'code': $scope.purchase.code,
                    'budget': $scope.purchase.budget,
                    'provider': $scope.purchase.provider,
                    'leadtime': parseInt($scope.purchase.leadtime),
                    'discount': $scope.purchase.discount,
                    'observation': ($scope.purchase.observation) ? $scope.purchase.observation : null
                }).$promise.then(
                    function (data) {
                        $scope.purchase.idpurchase = data.purchase.idpurchase
                        $scope.purchaseSave = true;
                        $scope.showDetail = true;
                    },
                    function (error) {
                        $scope.purchaseSave = false;
                        $scope.showDetail = false;
                        $log.error(error);
                    }
                );
            } else {
                Purchase.update({
                    'idpurchase': $scope.purchase.idpurchase,
                    'code': $scope.purchase.code,
                    'budget': $scope.purchase.budget,
                    'provider': $scope.purchase.provider,
                    'leadtime': parseInt($scope.purchase.leadtime),
                    'discount': $scope.purchase.discount,
                    'observation': ($scope.purchase.observation) ? $scope.purchase.observation : null
                }).$promise.then(
                    function (purchase) {
                        $log.info(purchase);
                        $scope.showDetail = true;
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }
        }
    }])
    .controller('PurchaseUpdateController', ["$log", "$scope", 'SweetAlert', 'Purchase', 'Detail', function ($log, $scope, SweetAlert, Purchase, Detail) {

        $scope.purchase = [];
        $scope.purchaseSave = false;
        $scope.showDetail = false;
        $scope.enabledStatus = 0;
        $scope.details = [];

        $scope.init = function (purchase) {
            $scope.idpurchase = purchase;
            //Factories
            Purchase.get({purchaseId: $scope.idpurchase}).$promise.then(
                function (purchase) {
                    $scope.purchase = purchase;
                    $scope.purchase.idpurchase = purchase.idpurchase.toString();
                    $scope.purchase.status = purchase.idstatuspurchase.toString();
                    if ($scope.purchase.status == 4) {
                        $scope.enabledStatus = 1
                    }
                    $scope.purchase.provider = purchase.idprovider.toString();
                    $scope.purchaseSave = true;

                    //Detail Search
                    Detail.query({purchase: purchase.idpurchase}).$promise.then(
                        function (details) {
                            $scope.showDetail = true;
                            $scope.details = details;
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );

                },
                function (error) {
                    $log.error(error);
                    $scope.purchaseSave = false;
                    $scope.showDetail = false;
                }
            );
        };

        //Functions
        $scope.update = function () {
            Purchase.update({
                'idpurchase': $scope.purchase.idpurchase,
                'code': $scope.purchase.code,
                'budget': $scope.purchase.budget,
                'provider': $scope.purchase.provider,
                'leadtime': parseInt($scope.purchase.leadtime),
                'discount': $scope.purchase.discount,
                'observation': ($scope.purchase.observation) ? $scope.purchase.observation : null
            }).$promise.then(
                function (purchase) {
                    $log.info(purchase);
                    $scope.showDetail = true;
                },
                function (error) {
                    $log.error(error);
                }
            );
        }

        $scope.updateStatus = function () {

            if ($scope.purchase.status == 4) {
                $scope.enabledStatus = 1
            }

            Purchase.updateStatus({
                'purchase': $scope.purchase.idpurchase,
                'status': $scope.purchase.status,
            }).$promise.then(
                function (purchase) {
                    $log.info(purchase);
                    SweetAlert.success("Excelente", purchase.message);
                },
                function (error) {
                    $log.error(error);
                    SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                }
            );
        }

        $scope.$watch('purchase.status', function (newStatus, oldStatus) {
            if (newStatus !== oldStatus) {
                if (newStatus == 4) {
                    $scope.enabledStatus = 1
                }
            }
        });


    }])
    .controller('DetailNewController', ["$scope", '$log', 'SweetAlert', '$location', 'Product', 'Detail', function ($scope, $log, SweetAlert, $location, Product, Detail) {

        $scope.isDisabled = true;
        $scope.detail = {
            quantity: 0,
            cost: 0.00
        }

        $scope.init = function (purchase) {
            $scope.purchaseId = purchase
        }

        $scope.detail.total = $scope.detail.cost * $scope.detail.quantity;

        $scope.$watch('detail.code', function (newCode, oldCode) {
            if ((newCode !== oldCode) && $scope.detail.code != undefined) {
                Product.getCode({code: $scope.detail.code}).$promise.then(
                    function (product) {
                        $scope.detail = {
                            quantity: 0,
                            idproduct: product.idproduct,
                            unit: product.unit,
                            vat: product.vat,
                            product: product.name,
                            cost: 0.00,
                            total: 0.00
                        }
                    },
                    function (error) {
                        $log.error(error);
                    }
                );
            }
        });

        $scope.$watch('detail.quantity', function (newQuantity, oldQuantity) {
            if (newQuantity !== oldQuantity) {
                $scope.detail.total = 0;
                $scope.detail.total = $scope.detail.cost * $scope.detail.quantity;
                if (newQuantity > 0 && $scope.detail.cost > 0) {
                    $scope.isDisabled = false;
                } else {
                    $scope.isDisabled = true;
                }
            }
        });
        $scope.$watch('detail.cost', function (newCost, oldCost) {
            if (newCost !== oldCost) {
                $scope.detail.total = 0;
                $scope.detail.total = $scope.detail.cost * $scope.detail.quantity;
                if (newCost > 0 && $scope.detail.quantity > 0) {
                    $scope.isDisabled = false;
                } else {
                    $scope.isDisabled = true;
                }
            }
        });

        //Create new Item
        $scope.newDetail = function () {
            Detail.save({
                purchase: $scope.purchaseId,
                product: $scope.detail.idproduct,
                quantity: $scope.detail.quantity,
                cost: $scope.detail.cost
            }).$promise.then(
                function (detail) {
                    $log.info(detail);
                    window.location = '/resources/purchases/edit/' + $scope.purchaseId
                },
                function (error) {
                    $log.error(error);
                }
            );
        }

    }])
    .controller('VisitorController', ['$scope', '$log', 'Visitor', function ($scope, $log, Visitor) {

    }])
    .controller('VisitorNewController', ['$scope', '$log', 'SweetAlert', 'moment', 'Visitor', function ($scope, $log, SweetAlert, moment, Visitor) {
        //Scope
        $scope.visitorSave = false;
        $scope.visitor = {
            code: '',
            date: new moment().format('YYYY-MM-DD'),
            time: new moment().format('hh:mm'),
        }
        //Generate Code
        Visitor.generateCode({}).$promise.then(
            function (result) {
                $scope.visitor.code = result.code;
            },
            function (error) {
                $log.error(error);
            }
        );
        //Functions
        $scope.registerVisitor = function () {
            if (!$scope.visitorSave) {
                $scope.visitorSave = true;
                Visitor.save({
                    'code': $scope.visitor.code,
                    'name': $scope.visitor.name,
                    'identificationtype': $scope.visitor.identificationtype,
                    'identification': $scope.visitor.identification,
                    'gender': $scope.visitor.gender,
                    'company': $scope.visitor.company,
                    'type': $scope.visitor.type,
                    'accesstype': $scope.visitor.accesstype,
                    'licenseplate': ($scope.visitor.licenseplate) ? $scope.visitor.licenseplate : null,
                    'date': $scope.visitor.date,
                    'time': $scope.visitor.time,
                    'destination': $scope.visitor.destination,
                    'observation': ($scope.visitor.observation) ? $scope.visitor.observation : null
                }).$promise.then(
                    function (data) {
                        $scope.visitor.idvisitor = data.visitor.idvisitor
                        $scope.visitorSave = true;
                        SweetAlert.success("Excelente", data.message);
                    },
                    function (error) {
                        $scope.visitorSave = false;
                        $log.error(error);
                        SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                    }
                );
            } else {
                Visitor.update({
                    'idvisitor': $scope.visitor.idvisitor,
                    'code': $scope.visitor.code,
                    'name': $scope.visitor.name,
                    'identificationtype': $scope.visitor.identificationtype,
                    'identification': $scope.visitor.identification,
                    'gender': $scope.visitor.gender,
                    'type': $scope.visitor.type,
                    'accesstype': $scope.visitor.accesstype,
                    'licenseplate': ($scope.visitor.licenseplate) ? $scope.visitor.licenseplate : null,
                    'date': $scope.visitor.date,
                    'time': $scope.visitor.time,
                    'destination': $scope.visitor.destination,
                    'observation': ($scope.visitor.observation) ? $scope.visitor.observation : null
                }).$promise.then(
                    function (visitor) {
                        SweetAlert.success("Excelente", visitor.message);
                    },
                    function (error) {
                        $log.error(error);
                        SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                    }
                );
            }
        }
    }])
    .controller('VisitorUpdateController', ['$scope', '$log', 'SweetAlert', 'moment', 'Visitor', function ($scope, $log, SweetAlert, moment, Visitor) {
        //Scope
        $scope.visitorSave = true;
        $scope.visitor = {
            code: '',
            date: new moment().format('YYYY-MM-DD'),
            time: new moment().format('hh:mm'),
        }
        //Functions
        $scope.updateVisitor = function () {
            if (!$scope.visitorSave) {
                $scope.visitorSave = true;
                Visitor.save({
                    'code': $scope.visitor.code,
                    'name': $scope.visitor.name,
                    'identificationtype': $scope.visitor.identificationtype,
                    'identification': $scope.visitor.identification,
                    'gender': $scope.visitor.gender,
                    'company': $scope.visitor.company,
                    'type': $scope.visitor.type,
                    'accesstype': $scope.visitor.accesstype,
                    'licenseplate': ($scope.visitor.licenseplate) ? $scope.visitor.licenseplate : null,
                    'date': $scope.visitor.date,
                    'time': $scope.visitor.time,
                    'destination': $scope.visitor.destination,
                    'observation': ($scope.visitor.observation) ? $scope.visitor.observation : null
                }).$promise.then(
                    function (data) {
                        $scope.visitor.idvisitor = data.visitor.idvisitor
                        $scope.visitorSave = true;
                        SweetAlert.success("Excelente", data.message);
                    },
                    function (error) {
                        $scope.visitorSave = false;
                        $log.error(error);
                        SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                    }
                );
            } else {
                Visitor.update({
                    'idvisitor': $scope.visitor.idvisitor,
                    'code': $scope.visitor.code,
                    'name': $scope.visitor.name,
                    'identificationtype': $scope.visitor.identificationtype,
                    'identification': $scope.visitor.identification,
                    'gender': $scope.visitor.gender,
                    'company': $scope.visitor.company,
                    'type': $scope.visitor.type,
                    'accesstype': $scope.visitor.accesstype,
                    'licenseplate': ($scope.visitor.licenseplate) ? $scope.visitor.licenseplate : null,
                    'date': $scope.visitor.date,
                    'time': $scope.visitor.time,
                    'destination': $scope.visitor.destination,
                    'observation': ($scope.visitor.observation) ? $scope.visitor.observation : null
                }).$promise.then(
                    function (visitor) {
                        SweetAlert.success("Excelente", visitor.message);
                    },
                    function (error) {
                        $log.error(error);
                        SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                    }
                );
            }
            ;
        };
    }])
    .controller('AssetController', ["$log", "$scope", function ($log, $scope) {
        //Scope
        $scope.search = {};
        $scope.init = function (search) {
            $scope.search = search;
        };
        $scope.result = {};

    }])
    .controller('InventoriesController', ["$log", "$scope", function ($log, $scope) {

    }])
    .controller('AssetNewController', ["$log", "$scope", 'SweetAlert', 'Asset', function ($log, $scope, SweetAlert, Asset) {

        //Scope
        $scope.asset = [];
        $scope.saveAsset = false;

        //Create Asset
        $scope.newAsset = function () {
            if(!$scope.saveAsset) {
                Asset.save({
                    'assetcategory': $scope.asset.assetcategory,
                    'provider': $scope.asset.provider,
                    'code': $scope.asset.code,
                    'name': $scope.asset.name,
                    'cost': $scope.asset.cost,
                    'acquired': $scope.asset.acquired,
                    'verified': $scope.asset.verified,
                    'description': ($scope.asset.description) ? $scope.asset.description : null,
                    'manufacturer': ($scope.asset.manufacturer) ? $scope.asset.manufacturer : null,
                    'model': ($scope.asset.model) ? $scope.asset.model : null,
                    'serial': ($scope.asset.serial) ? $scope.asset.serial : null
                }).$promise.then(
                    function (asset) {
                        SweetAlert.success("Excelente", asset.message);
                        $scope.saveAsset = true;
                        $scope.asset.idasset = asset.asset.idasset;
                    },
                    function (error) {
                        $log.error(error);
                        SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                        $scope.saveAsset = false;
                    }
                );
            } else {
                Asset.update({
                    'idasset': $scope.asset.idasset,
                    'assetcategory': $scope.asset.assetcategory,
                    'provider': $scope.asset.provider,
                    'code': $scope.asset.code,
                    'name': $scope.asset.name,
                    'cost': $scope.asset.cost,
                    'acquired': $scope.asset.acquired,
                    'verified': $scope.asset.verified,
                    'description': ($scope.asset.description) ? $scope.asset.description : null,
                    'manufacturer': ($scope.asset.manufacturer) ? $scope.asset.manufacturer : null,
                    'model': ($scope.asset.model) ? $scope.asset.model : null,
                    'serial': ($scope.asset.serial) ? $scope.asset.serial : null
                }).$promise.then(
                    function (asset) {
                        SweetAlert.success("Excelente", asset.message);
                        $scope.saveAsset = true;
                    },
                    function (error) {
                        $log.error(error);
                        SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                    }
                );
            }
        };

    }])
    .controller('AssetUpdateController', ["$log", "$scope", 'SweetAlert', 'Asset', function ($log, $scope, SweetAlert, Asset) {
        //Scope
        $scope.asset = [];

        $scope.init = function (asset) {
            $scope.asset.idasset = asset.idasset,
                $scope.asset.verified = asset.verified,
                $scope.asset.verifiedOld = asset.verified;
        }

        //Update Asset
        $scope.updateAsset = function () {
            Asset.update({
                'idasset': $scope.asset.idasset,
                'assetcategory': $scope.asset.assetcategory,
                'provider': $scope.asset.provider,
                'code': $scope.asset.code,
                'name': $scope.asset.name,
                'cost': $scope.asset.cost,
                'acquired': $scope.asset.acquired,
                'verified': $scope.asset.verified,
                'description': ($scope.asset.description) ? $scope.asset.description : null,
                'manufacturer': ($scope.asset.manufacturer) ? $scope.asset.manufacturer : null,
                'model': ($scope.asset.model) ? $scope.asset.model : null,
                'serial': ($scope.asset.serial) ? $scope.asset.serial : null
            }).$promise.then(
                function (asset) {
                    SweetAlert.success("Excelente", asset.message);
                },
                function (error) {
                    $log.error(error);
                    SweetAlert.error("Error", "Se ha presentado un error al guardar la información");
                }
            );
        };

    }]);