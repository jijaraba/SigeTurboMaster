@extends("layouts.roles")
@section("title",Lang::get("sige.Roles"))
@section("roles")
    <div class="sige-form-container">
        @include("layouts.partials.flashmessage")
        <h2>{{ Lang::get("sige.Roles") }}</h2>
        <p>{{ getUser()->firstname }}, <strong>SigeTurbo</strong> ha dectectado que usted tiene <strong>{{ count($roles) }} {{ (count($roles) == 1)? "role" : "roles" }}</strong> asignados. Por favor seleccione el rol de usuario que mas se ajuste al trabajo que va a realizar en <strong>SigeTurbo</strong> en este momento</p>
        {!! Form::open(array('route' => 'roles.store', 'id' => 'sigeFormRole')) !!}
        <ul class="display-horizontal col-100">
            @foreach($roles as $role)
                <li style="width:{{ round(100 / count($roles),4) }}%" class="gutter-5">
                    <div class="role">
                        <label for="{{ $role }}">
                            {!! Form::radio('role', $role,false, array('id'=>$role)) !!}
                            <i class="fa fa-user"></i>
                            <img src="{{ getenv("ASSETS_SERVER") }}/img/users/sigeturbo.jpg" alt="">
                            <span>{{ rolName($role) }}</span>
                        </label>
                    </div>
                </li>
            @endforeach
        </ul>
        {!! Form::close() !!}
    </div>
@stop