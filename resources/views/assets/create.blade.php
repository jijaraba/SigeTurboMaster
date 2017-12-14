@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Assets"))
@section("title", Lang::get("sige.Assets"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('resources.partials.helper')
    @endif
@stop
@section("dashboard")
    <section class="grid-100" ng-controller="AssetNewController">
        <section class="sige-contained">
            <a href="{{ URL::route('resources.assets.index',['search' => $search,'sort' => $sort, 'order' => $order, 'page' => $page, 'ubication' => $ubication])}}"
               class="btn btn-transparent margin-bottom-20"><i class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
            <h4>Crear Activo</h4>
            <section class="sige-asset-main">
                <form ng-submit="submitNew()">
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-20 gutter-5 code">
                                <input name="code" type="text" ng-model="asset.code" placeholder="Código Activo"
                                       required="true"/>
                            </li>
                            <li class="col-30 gutter-5 name">
                                <input name="name" type="text" ng-model="asset.name"
                                       placeholder="Nombre Activo" required="true"/>
                            </li>

                            <li class="col-35 gutter-5 assetcategory">
                                <label class="select-arrow" for="idassetcategory">
                                    {!! Form::select('idassetcategory', $assetcategories, null, ['ng-model' => 'asset.assetcategory']) !!}
                                </label>
                            </li>
                            <li class="col-15 gutter-5 cost">
                                <input name="model" type="text" ng-model="asset.cost"
                                       placeholder="Costo" required="true"/>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-40 gutter-5 name">
                                <textarea name="description" ng-model="asset.description"
                                          id="description"
                                          rows="2"></textarea>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-20 gutter-5">
                                <label class="select-arrow" for="idprovider">
                                    {!! Form::select('idprovider', $providers, null, ['ng-model' => 'asset.provider']) !!}
                                </label>
                            </li>
                            <li class="col-30 gutter-5 manufacturer">
                                <input name="manufacturer" type="text" ng-model="asset.manufacturer"
                                       placeholder="Fabricante" required="false"/>
                            </li>
                            <li class="col-20 gutter-5 model">
                                <input name="model" type="text" ng-model="asset.model"
                                       placeholder="Modelo" required="false"/>
                            </li>
                            <li class="col-15 gutter-5 serial">
                                <input name="serial" type="text" ng-model="asset.serial"
                                       placeholder="Serial" required="false"/>
                            </li>
                            <li class="col-15 gutter-5 acquired">
                                <input name="acquired" type="text" ng-model="asset.acquired"
                                       placeholder="Fecha Compra" required="false"/>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-100 gutter-5">
                                <button type="button" class="btn btn-aquamarine" ng-click="newAsset()">Save</button>
                            </li>
                        </ul>
                    </fieldset>
                </form>
            </section>
        </section>
    </section>
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