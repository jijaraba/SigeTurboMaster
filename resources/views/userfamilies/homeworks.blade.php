@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Parents"))
@section("title", Lang::get("sige.Parents"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('parents.partials.helper')
    @endif
@stop
@section("dashboard")
    <section ng-controller="HomeworkController">
        <div class="grid-100">
            <section class="sige-contained">
                <section>
                    <h4>Seleccionar Estudiante</h4>
                    <section class="sige-student-lists">
                        <section class="student-list">
                            <ul id="student-list">
                                @foreach($users as $user)
                                    <li>
                                        <div class="student" id="student" data-student-id="{{ $user["iduser"] }}">
                                            <div class="body" id="student_{{$user["iduser"]}}" ng-click="search({{ $user["iduser"] }})">
                                                <div class="image normal-background">
                                                    <img src="{{ getenv("ASSETS_SERVER") }}/img/users/{{ $user["photo"] }}"
                                                         alt="{{ $user["lastname"] }}"
                                                         title="{{ $user["lastname"] ." ". $user["firstname"] }}"/>
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
            </section>
        </div>
        <div class="grid-100" ng-if="showTasks">
            <section class="sige-contained">
                <section class="sige-tasks">
                    <h4>@{{ message }}</h4>
                    <section class="task-list">
                        <ul id="task-list" class="display-horizontal col-100">
                            <li class="col-100" ng-repeat="task in tasks">
                                <ul class="display-horizontal col-100 task">
                                    <li class="col-05 select">
                                        <input type="checkbox">
                                    </li>
                                    <li class="col-05 type">
                                        <span class="@{{ task.idtasktype | taskType }}"></span>
                                    </li>
                                    <li class="col-10 photo">
                                        <div>
                                            <img ng-src="@{{assets}}/img/users/@{{task.photo}}" alt="@{{ task.teacher }}"
                                                 title="@{{ task.teacher }}"/>
                                        </div>
                                    </li>
                                    <li class="col-10 ends">@{{ task.ends}}</li>
                                    <li class="col-10 group">
                                        <div>@{{ task.group }}</div>
                                    </li>
                                    <li class="col-45 main-info">
                                        <div class="title">@{{ task.name }}</div>
                                        <div class="subject">@{{ task.subject }} : @{{ task.nivel }}</div>
                                    </li>
                                    <li class="col-10 days">@{{ task.days | days }}</li>
                                    <li class="col-100 description">
                                        <section class="task-description" id="task_description">
                                            <h4>Descripción</h4>
                                            <p>@{{ task.description }}</p>
                                        </section>
                                    </li>
                                    <li class="col-100 files">
                                        <section class="file-list" ng-if="task.taskfiles.length > 0">
                                            <ul class="display-horizontal col-100 progress"
                                                data-ng-repeat="file in task.taskfiles" ng-if="!file.deleted">
                                                <li class="col-05 gutter-5 icon fa fa-cloud-download"></li>
                                                <li class="col-80 gutter-5 name"><a target="_blank"
                                                                                    href="@{{ assets }}/task/@{{ file.file }}">@{{file.realname}}</a>
                                                </li>
                                                <li class="col-10 gutter-5 size">@{{file.size | size }}</li>
                                            </ul>
                                        </section>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </section>
                </section>
            </section>
        </div>
        <div class="grid-100" ng-if="!showTasks && tasks.length == 0">
            No hay tareas vigentes en el sistema 
        </div>
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