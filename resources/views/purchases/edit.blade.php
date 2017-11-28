@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Purchases"))
@section("title", Lang::get("sige.Purchases"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('resources.partials.helper')
    @endif
@stop
@section("dashboard")
    <section class="grid-100" ng-controller="PurchaseUpdateController" ng-init="init({{ $purchase->idpurchase }})">
        <section class="sige-contained">
            <a href="{{ URL::route('resources.purchases.index', ['sort' => $sort, 'order' => $order, 'page' => $page])}}" class="btn btn-transparent margin-bottom-20"><i class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
            <section class="sige-purchase-main">
                <h4>Actualizar Compra</h4>
                <section class="sige-purchase-status">
                    <ul class="display-horizontal col-100" style="margin-top: 10px">
                        <li class="col-100 gutter-5">
                            <div class="status-purchase">
                                <label class="select-arrow" for="idstatus">
                                    {!! Form::select('idstatuspurchase', $statuses, $purchase->idstatuspurchase, ['ng-model' => 'purchase.status','ng-init'=>"purchase.status = \"$purchase->idstatuspurchase\"", 'ng-change' => 'updateStatus()', 'ng-disabled'=>'enabledStatus']) !!}
                                </label>
                            </div>
                        </li>
                    </ul>
                </section>
                @if ($purchase->idstatuspurchase == 3 || $purchase->idstatuspurchase == 4)
                    <sige-turbo-purchase-evaluation purchase="{{ $purchase->idpurchase }}" status="purchase.status"></sige-turbo-purchase-evaluation>
                @endif
                <form ng-submit="update()" style="margin: 0px 0px 20px 0px">
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-15 gutter-5">
                                <input class="center" type="text" ng-model="purchase.code" value=""
                                       ng-init="purchase.code = '{{$purchase->code}}'" placeholder="Código"
                                       required="true"/>
                            </li>
                            <li class="col-30 gutter-5">
                                <input type="text" ng-model="purchase.budget" value=""
                                       ng-init="purchase.budget = '{{$purchase->budget}}'" placeholder="Presupuesto"
                                       required="true"/>
                            </li>
                            <li class="col-35 gutter-5">
                                <label class="select-arrow" for="idprovider">
                                    {!! Form::select('idprovider', $providers, null, ['ng-model' => 'purchase.provider','ng-init'=>"purchase.provider = \"$purchase->idprovider\""]) !!}
                                </label>
                            </li>
                            <li class="col-05 gutter-5">
                                <input class="center" type="text" ng-model="purchase.discount" value=""
                                       ng-init="purchase.discount = '{{$purchase->discount}}'" placeholder="%"
                                       required="true"/>
                            </li>
                            <li class="col-05 gutter-5">
                                <input class="center" type="text" ng-model="purchase.leadtime" value=""
                                       ng-init="purchase.leadtime = '{{$purchase->leadtime}}'" placeholder="T"
                                       required="true"/>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset id="purchase_observation">
                        <ul class="display-horizontal col-100">
                            <li class="col-100 gutter-5">
                                <textarea name="observation" ng-model="purchase.observation"
                                          ng-init="purchase.observation = '{{$purchase->observation}}'" id="observation"
                                          rows="2"></textarea>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="button gutter-5">
                                <button id="save" type="submit" class="btn btn-aquamarine">Save</button>
                            </li>
                        </ul>
                    </fieldset>
                    <input type="hidden" ng-model="purchase.idpurchase"
                           ng-init="purchase.idpurchase = '{{$purchase->idpurchase}}'">
                </form>
            </section>
            <section class="sige-purchase-detail">
                <ul class="display-horizontal col-100 update">
                    <li class="col-100 detail" data-ng-repeat="detail in details">
                        <sige-turbo-purchase-detail detail="detail"></sige-turbo-purchase-detail>
                    </li>
                    <li class="col-100">
                        <a class="item"
                           href="{{ URL::route('resources.details.create',['purchase' => $purchase->idpurchase]) }}"
                           id="new_detail">Agregar Ítem</a>
                    </li>
                </ul>
            </section>
            <section class="sige-purchase-total">
                <ul class="display-horizontal col-100 purchase-total">
                    <li class="col-100 gutter-5 total">
                        <span>Subtotal: @{{ details | subtotal | currency }}</span>
                    </li>
                    <li class="col-100 gutter-5 total">
                        <span>Descuento (@{{ purchase.discount | percentage }}
                            ): @{{ details | discount:purchase.discount | currency }}</span>
                    </li>
                    <li class="col-100 gutter-5 total">
                        <span>IVA: @{{ details | vat:purchase.discount | currency }}</span>
                    </li>
                    <li class="col-100 gutter-5 total">
                        <span>Total: @{{ details | total:purchase.discount | currency }}</span>
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