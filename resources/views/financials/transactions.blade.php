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
@section("script")
    {!! HTML::script('js/' . getCurrentRoute() . '.js') !!}
@stop
@section("vendor")
    {!! HTML::script('js/vendor/vendor.js') !!}
@stop
@section("socket")
    {!! HTML::script('js/vendor/socket.io.js') !!}
@stop
@section("sigeturbo")
    {!! HTML::script('js/SigeTurbo.js') !!}
    {!! HTML::script('js/Stream.js') !!}
@stop
