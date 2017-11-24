@extends('layouts/groupdirector')
@section("title", Lang::get("sige.HomeroomTeacher"))
@section("content")
    <section id="groupdirector-dashboard">
        <section class="sige-contained padding-05">
            <div class="flash flash-notice">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
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
                    <button class="btn btn-transparent-gray">Conocer más</button>
                </section>
            </section>
        </section>
        <section></section>
        <ul class="display-horizontal col-100">
            <li class="col-70">
                <section class="sige-contained padding-05">
                    <section class="sige-contained rounded-05 bkg-white padding-20">
                        <header>
                            <h4>{{ Lang::get('sige.Students') }}</h4>
                        </header>
                        <section class="sige-lists margin-top-10">
                            <sigeturbo-view-groupdirector-students group="{{ $group->idgroup }}"></sigeturbo-view-groupdirector-students>
                        </section>
                    </section>
                </section>
            </li>
            <li class="col-30">
                <section class="sige-contained padding-05">
                    <section class="sige-contained rounded-05 bkg-white padding-20">
                        <h6 class="center">DISTRIBUCIÓN DESEMPEÑOS</h6>
                        <sigeturbo-view-groupdirector-performance></sigeturbo-view-groupdirector-performance>
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
    {!! HTML::script(mix('js/groupdirector/dashboard.js')) !!}
@stop