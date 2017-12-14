@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Resources"))
@section("title", Lang::get("sige.Resources"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('resources.partials.helper')
    @endif
@stop
@section("dashboard")
    <div class="grid-100" ng-controller="InventoriesController" ng-init="init({{ json_encode($search) }})">
        <div class="grid-100">
            <div class="sige-contained">
                <section class="sige-inventories-verify">
                    <a href="{{ URL::route('resources.inventories.index',[])}}"
                       class="btn btn-transparent margin-bottom-20"><i class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
                    <h4>{{ Lang::get('sige.Inventories') }}</h4>
                    <section class="sige-inventories-verify-container">
                        <article>
                            <header>
                                <h2>{{ Lang::get("sige.Inventory") }}</h2>
                                <img src="{{env('ASSETS_SERVER')}}/img/modules/payment_respond.svg"/>
                            </header>
                            <section>
                                <p class="inventory">{{ $inventorytype->name }}</p>
                                <h2>
                                    {{ Lang::get('sige.Asset') }}
                                </h2>
                                {!! Form::open(array('route'=>'resources.inventories.inventory', 'autocomplete' => 'off')) !!}
                                <fieldset>
                                    <ul class="display-horizontal col-100">
                                        <li class="col-50 gutter-5 ubication">
                                            {!! Form::select('idubication', $ubications, old('idubication')) !!}
                                        </li>
                                        <li class="col-50 gutter-5 quality">
                                            {!! Form::select('idquality', $qualities, old('idquality')) !!}
                                        </li>
                                        <li class="col-100 gutter-5 code">
                                            <textarea name="code" id="code" rows="2"
                                                      placeholder="{{ mb_strtoupper(Lang::get('sige.Codes')) }}">{{ old('code') }}</textarea>
                                            {!! $errors->first('code','<ul class="errors"><li>:message</li></ul>') !!}
                                            @if(Session::get('wrong'))
                                                <ul class="flash">
                                                    <li class="flash-notice">{{ implode(",",Session::get('wrong')) }}</li>
                                                </ul>
                                            @endif
                                        </li>
                                        <li class="col-100 gutter-5 observation">
                                            <textarea name="observation" id="observation" rows="2"
                                                      placeholder="{{ mb_strtoupper(Lang::get('sige.Observation')) }}">{{  old('observation') }}</textarea>
                                        </li>
                                        <li class="col-100 button">
                                            <button id="save" type="submit"
                                                    class="btn btn-aquamarine">{{ Lang::get('sige.Verify') }}</button>
                                        </li>
                                    </ul>
                                </fieldset>
                                <input type="hidden" value="{{ $inventorytype->idinventorytype }}" id="inventorytype"
                                       name="inventorytype">
                                {!! Form::close() !!}
                            </section>
                            <footer>
                                <div>THE NEW SCHOOL</div>
                            </footer>
                        </article>
                    </section>

                </section>
            </div>
        </div>
    </div>
@stop
@section("vendor")
    {!! HTML::script('js/vendor/vendor.js') !!}
@stop
@section("script")
    {!! HTML::script('js/angular/' . getCurrentRoute() . '.js') !!}
@stop
@section("socket")
    {!! HTML::script('js/vendor/socket.io.js') !!}
@stop
@section("sigeturbo")
    {!! HTML::script('js/SigeTurbo.js') !!}
    {!! HTML::script('js/Stream.js') !!}
@stop