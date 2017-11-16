@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Providers"))
@section("title", Lang::get("sige.Providers"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('resources.partials.helper')
    @endif
@stop
@section("dashboard")
    <section class="grid-100" ng-controller="ProviderUpdateController" ng-init="init({{ $provider }})">
        <section class="sige-contained">
            <a href="{{ URL::route('resources.providers.index', ['sort' => $sort, 'order' => $order, 'page' => $page])}}" class="btn btn-transparent"><i class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
            <section class="sige-purchase-main">
                <h4>{{ Lang::get('sige.ProviderUpdate') }}</h4>
                <section class="sige-provider-main">
                    <form ng-submit="updateProvider()">
                        <fieldset>
                            <ul class="display-horizontal col-10 evaluation-container">
                                <li class="col-100 gutter-5 evaluation">
                                    <input type="text" ng-model="provider.evaluation" name="evaluation" id="evaluation" value="{{ $provider->evaluation }}">
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset>
                            <ul class="display-horizontal col-100">
                                <li class="col-20 gutter-5 nit">
                                    <div>
                                        <input type="text" ng-model="provider.nit" name="nit" id="nit" value="{{ $provider->nit }}" placeholder="NIT">
                                    </div>
                                </li>
                                <li class="col-30 gutter-5 name">
                                    <div>
                                        <input type="text" ng-model="provider.name" name="name" id="name" value="{{ $provider->name }}" placeholder="Nombre Proveedor">
                                    </div>
                                </li>
                                <li class="col-30 gutter-5 name">
                                    <div>
                                        <input type="text" ng-model="provider.contact" name="contact" id="contact" value="{{ $provider->contact }}" placeholder="Contacto">
                                    </div>
                                </li>
                                <li class="col-20 gutter-5 phone">
                                    <div>
                                        <input type="text" ng-model="provider.phone" name="phone" id="phone" value="{{ $provider->phone }}" placeholder="Teléfono Proveedor">
                                    </div>
                                </li>
                            </ul>
                        </fieldset>
                        <fiedlset>
                            <ul class="display-horizontal col-100">
                                <li class="col-20 gutter-5 fax">
                                    <div>
                                        <input type="text" ng-model="provider.fax" name="fax" id="fax" value="{{ $provider->fax }}" placeholder="Fax Proveedor">
                                    </div>
                                </li>
                                <li class="col-50 gutter-5 email">
                                    <div>
                                        <input type="text" ng-model="provider.email" name="email" id="email" value="{{ $provider->email }}" placeholder="Email Proveedor">
                                    </div>
                                </li>
                                <li class="col-10 gutter-5 leadtime">
                                    <div>
                                        <input type="text" ng-model="provider.leadtime" name="leadtime" id="leadtime" value="{{ $provider->leadtime }}" placeholder="Tiempo Líder">
                                    </div>
                                </li>
                                <li class="col-10 gutter-5 paymentform">
                                    <div>
                                        <input type="text" ng-model="provider.paymentform" name="paymentform" id="paymentform" value="{{ $provider->paymentform }}" placeholder="Forma de Pago">
                                    </div>
                                </li>
                                <li class="col-10 gutter-5 warranty">
                                    <div>
                                        <input type="text" ng-model="provider.warranty" name="warranty" id="warranty" value="{{ $provider->warranty }}" placeholder="Garantía">
                                    </div>
                                </li>
                            </ul>
                        </fiedlset>
                        <fieldset>
                            <ul class="display-horizontal col-100">
                                <li class="col-65 gutter-5 web">
                                    <div><input ng-model="provider.web" id="web" name="web" type="text" value="{{ $provider->web }}" placeholder="Página Web Proveedor"></div>
                                </li>
                                <li class="col-20 gutter-5 address">
                                    <div><input ng-model="provider.address" id="address" name="address" type="text" value="{{ $provider->address }}" placeholder="Dirección del Proveedor"></div>
                                </li>
                                <li class="col-15 gutter-5 date">
                                    <div><input ng-model="provider.date" id="date" name="date" type="text" value="{{ $provider->date }}" placeholder="Fecha de Ingreso"></div>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5 services">
                                    <textarea name="services" id="services" ng-model="provider.services" placeholder="Servicios o productos que proporciona el proveedor">{{ $provider->services }}</textarea>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5 observation">
                                    <textarea name="observation" id="observation" ng-model="provider.observation" placeholder="Observación asociada al proveedor">{{ $provider->observation }}</textarea>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <button type="submit" class="btn btn-aquamarine">Save</button>
                                </li>
                            </ul>
                        </fieldset>
                        <input type="hidden" name="idprovider" id="idprovider" ng-model="provider.idprovider" ng-init="provider.idprovider ='{{$provider->idprovider}}'">
                    </form>
                </section>
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