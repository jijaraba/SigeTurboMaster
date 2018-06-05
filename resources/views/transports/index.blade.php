@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Tranports"))
@section("title", Lang::get("sige.Tranports"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('parents.partials.helper')
    @endif
@stop
@section("dashboard")
    <section ng-controller="TransportsController" ng-init="init({{ json_encode($search) }})">
        <section class="grid-100">
            <section class="sige-contained">
                <section class="sige-payments-lists">
                    <h4>{{ Lang::get('sige.Transports') }}</h4>
                    {!! Form::open(['autocomplete' => 'off']) !!}
                    <section class="search-container">
                        <ul class="display-horizontal col-100">
                            <li class="col-100 gutter-5">
                                <sige-turbo-transport-search search="search" result="result"></sige-turbo-transport-search>
                                <input name="search" ng-model="result" ng-value="result" type="hidden"
                                       value="{{json_encode($search)}}"/>
                            </li>
                            <li id="views" class="col-30 gutter-5">
                                <span>Vista: </span>
                                <input value="photo" id="images" type="radio" name="view"
                                        onclick="this.form.submit()">
                                <label for="images">
                                    <div class="far fa-image"></div>
                                </label>
                                <input value="list" id="list" type="radio" name="view"
                                        onclick="this.form.submit()">
                                <label for="list">
                                    <div class="fa fa-list"></div>
                                </label>
                            </li>
                            <li class="col-40 gutter-5">
    
                            </li>
                            <li id="reverse" class="col-20 gutter-5">
                                <input value="asc" id="asc" name="order" type="radio"
                                        onclick="this.form.submit()">
                                <label for="asc">
                                    <div class="fa fa-sort-alpha-up"></div>
                                </label>
                                <input value="desc" id="desc" name="order" type="radio"
                                        onclick="this.form.submit()">
                                <label for="desc">
                                    <div class="fa fa-sort-alpha-down"></div>
                                </label>
                            </li>
                        </ul>
                    </section>
                    {!! Form::close() !!}
                    <div class="clearfix"></div>
                        <section class="payment-list" style="margin-top: 10px;">
                            <section class="search-container" style="margin-bottom: 20px;">
                                <ul class="display-horizontal col-100">
                                    <li id="views" class="col-80 gutter-5">
                                        <ul class="display-horizontal col-100 payment">
                                            <li class="col-25 family">
                                                <a class="btn btn-green" ng-click="dialogsforms('route','{{ Lang::get('sige.Add')." Ruta"}}');">
                                                    <i class="fa fa-plus-circle"></i>{{ Lang::get('sige.Route') }}
                                                </a>
                                            </li>
                                            <li class="col-25 family">
                                                <a class="btn btn-green" ng-click="dialogsforms('conveyor','{{ Lang::get('sige.Add')." ".Lang::get('sige.Conveyor')}}')">
                                                    <i class="fa fa-user" aria-hidden="true"></i>  {{ Lang::get('sige.Conveyor') }}
                                                </a>
                                            </li>
                                            <li class="col-25 family">
                                                <a class="btn btn-green" ng-click="dialogsforms('vehicle','{{ Lang::get('sige.Add')." ".Lang::get('sige.Vehicle')}}')"> 
                                                    <i class="fa fa-car" aria-hidden="true"></i>{{ Lang::get('sige.Vehicle') }}
                                                </a>
                                            </li>
                                            <li class="col-25 family">
                                                <a class="btn btn-green" ng-click="dialogsforms('user','{{ Lang::get('sige.Add')." ".Lang::get('sige.Users')}}')">
                                                    <i class="fa fa-users" aria-hidden="true"></i>{{ Lang::get('sige.Add') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </section>
                            @foreach($routes as $route)
                                <div ng-model="routeactual" ng-init="routeactual={{ json_encode($route) }}"></div>
                                <sige-turbo-admissions-route-actual conveyors="conveyors" vehicles="vehicles" routeactual="{{json_encode($route)}}" id="routeinformation"></sige-turbo-admissions-route-actual>
                            @endforeach
                        </section>
                    <section class="sige-turbo-pagination col-100">
                       {!! $routes->appends(['search' => json_encode($search)])->render() !!}
                    </section>
                </section>
                <div class="clearfix"></div>
                    <sige-turbo-admissions-usersbyroute usersinroute="{{json_encode($usersbyroute)}}" id="usersinthisroute"></sige-turbo-admissions-usersbyroute>
            </section>
        </section>
    </section>
@stop
@section("script")
    {!! HTML::script('js/' . getCurrentRoute() . '.js') !!}
@stop
@section("vendor")
    {!! HTML::script('js/vendor/vendor.js') !!}
@stop
@section("socket")
    {!! HTML::script('js/vendor/socket.io.js') !!}
@stop
@section("sigeturbo")
    {!! HTML::script('js/SigeTurbo.js') !!}
    {!! HTML::script('js/Stream.js') !!}
@stop