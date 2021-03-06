@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Financials"))
@section("title", Lang::get("sige.Financials"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("financials.partials.helper")
    @endif
@stop
@section("dashboard")
    <section class="grid-100">
        <section class="sige-contained">
            <h4>Dashboard</h4>
            <div class="sige-dashboard">
                @include('financials.partials.dashboard.global')
                <ul class="display-horizontal col-100">
                    <li class="col-50 main_dashboard">
                        <article>
                            <ul class="display-horizontal">
                                <li class="col-70">
                                    <ul class="display-horizontal measurements">
                                        <li class="col-100">
                                            <ul class="display-horizontal col-100" style="display: none">
                                                <li class="col-100 inclusion-text" style="text-align:center;">
                                                    <h5 class="header-aquamarine">Exportar Asientos</h5>
                                                </li>
                                                <li class="col-45 inclusion" style="text-align: -webkit-center;">
                                                    <button class="btn btn-green" ng-click="exportseat('xlsx')"
                                                            style="border-radius: 30px;"><i class="fa fa-file-excel-o"
                                                                                            aria-hidden="true"></i>
                                                        Excel
                                                    </button>
                                                </li>
                                                <li class="col-5 inclusion"></li>
                                                <li class="col-50 inclusion-text" style="text-align: -webkit-center;">
                                                    <a class="btn btn-blue" ng-click="exportseat('text/plain')"
                                                       style="border-radius: 30px;"><i class="fa fa-file-text-o"
                                                                                       aria-hidden="true"></i>
                                                        <span style="font-size: 0.71em;">Texto Plano</span>
                                                    </a>
                                                </li>
                                                <li class="col-45 inclusion-text">Comprobante</li>
                                                <li class="col-5 inclusion"></li>
                                                <li class="col-50 inclusion">
                                                    <select name="vouchertype" ng-model="registry.vouchertype"
                                                            ng-options="vouchertype.code as vouchertype.name for vouchertype in vouchertypes"
                                                            required>
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </li>
                                                <li class="col-45 inclusion-text">Fecha de Inicio</li>
                                                <li class="col-5 inclusion"></li>
                                                <li class="col-50 inclusion">
                                                    <input name="starts" type="text" ng-model="registry.starts"
                                                           ng-value="registry.starts"
                                                           ng-bind-html="registry.starts | getValidateDate" required>
                                                    <p ng-if="(registry.starts | getValidateDate) == false">Formato de
                                                        Fecha Incorrecto</p>
                                                </li>
                                                <li class="col-45 inclusion-text">Fecha de Finalización</li>
                                                <li class="col-5 inclusion"></li>
                                                <li class="col-50 inclusion">
                                                    <input name="ends" type="text" ng-model="registry.ends"
                                                           ng-value="registry.ends"
                                                           ng-bind-html="registry.ends | getValidateDate" required>
                                                    <p ng-if="(registry.ends | getValidateDate) == false">Formato de
                                                        Fecha Incorrecto</p>
                                                </li>
                                                <li class="col-100 inclusion" ng-if="dataincomplete">Datos incompletos o
                                                    incorrectos
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="col-30" id="main_dashboard">

                                </li>
                            </ul>
                        </article>
                    </li>
                    <li class="col-50 secondary_dashboard">
                        @if(count($payments)>0)
                            <article>
                                <h5 class="header-aquamarine">{{ Lang::get('sige.PaymentsPendings') }}</h5>
                                <ul class="display-horizontal">
                                    <li class="col-100">
                                        <sigeturbo-payments-calendar :payments="{{json_encode($payments,true)}}"
                                                                     :server-date="{{ $serverdate }}"></sigeturbo-payments-calendar>
                                    </li>
                                </ul>
                            </article>
                        @endif
                    </li>
                </ul>
            </div>
        </section>
    </section>
@stop
@section("vendor")
    {!! HTML::script(mix('/js/vendor/vendor.js')) !!}
    {!! HTML::script(mix('/js/Utils.js')) !!}
@stop
@section("script")
    {!! HTML::script(mix('js/' . getCurrentRoute() . '/' . getCurrentApp() .  '.js')) !!}
@stop
@section("socket")
    {!! HTML::script(mix('js/vendor/socket.io.js')) !!}
@stop
@section("sigeturbo")
    {!! HTML::script(mix('js/SigeTurbo.js')) !!}
    {!! HTML::script(mix('js/Stream.js')) !!}
@stop
