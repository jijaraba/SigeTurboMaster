@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Parents"))
@section("title", Lang::get("sige.Parents"))
@section("content")
    @if(getUser()->welcome_container == 0)
        <section class="grid-100" id="contained">
            <section class="sige-contained-welcome">
                <button class="sige-welcome-close fa fa-times fa-lg" id="sige-welcome-close"></button>
                <h4>{{ ((getUser()->idgender == 1)? Lang::get('sige.Welcome'): Lang::get('sige.Welcome2')). ", " . getUser()->firstname }}</h4>

                <p><span class="sige-turbo-title-app">SigeTurbo</span> es el Sistema de Información y Gestión Educativa
                    diseñado para soportar el flujo de información de todos los procesos de El Nuevo Colegio. El módulo
                    <span
                            class="sige-turbo-title-app">{!! Lang::get("sige.Parents") !!}</span> está estructurado para
                    soportar todos procesos académicos que se desarrollan en la institución.</p>
            </section>
        </section>
    @endif
@stop
@section("dashboard")
    <section ng-controller="PaymentsRespondController" ng-init="init({{ json_encode($payment) }})">
        <section class="grid-100">
            <section class="sige-contained">
                <section class="sige-payments-checkout">
                    <a href="{{ URL::route('parents.payments.index',[])}}"
                       class="btn btn-transparent"><i class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
                    <h4>Respuesta Pago</h4>
                    <section class="sige-payments-respond">
                        <article>
                            <header>
                                <h2>{{ Lang::get("sige.Payment" . ucfirst($payment->method)) }}</h2>
                                <img src="{{env('ASSETS_SERVER')}}/img/modules/payment_respond.svg"/>
                            </header>
                            <section>
                                <h2>
                                    @if($payment->method == 'agreement')
                                        {{ money($payment->realValue) }}
                                        <span>(SALDO PENDIENTE: {{ money($payment->value2 -  $payment->realValue)}}
                                            )</span>
                                    @else
                                        {{ money($payment->realValue) }}
                                    @endif
                                </h2>
                                <p class="observation">{{ $payment->observation1 }}</p>
                                <sige-turbo-payment-result-transaction
                                        payment="payment"></sige-turbo-payment-result-transaction>
                            </section>
                            <footer>
                                <div>THE NEW SCHOOL</div>
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
@section("payments")
    {!! HTML::script(mix('js/vendor/hmac-sha256.js')) !!}
    {!! HTML::script(mix('js/vendor/enc-base64-min.js')) !!}
@stop