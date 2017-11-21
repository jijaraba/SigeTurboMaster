@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Task"))
@section("title", Lang::get("sige.Task"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("formation.partials.helper")
    @endif
@stop
@section("dashboard")
    <section ng-controller="TaskController">
        <section class="grid-100">
            <div class="sige-contained">
                <section class="sige-formation-task-register">
                    <a class="btn btn-green" href="{{ URL::route('formation.tasks.create') }}">Nueva</a>
                </section>
                <section class="sige-tasks-lists">
                    <h4>{{ Lang::get('sige.Task') }}</h4>
                    {!! Form::open() !!}
                    <section class="search-container">
                        <ul class="display-horizontal col-100">
                            <li class="col-35 gutter-5">
                                <label for="search">Buscar: </label>
                                <input id="search" type="text" ng-model="searchTask"/>
                            </li>
                            <li class="col-30 gutter-5">
                                <label for="idsubject">{{ Lang::get('sige.Subject') }}: </label>
                                <label class="select-arrow" for="idsubject">
                                    {!! Form::select('subject', $subjects, $subject, ['id' => 'subject','onchange' => 'this.form.submit()']) !!}
                                </label>
                            </li>
                            <li class="col-25 gutter-5">
                                <label for="order">Ordenar: </label>
                                <select name="sort" id="order" onchange="this.form.submit()">
                                    <option value="group" {{ ($sort == 'group')? 'selected' : '' }}>Grupo</option>
                                    <option value="subject" {{ ($sort == 'subject')? 'selected' : '' }}>Asignatura
                                    </option>
                                    <option value="teacher" {{ ($sort == 'teacher')? 'selected' : '' }}>Docente</option>
                                    <option value="starts" {{ ($sort == 'starts')? 'selected' : '' }}>Inicio</option>
                                    <option value="ends" {{ ($sort == 'ends')? 'selected' : '' }}>Termina</option>
                                    <option value="status" {{ ($sort == 'status')? 'selected' : '' }}>Aprobada</option>
                                    <option value="created_at" {{ ($sort == 'created_at')? 'selected' : '' }}>Ingreso
                                    </option>
                                </select>
                            </li>
                            <li id="reverse" class="col-10 gutter-5">
                                <label for="order"></label>
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
                    <section class="task-list">
                        <ul id="task-list" class="display-horizontal col-100">
                            @foreach($tasks as $task)
                                <li class="col-100">
                                    <ul class="display-horizontal col-100 task">
                                        <li class="col-05 select">
                                            <input type="checkbox"/>
                                        </li>
                                        <li class="col-05 status">
                                            <span class="{{ taskStatus($task->status) }}"></span>
                                        </li>
                                        <li class="col-10 photo">
                                            <div>
                                                <img ng-src="{{env('ASSETS_SERVER') . "/img/users/" . $task->photo}}"
                                                     alt="{{ $task->teacher }}" title="{{ $task->teacher }}"/>
                                            </div>
                                        </li>
                                        <li class="col-15 group">
                                            <div>{{ $task->group }}</div>
                                        </li>
                                        <li class="col-45 description">
                                            <div class="title">{{ ucwords($task->name) }}</div>
                                            <div class="subject"><span>{{ $task->subject }}</span> : {{ $task->nivel }}
                                            </div>
                                            <div class="description"
                                                 style="display: block">{{ $task->description }}</div>
                                            <div class="starts">
                                                <i class="fa fa-calendar"></i>
                                                <span>{{ Lang::get('sige.Starts') }}:</span>
                                                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($task->starts))->formatLocalized('%A, %d %B %Y') }}
                                            </div>
                                            <div class="ends">
                                                <i class="fa fa-calendar"></i>
                                                <span>{{ Lang::get('sige.Ends') }}:</span>
                                                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($task->ends))->formatLocalized('%A, %d %B %Y')  }}
                                            </div>
                                            <div class="files">
                                                @if(count($task->taskfiles) >  0)
                                                    <i class="fa fa-cloud-download"></i>
                                                    <a ui-sref="task_update({taskId:task.idtask})">{{ count($task->taskfiles) > 1 ? Lang::get('sige.Files') : Lang::get('sige.File') }}
                                                        ( {{ count($task->taskfiles) }} )</a>
                                                @endif
                                            </div>
                                        </li>
                                        <li class="col-10 edit">
                                            <a href="{{ URL::route('formation.tasks.edit', ['subject' => $subject,'task' => $task->idtask, 'sort' => $sort, 'order' => $order, 'page' => $tasks->currentPage()]) }}"
                                               id="update">{{ Lang::get('sige.Edit') }}</a>
                                        </li>
                                        <li class="col-10 delete">
                                            <a ui-sref="task_delete({taskId:task.idtask})"
                                               id="delete">{{ Lang::get('sige.Delete') }}</a>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                    <section class="sige-turbo-pagination col-100">
                        {!! $tasks->appends(['subject' => $subject, 'sort' => $sort, 'order' => $order])->render() !!}
                    </section>
                </section>
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