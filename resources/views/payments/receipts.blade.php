@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Payments"))
@section("title", Lang::get("sige.Payments"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('financials.partials.helper')
    @endif
@stop
@section("dashboard")
    <section>
        <section class="grid-100">
            <section class="sige-contained">
                <section class="sige-financials-payment-register">
                    <a class="btn btn-green" href="{{ URL::route('financials.payments.create') }}">
                        <i class="fa fa-plus-circle"></i>
                        <span>{{ Lang::get('sige.Charge') }}</span>
                    </a>
                </section>
                <section class="sige-payments-lists">
                    <h4>{{ Lang::get('sige.Payments') }}</h4>
                    <sigeturbo-payments-calendar server-date="{{ $serverdate }}"></sigeturbo-payments-calendar>
                </section>
            </section>
        </section>
    </section>
@stop
@section("vendor")
    {!! HTML::script(mix('/js/vendor/vendor.js')) !!}
    {!! HTML::script(mix('/js/Utils.js')) !!}
@stop
@section("script")
    {!! HTML::script(mix('js/' . getCurrentRoute() . '/' . getCurrentApp() .  '.js')) !!}
@stop
@section("socket")
    {!! HTML::script(mix('js/vendor/socket.io.js')) !!}
@stop
@section("sigeturbo")
    {!! HTML::script(mix('js/SigeTurbo.js')) !!}
    {!! HTML::script(mix('js/Stream.js')) !!}
@stop