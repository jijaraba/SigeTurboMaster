@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Parents"))
@section("title", Lang::get("sige.Parents"))
@section("content")
    @if(getUser()->welcome_container == 0)
        <section class="grid-100" id="contained">
            <section class="sige-contained-welcome">
                <button class="sige-welcome-close fa fa-times fa-lg" id="sige-welcome-close"></button>
                <h4>{{ ((getUser()->idgender == 1)? Lang::get('sige.Welcome'): Lang::get('sige.Welcome2')). ", " . getUser()->firstname }}</h4>
                <p><span class="sige-turbo-title-app">SigeTurbo</span> es el Sistema de Información y Gestión Educativa
                    diseñado para soportar el flujo de información de todos los procesos de El Nuevo Colegio. El módulo
                    <span class="sige-turbo-title-app">{!! Lang::get("sige.Parents") !!}</span> está estructurado para
                    soportar todos procesos académicos que se desarrollan en la institución.</p>
            </section>
        </section>
    @endif
@stop
@section("dashboard")
    <section class="grid-100">
        <section class="sige-contained">
            <h4>Dashboard</h4>
            <div class="sige-dashboard-main">
                @include('parents.partials.dashboard')
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
@section("sigeturbo")
    {!! HTML::script(mix('js/SigeTurbo.js')) !!}
@stop