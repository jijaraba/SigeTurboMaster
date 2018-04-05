@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Statistics"))
@section("title", Lang::get("sige.Statistics"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("formation.partials.helper")
    @endif
@stop
@section("dashboard")
    <section class="grid-100" ng-controller="StatisticsController">
        <section class="sige-contained statistics">
            <h4>Dashboard</h4>
            <section class="col-40">
                <ul class="display-horizontal col-100">
                    <li class="col-50 gutter-10">
                        <label class="select-arrow" for="idyear">
                            <select name="idyear" id="idyear" ng-model="academic.year" ng-init="academic.year = '2017'"
                                    ng-change="change(academic.year,academic.period)">
                                <option value="2017">2017-2018</option>
                                <option value="2016">2016-2017</option>
                                <option value="2015">2015-2016</option>
                                <option value="2014">2014-2015</option>
                                <option value="2013">2013-2014</option>
                            </select>
                        </label>
                    </li>
                    <li class="col-50 gutter-10">
                        <label class="select-arrow" for="idperiod">
                            <select name="idperiod" id="idperiod" ng-model="academic.period"
                                    ng-init="academic.period = '3'" ng-change="change(academic.year,academic.period)">
                                <option value="1">Primer Periodo</option>
                                <option value="2">Segundo Periodo</option>
                                <option value="3">Tercer Periodo</option>
                            </select>
                        </label>
                    </li>
                </ul>
            </section>
            <section class="sige-dashboard">
                <ul class="display-horizontal">
                    <li class="col-50" id="main_dashboard">
                        <article>
                            <h5 class="header-aquamarine">Distribución de Desempeños</h5>
                            <ul class="display-horizontal">
                                <li class="col-40" id="description">
                                    <ul class="display-horizontal line">
                                        <li ng-if="DP" class="col-100">@{{ DP }}
                                            <div class="dp"></div>
                                        <li ng-if="DB" class="col-100">@{{ DB }}
                                            <div class="db"></div>
                                        <li ng-if="DA" class="col-100">@{{ DA }}
                                            <div class="da"></div>
                                        <li ng-if="DS" class="col-100">@{{ DS }}
                                            <div class="ds"></div>
                                    </ul>
                                </li>
                                <li class="col-60" id="chart">
                                    <canvas tc-chartjs-doughnut chart-options="options" chart-data="data" width="250"
                                            height="250"></canvas>
                                </li>
                            </ul>
                        </article>
                    </li>
                    <li class="col-50" id="secondary_dashboard">
                        <ul class="display-horizontal measurements">
                            <li class="col-100" ng-if="total > 0">
                                <article>
                                    <h5 class="header-aquamarine">Mediciones</h5>
                                    <ul class="display-horizontal">
                                        <li class="col-10">
                                            <p>Cantidad de Desempeños</p>
                                            <div class="global">@{{total}}</div>
                                        </li>
                                    </ul>
                                </article>
                            </li>
                            <li class="col-100">
                                <article>
                                    <h5 class="header-aquamarine">Por Segmento</h5>
                                    <p>Seleccione el segmento <strong>Grupo, Asignatura, Area</strong> del cual desea
                                        ver las estadísticas</p>
                                    <ul class="display-horizontal col-100 reports">
                                        <li class="col-100">
                                            <a href="/formation/statistics/group">
                                                <i class="fa fa-bar-chart"></i>
                                                <span>Grupo</span>
                                            </a>
                                        </li>
                                        <li class="col-100">
                                            <a href="/formation/statistics/subject">
                                                <i class="fa fa-bar-chart"></i>
                                                <span>Asignatura</span>
                                            </a>
                                        </li>
                                        <li class="col-100">
                                            <a href="/formation/statistics/area">
                                                <i class="fa fa-bar-chart"></i>
                                                <span>Área</span>
                                            </a>
                                        </li>
                                    </ul>
                                </article>
                            </li>
                        </ul>
                    </li>
                </ul>
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
@section("socket")
    {!! HTML::script(mix('js/vendor/socket.io.js')) !!}
@stop
@section("sigeturbo")
    {!! HTML::script(mix('js/SigeTurbo.js')) !!}
    {!! HTML::script(mix('js/Stream.js')) !!}
@stop