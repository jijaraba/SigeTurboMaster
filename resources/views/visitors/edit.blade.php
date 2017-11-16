@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Visitors"))
@section("title", Lang::get("sige.Visitors"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('resources.partials.helper')
    @endif
@stop
@section("dashboard")
    <section class="grid-100" ng-controller="VisitorUpdateController">
        <section class="sige-contained">
            <a href="{{ URL::route('resources.visitors.index')}}" class="btn btn-transparent"><i class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
            <h4>Editar Permiso</h4>
            <section class="sige-visitor-main">
                <form ng-submit="submitNew()">
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-100 gutter-5 type">
                                <div class="status-visitortype">
                                    <label class="select-arrow" for="idvisitortype">
                                        {!! Form::select('idvisitortype', $visitortypes, $visitor->idvisitortype, ["id" => "idvisitortype","ng-model" => "visitor.type","ng-init"=>"visitor.type = \"$visitor->idvisitortype\""]) !!}
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-20 gutter-5">
                                <label class="select-arrow" for="ididentificationtype">
                                    {!! Form::select('ididentificationtype', $identificationtypes, $visitor->ididentificationtype, ["ng-model" => "visitor.identificationtype","ng-init"=>"visitor.identificationtype = \"$visitor->ididentificationtype\""]) !!}
                                </label>
                            </li>
                            <li class="col-20 gutter-5 identification">
                                <input name="identification" type="text" ng-model="visitor.identification" ng-init="visitor.identification='{{$visitor->identification}}'" value="" placeholder="Identificación" required="true"/>
                            </li>
                            <li class="col-40 gutter-5 name">
                                <input name="name" type="text" ng-model="visitor.name" ng-init="visitor.name='{{$visitor->name}}'" value="{{ $visitor->name  }}" placeholder="Nombre Persona o Empresa" required="true"/>
                            </li>
                            <li class="col-20 gutter-5 gender">
                                <input type="radio" value="1" name="gender" id="gender" ng-model="visitor.gender" checked ng-init="visitor.gender='{{$visitor->gender}}'">Mujer
                                <input type="radio" value="0" name="gender" id="gender" ng-model="visitor.gender">Hombre
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-1000 gutter-5">
                                <input name="name" type="text" ng-model="visitor.company" ng-init="visitor.company='{{$visitor->company}}'" value="" placeholder="Nombre Empresa"/>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-15 gutter-5 accesstype">
                                <label class="select-arrow" for="accesstype">
                                    <select name="accesstype" id="accesstype" ng-model="visitor.accesstype" ng-init="visitor.accesstype ='{{$visitor->accesstype}}'">
                                        <option value="1">Peatonal</option>
                                        <option value="2" selected>Vehículo</option>
                                    </select>
                                </label>
                            </li>
                            <li class="col-15 gutter-5 licenseplate">
                                <input name="licenseplate" type="text" ng-model="visitor.licenseplate" ng-init="visitor.licenseplate ='{{$visitor->licenseplate}}'" value="" placeholder="Placa" required="true"/>
                            </li>
                            <li class="col-15 gutter-5 date">
                                <input name="date" type="text" ng-model="visitor.date" ng-init="visitor.date ='{{$visitor->date}}'" value="" placeholder="Fecha" required="true"/>
                            </li>
                            <li class="col-10 gutter-5 time">
                                <input name="time" type="text" ng-model="visitor.time" ng-init="visitor.time ='{{$visitor->time}}'" value="" placeholder="Hora" required="true"/>
                            </li>
                            <li class="col-45 gutter-5 destination">
                                <input name="destination" type="text" ng-model="visitor.destination" ng-init="visitor.destination ='{{$visitor->destination}}'" value="" placeholder="Destino" required="true"/>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset id="visitor_observation">
                        <ul class="display-horizontal col-100">
                            <li class="col-100 gutter-5">
                                <textarea name="observation" ng-model="visitor.observation" ng-init="visitor.observation ='{{$visitor->observation}}'" id="observation" title="Observación asociada al permiso de acceso" rows="2" ng-blur="register()"></textarea>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-100 gutter-5">
                                <button type="button" class="btn btn-aquamarine" ng-click="updateVisitor()">Save</button>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset class="gutter-5">
                        <section class="visitor-code gutter-5">
                            <input type="text" ng-model="visitor.code" ng-init="visitor.code ='{{$visitor->code}}'" observation value="">
                        </section>
                    </fieldset>
                    <input type="hidden" name="idvisitor" id="idvisitor" ng-model="visitor.idvisitor" ng-init="visitor.idvisitor ='{{$visitor->idvisitor}}'">
                </form>
            </section>
        </section>
    </section>
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