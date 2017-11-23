@extends('layouts/groupdirector')
@section("content")
    <section id="groupdirector-student">
        <div>Student {{ $enrollment->firstname }}</div>
        <sigeturbo-view-groupdirector-student
                student="{{ $enrollment->iduser }}"></sigeturbo-view-groupdirector-student>
    </section>
@stop
@section("vendor")
    {!! HTML::script(mix('/js/vendor/vendor.js')) !!}
@stop
@section("module")
    {!! HTML::script(mix('js/groupdirector/student.js')) !!}
@stop