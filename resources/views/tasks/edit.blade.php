@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Task"))
@section("title", Lang::get("sige.Task"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("formation.partials.helper")
    @endif
@stop
@section("dashboard")
    <section ng-controller="TaskUpdateController" ng-init="init({{ $task->idtask }})">
        <section class="grid-100">
            <section class="sige-contained">
                <a href="{{ URL::route('formation.tasks.index',['sort' => $sort, 'order' => $order, 'page' => $page, 'subject' => $subject])}}"
                   class="btn btn-transparent"><i class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
                <section class="sige-task-new">
                    <h4>Actualizar Tarea</h4>
                    <form ng-submit="Update()" name="taskForm" id="taskForm" method="post">
                        <section class="sige-task-status">
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5" ng-if="task.status != 1">
                                    <label for="draft" class="draft">
                                        <input type="radio" name="status" id="draft" value="0" ng-model="task.status"
                                               checked="true">
                                        <span>Draft</span>
                                    </label>
                                    <label for="approved">
                                        <input type="radio" name="status" id="approved" value="1"
                                               ng-model="task.status">
                                        <span>Approve</span>
                                    </label>
                                </li>
                                <li class="col-100 gutter-5 approved" ng-if="task.status == 1">
                                    <span>@{{ approvedResult }}</span>
                                </li>
                            </ul>
                        </section>
                        <div class="clearfix"></div>
                        <fieldset>
                            <sige-turbo-academic-embedded year="@{{task.year}}" period="@{{task.period}}"
                                                          group="@{{ task.group }}" subject="@{{ task.subject }}"
                                                          nivel="@{{ task.nivel }}"
                                                          academic="academic"></sige-turbo-academic-embedded>
                        </fieldset>
                        <fieldset>
                            <ul class="display-horizontal col-100">
                                <li class="col-20 gutter-5">
                                    <label class="select-arrow" for="idtasktype">
                                        <select id="idtasktype" name="idtasktype" ng-model="task.type"
                                                ng-options="tasktype.idtasktype as tasktype.name for tasktype in tasktypes"
                                                required></select>
                                    </label>
                                </li>
                                <li class="col-50 gutter-5">
                                    <input name="name" id="name" type="text" ng-model="task.name"
                                           placeholder="Nombre de la Tarea" required>
                                </li>
                                <li class="col-15 gutter-5">
                                    <input name="starts" id="starts" type="text" ng-model="task.starts"
                                           placeholder="Inicio" required>
                                </li>
                                <li class="col-15 gutter-5">
                                    <input name="ends" id="ends" type="text" ng-model="task.ends"
                                           placeholder="Terminación" required>
                                </li>
                                <li class="col-100 gutter-5">
                                    <textarea name="description" id="description" ng-model="task.description"
                                              placeholder="Descripción de la Tarea"></textarea>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset>
                            <section class="file-list" ng-if="taskFiles" style="padding-top: 5px">
                                <h4>{{ Lang::get('sige.Files') }}</h4>
                                <ul class="display-horizontal col-100 progress @{{ file.status | fileStatus }} @{{ file.deleted | fileDeleted }}"
                                    data-ng-repeat="file in task.taskfiles" ng-if="!file.deleted">
                                    <li class="col-05 gutter-5 icon fa fa-cloud-download"></li>
                                    <li class="col-75 gutter-5 name"><a target="_blank"
                                                                        href="@{{ assets }}/task/@{{ file.file }}">@{{file.realname}}</a>
                                    </li>
                                    <li class="col-10 gutter-5 size">@{{file.size | size }}</li>
                                    <li class="col-05 gutter-5 delete" ng-click="delete($index)">
                                        <span class="fa fa-times"></span>
                                    </li>
                                </ul>
                            </section>
                            <section class="file-upload" ng-if="taskSave">
                                <ul class="display-horizontal col-100">
                                    <li class="col-100" style="padding: 5px 0px">
                                        <sige-turbo-file-upload type="task"
                                                                id="@{{task.idtask}}"></sige-turbo-file-upload>
                                    </li>
                                </ul>
                            </section>
                        </fieldset>
                        <fieldset>
                            <ul class="display-horizontal col-100">
                                <li class="col-100">
                                    <button id='hiddenButton' type="submit"
                                            class="btn btn-aquamarine">{{ Lang::get('sige.Save') }}</button>
                                </li>
                            </ul>
                        </fieldset>
                    </form>
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
@section("socket")
    {!! HTML::script(mix('js/vendor/socket.io.js')) !!}
@stop
@section("sigeturbo")
    {!! HTML::script(mix('js/SigeTurbo.js')) !!}
    {!! HTML::script(mix('js/Stream.js')) !!}
@stop