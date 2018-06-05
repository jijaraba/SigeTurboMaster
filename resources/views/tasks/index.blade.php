@extends("layouts.tasks")
@section("ModuleName", Lang::get("sige.Tasks"))
@section("title", Lang::get("sige.Tasks"))
@section("content")
    <div class="grid-100" ng-controller="TaskController">
        <section class="sige-contained">
            <section class="sige-tasks-lists">
                <h4>{{ Lang::get('sige.Task') }}</h4>
                <section class="info">
                    <a class="icon icon-info" href="#"></a>
                    <p>@if (getUser()) {{ getUser()->firstname }}, en los enlaces <a style="color:#53BBB4"
                                                                                     href="{{ env('ASSETS_SERVER') }}/global/TNSProgramadorTareas2017_3.pdf">PROGRAMADOR
                            DE TAREAS</a> y <a style="color:#53BBB4"
                                               href="{{ env('ASSETS_SERVER') }}/global/TNSRúbricaEvaluaciónTareasV3.pdf">RÚBRICA
                            PARA LA EVALUACIÓN DE TAREAS</a> puede encontrar información relativa a la asignación de
                        tareas y la forma de evaluación. Seleccione @else En los enlaces <a style="color:#53BBB4"
                                                                                            href="{{ env('ASSETS_SERVER') }}/global/TNSProgramadorTareas2017_3.pdf">PROGRAMADOR
                            DE TAREAS</a> y <a style="color:#53BBB4"
                                               href="{{ env('ASSETS_SERVER') }}/global/TNSRúbricaEvaluaciónTareasV3.pdf">RÚBRICA
                            PARA LA EVALUACIÓN DE TAREAS</a> puede encontrar información relativa a la asignación de
                        tareas y la forma de evaluación. Seleccione @endif las opciones que
                        más se ajusten a sus necesidades de búsqueda tales como seleccionar el <strong>grupo</strong> y
                        la forma de ordenar la tarea. <strong>Recuerde:</strong> Puede ampliar la información asociada a
                        la tarea dando clic en el botón "Detalle" .</p>
                </section>
                <div class="clearfix"></div>

                {!! Form::open() !!}
                <div class="search-container">
                    <ul class="display-horizontal col-100">
                        <li class="col-50 gutter-5 search">
                            <span>Buscar: </span>
                            <input id="search" type="text" ng-model="searchTask" placeholder="Buscar Tarea"/>
                        </li>
                        <li class="col-20 gutter-5 group"
                            data-intro="Seleccionar el grupo en el que se encuentre el estudiante" data-step="1">
                            <span>Grupo: </span>
                            <label class="select-arrow" for="group">
                                {!! Form::select('group', $groups, $group, ['id' => 'group','onchange' => 'this.form.submit()']) !!}
                            </label>
                        </li>
                        <li class="col-20 gutter-5 order">
                            <span>Ordenar: </span>
                            <label class="select-arrow" for="sort">
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
                            </label>
                        </li>
                        <li id="reverse" class="col-10 gutter-5 reverse">
                            <span>Ordenar</span>
                            <input value="asc" id="asc" name="order" type="radio"
                                   {{ ($order == 'asc')? 'checked' : '' }} onclick="this.form.submit()">
                            <label for="asc">
                                <div class="fa fa-sort-alpha-up"></div>
                            </label>
                            <input value="desc" id="desc" name="order" type="radio"
                                   {{ ($order == 'desc')? 'checked' : '' }} onclick="this.form.submit()">
                            <label for="desc">
                                <div class="fa fa-sort-alpha-down"></div>
                            </label>
                        </li>
                        <li></li>
                    </ul>
                </div>
                {!! Form::close() !!}
                <div class="clearfix"></div>
                <section class="task-list">
                    <ul id="task-list" class="display-horizontal col-100">
                        @foreach($tasks as $task)
                            <li class="col-100">
                                <ul class="display-horizontal col-100 task"
                                    data-intro="Cada actividad está compuesta por: Un tipo, docente, información general y fecha de entrega "
                                    data-step="2">
                                    <li class="col-05 select">
                                        <input type="checkbox">
                                    </li>
                                    <li class="col-10 type"
                                        data-intro="Tipo de Actividad entre los cuales se puede encontrar: Tarea, Examen, Plan de Apoyo"
                                        data-step="3">
                                        <span class="{{ taskType($task->idtasktype) }}"></span>
                                    </li>
                                    <li class="col-10 photo">
                                        <div>
                                            <img src="{{env('ASSETS_SERVER')}}/img/users/{{$task->photo}}"
                                                 alt="{{ $task->teacher }}"
                                                 title="{{ $task->teacher }} - {{ $task->email }}"/>
                                        </div>
                                    </li>
                                    <li class="col-10 group">
                                        <div>{{ $task->group }}</div>
                                    </li>
                                    <li class="col-55 description">
                                        <div class="title" data-intro="Título de la Actividad"
                                             data-step="5">{{ $task->name }}</div>
                                        <div class="subject"
                                             data-intro="Asignatura y Nivel. El nivel debe ser tenido en cuenta ya que especifica cuál actividad debe realizar el estudiante según el nivel en el que se encuentre"
                                             data-step="6">{{ $task->subject }} : {{ $task->nivel }}</div>
                                        <div class="ends" data-intro="Fecha de Entrega o realización de la actividad"
                                             data-step="7">Fecha
                                            Entrega: {{ \Carbon\Carbon::createFromTimeStamp(strtotime($task->ends))->formatLocalized('%A, %d %B %Y') }}</div>
                                        <div class="comment">{{ str_limit($task->description, $limit = 200, $end = '...') }}</div>
                                        @if (count($task->taskfiles) > 0)
                                            <div class="files">
                                                <a>{{ Lang::get('sige.Files') }} ( {{ count($task->taskfiles) }} )</a>
                                            </div>
                                        @endif
                                    </li>
                                    <li class="col-10 detail"
                                        data-intro="Detalle de la Actividad. En la cual se puede ampliar la información o la descarga de archivos asociados a la misma."
                                        data-step="8">
                                        <a href="{{ URL::route('guest.tasks.detail', ['group' => $group,'task' => $task->idtask, 'sort' => $sort, 'order' => $order, 'page' => $tasks->currentPage()]) }}"
                                           id="update">
                                            <div class="fa fa-long-arrow-right"></div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </section>
                <section class="sige-turbo-pagination col-100">
                    {!! $tasks->appends(['sort' => $sort, 'order' => $order, 'group' => $group])->render() !!}
                </section>
            </section>
        </section>
    </div>
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
    {!! HTML::script(mix('js/Homework.js')) !!}
@stop