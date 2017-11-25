@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Parents"))
@section("title", Lang::get("sige.Parents"))
@section("content")
    @if(getUser()->welcome_container == 0)

    @endif
@stop
@section("dashboard")
    <section ng-controller="ReportsController">
        <section class="grid-100">
            <section class="sige-contained">
                <section class="sige-payments-lists">
                    <h4>{{ Lang::get('sige.Reports') }}</h4>
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
                            @foreach($users as $user)
                                <li class="col-100">
                                    <ul class="display-horizontal col-100 payment">
                                        <li class="col-05 is_payment">
                                            <div class="payment-container">
                                                <img src="{{env('ASSETS_SERVER') . "/img/modules/payment_normal.svg" }}"
                                                     title=''/>
                                            </div>
                                        </li>
                                        <li class="col-10 photo">
                                            <div>
                                                <img src="{{env('ASSETS_SERVER')}}/img/users/{{$user->photo}}"
                                                     alt="{{ $user->fullname }}" title="{{ $user->fullname }}"/>
                                            </div>
                                        </li>
                                        <li class="col-05 date">
                                            <div>2017</div>
                                        </li>
                                        <li class="col-15 date">
                                            <div>{{ mb_strtoupper(Lang::get('sige.FirstPeriod')) }}</div>
                                        </li>
                                        <li class="col-45 concept">
                                            <div title="">INFORME PARCIAL PRIMER PERIODO ({{ $user->iduser }}
                                                - {{ mb_strtoupper($user->fullname) }})
                                            </div>
                                        </li>
                                        <li class="col-20 generate">
                                            <sige-turbo-report-generate
                                                    student="{{ $user->iduser }}"
                                                    type="partialreport"></sige-turbo-report-generate>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                    <section class="payment-list">
                        <ul id="payment-list display-horizontal col-100">
                            @foreach($users as $user)
                                <li class="col-100">
                                    <ul class="display-horizontal col-100 payment">
                                        <li class="col-05 is_payment">
                                            <div class="payment-container">
                                                <img src="{{env('ASSETS_SERVER') . "/img/modules/payment_normal.svg" }}"
                                                     title=''/>
                                            </div>
                                        </li>
                                        <li class="col-10 photo">
                                            <div>
                                                <img src="{{env('ASSETS_SERVER')}}/img/users/{{$user->photo}}"
                                                     alt="{{ $user->fullname }}" title="{{ $user->fullname }}"/>
                                            </div>
                                        </li>
                                        <li class="col-05 date">
                                            <div>2017</div>
                                        </li>
                                        <li class="col-15 date">
                                            <div>{{ mb_strtoupper(Lang::get('sige.FirstPeriod')) }}</div>
                                        </li>
                                        <li class="col-45 concept">
                                            <div title="">INFORME FINAL PRIMER PERIODO ({{ $user->iduser }}
                                                - {{ mb_strtoupper($user->fullname) }})
                                            </div>
                                        </li>
                                        <li class="col-20 generate">
                                            @if(\SigeTurbo\Repositories\Enrollment\EnrollmentRepository::getEnrollmentLatest($user->iduser)->group < 11)
                                                <sige-turbo-report-generate
                                                        student="{{ $user->iduser }}"
                                                        type="descriptivereport"></sige-turbo-report-generate>
                                            @else
                                                <sige-turbo-report-generate
                                                        student="{{ $user->iduser }}"
                                                        type="finalreport"></sige-turbo-report-generate>
                                            @endif
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                    <section class="sige-turbo-pagination col-100">
                        {!! $users->appends(['sort' => $sort, 'order' => $order])->render() !!}
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