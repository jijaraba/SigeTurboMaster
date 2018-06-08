@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Parents"))
@section("title", Lang::get("sige.Parents"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('parents.partials.helper')
    @endif
@stop
@section("dashboard")
    <section>
        <section class="grid-100">
            <section class="sige-contained">
                <a href="{{ URL::route('parents.monitoring.index')}}" class="btn btn-transparent margin-bottom-20"><i
                            class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
                <h4>Asignatura {{ $subject->name }}</h4>
                @foreach($monitorings as $monitoring)
                    <section class="monitoring-detail">
                        <div class="category">
                            <ul class="display-horizontal col-100">
                                <li class="col-50 category-name">
                                    {{ $monitoring->category }} ({{ percentage($monitoring->percent,'normal') }})
                                </li>
                                <li class="col-50 monitoring">
                                    {{ scale($monitoring->average,$monitoring->idgroup) }}
                                </li>
                            </ul>
                        </div>
                        <div class="detail">
                            @foreach(json_decode($monitoring->details,true) as $detail)
                                <input class="tooltip" type="text"
                                       value="{{ scale($detail['rating'], $monitoring->idgroup) }}"
                                       title="{{ $detail['monitoringtype'] }}">
                            @endforeach
                        </div>
                    </section>
                @endforeach
            </section>
        </section>
    </section>
@stop
@section("vendor")
    {!! HTML::script(mix('js/vendor/vendor.js')) !!}
@stop
@section("script")
    {!! HTML::script(mix('js/angular/' . getCurrentRoute() . '.js')) !!}
@stop
@section("sigeturbo")
    {!! HTML::script(mix('js/SigeTurbo.js')) !!}
@stop