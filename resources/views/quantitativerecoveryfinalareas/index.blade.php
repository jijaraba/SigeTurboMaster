@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Quantitativerecoveryfinalareas"))
@section("title", Lang::get("sige.Quantitativerecoveryfinalareas"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("formation.partials.helper")
    @endif
@stop
@section("dashboard")
   <section ng-controller="QuantitaiverecoveryfinalareasController" ng-init="init({{ json_encode($search) }})">
            @if($userselected === null)
                @include('quantitativerecoveryfinalareas.partials.allpendings')
            @else
                @include('quantitativerecoveryfinalareas.partials.allpendingsbystudent')
            @endif
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