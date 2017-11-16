@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Assets"))
@section("title", Lang::get("sige.Assets"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('resources.partials.helper')
    @endif
@stop
@section("dashboard")
    <section class="grid-100" ng-controller="AssetUpdateController" ng-init="init({{ json_encode($asset) }})">
        <section class="sige-contained">
            <a href="{{ URL::route('resources.assets.index',['search' => $search,'sort' => $sort, 'order' => $order, 'page' => $page, 'ubication' => $ubication])}}"
               class="btn btn-transparent"><i class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
            <h4>Editar Activo</h4>
            <section class="sige-asset-main">
                <form ng-submit="submitNew()">
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-20 gutter-5 code">
                                <input name="code" type="text" ng-model="asset.code"
                                       ng-init="asset.code='{{$asset->code}}'" value="{{ $asset->code  }}"
                                       placeholder="Código Activo" required="true"/>
                            </li>
                            <li class="col-30 gutter-5 name">
                                <input name="name" type="text" ng-model="asset.name"
                                       ng-init="asset.name='{{$asset->name}}'" value="{{ $asset->name  }}"
                                       placeholder="Nombre Activo" required="true"/>
                            </li>

                            <li class="col-35 gutter-5 assetcategory">
                                <label class="select-arrow" for="idassetcategory">
                                    {!! Form::select('idassetcategory', $assetcategories, $asset->idassetcategory, ['ng-model' => 'asset.assetcategory','ng-init'=>"asset.assetcategory = \"$asset->idassetcategory\""]) !!}
                                </label>
                            </li>
                            <li class="col-15 gutter-5 cost">
                                <input name="model" type="text" ng-model="asset.cost"
                                       ng-init="asset.cost='{{$asset->cost}}'" value="{{ $asset->cost  }}"
                                       placeholder="Costo" required="true"/>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-40 gutter-5 name">
                                <textarea name="description" ng-model="asset.description"
                                          ng-init="asset.description = '{{$asset->description}}'" id="description"
                                          rows="2"></textarea>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-20 gutter-5">
                                <label class="select-arrow" for="idprovider">
                                    {!! Form::select('idprovider', $providers, $asset->idprovider, ['ng-model' => 'asset.provider','ng-init'=>"asset.provider = \"$asset->idprovider\""]) !!}
                                </label>
                            </li>
                            <li class="col-30 gutter-5 manufacturer">
                                <input name="manufacturer" type="text" ng-model="asset.manufacturer"
                                       ng-init="asset.manufacturer='{{$asset->manufacturer}}'"
                                       value="{{ $asset->manufacturer  }}" placeholder="Fabricante" required="false"/>
                            </li>
                            <li class="col-20 gutter-5 model">
                                <input name="model" type="text" ng-model="asset.model"
                                       ng-init="asset.model='{{$asset->model}}'" value="{{ $asset->model  }}"
                                       placeholder="Modelo" required="false"/>
                            </li>
                            <li class="col-15 gutter-5 serial">
                                <input name="serial" type="text" ng-model="asset.serial"
                                       ng-init="asset.serial='{{$asset->serial}}'" value="{{ $asset->serial  }}"
                                       placeholder="Serial" required="false"/>
                            </li>
                            <li class="col-15 gutter-5 acquired">
                                <input name="acquired" type="text" ng-model="asset.acquired"
                                       ng-init="asset.acquired='{{$asset->acquired}}'" value="{{ $asset->acquired  }}"
                                       placeholder="Fecha Compra" required="false"/>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-100 gutter-5">
                                <button type="button" class="btn btn-aquamarine" ng-click="updateAsset()">Save</button>
                            </li>
                        </ul>
                    </fieldset>
                    <input type="hidden" name="idasset" id="idasset" value="{{$asset->idasset}}"
                           ng-model="asset.idasset" ng-init="asset.idasset ='{{$asset->idasset}}'">
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