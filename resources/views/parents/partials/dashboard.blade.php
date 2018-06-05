<section class="grid-100" ng-controller="DashboardController">
    <section>
        <section class="sige-dashboard">
            <ul class="display-horizontal">
                <li class="col-50" id="main_dashboard">
                    <article>
                        <h5 class="header-aquamarine">Comunicados</h5>
                        <ul class="display-horizontal col-100">
                            <li class="col-100">
                            <!--
                                <article class="sige-parents-communications">
                                    <h5>Costos Educativos 2017-2018</h5>
                                    <p>
                                        En el siguiente enlace: <a href="{{ env('ASSETS_SERVER') }}/global/TNSCostos_2017-2018.pdf">Costos Educativos 2017-2018</a> pueden encontrar la proyección de los costos para el año 2017-2018. Cualquier aporte al respecto agracedemos informarlo por medio del correo: admisiones@thenewschool.edu.co antes del 05 de febrero de 2017.
                                    </p>
                                </article>
                                -->
                            </li>
                        </ul>
                    </article>
                </li>
                <li class="col-50" id="secondary_dashboard">
                    <ul class="display-horizontal measurements">
                        <li class="col-100">
                            <article>
                                <h5 class="header-aquamarine">Información</h5>
                                <ul class="display-horizontal col-100">
                                    <li class="col-10">
                                        <sigeturbo-payment-pending-family
                                                user="{{ getUser()->iduser }}"></sigeturbo-payment-pending-family>
                                    </li>
                                </ul>
                            </article>
                        </li>
                    </ul>
                </li>
            </ul>
        </section>
    </section>
</section>