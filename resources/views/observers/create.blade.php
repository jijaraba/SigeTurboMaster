@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Observator"))
@section("title", Lang::get("sige.Observator"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("formation.partials.helper")
    @endif
@stop
@section("dashboard")
    <section ng-controller="ObservatorNewController">
        <section class="sige-secondary-heading clearfix">
            <h4>Nueva Observación</h4>
        </section>
        <section class="grid-100">
            <div class="sige-contained">
                <a href="{{ URL::route('formation.observators.index')}}" class="btn btn-transparent margin-bottom-20"><i
                            class="fa fa-arrow-left"></i>Volver</a>
                <section class="sige-observer-new">
                    <h4>Estudiante</h4>
                    <form ng-submit="observationSave()">
                        <fieldset>
                            <ul class="display-horizontal col-100 student">
                                <li class="col-10 photo">
                                    <div>
                                        <img src="{{ env('ASSETS_SERVER') . "/img/users/" . $student->photo}}"
                                             alt="{{ $student->firstname ." ".$student->lastname }}"
                                             title="{{ $student->lastname ." ". $student->firstname }}"/>
                                    </div>
                                </li>
                                <li class="col-85 body">
                                    <div>{{ $student->firstname ." ".$student->lastname }}</div>
                                    <div>{{ Lang::get('sige.Celular') }}: {{ $student->celular }}</div>
                                    <div>{{ Lang::get('sige.Phone') }}: {{ $student->phone }}</div>
                                    @if ($student->email_confirmed)
                                        <div>{{ $student->email }}</div>
                                    @endif
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <label class="select-arrow" for="idobservertype">
                                        {!! Form::select('idobservertype', $observertypes, 3, ['ng-model' => 'observer.type','ng-init' => 'observer.type = "3"']) !!}
                                    </label>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <textarea name="observer" id="observer" ng-model="observer.observer" rows="5"
                                              placeholder="Redactar observación"></textarea>
                                </li>
                                <li class="col-100 gutter-5">
                                    <input type="text" name="tags" id="tags" ng-model="observer.tags"
                                           placeholder="Etiquetas de Búsqueda">
                                </li>
                                <li class="col-100">
                                    <button type="submit" class="btn btn-aquamarine" ng-disabled="isDisabled">Guardar
                                    </button>
                                </li>
                            </ul>
                        </fieldset>
                        <input type="hidden" ng-model="observer.year" ng-init="observer.year = '{{ $year }}'">
                        <input type="hidden" ng-model="observer.group" ng-init="observer.group = '{{ $group }}'">
                        <input type="hidden" ng-model="observer.student"
                               ng-init="observer.student = '{{ $student->iduser }}'">
                    </form>
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