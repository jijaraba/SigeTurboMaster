@extends("layouts.payments")
@section("content")
    <section class="sige-payments" ng-controller="PaymentsGuestController">
        <section class="payments-header">
            <img src="https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com/assets/payment_guest_background_04.png"
                 alt="payment">
        </section>
        <section class="payments-options">
            <p style="width: 100%;text-align: center;font-size:0.8em">SELECCIONE MÉTODO DE PAGO</p>
            <ul class="display-horizontal col-40">
                <li class="col-33" ng-click="showOption(1)">
                    <img src="https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com/img/modules/payment_individual.svg"
                         alt="payment">
                    <span style="text-align: center">PASARELA DE PAGOS</span>
                </li>
                <!--
                <li class="col-33" ng-click="showOption(2)">
                    <img src="https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com/img/modules/payment_individual.svg"
                         alt="payment">
                    <span style="text-align: center">BBVA</span>
                </li>
                -->
                <li class="col-33" ng-click="showOption(3)">
                    <img src="https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com/img/modules/payment_individual.svg"
                         alt="payment">
                    <span style="text-align: center">DONACIONES ASPANS</span>
                </li>
            </ul>
        </section>
        <section class="payments-gateway" ng-if="options.gateway">
            <h4>Pasarela de Pagos</h4>
            <section class="payment-container">
                <ul class="display-horizontal col-100">
                    <li class="col-30 imagen">
                        <img src="https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com/img/modules/payment_individual.svg"
                             alt="payment">
                    </li>
                    <li class="col-70 body">
                        <h4>Pasarela de Pagos</h4>
                        <p>
                            {{ "Con nuestro moderno sistema de pagos integrado a SigeTurbo puede mantener un registro detallado de cada uno de los pagos que realice en tiempo real, recibir notificaciones y establecer acuerdos de pago con el colegio" }}
                        </p>
                        <a href="https://sigeturbo.thenewschool.edu.co/parents/payments">Ingresar al Gestor de Pagos</a>
                        <section class="info_generic">
                            <div>
                                <i class="icon icon-info col-10" href="#"></i>
                                <span class="col-90">Para ingresar a SigeTurbo debe tener una cuenta activa. En caso de aún no tenerla puede comunicarse con el Área Administración de Recursos en la línea 5207270 Ext 207</span>
                            </div>
                        </section>
                    </li>
                </ul>
            </section>
        </section>
        <section class="payments-bank" ng-if="options.bank">
            <h4>Banco BBVA</h4>
            <section class="payment-container">
                <ul class="display-horizontal col-100">
                    <li class="col-30 imagen">
                        <img src="https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com/img/modules/payment_individual.svg"
                             alt="payment">
                    </li>
                    <li class="col-70 body">
                        <h4>Consultar Código Familia</h4>
                        <p>
                            {{ "Si aún no conoce el Código de Familia, puede consultarlo escribiendo el apellido completo de la familia en el formulario y dando clic en el botón Buscar." }}
                        </p>
                        <form>
                            <fieldset>
                                <ul class="display-horizontal col-100">
                                    <li class="col-50">
                                        <input type="text" placeholder="Apellidos Familia" ng-model="search.family">
                                    </li>
                                    <li class="col-50">
                                        <button style="margin: 0px 5px" type="button" class="btn btn-aquamarine"
                                                ng-click="searchFamily()">{{ Lang::get('sige.Search') }}</button>
                                    </li>
                                    <li class="col-100" style="margin-top: 10px">
                                        <a href="https://www.zonapagos.com/t_nschool/pagos.asp">Ir Zona Pagos</a>
                                    </li>
                                </ul>
                            </fieldset>
                        </form>
                        <section class="info_generic">
                            <div>
                                <i class="icon icon-info col-10" href="#"></i>
                                <span class="col-90">Por favor tener en cuenta que con el Banco BBVA solo se pueden realizar los pagos pendientes correspondientes al año académico 2015-2016</span>
                            </div>
                        </section>
                    </li>
                </ul>
            </section>
        </section>
        <section class="payments-aspans" ng-if="options.aspans">
            <h4>Donaciones ASPANS</h4>
            <section class="payment-container">
                <ul class="display-horizontal col-100">
                    <li class="col-30 imagen">
                        <img src="https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com/img/modules/payment_individual.svg"
                             alt="payment">
                    </li>
                    <li class="col-70 body">
                        <h4>Donaciones ASPANS</h4>
                        <p>
                            {{ "Realice sus donaciones a la Asociación de Padres de Familia de The New School (ASPANS). " }}
                        </p>
                        <a href="https://www.zonapagos.com/t_asopaflia/pagos.asp">Ir Zona Pagos</a>
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
    {!! HTML::script('js/Homework.js') !!}
@stop