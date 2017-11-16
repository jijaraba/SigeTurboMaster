@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Payments"))
@section("title", Lang::get("sige.Payments"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('financials.partials.helper')
    @endif
@stop
@section("dashboard")
    <section ng-controller="PaymentsController" ng-init="init({{ json_encode($search) }})">
        <section class="grid-100">
            <section class="sige-contained">
                <section class="sige-financials-payment-register">
                    <a class="btn btn-green" href="{{ URL::route('financials.payments.create') }}">
                        <i class="fa fa-plus-circle"></i>
                        <span>{{ Lang::get('sige.New') }}</span>
                    </a>
                </section>
                <section class="sige-payments-lists">
                    <h4>{{ Lang::get('sige.Payments') }}</h4>
                    {!! Form::open(['autocomplete' => 'off']) !!}
                    <section class="search-container">
                        <ul class="display-horizontal col-100">
                            <li class="col-100 gutter-5">
                                <sige-turbo-payment-search search="search" result="result"></sige-turbo-payment-search>
                                <input name="search" ng-model="result" ng-value="result" type="hidden"
                                       value="{{json_encode($search)}}"/>
                            </li>
                            <li id="views" class="col-30 gutter-5">
                                <span>Vista: </span>
                                <input value="photo" id="images" type="radio" name="view"
                                       {{ ($view == 'photo')? 'checked' : '' }} onclick="this.form.submit()">
                                <label for="images">
                                    <div class="fa fa-picture-o"></div>
                                </label>
                                <input value="list" id="list" type="radio" name="view"
                                       {{ ($view == 'list')? 'checked' : '' }} onclick="this.form.submit()">
                                <label for="list">
                                    <div class="fa fa-list"></div>
                                </label>
                            </li>
                            <li class="col-40 gutter-5">
                                <label class="select-arrow" for="order">
                                    <select name="sort" id="order" onchange="this.form.submit()">
                                        <option value="code" {{ ($sort == 'code')? 'selected' : '' }}>Código</option>
                                        <option value="provider" {{ ($sort == 'provider')? 'selected' : '' }}>{{ Lang::get('sige.Provider') }}</option>
                                        <option value="status" {{ ($sort == 'status')? 'selected' : '' }}>{{ Lang::get('sige.Approved') }}</option>
                                        <option value="created_at" {{ ($sort == 'created_at')? 'selected' : '' }}>{{ Lang::get('sige.CreatedAt') }}</option>
                                    </select>
                                </label>
                            </li>
                            <li id="reverse" class="col-20 gutter-5">
                                <input value="asc" id="asc" name="order" type="radio"
                                       {{ ($order == 'asc')? 'checked' : '' }} onclick="this.form.submit()">
                                <label for="asc">
                                    <div class="fa fa-sort-alpha-asc"></div>
                                </label>
                                <input value="desc" id="desc" name="order" type="radio"
                                       {{ ($order == 'desc')? 'checked' : '' }} onclick="this.form.submit()">
                                <label for="desc">
                                    <div class="fa fa-sort-alpha-desc"></div>
                                </label>
                            </li>
                        </ul>
                    </section>
                    {!! Form::close() !!}
                    <div class="clearfix"></div>
                    <section class="payment-list">
                        <ul id="payment-list display-horizontal col-100">
                            @foreach($families as $family)
                                @if($search["pending"] == 1)
                                    <li class="col-100">
                                        <ul class="display-horizontal col-100 payment">
                                            <li class="col-05 select">
                                                <input type="checkbox"/>
                                            </li>
                                            <li class="col-10 photo">
                                                <div>
                                                    <a href="{{ URL::route('admissions.students.edit',['student' => $family->iduser]) }}">
                                                        <img src="{{env('ASSETS_SERVER')}}/img/users/{{$family->photo}}"
                                                             alt="{{ $family->lastname }}"
                                                             title="{{ $family->lastname ." ". $family->firstname  }} ({{ $family->iduser }})"/>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="col-15 family">
                                                <div>{{ $family->family }}</div>
                                            </li>
                                            <li class="payments col-40">
                                                <div>
                                                    <sige-turbo-payments-calendar
                                                            payments="{{json_encode($family->payments,true)}}"
                                                            serverdate="{{ $serverdate }}"></sige-turbo-payments-calendar>
                                                </div>
                                            </li>
                                            <li class="col-20 pending">
                                                <div>{{ money(paymentPending($family->payments)) }}</div>
                                            </li>
                                            <li class="col-10 detail">
                                                <a href="{{ URL::route('financials.payments.edit',['payment' => $family->idpayment,'search' => json_encode($search), 'sort' => $sort, 'order' => $order, 'page' => $families->currentPage()]) }}"
                                                   id="update">{{ Lang::get('sige.Detail') }}</a>
                                            </li>
                                        </ul>
                                    </li>
                                @elseif(count($family->payments) == $search["pending"])
                                    <li class="col-100">
                                        <ul class="display-horizontal col-100 payment">
                                            <li class="col-05 select">
                                                <input type="checkbox"/>
                                            </li>
                                            <li class="col-10 photo">
                                                <div>
                                                    <a href="{{ URL::route('admissions.students.edit',['student' => $family->iduser]) }}">
                                                        <img src="{{env('ASSETS_SERVER')}}/img/users/{{$family->photo}}"
                                                             alt="{{ $family->lastname }}"
                                                             title="{{ $family->lastname ." ". $family->firstname  }} ({{ $family->iduser }})"/>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="col-15 family">
                                                <div>{{ $family->family }}</div>
                                            </li>
                                            <li class="payments col-40">
                                                <div>
                                                    <sige-turbo-payments-calendar
                                                            payments="{{json_encode($family->payments,true)}}"></sige-turbo-payments-calendar>
                                                </div>
                                            </li>
                                            <li class="col-20 pending">
                                                <div>{{ money(paymentPending($family->payments)) }}</div>
                                            </li>
                                            <li class="col-10 detail">
                                                <a href="{{ URL::route('financials.payments.edit',['payment' => $family->idpayment,'search' => json_encode($search), 'sort' => $sort, 'order' => $order, 'page' => $families->currentPage()]) }}"
                                                   id="update">{{ Lang::get('sige.Detail') }}</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </section>
                    <section class="sige-turbo-pagination col-100">
                        {!! $families->appends(['search' => json_encode($search), 'view' => $view, 'sort' => $sort, 'order' => $order])->render() !!}
                    </section>
                </section>
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