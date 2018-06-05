@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Payments"))
@section("title", Lang::get("sige.Payments"))
@section("content")
    @if(getUser()->welcome_container == 0)
        <section class="grid-100" id="contained">
            <section class="sige-contained-welcome">
                <button class="sige-welcome-close fa fa-times fa-lg" id="sige-welcome-close"></button>
                <h4>{{ ((getUser()->idgender == 1)? Lang::get('sige.Welcome'): Lang::get('sige.Welcome2')). ", " . getUser()->firstname }}</h4>

                <p><span class="sige-turbo-title-app">SigeTurbo</span> es el Sistema de Información y Gestión Educativa
                    diseñado para soportar el flujo de información de todos los procesos de El Nuevo Colegio. El
                    módulo <span
                            class="sige-turbo-title-app">{!! Lang::get("sige.Parents") !!}</span> está estructurado para
                    soportar todos procesos académicos que se desarrollan en la institución.</p>
            </section>
        </section>
    @endif
@stop
@section("dashboard")
    <section>
        <section class="grid-100">
            <section class="sige-contained">
                <section class="sige-payments-create-form">
                    <a href="{{ URL::route('financials.payments.index',[])}}"
                       class="btn btn-transparent margin-bottom-20"><i
                                class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
                    <h4>Asignación de Pagos</h4>
                    <section class="sige-financials-create">
                        <article>
                            <header>
                                <h2>Seleccione Método de Pago</h2>
                            </header>
                            <section>
                                <h2>

                                </h2>
                                <p class="observation"></p>
                                <sigeturbo-payments-create></sigeturbo-payments-create>
                            </section>
                            <footer>
                                <div>{{ mb_strtoupper(config('app.company')) }}</div>
                            </footer>
                        </article>
                    </section>
                </section>
            </section>
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