@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Purchases"))
@section("title", Lang::get("sige.Purchases"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('resources.partials.helper')
    @endif
@stop
@section("dashboard")
    <section class="grid-100" ng-controller="PurchaseNewController">
        <section class="sige-contained">
            <a href="{{ URL::route('resources.purchases.index')}}" class="btn btn-transparent margin-bottom-20"><i class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
            <section class="sige-purchase-main">
                <h4>Nueva Compra</h4>
                <form ng-submit="submitNew()">
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-15 gutter-5">
                                <input class="center" type="text" ng-model="purchase.code" value="" placeholder="Código" required="true"/>
                            </li>
                            <li class="col-35 gutter-5">
                                <input type="text" ng-model="purchase.budget" value="" placeholder="Presupuesto" required="true"/>
                            </li>
                            <li class="col-30 gutter-5">
                                <label class="select-arrow" for="idprovider">
                                    {!! Form::select('idprovider', $providers, null, ['ng-model' => 'purchase.provider','ng-init'=>'purchase.provider = "1"']) !!}
                                </label>
                            </li>
                            <li class="col-05 gutter-5">
                                <input class="center" type="text" ng-model="purchase.discount" value="" title="Descuento" placeholder="%" required="true"/>
                            </li>
                            <li class="col-05 gutter-5">
                                <input class="center" type="text" ng-model="purchase.leadtime" value="" title="Tiempo de Entrega" placeholder="T" required="true"/>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset id="purchase_observation">
                        <ul class="display-horizontal col-100">
                            <li class="col-100 gutter-5">
                            <textarea name="observation" ng-model="purchase.observation" id="observation" title="Observación asociada a la Orden de Compra" rows="2" ng-blur="register()"></textarea>
                            </li>
                        </ul>
                    </fieldset>
                </form>
            </section>
            <section class="sige-purchase-detail" ng-if="showDetail">
                <ul class="display-horizontal col-100 update">
                    <li class="col-100 detail" data-ng-repeat="detail in details">
                        <sige-turbo-purchase-detail detail="detail"></sige-turbo-purchase-detail>
                    </li>
                    <li class="col-100">
                        <a class="item" href="/resources/details/create/@{{purchase.idpurchase}}" id="new_detail">Agregar Ítem</a>
                    </li>
                </ul>
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