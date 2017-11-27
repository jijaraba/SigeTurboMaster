@extends("layouts.login")
@section("login")
    <div class="sige-form-container">
        @include("layouts.partials.flashmessage")
        <h2>{{ Lang::get("sige.ResetPassword") }}</h2>
        {!! Form::open(['route' => 'password.request']) !!}
        {!! Form::hidden('token', $token) !!}
        <ul class="display-horizontal col-100">
            <li class="col-100 gutter-5">
                {!! Form::email('email',null,['placeholder' => Lang::get("sige.Email"),'required']) !!}
                {!!$errors->first('email', '<ul class="errors"><li>:message</li></ul>')  !!}
            </li>
            <li class="col-100 gutter-5">
                {!! Form::password('password',['placeholder' => Lang::get("sige.Password"),'required']) !!}
                {!! $errors->first('password', '<ul class="errors"><li>:message</li></ul>') !!}
            </li>
            <li class="col-100 gutter-5">
                {!! Form::password('password_confirmation',['placeholder' => Lang::get("sige.PasswordConfirmation"),'required']) !!}
                {!! $errors->first('password_confirmation', '<ul class="errors"><li>:message</li></ul>') !!}
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