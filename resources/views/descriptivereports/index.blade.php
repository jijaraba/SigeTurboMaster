@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Descriptivereport"))
@section("title", Lang::get("sige.Descriptivereport"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("formation.partials.helper")
    @endif
@stop
@section("dashboard")
    <section ng-controller="DescriptivereportController">
        <sige-turbo-formation>
            <sige-turbo-academic></sige-turbo-academic>
            <sige-turbo-descriptive-report></sige-turbo-descriptive-report>
        </sige-turbo-formation>
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