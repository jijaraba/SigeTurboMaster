@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Dashboard"))
@section("title", Lang::get("sige.Dashboard"))
@section("content")
    @if(getUser()->welcome_container == 0)
    <section class="grid-100" id="contained">
        <section class="sige-contained-welcome">
            <button class="sige-welcome-close fa fa-times fa-lg" id="sige-welcome-close"></button>
            <h4>{{ ((getUser()->idgender == 1)? Lang::get('sige.Welcome'): Lang::get('sige.Welcome2')). ", " . getUser()->firstname }}</h4>
            <p>SigeTurbo es el Sistema de Información y Gestión Educativa diseñado para soportar el flujo de información de todos los procesos de El Nuevo Colegio. En el módulo <span class="sige-turbo-title-app">{{ Lang::get("sige.Dashboard") }}</span> puedes encontrar estadísticas globales de todos los procesos de El Nuevo Colegio</p>
        </section>
    </section>
    @endif
@stop
@section("dashboard")
    <div class="grid-100" ng-controller="DashboardController">
        <div class="sige-contained">
            <h4>Dashboard</h4>
            <div class="sige-dashboard-main">
                @if(getUser()->role_selected == 'Parents' || getUser()->role_selected == 'Student')
                <a href="/parents">Ir Módulo Padres</a>
                @else
                    @include('home.partials.teacher')
                    <a href="/formation">Ir Módulo Formación</a>
                @endif
            </div>
        </div>
    </div>
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
