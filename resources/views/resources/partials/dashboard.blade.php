<section class="grid-100" ng-controller="DashboardController">
    <section class="sige-contained">
        <section class="sige-dashboard">
            <ul class="display-horizontal">
                <li class="col-50" id="main_dashboard">
                    <sige-turbo-visitors-dashboard-account></sige-turbo-visitors-dashboard-account>
                </li>
                <li class="col-50" id="secondary_dashboard">
                    <ul class="display-horizontal measurements">
                        <li class="col-100">
                            @if(count($purchases) > 0)
                                <article>
                                    <h5 class="header-aquamarine">Ahorro</h5>
                                    <ul class="display-horizontal">
                                        <li class="col-10">
                                            <p>Porcentaje de Ahorro en Compras</p>
                                            <ul class="display-horizontal col-100 purchase-discount">
                                                <li class="col-70 values">
                                                    <ul class="display-vertical col-100">
                                                        <li>{{ money($purchases->total)  }}</li>
                                                        <li>{{ money($purchases->discount) }}</li>
                                                    </ul>
                                                </li>
                                                <li class="col-30 discount">
                                                    {{ percentage(division($purchases->discount,$purchases->total),'discount') }}
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </article>
                            @endif
                        </li>
                    </ul>
                </li>
            </ul>
        </section>
    </section>
</section>