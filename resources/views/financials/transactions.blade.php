@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Financials"))
@section("title", Lang::get("sige.Financials"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("financials.partials.helper")
    @endif
@stop
@section("dashboard")
    <section class="grid-100" ng-controller="TransactionsController">
        <section class="sige-contained">
            <h4>{{ Lang::get('sige.Transactions') }}</h4>
            <section class="sige-financials-student">
                <section class="sige-members">
                    @include('financials.partials.members.list')
                </section>
            </section>
            <section class="sige-financials-transactions">
                <section class="transactions-container">
                    <sige-turbo-financials-payments
                            student="{{ $student->iduser }}"></sige-turbo-financials-payments>
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
@section("socket")
    {!! HTML::script(mix('js/vendor/socket.io.js')) !!}
@stop
@section("sigeturbo")
    {!! HTML::script(mix('js/SigeTurbo.js')) !!}
    {!! HTML::script(mix('js/Stream.js')) !!}
@stop
