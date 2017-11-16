@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Details"))
@section("title", Lang::get("sige.Details"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('resources.partials.helper')
    @endif
@stop
@section("dashboard")
    <section class="grid-100" ng-controller="DetailNewController" ng-init="init({{ $purchase->idpurchase }})">
        <section class="sige-contained">
            <h4>Agregar Ítem</h4>
            <section class="sige-purchase-main">
                <form ng-submit="newDetail()">
                    <fieldset>
                        <ul class="display-horizontal col-100 detail-info">
                            <li class="col-10 gutter-5 code">
                                <span><sige-turbo-purchase-product-select ng-model="detail.code"></sige-turbo-purchase-product-select></span>
                            </li>
                            <li class="col-10 gutter-5 quantity">
                                <input type="text" ng-model="detail.quantity" value="@{{ detail.quantity }}" ng-change="update()"/>
                            </li>
                            <li class="col-10 gutter-5 unit">
                                @{{ detail.unit }}
                            </li>
                            <li class="col-25 gutter-5 product">
                                <span>@{{ detail.product }}</span>
                            </li>
                            <li class="col-05 gutter-5 vat">
                                <span>@{{ detail.vat | percentage }}</span>
                            </li>
                            <li class="col-10 gutter-5 cost">
                                <input type="text" ng-model="detail.cost" value="@{{ detail.cost }}" ng-change="update()"/>
                            </li>
                            <li class="col-10 gutter-5 total">
                                <span>@{{ detail.total | currency }}</span>
                            </li>
                            <li class="col-10 gutter-5">
                                <button ng-disabled="isDisabled" type="submit" class="btn btn-aquamarine">Ingresar</button>
                            </li>
                        </ul>
                    </fieldset>
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