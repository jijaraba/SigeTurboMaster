@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Formation"))
@section("title", Lang::get("sige.Formation"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("formation.partials.helper")
    @endif
@stop
@section("dashboard")
    <section class="grid-100">
        <section class="sige-contained">
            <h4>Dashboard</h4>
            <div class="sige-dashboard-main">
                @include('formation.partials.dashboard')
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