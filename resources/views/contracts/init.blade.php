@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Contracts"))
@section("title", Lang::get("sige.Contracts"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("formation.partials.helper")
    @endif
@stop
@section("dashboard")
    <section class="sige-student-items">
        <ul class="display-horizontal col-95">
            <li ng-click="changeItem(1)">
                <div title="Calendario Académico" style="float: left;text-align: center;margin: 0;border-bottom: 1px solid #eee;background: #f5f5f5;border-top-left-radius: 5px;border-top-right-radius: 5px;width: 40%;">
                    <div onclick="window.location='{{ URL::to('formation/academics/init') }}';" style="position: relative;top: 40%;text-align: center;margin: 5px auto;width: 50px;height: 50px;border-radius: 50%;padding: 15px;background-color: #53bbb4;">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                    </div>
                </div>
            </li>
            <li ng-click="changeItem(3)">
                <div title="Directores de Grupo" style="float: left;text-align: center;margin: 0;border-bottom: 1px solid #eee;background: #f5f5f5;border-top-left-radius: 5px;border-top-right-radius: 5px;width: 40%;">
                    <div onclick="window.location='{{ URL::to('formation/groupdirectors/init') }}';" style="position: relative;top: 40%;text-align: center;margin: 5px auto;width: 50px;height: 50px;border-radius: 50%;padding: 15px;background-color: #53bbb4;">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                </div>
            </li>
            <li ng-click="changeItem(2)">
                <div title="Carga Académica" style="float: left;text-align: center;margin: 0;border-bottom: 1px solid #eee;background: #f5f5f5;border-top-left-radius: 5px;border-top-right-radius: 5px;width: 40%;">
                    <div onclick="window.location='{{ URL::to('formation/contracts') }}';" style="position: relative;top: 40%;text-align: center;margin: 5px auto;width: 50px;height: 50px;border-radius: 50%;padding: 15px;background-color: #53bbb4;">
                        <i class="fa fa-address-card" aria-hidden="true"></i>
                    </div>
                </div>
            </li>
            <li ng-click="changeItem(4)">
                <div title="Jefes de Area" style="float: left;text-align: center;margin: 0;border-bottom: 1px solid #eee;background: #f5f5f5;border-top-left-radius: 5px;border-top-right-radius: 5px;width: 40%;">
                    <div onclick="window.location='{{ URL::to('formation/areamanagers/init') }}';" style="position: relative;top: 40%;text-align: center;margin: 5px auto;width: 50px;height: 50px;border-radius: 50%;padding: 15px;background-color: #53bbb4;">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                    </div>
                </div>
            </li>
            <li ng-click="changeItem(5)">
                <div title="Porcentajes de asignaturas por año" style="float: left;text-align: center;margin: 0;border-bottom: 1px solid #eee;background: #f5f5f5;border-top-left-radius: 5px;border-top-right-radius: 5px;width: 40%;">
                    <div onclick="window.location='{{ URL::to('formation/monitoringcategorybyyears/init') }}';" style="position: relative;top: 40%;text-align: center;margin: 5px auto;width: 50px;height: 50px;border-radius: 50%;padding: 15px;background-color: #53bbb4;">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                    </div>
                </div>
            </li>
            <li ng-click="changeItem(6)">
                <div title="Areas, Asignaturas y Niveles" style="float: left;text-align: center;margin: 0;border-bottom: 1px solid #eee;background: #f5f5f5;border-top-left-radius: 5px;border-top-right-radius: 5px;width: 40%;">
                    <div onclick="window.location='{{ URL::to('formation/subjects/init') }}';" style="position: relative;top: 40%;text-align: center;margin: 5px auto;width: 50px;height: 50px;border-radius: 50%;padding: 15px;background-color: #53bbb4;">
                        <i class="fa fa-book" aria-hidden="true"></i>
                    </div>
                </div>
            </li>
            <li ng-click="changeItem(7)">
                <div title="Votaciones" style="float: left;text-align: center;margin: 0;border-bottom: 1px solid #eee;background: #f5f5f5;border-top-left-radius: 5px;border-top-right-radius: 5px;width: 40%;">
                    <div onclick="window.location='{{ URL::to('formation/votes/init') }}';" style="position: relative;top: 40%;text-align: center;margin: 5px auto;width: 50px;height: 50px;border-radius: 50%;padding: 15px;background-color: #53bbb4;">
                        <i class="fa fa-area-chart" aria-hidden="true"></i>
                    </div>
                </div>
            </li>
            <li ng-click="changeItem(8)">
                <div title="Estudiantes Pendientes Por Calificar" style="float: left;text-align: center;margin: 0;border-bottom: 1px solid #eee;background: #f5f5f5;border-top-left-radius: 5px;border-top-right-radius: 5px;width: 40%;">
                    <div onclick="window.location='{{ URL::to('formation/monitorings/studentspendigsbymonitoring') }}';" style="position: relative;top: 40%;text-align: center;margin: 5px auto;width: 50px;height: 50px;border-radius: 50%;padding: 15px;background-color: #53bbb4;">
                        <i class="fa fa-user-times" aria-hidden="true"></i>
                    </div>
                </div>
            </li>
        </ul>
    </section>
    @if($search['option'] == 'contract')
        @include('contracts.partials.contracts')
    @elseif ($search['option'] == 'groupdirectors')
        @include('contracts.partials.groupdirectors')
    @elseif ($search['option'] == 'monitoringcategorybyyears')
        @include('contracts.partials.monitoringcategorybyyears')
    @elseif ($search['option'] == 'subjects')
        @include('contracts.partials.subjects')
    @elseif ($search['option'] == 'areamanagers')
        @include('contracts.partials.areamanagers')
    @elseif ($search['option'] == 'votes')
        @include('contracts.partials.votations')
    @elseif ($search['option'] == 'studentspendigsbymonitoring')
        @include('contracts.partials.studentspendigsbymonitoring')
    @else
        @include('contracts.partials.academics')
    @endif
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