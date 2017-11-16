@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Observator"))
@section("title", Lang::get("sige.Observator"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("formation.partials.helper")
    @endif
@stop
@section("dashboard")
    <section ng-controller="ObservatorController">
        <sige-turbo-formation>
            <sige-turbo-formation>
                <sige-turbo-academic-basic></sige-turbo-academic-basic>
                <sige-turbo-observator></sige-turbo-observator>
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