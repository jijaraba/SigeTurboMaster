@extends("layouts.default")
@section("ModuleName", Lang::get("sige.MonitoringType"))
@section("title", Lang::get("sige.MonitoringType"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("formation.partials.helper")
    @endif
@stop
@section("dashboard")
    <section ng-controller="MonitoringtypeController">
        <sige-turbo-formation>
            <sige-turbo-academic></sige-turbo-academic>
            <sige-turbo-monitoring-types-insert></sige-turbo-monitoring-types-insert>
            <sige-turbo-monitoring-types-list></sige-turbo-monitoring-types-list>
        </sige-turbo-formation>
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