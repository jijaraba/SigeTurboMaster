@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Admissions"))
@section("title", Lang::get("sige.Admissions"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("admissions.partials.helper")
    @endif
@stop
@section("dashboard")
    <section class="grid-100" ng-controller="DashboardController">
        <section class="sige-contained">
            <h4>Dashboard</h4>
            <div class="sige-dashboard-main">
                @include('admissions.partials.dashboard.global')
            </div>
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
