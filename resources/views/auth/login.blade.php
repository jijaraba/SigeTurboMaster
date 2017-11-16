@extends("layouts.login")
@section("title",Lang::get("sige.SignIn"))
@section("login")
    <div class="sige-form-container">
        @include("layouts.partials.flashmessage")
        <h2>{{ Lang::get("sige.SignIn") }}</h2>
        {!! Form::open(array('route' => 'login'))  !!}
        <ul class="display-horizontal col-100">
            <li class="col-100">
                {!! Form::email('email',null,['id' => 'email','placeholder' => Lang::get("sige.Email")]) !!}
                {!! $errors->first('email', '<ul class="errors"><li>:message</li></ul>') !!}
            </li>
            <li class="col-100">
                {!! Form::password('password',['id' => 'password','placeholder' => Lang::get("sige.Password")]) !!}
                {!! $errors->first('password','<ul class="errors"><li>:message</li></ul>') !!}
            </li>
            <li class="col-100">
                <div class="remember-password">
                    <ul class="display-horizontal col-100">
                        <li class="col-20">{!! Form::label("remember-password", Lang::get("sige.RememberPassword")) !!} </li>
                        <li class="col-10">{!! Form::checkbox('remember-password','1') !!} </li>
                        <li class="col-70"></li>
                    </ul>
                </div>
            </li>
        </ul>
        {!! Form::button(Lang::get("sige.SignIn"), ['type' => 'submit', 'id'=>'login-button','class' => 'btn btn-aquamarine']) !!}
        {!! Form::close() !!}
        <p>
            {!! link_to('/password/email',Lang::get('sige.ForgotPassword'),array('id'=>'reminder')) !!}
        </p>
    </div>
@stop
