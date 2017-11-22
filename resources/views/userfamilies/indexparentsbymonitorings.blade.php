@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Parents"))
@section("title", Lang::get("sige.Parents"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('parents.partials.helper')
    @endif
@stop
@section("dashboard")
    <section ng-controller="MonitoringsController" ng-init="init()">
        <section class="grid-100">
            <section class="sige-contained">
                <section>
                    <h4>Seleccionar Estudiante</h4>
                    <section class="sige-student-lists">
                        <section class="student-list">
                            <ul id="student-list">
                                @foreach($users as $user)
                                    <li>
                                        <div class="student" id="student" data-student-id="{{ $user["iduser"] }}">
                                            <div class="body" id="student_{{$user["iduser"]}}"
                                                 ng-click="select({{ $user["iduser"] }})">
                                                <div class="image normal-background">
                                                    <img src="{{ getenv("ASSETS_SERVER") }}/img/users/{{$user["photo"]}}"
                                                         alt="{{ $user["lastname"] }}"
                                                         title="{{ $user["lastname"]}} {{ $user["firstname"] }}"/>
                                                </div>
                                            </div>
                                            <div class="lead">
                                                {{ $user["firstname"] }}
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    </section>
                </section>
                <section class="col-100 sige-academic-options">
                    <h4>Opciones</h4>
                    <ul class="display-horizontal col-40">
                        <li class="col-50 gutter-10">
                            <label class="select-arrow" for="idyear">
                                <select name="idyear" id="idyear" ng-model="academic.year" ng-change="search()"
                                        ng-options="year.idyear as year.name for year in years"></select>
                            </label>
                        </li>
                        <li class="col-50 gutter-10">
                            <label class="select-arrow" for="idperiod">
                                <select name="idperiod" id="idperiod" ng-model="academic.period" ng-change="search()"
                                        ng-options="period.idperiod as period.name for period in periods"></select>
                            </label>
                        </li>
                    </ul>
                </section>
                <section ng-if="showMonitoring" class="sige-monitorings">
                    <h4>Calificación Final</h4>
                    <ul>
                        <li ng-repeat="monitoring in monitorings" class="monitoring">
                            <div class="monitoring-container">
                                <ul class="display-horizontal col-100">
                                    <li class="col-10 gutter-5 image">
                                        <i class="fa fa-bar-chart"></i>
                                    </li>
                                    <li class="col-30 gutter-5 concept subject">@{{ monitoring.subject }}</li>
                                    <li class="col-15 gutter-5 concept nivel">@{{ monitoring.nivel }}</li>
                                    <li class="col-10 gutter-5 monitoring">
                                        <div class="monitorings @{{ monitoring.ratingperiod | performance:'normal' }}">
                                            @{{ monitoring.ratingperiod | scale:monitoring.idgroup}}
                                        </div>
                                    </li>
                                    <li class="col-10 gutter-5 value recovery">@{{ monitoring.ratingrecovery | recovery
                                        }}
                                    </li>
                                    <li class="col-10 gutter-5 value attendance">@{{ monitoring.attendance |
                                        attendance}}
                                    </li>
                                    <li class="col-10 gutter-5 detail">
                                        <a href="/parents/monitorings/detail/@{{ monitoring.idyear }}/@{{ monitoring.idperiod }}/@{{ monitoring.idgroup }}/@{{ monitoring.idsubject }}/@{{ monitoring.idnivel }}/@{{ monitoring.iduser }}"
                                           class="fa fa-arrow-right"></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </section>
            </section>
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