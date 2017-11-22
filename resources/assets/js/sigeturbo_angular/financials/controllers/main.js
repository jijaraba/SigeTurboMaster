'use strict';

/* Financials Controllers */
angular.module('Financials.controllers', [])
    .controller('DashboardController', ['$log', '$scope', 'Payment','$window', '$filter', function ($log, $scope, Payment,$window,$filter) {

        $scope.registry= {
            vouchertype : undefined
        };
        //Vouchertypes
        $scope.vouchertypes = [
            {code: '00001', name: 'RECIBO VIRTUAL'},
            {code: '00002', name: 'RECIBO MANUAL'},
            {code: '00008', name: 'VENTAS'},
            {code: '00010', name: 'ANTICIPO'},
        ];

        $scope.dataincomplete = false;
        $scope.exportseat = function ($type) {
            if($scope.registry.vouchertype != undefined && $filter('getValidateDate')($scope.registry.starts) == true && $filter('getValidateDate')($scope.registry.ends) == true){
                $scope.dataincomplete = false;
                $window.location.href = '/totxt?vouchertype='+$scope.registry.vouchertype+'&starts='+$scope.registry.starts+'&ends='+$scope.registry.ends+'&type='+$type;
            }else{
                $scope.dataincomplete = true;
            }
        };

        //Get Payments Pendings
        Payment.getPaymentsPendings({}).$promise.then(
            function (payments) {
                $scope.payments = payments;
                $log.info(payments);
            },
            function (error) {
                $log.info(error);
            }
        );
    }])
    .controller('StudentsController', ['$log', '$scope', function ($log, $scope) {
        //Scope
        $scope.search = {};
        $scope.init = function (search) {
            $scope.search = search;
        };
        $scope.result = {};

    }])
    .controller('TransactionsController', ['$log', '$scope', function ($log, $scope) {
        //Scope
        $scope.init = function (student) {
            $scope.student = student;
        };
    }])
    .controller('PaymentsController', ['$log', '$scope', function ($log, $scope) {
        //Scope
        $scope.search = {};
        $scope.init = function (search) {
            $scope.search = search;
        };
        $scope.result = {};


    }])
    .controller('PaymentsCreateController', [function () {

    }])
    .controller('PaymentsEditController', ['$log', '$scope', 'Payment', 'SweetAlert', function ($log, $scope, Payment, SweetAlert) {
        $scope.payment = {};
        //Concepts
        $scope.concepttypes = [
            {type: '1', name: 'MATRÍCULA'},
            {type: '2', name: 'PENSIÓN'},
            {type: '3', name: 'EXTRACURRICULAR'},
            {type: '4', name: 'NIVELACIÓN'},
        ];
        //Methods
        $scope.methods = [
            {method: 'discount', name: 'DESCUENTO'},
            {method: 'normal', name: 'NORMAL'},
            {method: 'card', name: 'TARJETA'},
            {method: 'agreement', name: 'ACUERDO'},
        ];
        //Options
        $scope.options = {
            option01: false,
            option02: false,
            option03: false,
            option04: false,
        };
        //
        //Functions
        $scope.showOption = function (method) {
            switch (method) {
            case 1:
                $scope.options.option01 = true;
                $scope.options.option02 = false;
                $scope.options.option03 = false;
                $scope.options.option04 = false;
                break;
            case 2:
                $scope.options.option01 = false;
                $scope.options.option02 = true;
                $scope.options.option03 = false;
                $scope.options.option04 = false;
                break;
            case 3:
                $scope.options.option01 = false;
                $scope.options.option02 = false;
                $scope.options.option03 = true;
                $scope.options.option04 = false;
                break;
            case 4:
                $scope.options.option01 = false;
                $scope.options.option02 = false;
                $scope.options.option03 = false;
                $scope.options.option04 = true;
                break;
            }
        };

        $scope.$watch('payment.ispayment', function (newPayment) {
            if (newPayment === 'Y') {
                $scope.payment.approved = 'A';
            } else {
                $scope.payment.approved = 'N';
            }
        });

        $scope.updatePayment = function () {
            Payment.update({
                'id': $scope.payment.idpayment,
                'method': $scope.payment.method,
                'type': $scope.payment.type,
                'family': $scope.payment.family,
                'student': $scope.payment.student,
                'ispayment': $scope.payment.ispayment,
                'approved': $scope.payment.approved,
                'bank': $scope.payment.bank,
                'voucher': $scope.payment.voucher,
                'observation': $scope.payment.observation,
                'concept1': $scope.payment.concept1,
                'date1': $scope.payment.date1,
                'value1': $scope.payment.value1,
                'observation1': $scope.payment.observation1,
                'concept2': $scope.payment.concept1,
                'date2': $scope.payment.date2,
                'value2': $scope.payment.value2,
                'observation2': $scope.payment.observation2,
                'concept3': $scope.payment.concept3,
                'date3': $scope.payment.date3,
                'value3': $scope.payment.value3,
                'observation3': $scope.payment.observation3,
                'concept4': $scope.payment.concept4,
                'date4': $scope.payment.date4,
                'value4': $scope.payment.value4,
                'observation4': $scope.payment.observation4,
                'value': $scope.payment.value,
            }).$promise.then(
                function (result) {
                    SweetAlert.success('Excelente', result.message);
                },
                function (error) {
                    $log.error(error);
                    SweetAlert.error('Error', 'Error al procesar la operación');
                }
            );
        };

    }]);

