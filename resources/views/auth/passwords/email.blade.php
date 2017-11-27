@extends("layouts.login")
@section("login")
    <div class="sige-form-container">
        @include("layouts.partials.flashmessage")
        <h2>{{ Lang::get("passwords.reminder") }}</h2>
        {!! Form::open(['route' => 'password.email']) !!}
        <ul class="display-horizontal col-100">
            <li class="col-100">
                {!! Form::email('email',null,['placeholder' => Lang::get("sige.Email"), 'id' => 'email']) !!}
                {!! $errors->first('email', '<ul class="errors"><li>:message</li></ul>') !!}
            </li>
        </ul>
        {!! Form::button(Lang::get("sige.Reset"), ['type' => 'submit', 'class' => 'btn btn-aquamarine', 'id' => 'reminder-button']) !!}
        {!! Form::close() !!}
        <div class="info" style="margin:10px 0px">
            <a class="icon icon-info" href="#"></a>
            <p>{{ Lang::get('passwords.help') }}</p>
        </div>
    </div>
@stop