/* eslint-disable no-undef */
'use strict';
/* Parents Directives */
angular.module('Parents.directives', [])
    .directive('appVersion', ['version', function (version) {
        return function (scope, elm) {
            elm.text(version);
        };
    }])
    .directive('sigeTurboPaymentResultTransaction', ['$log', 'ASSETS_SERVER', function ($log, ASSETS_SERVER) {
        return {
            restrict: 'AE',
            scope: {
                payment: '='
            },
            controller: ['$scope', function ($scope) {
                $scope.assets = ASSETS_SERVER;
                switch ($scope.payment.approved) {
                case 'A':
                    $scope.transactionType = 'TRANSACCIÓN APROBADA';
                    $scope.message = 'MUCHAS GRACIAS POR SU PAGO';
                    break;
                case 'P':
                    $scope.transactionType = 'TRANSACCIÓN PENDIENTE';
                    $scope.message = 'TRANSACCIÓN PENDIENTE POR SER APROBADA POR SU ENTIDAD BANCARIA';
                    break;
                case 'R':
                    $scope.transactionType = 'TRANSACCIÓN RECHAZADA';
                    $scope.message = 'TRANSACCIÓN RECHAZADA POR SU ENTIDAD BANCARIA';
                    break;
                }
            }],
            template: require('./views/payment/transaction.html'),
            link: function () {
            }
        };
    }])
    .directive('sigeTurboReportGenerate', ['$log', '$timeout', 'ASSETS_SERVER', 'Export', function ($log, $timeout, ASSETS_SERVER, Export) {
        return {
            restrict: 'AE',
            scope: {
                student: '@'
            },
            controller: ['$scope', function ($scope) {
                $scope.assets = ASSETS_SERVER;
                $scope.showDownload = false;
                $scope.generateText = 'Generar';
                $scope.generate = function (filename, format) {

                    Export.getPartialReport({
                        'filename': filename,
                        'format': format,
                        'year': 2017,
                        'period': 1,
                        'student': $scope.student,
                    }).$promise.then(
                        function (result) {
                            $scope.download = $scope.assets + '/export/' + result.file;
                            $timeout(function () {
                                $scope.generateText = 'Generado';
                                $scope.showDownload = true;
                            }, 2000);
                        },
                        function (error) {
                            $log.error(error);
                            $scope.showDownload = false;
                        }
                    );
                };
            }],
            template: require('./views/report/generate.html'),
            link: function () {

            }
        };
    }])
    .directive('sigeTurboPaymentCheckout', ['$log', 'Payment', 'ASSETS_SERVER', 'CONVENIO_ID', 'CONVENIO_KEY', function ($log, Payment, ASSETS_SERVER, CONVENIO_ID, CONVENIO_KEY) {
        return {
            restrict: 'AE',
            scope: {
                payment: '=',
                transaction: '=',
            },
            controller: ['$scope', function ($scope) {
                $scope.assets = ASSETS_SERVER;
                $scope.transaccionID = $scope.transaction + '-' + $scope.payment.idpayment,
                $scope.methodValid = false;
                $scope.methodSelected = 'normal';
                $scope.message = 'Seleccionar tipo de pago';
                $scope.payment_ref = [];
                $scope.agreement = false;
                $scope.icon_discount = 'payment_discount.svg';
                $scope.icon_normal = 'payment_normal.svg';
                $scope.icon_rate = 'payment_rate.svg';
                $scope.icon_agreement = 'payment_agreement.svg';
            }],
            template: require('./views/payment/checkout.html'),
            link: function ($scope) {

                //Submit Data to CPV
                $scope.submit = function () {
                    var reg = {};
                    reg.convenioId = parseInt(CONVENIO_ID);
                    reg.transaccionConvenioId = $scope.transaccionID;
                    reg.referenciaPago1 = $scope.payment.iduser;
                    reg.referenciaPago2 = '';
                    reg.referenciaPago3 = '';
                    reg.referenciaPago4 = '';
                    reg.descripcion = $scope.payment_ref.concept;
                    reg.valor = parseInt($scope.payment_ref.value);
                    reg.urlRespuesta = 'https://sigeturbo.thenewschool.edu.co/parents/payments/respond?transaccionConvenioId={transaccionConvenioId}&transaccionId={transaccionId}&aprobado={aprobado}&ref1={ref1}&valor={valor}&uuid={uuid}';

                    var hashforQuery = $scope.getHashForQuery(reg, CONVENIO_KEY);

                    //Save Payment Method AND HASH
                    Payment.setPaymentMethod({
                        'payment': $scope.payment.idpayment,
                        'method': $scope.methodSelected,
                        'hash': hashforQuery,
                        'transaccionTNS': $scope.transaccionID,
                        'approved': 'P',
                        'realValue': parseInt($scope.payment_ref.value)
                    }).$promise.then(
                        function () {
                            $scope.setHash(reg, CONVENIO_KEY);
                            $scope.sendCpv(reg, '#formPaymentCpv');
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );
                };

                //Send Data To CPV
                $scope.sendCpv = function (reg, form) {
                    $(form).empty();
                    $.each(reg, function (key, value) {
                        $('<input type="hidden" />').attr({name: key, value: value}).appendTo(form);
                    });
                    $(form).submit();
                };

                //Encode Text
                $scope.encodeText = function (text, keyHttps) {
                    var hash = CryptoJS.HmacSHA256(text, keyHttps);
                    return CryptoJS.enc.Base64.stringify(hash);
                };

                $scope.getHashForQuery = function (reg, keyHttps) {
                    var text = [reg.convenioId, reg.transaccionConvenioId || ''].join('-');
                    return $scope.encodeText(text, keyHttps);
                };

                //Calculate hash
                $scope.setHash = function (reg, keyHttps) {
                    var text = [reg.convenioId, reg.transaccionConvenioId || ''
                        , reg.referenciaPago1, reg.referenciaPago2 || '', reg.referenciaPago3 || '', reg.referenciaPago4 || ''
                        , reg.valor || '', reg.urlRespuesta].join('-');
                    reg.hash = $scope.encodeText(text, keyHttps);
                };

                //Calculate hash
                /*$scope.setHash = function (reg, keyHttps) {
                 var text = [reg.convenioId, reg.transaccionConvenioId || ""
                 , reg.referenciaPago1, reg.referenciaPago2, reg.referenciaPago3, reg.referenciaPago4
                 , reg.valor || "", reg.urlRespuesta].join("-");
                 reg.hash = $scope.encodeText(text, keyHttps)
                 }*/


                //Get Method by Default
                var dateDiscountPayment = moment($scope.payment.date1, 'YYYY-MM-DD').format('YYYY-MM-DD');
                var dateNormalPayment = moment($scope.payment.date2, 'YYYY-MM-DD').format('YYYY-MM-DD');
                var dateCurrent = moment($scope.payment.currentDate, 'YYYY-MM-DD').format('YYYY-MM-DD');
                var dateshortPayment = moment($scope.payment.date1, 'YYYY-MM-DD').format('YYYY-MM');
                var dateshortCurrent = moment($scope.payment.currentDate, 'YYYY-MM-DD').format('YYYY-MM');


                if (dateshortPayment <= dateshortCurrent) {
                    if (dateDiscountPayment >= dateCurrent) {
                        //Selected Method
                        $scope.methodSelected = 'discount';
                        //Verified Method
                        if ($scope.payment.concept1 != null) {
                            $scope.methodValid = true;
                        } else {
                            $scope.methodValid = false;
                        }
                        //Charge Values
                        $scope.payment_ref = {
                            referenciaPago1: $scope.payment.idpayment,
                            concept: $scope.payment.concept1,
                            observation: $scope.payment.observation1,
                            value: $scope.payment.value1,
                            date: $scope.payment.date1
                        };
                        //Change Images
                        $scope.icon_discount = 'payment_discount_active.svg';
                        $scope.icon_normal = 'payment_normal.svg';
                        $scope.icon_rate = 'payment_rate.svg';
                        $scope.icon_agreement = 'payment_agreement.svg';
                    } else if (dateNormalPayment >= dateCurrent) {
                        //Selected Method
                        $scope.methodSelected = 'normal';
                        //Verified Method
                        if ($scope.payment.concept2 != null) {
                            $scope.methodValid = true;
                        } else {
                            $scope.methodValid = false;
                        }
                        //Charge Values
                        $scope.payment_ref = {
                            referenciaPago1: $scope.payment.idpayment,
                            concept: $scope.payment.concept2,
                            observation: $scope.payment.observation2,
                            value: $scope.payment.value2,
                            date: $scope.payment.date2
                        };
                        //Change Images
                        $scope.icon_discount = 'payment_discount.svg';
                        $scope.icon_normal = 'payment_normal_active.svg';
                        $scope.icon_rate = 'payment_rate.svg';
                        $scope.icon_agreement = 'payment_agreement.svg';
                    } else {
                        //Selected Method
                        $scope.methodSelected = 'rate';
                        //Verified Method
                        if ($scope.payment.concept3 != null) {
                            $scope.methodValid = true;
                        } else {
                            $scope.methodValid = false;
                        }
                        //Charge Values
                        $scope.payment_ref = {
                            referenciaPago1: $scope.payment.idpayment,
                            concept: $scope.payment.concept3,
                            observation: $scope.payment.observation3,
                            value: $scope.payment.value3,
                            date: $scope.payment.date3
                        };
                        //Change Images
                        $scope.icon_discount = 'payment_discount.svg';
                        $scope.icon_normal = 'payment_normal.svg';
                        $scope.icon_rate = 'payment_rate_active.svg';
                        $scope.icon_agreement = 'payment_agreement.svg';
                    }
                } else {

                    //Selected Method
                    $scope.methodSelected = 'discount';

                    //Verified Method
                    if ($scope.payment.concept1 != null) {
                        $scope.methodValid = true;
                    } else {
                        $scope.methodValid = false;
                    }
                    //Charge Values
                    $scope.payment_ref = {
                        referenciaPago1: $scope.payment.idpayment,
                        concept: $scope.payment.concept1,
                        observation: $scope.payment.observation1,
                        value: $scope.payment.value1,
                        date: $scope.payment.date1
                    };
                    //Change Images
                    $scope.icon_discount = 'payment_discount_active.svg';
                    $scope.icon_normal = 'payment_normal.svg';
                    $scope.icon_rate = 'payment_rate.svg';
                    $scope.icon_agreement = 'payment_agreement.svg';
                }

                $scope.method = function (method) {

                    //Selected Method
                    $scope.methodSelected = method;

                    switch (method) {
                    case 'discount':
                        //Agreement
                        $scope.agreement = false;

                        if (dateshortPayment <= dateshortCurrent) {
                            if (dateDiscountPayment < dateCurrent) {
                                $scope.payment.concept1 = null;
                            }
                        }
                        //Verified Method Discount
                        if ($scope.payment.concept1 != null) {
                            $scope.methodValid = true;
                        } else {
                            $scope.methodValid = false;
                            $scope.message = 'No hay pagos con descuento configurados';
                        }
                        //Charge Values
                        $scope.payment_ref = {
                            referenciaPago1: $scope.payment.idpayment,
                            concept: $scope.payment.concept1,
                            observation: $scope.payment.observation1,
                            value: $scope.payment.value1,
                            date: $scope.payment.date1
                        };
                        //Change Images
                        $scope.icon_discount = 'payment_discount_active.svg';
                        $scope.icon_normal = 'payment_normal.svg';
                        $scope.icon_rate = 'payment_rate.svg';
                        $scope.icon_agreement = 'payment_agreement.svg';
                        break;
                    case 'normal':
                        //Agreement
                        $scope.agreement = false;

                        if (dateNormalPayment < dateCurrent) {
                            $scope.payment.concept2 = null;
                        }

                        //Verified Method
                        if ($scope.payment.concept2 != null) {
                            $scope.methodValid = true;
                        } else {
                            $scope.methodValid = false;
                            $scope.message = 'No hay pagos configurados';
                        }
                        //Charge Values
                        $scope.payment_ref = {
                            referenciaPago1: $scope.payment.idpayment,
                            concept: $scope.payment.concept2,
                            observation: $scope.payment.observation2,
                            value: $scope.payment.value2,
                            date: $scope.payment.date2
                        };
                        //Change Images
                        $scope.icon_discount = 'payment_discount.svg';
                        $scope.icon_normal = 'payment_normal_active.svg';
                        $scope.icon_rate = 'payment_rate.svg';
                        $scope.icon_agreement = 'payment_agreement.svg';
                        break;
                    case 'rate':
                        //Agreement
                        $scope.agreement = false;

                        if (dateNormalPayment > dateCurrent) {
                            $scope.payment.concept3 = null;
                        }

                        //Verified Method
                        if ($scope.payment.concept3 != null) {
                            $scope.methodValid = true;
                        } else {
                            $scope.methodValid = false;
                            $scope.message = 'No se han configurado pago con intereses';
                        }
                        //Charge Values
                        $scope.payment_ref = {
                            referenciaPago1: $scope.payment.idpayment,
                            concept: $scope.payment.concept3,
                            observation: $scope.payment.observation3,
                            value: $scope.payment.value3,
                            date: $scope.payment.date3
                        };
                        //Change Images
                        $scope.icon_discount = 'payment_discount.svg';
                        $scope.icon_normal = 'payment_normal.svg';
                        $scope.icon_rate = 'payment_rate_active.svg';
                        $scope.icon_agreement = 'payment_agreement.svg';
                        break;
                    case 'agreement':
                        //Agreement
                        $scope.agreement = true;

                        var realValue = 0;
                        if (dateshortPayment <= dateshortCurrent) {
                            if (dateDiscountPayment > dateCurrent) {
                                realValue = $scope.payment.value1;
                            } else if (dateNormalPayment > dateCurrent) {
                                realValue = $scope.payment.value2;
                            } else {
                                realValue = $scope.payment.value3;
                            }
                        } else {
                            realValue = $scope.payment.value1;
                        }

                        //Verified Method
                        if ($scope.payment.concept4 != null) {
                            $scope.methodValid = true;
                        } else {
                            $scope.methodValid = false;
                            $scope.message = 'No hay acuerdos de pago';
                        }
                        
                        //Charge Values
                        $scope.payment_ref = {
                            referenciaPago1: $scope.payment.idpayment,
                            concept: $scope.payment.concept4,
                            observation: $scope.payment.observation4,
                            value: realValue,
                            date: $scope.payment.date4
                        };
                        //Change Images
                        $scope.icon_discount = 'payment_discount.svg';
                        $scope.icon_normal = 'payment_normal.svg';
                        $scope.icon_rate = 'payment_rate.svg';
                        $scope.icon_agreement = 'payment_agreement_active.svg';
                        break;
                    default:
                        //Verified Method
                        if ($scope.payment.concept1 != null) {
                            $scope.methodValid = true;
                        } else {
                            $scope.methodValid = false;
                            $scope.message = 'No hay pagos con descuento configurados';
                        }
                        //Charge Values
                        $scope.payment_ref = {
                            referenciaPago1: $scope.payment.idpayment,
                            concept: $scope.payment.concept1,
                            observation: $scope.payment.observation1,
                            value: $scope.payment.value1,
                            date: $scope.payment.date1
                        };
                        //Change Images
                        $scope.icon_discount = 'payment_discount_active.svg';
                        $scope.icon_normal = 'payment_normal.svg';
                        $scope.icon_rate = 'payment_rate.svg';
                        $scope.icon_agreement = 'payment_agreement.svg';
                        break;
                    }
                };

                //Change Value Agreement
                $scope.changeValueAgreement = function () {
                    Payment.setPaymentAgreement({
                        'payment': $scope.payment.idpayment,
                        'value': $scope.payment_ref.value
                    }).$promise.then(
                        function (result) {
                            $log.log(result);
                        },
                        function (error) {
                            $log.error(error);
                        }
                    );
                };

            }
        };
    }]);