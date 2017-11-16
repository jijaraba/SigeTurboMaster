@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Communications"))
@section("title", Lang::get("sige.Communications"))
@section("content")
    <section class="grid-100" id="contained">
        <section class="sige-contained-welcome">
            <button class="sige-welcome-close fa fa-times fa-lg" id="sige-welcome-close"></button>
            <h4>{{ ((getUser()->idgender == 1)? Lang::get('sige.Welcome'): Lang::get('sige.Welcome2')). ", " . getUser()->firstname }}</h4>
            <p><span class="sige-turbo-title-app">SigeTurbo</span> es el Sistema de Información y Gestión Educativa diseñado para soportar el flujo de información de todos los procesos de El Nuevo Colegio. En el módulo <span class="sige-turbo-title-app">{!! Lang::get("sige.Communications") !!}</span> se encuentra diseñado para soportar todos los procesos de apoyo de la institución.</p>
        </section>
    </section>
@stop
@section("dashboard")
    <section class="grid-100">
        <section class="sige-contained">
            <h4>Dashboard</h4>
            <div class="sige-dashboard-main">

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