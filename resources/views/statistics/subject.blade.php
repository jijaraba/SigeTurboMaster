@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Statistics"))
@section("title", Lang::get("sige.Statistics"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("formation.partials.helper")
    @endif
@stop
@section("dashboard")
    <section class="grid-100" ng-controller="StatisticsSubjectController">
        <section class="sige-contained statistics">
            <a href="{{ URL::route('formation.statistics.index')}}" class="btn btn-transparent margin-bottom-20"><i
                        class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
            <h4>Asignaturas</h4>
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
            <section class="sige-statistics">
                <section>
                    <p>Listado de Distribuciones de <strong>Desempeños por Asignatura</strong>. La cantidad de
                        desempeños especificada por cada asignatura corresponde al promedioo obtenido por cada
                        estudiante durante el periodo seleccionado</p>
                    <ul class="display-horizontal">
                        <li data-ng-repeat="subject in subjects" ng-if="subject.datasets[0].data.length > 0"
                            class="subject" style="width: 400px;height:400px">
                            <div class="subject-container" title="@{{ subject.name }}">
                                <h6>@{{ subject.shortname }}</h6>
                                <canvas tc-chartjs-doughnut chart-options="options" chart-data="subject"></canvas>
                            </div>
                        </li>
                    </ul>
                </section>
            </section>
        </section>
    </section>
@stop
@section("script")
    {!! HTML::script(mix('js/angular/' . getCurrentRoute() . '.js')) !!}
@stop
@section("vendor")
    {!! HTML::script(mix('js/vendor/vendor.js')) !!}
@stop
@section("socket")
    {!! HTML::script(mix('js/vendor/socket.io.js')) !!}
@stop
@section("sigeturbo")
    {!! HTML::script(mix('js/SigeTurbo.js')) !!}
    {!! HTML::script(mix('js/Stream.js')) !!}
@stop