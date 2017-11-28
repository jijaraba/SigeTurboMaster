@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Purchases"))
@section("title", Lang::get("sige.Purchases"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('admissions.partials.helper')
    @endif
@stop
@section("dashboard")
    <section ng-controller="PaymentsEditController">
        <section class="grid-100">
            <section class="sige-contained">
                <a href="{{ URL::route('financials.payments.index', ['sort' => $sort, 'order' => $order, 'page' => $page])}}"
                   class="btn btn-transparent margin-bottom-20"><i class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
                <section class="sige-payment-main">
                    <h4 style="border-bottom:none">ACTUALIZAR PAGO</h4>
                    <section class="sige-payments-container">
                        <article>
                            <header>
                                <h2>PAGO #{{ setZero(6,$payment->idpayment) }}</h2>
                            </header>
                            <section>
                                <form ng-submit="updatePayment()" style="margin: 0px 0px 20px 0px">
                                    <fieldset>
                                        <ul class="display-horizontal col-100">
                                            <li class="col-10 gutter-5">
                                                <select name="method" ng-model="payment.method"
                                                        title="{{ Lang::get('sige.MethodpaymentTitle') }}"
                                                        ng-init="payment.method = '{{ $payment->method }}'"
                                                        ng-options="method.method as method.name for method in methods"></select>
                                            </li>
                                            <li class="col-15 gutter-5">
                                                <select name="type" ng-model="payment.type"
                                                        title="{{ Lang::get('sige.PaymenttypeTitle') }}"
                                                        ng-init="payment.type = '{{ $payment->idpaymenttype }}'"
                                                        ng-options="concepttype.type as concepttype.name for concepttype in concepttypes"
                                                        required></select>
                                            </li>
                                            <li class="col-10 gutter-5">
                                                <input type="text" ng-model="payment.family"
                                                       title="{{ Lang::get('sige.Codefamily') }}"
                                                       ng-init="payment.family = '{{ $payment->idfamily }}'"
                                                       placeholder="Familia">
                                            </li>
                                            <li class="col-10 gutter-5">
                                                <input type="text" ng-model="payment.student"
                                                       title="{{ Lang::get('sige.Code') }}"
                                                       ng-init="payment.student = '{{ $payment->iduser }}'"
                                                       placeholder="Estudiante">
                                            </li>
                                            <li class="col-10 gutter-5">
                                                <select name="ispayment" ng-model="payment.ispayment"
                                                        title="{{ Lang::get('sige.IsPayment') }}"
                                                        ng-init="payment.ispayment = '{{ $payment->ispayment }}'">
                                                    <option value="N">N</option>
                                                    <option value="Y">Y</option>
                                                </select>
                                            </li>
                                            <li class="col-15 gutter-5">
                                                <select name="approved" ng-model="payment.approved"
                                                        title="{{ Lang::get('sige.Approved') }}"
                                                        ng-init="payment.approved = '{{ $payment->approved }}'">
                                                    <option value="N"></option>
                                                    <option value="A">APROBADO</option>
                                                    <option value="R">RECHAZADO</option>
                                                    <option value="P">PENDIENTE</option>
                                                </select>
                                            </li>
                                            <li class="col-15 gutter-5">
                                                <select name="bank" ng-model="payment.bank"
                                                        title="{{ Lang::get('sige.BankTitle') }}"
                                                        ng-init="payment.bank = '{{ $payment->idbank }}'">
                                                    <option value="1"></option>
                                                    <option value="2">TESORERÍA</option>
                                                    <option value="3">AV VILLAS</option>
                                                    <option value="4">BBVA</option>
                                                </select>
                                            </li>
                                            <li class="col-15 gutter-5">
                                                <input type="text" ng-model="payment.voucher"
                                                       title="{{ Lang::get('sige.VoucherTitle') }}"
                                                       ng-init="payment.voucher = '{{ $payment->voucher }}'"
                                                       placeholder="COMPROBANTE">
                                            </li>
                                            <li class="col-100 gutter-5">
                                                <textarea ng-model="payment.observation"
                                                          title="{{ Lang::get('sige.Observation') }}"
                                                          ng-init="payment.observation = '{{ $payment->observation }}'"
                                                          placeholder="OBSERVACIÓN"></textarea>
                                            </li>
                                            <li class="col-20 gutter-5">
                                                <input type="text" ng-model="payment.value"
                                                       title="{{ Lang::get('sige.RealValue') }}"
                                                       ng-init="payment.value = '{{ $payment->realValue }}'"
                                                       placeholder="Valor Real">
                                            </li>
                                            <li class="col-80 gutter-5"></li>
                                        </ul>
                                    </fieldset>
                                    <fieldset class="payments-options">
                                        <ul class="display-horizontal col-100">
                                            <li class="col-25" ng-click="showOption(1)">
                                                <div>
                                                    <img src="{{env("ASSETS_SERVER")}}/img/modules/payment_discount.svg"
                                                         alt="">
                                                </div>
                                            </li>
                                            <li class="col-25" ng-click="showOption(2)">
                                                <div>
                                                    <img src="{{env("ASSETS_SERVER")}}/img/modules/payment_normal.svg"
                                                         alt="">
                                                </div>
                                            </li>
                                            <li class="col-25" ng-click="showOption(3)">
                                                <div>
                                                    <img src="{{env("ASSETS_SERVER")}}/img/modules/payment_rate.svg"
                                                         alt="">
                                                </div>
                                            </li>
                                            <li class="col-25" ng-click="showOption(4)">
                                                <div>
                                                    <img src="{{env("ASSETS_SERVER")}}/img/modules/payment_agreement.svg"
                                                         alt="">
                                                </div>
                                            </li>
                                        </ul>
                                    </fieldset>
                                    <fieldset ng-show="options.option01">
                                        <legend>OPCIÓN 01:</legend>
                                        <ul class="display-horizontal col-100">
                                            <li class="col-70 gutter-5">
                                                <input type="text" ng-model="payment.concept1"
                                                       title="{{ Lang::get('sige.ConceptWithDiscountTitle') }}"
                                                       ng-init="payment.concept1 = '{{ $payment->concept1 }}'"
                                                       placeholder="Concepto">
                                            </li>
                                            <li class="col-15 gutter-5 icon-left">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <input type="text" ng-model="payment.date1"
                                                       title="{{ Lang::get('sige.DateWithDiscountTitle') }}"
                                                       ng-init="payment.date1 = '{{ $payment->date1 }}'"
                                                       placeholder="Fecha">
                                            </li>
                                            <li class="col-15 gutter-5">
                                                <input type="text" ng-model="payment.value1"
                                                       title="{{ Lang::get('sige.ValueWithDiscountTitle') }}"
                                                       ng-init="payment.value1 = '{{ $payment->value1 }}'"
                                                       placeholder="Valor">
                                            </li>
                                            <li class="col-100 gutter-5 border">
                                                <textarea ng-model="payment.observation1"
                                                          title="{{ Lang::get('sige.ObservationWithDiscountTitle') }}"
                                                          ng-init="payment.observation1 = '{{ $payment->observation1 }}'"
                                                          placeholder="Observación"></textarea>
                                            </li>
                                        </ul>
                                    </fieldset>
                                    <fieldset ng-show="options.option02">
                                        <legend>OPCIÓN 02:</legend>
                                        <ul class="display-horizontal col-100">
                                            <li class="col-70 gutter-5">
                                                <input type="text" ng-model="payment.concept2"
                                                       title="{{ Lang::get('sige.ConceptNormalTitle') }}"
                                                       ng-init="payment.concept2 = '{{ $payment->concept2 }}'"
                                                       placeholder="Concepto">
                                            </li>
                                            <li class="col-15 gutter-5 icon-left">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <input type="text" ng-model="payment.date2"
                                                       title="{{ Lang::get('sige.DateNormalTitle') }}"
                                                       ng-init="payment.date2 = '{{ $payment->date2 }}'"
                                                       placeholder="Fecha">
                                            </li>
                                            <li class="col-15 gutter-5">
                                                <input type="text" ng-model="payment.value2"
                                                       title="{{ Lang::get('sige.ValueNormalTitle') }}"
                                                       ng-init="payment.value2 = '{{ $payment->value2 }}'"
                                                       placeholder="Valor">
                                            </li>
                                            <li class="col-100 gutter-5 border">
                                        <textarea ng-model="payment.observation2"
                                                  title="{{ Lang::get('sige.ObservationNormalTitle') }}"
                                                  ng-init="payment.observation2 = '{{ $payment->observation2 }}'"
                                                  placeholder="Observación"></textarea>
                                            </li>
                                        </ul>
                                    </fieldset>
                                    <fieldset ng-show="options.option03">
                                        <legend>OPCIÓN 03:</legend>
                                        <ul class="display-horizontal col-100">
                                            <li class="col-70 gutter-5">
                                                <input type="text" ng-model="payment.concept3"
                                                       title="{{ Lang::get('sige.ConceptWithRateTitle') }}"
                                                       ng-init="payment.concept3 = '{{ $payment->concept3 }}'"
                                                       placeholder="Concepto">
                                            </li>
                                            <li class="col-15 gutter-5 icon-left">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <input type="text" ng-model="payment.date3"
                                                       title="{{ Lang::get('sige.DateWithRateTitle') }}"
                                                       ng-init="payment.date3 = '{{ $payment->date3 }}'"
                                                       placeholder="Fecha">
                                            </li>
                                            <li class="col-15 gutter-5">
                                                <input type="text" ng-model="payment.value3"
                                                       title="{{ Lang::get('sige.ValueWithRateTitle') }}"
                                                       ng-init="payment.value3 = '{{ $payment->value3 }}'"
                                                       placeholder="Valor">
                                            </li>
                                            <li class="col-100 gutter-5 border">
                                        <textarea ng-model="payment.observation3"
                                                  title="{{ Lang::get('sige.ObservationWithRateTitle') }}"
                                                  ng-init="payment.observation3 = '{{ $payment->observation3 }}'"
                                                  placeholder="Observación"></textarea>
                                            </li>
                                        </ul>
                                    </fieldset>
                                    <fieldset ng-show="options.option04">
                                        <legend>OPCIÓN 04:</legend>
                                        <ul class="display-horizontal col-100">
                                            <li class="col-70 gutter-5">
                                                <input type="text" ng-model="payment.concept4"
                                                       title="{{ Lang::get('sige.ConceptWithAgreementTitle') }}"
                                                       ng-init="payment.concept4 = '{{ $payment->concept4 }}'"
                                                       placeholder="Concepto">
                                            </li>
                                            <li class="col-15 gutter-5  icon-left">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <input type="text" ng-model="payment.date4"
                                                       title="{{ Lang::get('sige.DateWithAgreementTitle') }}"
                                                       ng-init="payment.date4 = '{{ $payment->date4 }}'"
                                                       placeholder="Fecha">
                                            </li>
                                            <li class="col-15 gutter-5">
                                                <input type="text" ng-model="payment.value4 "
                                                       title="{{ Lang::get('sige.ValueWithAgreementTitle') }}"
                                                       ng-init="payment.value4 = '{{ $payment->value4 }}'"
                                                       placeholder="Valor">
                                            </li>
                                            <li class="col-100 gutter-5 border">
                                        <textarea ng-model="payment.observation4"
                                                  title="{{ Lang::get('sige.ObservationWithAgreementTitle') }}"
                                                  ng-init="payment.observation4 = '{{ $payment->observation4 }}'"
                                                  placeholder="Observación"></textarea>
                                            </li>
                                        </ul>
                                    </fieldset>
                                    <fieldset>
                                        <ul class="display-horizontal col-100">
                                            <li class="button gutter-5">
                                                <button id="save" type="submit"
                                                        class="btn btn-aquamarine">{{ Lang::get('sige.Save') }}</button>
                                            </li>
                                        </ul>
                                    </fieldset>
                                    <input type="hidden" ng-model="purchase.idpurchase"
                                           ng-init="payment.idpayment = '{{$payment->idpayment}}'">
                                </form>
                            </section>
                            <footer>

                            </footer>
                        </article>
                    </section>
                </section>

            </section>
        </section>
    </section>
@stop
@section("vendor")
    {!! HTML::script(mix('js/vendor/vendor.js')) !!}
@stop
@section("script")
    {!! HTML::script(mix('js/angular/' . getCurrentRoute() . '.js')) !!}
@stop
@section("sigeturbo")
    {!! HTML::script(mix('js/SigeTurbo.js')) !!}
@stop