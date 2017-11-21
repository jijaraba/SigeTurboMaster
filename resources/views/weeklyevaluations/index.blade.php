@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Communications"))
@section("title", Lang::get("sige.Communications"))
@section("content")
    <section class="grid-100" id="contained">
        <section class="sige-contained-welcome">
            <button class="sige-welcome-close fa fa-times fa-lg" id="sige-welcome-close"></button>
            <h4>{{ ((getUser()->idgender == 1)? Lang::get('sige.Welcome'): Lang::get('sige.Welcome2')). ", " . getUser()->firstname }}</h4>
            <p><span class="sige-turbo-title-app">SigeTurbo</span> es el Sistema de Información y Gestión Educativa
                diseñado para soportar el flujo de información de todos los procesos de El Nuevo Colegio. En el módulo
                <span class="sige-turbo-title-app">{!! Lang::get("sige.Communications") !!}</span> se encuentra diseñado
                para soportar todos los procesos de apoyo de la institución.</p>
        </section>
    </section>
@stop
@section("dashboard")
    <section ng-controller="WeeklyevaluationController">
        <div class="grid-100">
            <div class="sige-contained">
                <section class="sige-resources-purchase-register">
                    <a class="btn btn-green"
                       href="{{ URL::route('communications.weeklyevaluations.create') }}">Nuevo</a>
                </section>
                <section class="sige-evaluations-lists">
                    <h4>{{ Lang::get('sige.Weeklyevaluations') }}</h4>
                    {!! Form::open() !!}
                    <section class="search-container">
                        <ul class="display-horizontal col-100">
                            <li class="col-100 gutter-5">
                                <sige-turbo-communication-search ng-model="search"></sige-turbo-communication-search>
                                <input name="search" ng-model="search" ng-value="search" type="hidden"
                                       value="{{$search}}"/>
                            </li>
                            <li id="views" class="col-30 gutter-5">
                                <span>{{ Lang::get('sige.View') }}: </span>
                                <input value="photo" id="images" type="radio" name="view"
                                       {{ ($view == 'photo')? 'checked' : '' }} onclick="this.form.submit()">
                                <label for="images">
                                    <div class="fa fa-picture-o"></div>
                                </label>
                                <input value="list" id="list" type="radio" name="view"
                                       {{ ($view == 'list')? 'checked' : '' }} onclick="this.form.submit()">
                                <label for="list">
                                    <div class="fa fa-list"></div>
                                </label>
                            </li>
                            <li class="col-45 gutter-5">
                                <label class="select-arrow" for="order">
                                    <select name="sort" id="order" onchange="this.form.submit()">
                                        <option value="week" {{ ($sort == 'week')? 'selected' : '' }}>{{ Lang::get('sige.Week') }}</option>
                                        <option value="teacher" {{ ($sort == 'teacher')? 'selected' : '' }}>{{ Lang::get('sige.Teacher') }}</option>
                                        <option value="created_at" {{ ($sort == 'created_at')? 'selected' : '' }}>{{ Lang::get('sige.CreatedAt') }}</option>
                                    </select>
                                </label>
                            </li>
                            <li id="reverse" class="col-25 gutter-5">
                                <span>{{ Lang::get('sige.Order') }}: </span>
                                <input value="asc" id="asc" name="order" type="radio"
                                       {{ ($order == 'asc')? 'checked' : '' }} onclick="this.form.submit()">
                                <label for="asc">
                                    <div class="fa fa-sort-alpha-asc"></div>
                                </label>
                                <input value="desc" id="desc" name="order" type="radio"
                                       {{ ($order == 'desc')? 'checked' : '' }} onclick="this.form.submit()">
                                <label for="desc">
                                    <div class="fa fa-sort-alpha-desc"></div>
                                </label>
                            </li>
                        </ul>
                    </section>
                    {!! Form::close() !!}
                    <div class="clearfix"></div>
                    <section class="evaluation-list">
                        <ul id="evaluation-list" class="display-horizontal col-100">
                            @foreach($weeklyevaluations as $weeklyevaluation)
                                <li class="col-100">
                                    <ul class="display-horizontal col-100 evaluation">
                                        <li class="col-05 select">
                                            <input type="checkbox"/>
                                        </li>
                                        <li class="col-10 photo">
                                            <div>
                                                <img src="{{env('ASSETS_SERVER')}}/img/users/{{$weeklyevaluation->photo}}"
                                                     alt="{{ $weeklyevaluation->teacher }}"
                                                     title="{{ $weeklyevaluation->teacher }}"/>
                                            </div>
                                        </li>
                                        <li class="col-05 week">
                                            <span>{{ $weeklyevaluation->week }}</span>
                                        </li>
                                        <li class="col-60 comment">
                                            <p>{{ $weeklyevaluation->comment }}</p>
                                        </li>
                                        <li class="col-10 edit">
                                            <a href="{{ URL::route('communications.weeklyevaluations.edit',['weeklyevaluation' => $weeklyevaluation->idweeklyevaluation,'sort' => $sort, 'order' => $order, 'page' => $weeklyevaluations->currentPage()]) }}"
                                               id="update">{{ Lang::get('sige.Edit') }}</a>
                                        </li>
                                        <li class="col-10 delete">
                                            {!! Form::open(['route' => ['communications.weeklyevaluations.destroy', $weeklyevaluation->idweeklyevaluation], 'method' => 'delete']) !!}
                                            <button type="submit">{{ Lang::get('sige.Delete') }}</button>
                                            {!! Form::close() !!}
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                    <section class="sige-turbo-pagination col-100">
                        {!! $weeklyevaluations->appends(['sort' => $sort, 'order' => $order])->render() !!}
                    </section>
                </section>
            </div>
        </div>
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
