<section class="grid-100" id="contained">
    <section class="sige-contained-welcome">
        <button class="sige-welcome-close fa fa-times fa-lg" id="sige-welcome-close"></button>
        <h4>{{  ((getUser()->idgender == 1)? Lang::get('sige.Welcome'): Lang::get('sige.Welcome2')). ", " . getUser()->firstname }}</h4>
        <p><span class="sige-turbo-title-app">SigeTurbo</span> es el Sistema de Información y Gestión Educativa diseñado para soportar el flujo de información de todos los procesos de El Nuevo Colegio. En el módulo <span class="sige-turbo-title-app">{!! Lang::get("sige.Financials") !!}</span> soporta los cobros de matrículas y pensiones.</p>
    </section>
</section>