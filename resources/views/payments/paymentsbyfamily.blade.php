@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Parents"))
@section("title", Lang::get("sige.Parents"))
@section("content")
    @if(getUser()->welcome_container == 0)

    @endif
@stop
@section("dashboard")
    <section ng-controller="PaymentsController">
        <section class="grid-100">
            <section class="sige-contained">
                <section class="sige-payments-lists">
                    <h4>{{ Lang::get('sige.Payments') }}</h4>
                    {!! Form::open() !!}
                    <section class="search-container">
                        <ul class="display-horizontal col-100">
                            <li class="col-40 gutter-5">
                                <label for="search">{{ Lang::get('sige.Search') }}: </label>
                                <input id="search" type="text" ng-model="searchTask"/>
                            </li>
                            <li class="col-40 gutter-5">
                                <label for="order">{{ Lang::get("sige.Order") }}: </label>
                                <select name="sort" id="order" onchange="this.form.submit()">
                                    <option value="realdate" {{ ($sort == 'realdate')? 'selected' : '' }}>Fecha</option>
                                    <option value="ispayment" {{ ($sort == 'ispayment')? 'selected' : '' }}>Pendientes
                                    </option>

                                </select>
                            </li>
                            <li id="reverse" class="col-20 gutter-5">
                                <input value="asc" id="asc" name="order" type="radio"
                                       {{ ($order == 'asc')? 'checked' : '' }} onclick="this.form.submit()">
                                <label for="asc">
                                    <div class="fa fa-sort-alpha-up"></div>
                                </label>
                                <input value="desc" id="desc" name="order" type="radio"
                                       {{ ($order == 'desc')? 'checked' : '' }} onclick="this.form.submit()">
                                <label for="desc">
                                    <div class="fa fa-sort-alpha-down"></div>
                                </label>
                            </li>
                        </ul>
                    </section>
                    {!! Form::close() !!}
                    <div class="clearfix"></div>
                    <section class="payment-list">
                        <ul id="payment-list display-horizontal col-100">
                            @foreach($payments as $payment)
                                <li class="col-100">
                                    <ul class="display-horizontal col-100 payment {{ $payment->approved }}">
                                        <li class="col-05 is_payment">
                                            <div class="payment-container">
                                                @if($payment->ispayment == 'Y')
                                                    <img src="{{env('ASSETS_SERVER') . "/img/modules/payment_". $payment->method ."_active.svg" }}"
                                                         title='{{ Lang::get("sige.Payment" . ucfirst($payment->method)) }}'/>
                                                @else
                                                    <img src="{{env('ASSETS_SERVER') . "/img/modules/payment_" . $payment->method . ".svg" }}"
                                                         title='{{ Lang::get("sige.Payment" . ucfirst($payment->method)) }}'/>
                                                @endif
                                            </div>
                                        </li>
                                        <li class="col-10 photo">
                                            <div>
                                                <img src="{{env('ASSETS_SERVER')}}/img/users/{{$payment->photo}}"
                                                     alt="{{ $payment->fullname }}" title="{{ $payment->fullname }}"/>
                                            </div>
                                        </li>
                                        <li class="col-25 concept">
                                            <div title="{{ $payment->concept2 }}">{{ $payment->concept2 }}</div>
                                        </li>
                                        <li class="col-10 date">
                                            <div>{{ $payment->date2 }}</div>
                                        </li>
                                        <li class="col-20 voucher">
                                            <div>
                                                @if($payment->approved != 'N')
                                                    <span class="{{ $payment->approved }}">{{ Lang::get("sige.Transaction$payment->approved") }}
                                                        ({{ $payment->transaccionId }})</span>
                                                @endif
                                            </div>
                                        </li>
                                        <li class="col-10 total">
                                            <div>{{ money(paymentRealValue($payment)) }}</div>
                                        </li>
                                        <li class="col-10 {{ ($payment->ispayment == 'Y')?'detail':'edit' }}">
                                            @if($payment->ispayment == 'Y')
                                                <a href="{{ URL::route('parents.payments.detailpaymentbyparent',['payment' => $payment->idpayment]) }}"
                                                   id="detail">
                                                    <i class="fas fa-arrow-right"></i>
                                                </a>
                                            @else
                                                <a href="{{ URL::route('parents.payments.checkout',['payment' => $payment->idpayment]) }}"
                                                   id="checkout">{{ Lang::get('sige.Payment') }}</a>
                                            @endif
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                    <section class="sige-turbo-pagination col-100">
                        {!! $payments->appends(['sort' => $sort, 'order' => $order])->render() !!}
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
@section("sigeturbo")
    {!! HTML::script(mix('js/SigeTurbo.js')) !!}
@stop