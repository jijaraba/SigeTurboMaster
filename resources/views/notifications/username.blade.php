@extends('layouts.default')
@section("ModuleName", Lang::get("sige.Notifications"))
@section("title", Lang::get("sige.Notifications"))
@section("content")
    <div class="sige-contained" id="contained">
        <button class="sige-welcome-close fa fa-times fa-lg" id="sige-welcome-close"></button>
        <h4>{{ ((getUser()->idgender == 1)? Lang::get('sige.Welcome'): Lang::get('sige.Welcome2')). ", " . getUser()->firstname }}</h4>
        <p>Usted tiene {{ Alert::count($user->iduser) }} {{ (Alert::count($user->iduser) == 1)? " notificación":" notificaciones" }} en <strong>SigeTurbo</strong></p>
    </div>
@stop
