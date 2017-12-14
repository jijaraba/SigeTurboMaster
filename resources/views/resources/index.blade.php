@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Resources"))
@section("title", Lang::get("sige.Resources"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('resources.partials.helper')
    @endif
@stop
@section("dashboard")
    <section class="grid-100">
        <section class="sige-contained">
            <h4>Dashboard</h4>
            <div class="sige-dashboard-main">
                @include('resources.partials.dashboard')
            </div>
        </section>
    </section>
@stop
@section("vendor")
    {!! HTML::script('js/vendor/vendor.js') !!}
@stop
@section("script")
    {!! HTML::script('js/angular/' . getCurrentRoute() . '.js') !!}
@stop
@section("socket")
    {!! HTML::script('js/vendor/socket.io.js') !!}
@stop
@section("sigeturbo")
    {!! HTML::script('js/SigeTurbo.js') !!}
    {!! HTML::script('js/Stream.js') !!}
@stop