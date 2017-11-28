@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Task"))
@section("title", Lang::get("sige.Task"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("formation.partials.helper")
    @endif
@stop
@section("dashboard")
    <section ng-controller="TaskNewController">
        <div class="grid-100">
            <div class="sige-contained">
                <a href="{{ URL::route('formation.tasks.index')}}" class="btn btn-transparent margin-bottom-20"><i
                            class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
                <section class="sige-task-new">
                    <h4>Nueva Tarea</h4>
                    <form ng-submit="Insert()" name="taskForm" id="taskForm" method="post">
                        <fieldset>
                            <sige-turbo-academic-embedded academic="academic"></sige-turbo-academic-embedded>
                        </fieldset>
                        <fieldset>
                            <ul class="display-horizontal col-100">
                                <li class="col-20 gutter-5">
                                    <label class="select-arrow" for="idtasktype">
                                        {!! Form::select('idtasktype', $tasktypes, 1, ['ng-model' => 'task.type', 'ng-init' => 'task.type = "1"', 'required' => true]) !!}
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
                            <section class="file-upload" ng-if="taskSave">
                                <ul class="display-horizontal col-100">
                                    <li class="col-100 gutter-5">
                                        <sige-turbo-file-upload type="task"
                                                                id="@{{task.idtask}}"></sige-turbo-file-upload>
                                    </li>
                                </ul>
                            </section>
                        </fieldset>
                        <fieldset>
                            <ul class="display-horizontal col-100">
                                <li class="col-100">
                                    <button type="submit"
                                            class="btn btn-aquamarine">{{ Lang::get('sige.Save') }}</button>
                                </li>
                            </ul>
                        </fieldset>
                    </form>
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