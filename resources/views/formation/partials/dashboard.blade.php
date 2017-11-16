<section class="grid-100" ng-controller="DashboardController">
    <section class="sige-contained">
        <section class="sige-dashboard">
            <ul class="display-horizontal">
                <li class="col-50" id="main_dashboard">
                    <article>
                        <h5 class="header-aquamarine">Distribución de Seguimientos</h5>
                        <ul class="display-horizontal col-30 years">
                            <li class="col-100">
                                <label class="select-arrow" for="idyear">
                                    <select id="idyear" name="idyear" ng-model="academic.year" ng-change="selectYear(academic.year)" ng-options="year.idyear as year.name for year in years"></select>
                                </label>
                            </li>
                        </ul>
                        <ul class="display-horizontal" ng-if="total > 0">
                            <li class="col-40" id="description">
                                <ul class="display-horizontal line">
                                    <li ng-if="DP" class="col-100">
                                        <div class="value">@{{ DP }}</div>
                                        <div class="dp"></div>
                                    <li ng-if="DB" class="col-100">
                                        <div class="value">@{{ DB }}</div>
                                        <div class="db"></div>
                                    <li ng-if="DA" class="col-100">
                                        <div class="value">@{{ DA }}</div>
                                        <div class="da"></div>
                                    <li ng-if="DS" class="col-100">
                                        <div class="value">@{{ DS }}</div>
                                        <div class="ds"></div>
                                </ul>
                            </li>
                            <li class="col-60" id="chart">
                                <canvas tc-chartjs-doughnut chart-options="options" chart-data="data" width="250" height="250"></canvas>
                            </li>
                        </ul>
                    </article>
                </li>
                <li class="col-50" id="secondary_dashboard">
                    <ul class="display-horizontal measurements">
                        <li class="col-100" ng-if="total > 0">
                            <article>
                                <h5 class="header-aquamarine">Mediciones</h5>
                                <ul class="display-horizontal">
                                    <li class="col-10">
                                        <p>Seguimientos Ingresados</p>
                                        <div class="global">@{{total}}</div>
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