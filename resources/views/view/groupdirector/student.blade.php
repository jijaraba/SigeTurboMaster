@extends('layouts/groupdirector')
@section("title", Lang::get("sige.HomeroomTeacher"))
@section("content")
    <section id="groupdirector-student">
        <section class="sige-contained padding-05">
            <div class="flash flash-notice">
                El grupo <strong>{{ $group->name }}</strong> presenta novedades
            </div>
        </section>
        <section>
            <section class="sige-contained padding-05">
                <section class="sige-contained rounded-05 bkg-gray padding-20">
                    <h5 class="without-border">Hola {{ getUser()->firstname }}</h5>
                    <p>Bienvenido al nuevo aplicativo para Directores de Grupo en donde en una sola pantalla puede
                        visualizar estadísticas y toda la información correspondiente al grupo y cada uno de los
                        estudiantes que hacen parte del mismo.</p>
                    <a href="/formation/monitorings" class="btn btn-transparent-gray tooltip" title="Ir a Seguimiento Académico" style="width: 150px">Ir a Seguimientos</a>
                </section>
            </section>
        </section>
        <section></section>
        <ul class="display-horizontal col-100">
            <li class="col-70">
                <section class="sige-contained padding-05">
                    <section class="sige-contained rounded-05 bkg-white padding-20">
                        <header>
                            <h4>ESTUDIANTE</h4>
                        </header>
                        <section class="sige-item margin-top-10">
                            <ul class="display-horizontal col-100">
                                <li class="col-20">
                                    <figure class="big">
                                        <img src="{{env('ASSETS_SERVER')}}/img/users/{{$enrollment->photo}}"
                                             alt="{{ $enrollment->lastname }}"
                                             title="{{ $enrollment->lastname ." ". $enrollment->firstname }}">
                                    </figure>
                                </li>
                                <li class="col-80 description">
                                    <div>
                                        <span>{{ $enrollment->iduser }}</span>
                                        <span>{{ $enrollment->firstname ." ". $enrollment->lastname }}</span>
                                    </div>
                                </li>
                            </ul>
                        </section>
                        <hr class="margin-top-bottom-20">
                        <nav class="sige-view-groupdirector-nav">
                            <ul class="display-horizontal">
                                <li><a href="#" class="active">{{ mb_strtoupper(Lang::get('sige.Reports')) }}</a></li>
                            </ul>
                        </nav>
                        <section style="margin-top: 25px">
                            <header class="margin-bottom-15">
                                <h5 class="without-border">PRIMER PERIODO</h5>
                            </header>
                            <sigeturbo-view-groupdirector-student year="2017" period="1"
                                                                  student="{{ $enrollment->iduser }}"
                                                                  type="partialreport"></sigeturbo-view-groupdirector-student>
                            <hr class="margin-top-bottom-02">
                            <sigeturbo-view-groupdirector-student year="2017" period="1"
                                                                  student="{{ $enrollment->iduser }}"
                                                                  type="{{ $type }}"></sigeturbo-view-groupdirector-student>
                        </section>
                        <section style="margin-top: 25px">
                            <header class="margin-bottom-15">
                                <h5 class="without-border">SEGUNDO PERIODO</h5>
                            </header>
                            <sigeturbo-view-groupdirector-student year="2017" period="2"
                                                                  student="{{ $enrollment->iduser }}"
                                                                  type="partialreport"></sigeturbo-view-groupdirector-student>
                            <hr class="margin-top-bottom-02">
                            <sigeturbo-view-groupdirector-student year="2017" period="2"
                                                                  student="{{ $enrollment->iduser }}"
                                                                  type="{{ $type }}"></sigeturbo-view-groupdirector-student>
                        </section>
                    </section>
                </section>
            </li>
            <li class="col-30">
                <section class="sige-contained padding-05">
                    <section class="sige-contained rounded-05 bkg-white padding-20">
                        <h6 class="center">INTEGRANTES DE LA FAMILIA</h6>
                        <sigeturbo-view-groupdirector-members></sigeturbo-view-groupdirector-members>
                    </section>
                    <section class="sige-contained rounded-05 bkg-white top-10 padding-20">
                        <h6 class="center">DISTRIBUCIÓN DESEMPEÑOS</h6>
                        <sigeturbo-view-groupdirector-performance></sigeturbo-view-groupdirector-performance>
                    </section>
                    <section class="sige-contained rounded-05 bkg-white top-10 padding-20">
                        <h6 class="center">INTEGRANTES DE LA FAMILIA</h6>
                        <sigeturbo-view-groupdirector-members></sigeturbo-view-groupdirector-members>
                    </section>
                    <section class="sige-contained rounded-05 bkg-white top-10 padding-20">
                        <h6 class="center">FALTAS DE ASISTENCIA</h6>
                        <sigeturbo-view-groupdirector-attendance></sigeturbo-view-groupdirector-attendance>
                    </section>
                    <section class="sige-contained rounded-05 bkg-white top-10 padding-20">
                        <h6 class="center">OBSERVACIONES</h6>
                        <sigeturbo-view-groupdirector-observator></sigeturbo-view-groupdirector-observator>
                    </section>
                </section>
            </li>
        </ul>
    </section>
@stop
@section("vendor")
    {!! HTML::script(mix('/js/vendor/vendor.js')) !!}
@stop
@section("module")
    {!! HTML::script(mix('js/groupdirector/student.js')) !!}
@stop