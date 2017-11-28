@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Attendance"))
@section("title", Lang::get("sige.Attendance"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('formation.partials.helper')
    @endif
@stop
@section("dashboard")
    <section ng-controller="AttendanceShowController">
        <section class="grid-100">
            <section class="sige-contained">
                <a href="{{ URL::route('formation.attendances.index')}}" class="btn btn-transparent margin-bottom-20"><i
                            class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
                <section class="sige-attendances-lists">
                    <h4>{{ Lang::get('sige.Attendance') }}</h4>
                    <section class="attendance-list">
                        <ul class="display-horizontal col-100 student">
                            <li class="col-10 photo">
                                <div>
                                    <img src="{{ env('ASSETS_SERVER') }}/img/users/{{ $student->photo }}"
                                         alt="{{ $student->fullname }}" title="{{ $student->fullname }}">
                                </div>
                            </li>
                            <li class="col-85 body">
                                <div>{{ $student->fullname }}</div>
                                @if($student->celular_confirmed ==1)
                                    <div>{{ Lang::get('sige.Celular') }}: {{ $student->celular }}</div>
                                @endif
                                <div>{{ Lang::get('sige.Phone') }}: {{ $student->phone }}</div>
                                <div>
                                    <a href="{{ URL::route('admissions.students.edit',array('student' => $student->iduser))}}">Ver
                                        Información</a></div>
                            </li>
                        </ul>
                        <ul id="attendance-list display-horizontal col-100">
                            @foreach($attendances as $attendance)
                                <li class="col-100">
                                    <ul class="display-horizontal col-100 attendance">
                                        <li class="col-05">
                                            <input type="checkbox"/>
                                        </li>
                                        <li class="col-10 type">
                                            <div id="counts"
                                                 class="attendance-{{ $attendance->type }}-count">{{ $attendance->type }}</div>
                                        </li>
                                        <li class="col-10 photo">
                                            <div>
                                                <img src="{{env('ASSETS_SERVER')}}/img/users/{{$attendance->photo}}"
                                                     alt="{{ $attendance->teacher }}"
                                                     title="{{ $attendance->teacher  }}"/>
                                            </div>
                                        </li>
                                        <li class="col-10 group">
                                            <div>{{ $attendance->group }}</div>
                                        </li>
                                        <li class="col-15 subject">
                                            <div>{{ $attendance->subject }}</div>
                                        </li>
                                        <li class="col-10 nivel">
                                            <div>{{ $attendance->nivel }}</div>
                                        </li>
                                        <li class="col-20 date">
                                            <div>
                                                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($attendance->date))->formatLocalized('%A, %d %B %Y') }}
                                            </div>
                                        </li>
                                        <li class="col-10 time">
                                            <div>
                                                {{ $attendance->time }}
                                            </div>
                                        </li>
                                        <li class="col-10 delete">
                                            <a href="{{ URL::route('formation.attendances.delete',['attendance' => $attendance->idattendance]) }}"
                                               id="update">{{ Lang::get('sige.Delete') }}</a>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                </section>
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
@section("socket")
    {!! HTML::script(mix('js/vendor/socket.io.js')) !!}
@stop
@section("sigeturbo")
    {!! HTML::script(mix('js/SigeTurbo.js')) !!}
    {!! HTML::script(mix('js/Stream.js')) !!}
@stop