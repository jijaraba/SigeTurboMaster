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
