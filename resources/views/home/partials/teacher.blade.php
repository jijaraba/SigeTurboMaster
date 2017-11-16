<div class="grid-100" ng-controller="DashboardTeacherController">
    <div class="sige-contained">
        <section class="sige-dashboard">
            <ul class="display-horizontal dashboard-values">
                <li class="col-25">
                    <a href="{{ URL::route('admissions.students.index')}}">
                        <sige-turbo-dashboard-enrollments-active></sige-turbo-dashboard-enrollments-active>
                    </a>
                </li>
                <li class="col-25">
                    <a href="{{ URL::route('admissions.students.index',['search' => "{\"year\":$year,\"status\":[6]}"])}}">
                        <sige-turbo-dashboard-enrollments-internship></sige-turbo-dashboard-enrollments-internship>
                    </a>
                </li>
                <li class="col-25">
                    <a href="{{ URL::route('admissions.students.index',['search' => "{\"year\":$year,\"status\":[12]}"])}}">
                        <sige-turbo-dashboard-enrollments-pending></sige-turbo-dashboard-enrollments-pending>
                    </a>
                </li>
                <li class="col-25">
                    <a href="{{ URL::route('admissions.students.index',['search' => "{\"year\":$year,\"status\":[4]}"])}}">
                        <sige-turbo-dashboard-enrollments-retired></sige-turbo-dashboard-enrollments-retired>
                    </a>
                </li>
            </ul>
            <ul class="display-horizontal dashboard-graphics">
                <li class="col-50" id="main_dashboard">
                    <article>
                        <h5 class="header-aquamarine">Faltas de Asistencia Acumuladas</h5>
                        <canvas tc-chartjs-line chart-options="options" chart-data="data"
                                chart-click="onChartClick(event)"></canvas>
                    </article>
                </li>
                <li class="col-50" id="secondary_dashboard">
                    <ul class="display-horizontal measurements">
                        <li class="col-100">
                            @if(count($attendances) > 0)
                                <article>
                                    <h5 class="header-aquamarine">Porcentaje de Ausentismo</h5>
                                    <ul class="display-horizontal col-100 sige-dashboard-attendances">
                                        <li class="col-100 students">
                                            @foreach($attendances as $attendance)
                                                <ul class="display-horizontal col-100 student">
                                                    <li class="col-15 photo">
                                                        <div>
                                                            <img src="{{env('ASSETS_SERVER')."/img/users/".$attendance->photo}}"
                                                                 alt="{{ $attendance->student }}"
                                                                 title="{{ $attendance->student }}">
                                                        </div>
                                                    </li>
                                                    <li class="col-75 subject"><p>{{ $attendance->subject }}</p></li>
                                                    <li class="col-10 total"
                                                        title="Faltas Permitidas: {{ $attendance->totals }} - Faltas acumuladas: {{ $attendance->total }}">
                                                        <p>
                                                            <a href="{{ URL::route('formation.attendances.showbystudent',array('year' => $attendance->idyear,'period'=>$attendance->idperiod,'group'=>$attendance->idgroup,'subject'=>$attendance->idsubject,'nivel'=>$attendance->idnivel,'student'=>$attendance->iduser))}}">{{ round($attendance->total / $attendance->totals, 2) * 100 . "%" }}</a>
                                                        </p>
                                                    </li>
                                                </ul>
                                            @endforeach
                                        </li>
                                    </ul>
                                </article>
                            @endif
                        </li>
                    </ul>
                </li>
            </ul>
        </section>
    </div>
</div>