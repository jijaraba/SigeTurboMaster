@extends('layouts/groupdirector')
@section("content")
    <section id="groupdirector-dashboard">
        <div>Hello</div>
        <sigeturbo-view-groupdirector-students></sigeturbo-view-groupdirector-students>
    </section>
@stop
@section("vendor")
    {!! HTML::script(mix('/js/vendor/vendor.js')) !!}
@stop
@section("module")
    {!! HTML::script(mix('js/groupdirector/dashboard.js')) !!}
@stop