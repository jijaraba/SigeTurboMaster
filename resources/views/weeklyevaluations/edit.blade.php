@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Communications"))
@section("title", Lang::get("sige.Communications"))
@section("content")
    <section class="grid-100" id="contained">
        <section class="sige-contained-welcome">
            <button class="sige-welcome-close fa fa-times fa-lg" id="sige-welcome-close"></button>
            <h4>{{  ((getUser()->idgender == 1)? Lang::get('sige.Welcome'): Lang::get('sige.Welcome2')). ", " . getUser()->firstname }}</h4>
            <p><span class="sige-turbo-title-app">SigeTurbo</span> es el Sistema de Información y Gestión Educativa diseñado para soportar el flujo de información de todos los procesos de El Nuevo Colegio. En el módulo <span class="sige-turbo-title-app">{!! Lang::get("sige.Communications") !!}</span> se encuentra diseñado para soportar todos los procesos de apoyo de la institución.</p>
        </section>
    </section>
@stop
@section("dashboard")
    <section class="grid-100" ng-controller="WeeklyevaluationUpdateController" ng-init="init({{ json_encode($weeklyevaluation) }})">
        <section class="sige-contained">
            <a href="{{ URL::route('communications.weeklyevaluations.index')}}" class="btn btn-transparent"><i class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
            <section class="sige-evaluation-new">
                <h4>{{ Lang::get('sige.Weeklyevaluations') }}</h4>
                <form ng-submit="Update()" name="evaluationForm" id="evaluationForm" method="post">
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-15 gutter-5 photo">
                                <div>
                                    <img src="{{env('ASSETS_SERVER')}}/img/users/{{$user->photo}}" alt="{{ $user->fullname }}" title="{{ $user->fullname }}"/>
                                </div>
                            </li>
                            <li class="col-85 gutter-5">
                                <textarea name="comment" id="comment" ng-model="evaluation.comment" placeholder="¿Qué pasó durante esta semana?" required>{{ $weeklyevaluation->comment }}</textarea>
                            </li>
                        </ul>
                    </fieldset>
                    <div class="submit col-100 gutter-5">
                        <input type="submit" value="@{{ evaluationStatus }}" class="btn btn-green">
                    </div>
                </form>
            </section>
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