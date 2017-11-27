@extends("layouts.tasks")
@section("ModuleName", Lang::get("sige.Tasks"))
@section("title", Lang::get("sige.Tasks"))
@section("content")
    <div class="grid-100" ng-controller="TaskDetailController">
        <section class="sige-contained">
            <a href="{{ URL::route('guest.tasks.index',['sort' => $sort, 'order' => $order, 'page' => $page, 'group' => $group])}}"
               class="btn btn-transparent"><i class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
            <h4>{{ Lang::get('sige.Task') }}</h4>
            <section class="task-list">
                <ul id="task-list" class="display-horizontal col-100">
                    <li class="col-100">
                        <ul class="display-horizontal col-100 task">
                            <li class="col-05 badge">
                                <span {{ taskType($task->idtasktype) }}></span>
                            </li>
                            <li class="col-10 type">
                                <span class="{{ taskType($task->idtasktype) }}"></span>
                            </li>
                            <li class="col-10 photo">
                                <div>
                                    <img src="{{env('ASSETS_SERVER')}}/img/users/{{$task->photo}}"
                                         alt="{{ $task->teacher }}" title="{{ $task->teacher }} - {{ $task->email }}"/>
                                </div>
                            </li>
                            <li class="col-10 group">
                                <div>{{ $task->group }}</div>
                            </li>
                            <li class="col-65 description">
                                <div class="title">{{ $task->name }}</div>
                                <div class="subject">{{ $task->subject }} : {{ $task->nivel }}</div>
                                <div class="ends">Fecha
                                    Entrega: {{ \Carbon\Carbon::createFromTimeStamp(strtotime($task->ends))->formatLocalized('%A, %d %B %Y') }}</div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </section>
            <section class="task-description" id="task_description">
                <h4>Descripción</h4>
                <p>{{ $task->description }}</p>
            </section>
            @if(count($task->taskfiles) > 0)
                <section class="file-list">
                    <h4>{{ Lang::get('sige.Files') }}</h4>
                    @foreach($task->taskfiles as $file)
                        <ul class="display-horizontal col-100 progress">
                            <li class="col-05 gutter-5 icon fa fa-cloud-download"></li>
                            <li class="col-80 gutter-5 name">
                                <a target="_blank"
                                   href="{{env('ASSETS_SERVER')}}/task/{{ $file->file }}">{{$file->realname}}</a>
                            </li>
                            <li class="col-10 gutter-5 size">{{ taskFileSize($file->size) }}</li>
                        </ul>
                    @endforeach
                </section>
            @endif
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