@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Payments"))
@section("title", Lang::get("sige.Payments"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('financials.partials.helper')
    @endif
@stop
@section("dashboard")
    <section>
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
                                                    <sigeturbo-payments-calendar
                                                            :payments="{{json_encode($family->payments,true)}}"
                                                            :server-date="{{ $serverdate }}"></sigeturbo-payments-calendar>
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
                </section>
            </section>
        </section>
    </section>
@stop
@section("vendor")
    {!! HTML::script(mix('/js/vendor/vendor.js')) !!}
    {!! HTML::script(mix('/js/Utils.js')) !!}
@stop
@section("script")
    {!! HTML::script(mix('js/' . getCurrentRoute() . '/' . getCurrentApp() .  '.js')) !!}
@stop
@section("socket")
    {!! HTML::script(mix('js/vendor/socket.io.js')) !!}
@stop
@section("sigeturbo")
    {!! HTML::script(mix('js/SigeTurbo.js')) !!}
    {!! HTML::script(mix('js/Stream.js')) !!}
@stop