@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Purchases"))
@section("title", Lang::get("sige.Purchases"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('resources.partials.helper')
    @endif
@stop
@section("dashboard")
    <section ng-controller="PurchaseController">
        <section class="grid-100">
            <section class="sige-contained">
                <section class="sige-resources-purchase-register">
                    <a class="btn btn-green" href="{{ URL::route('resources.purchases.create') }}">
                        <i class="fa fa-plus-circle"></i>
                        <span>{{ Lang::get('sige.New') }}</span>
                    </a>
                </section>
                <section class="sige-purchases-lists">
                    <h4>{{ Lang::get('sige.Purchases') }}</h4>
                    {!! Form::open() !!}
                    <section class="search-container">
                        <ul class="display-horizontal col-100">
                            <li class="col-100 gutter-5">
                                <sige-turbo-resource-search ng-model="search"></sige-turbo-resource-search>
                                <input name="search" ng-model="search" ng-value="search" type="hidden"
                                       value="{{$search}}"/>
                            </li>
                            <li id="views" class="col-30 gutter-5">
                                <span>Vista: </span>
                                <input value="photo" id="images" type="radio" name="view"
                                       {{ ($view == 'photo')? 'checked' : '' }} onclick="this.form.submit()">
                                <label for="images">
                                    <div class="far fa-image"></div>
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
                    <section class="purchase-list">
                        <ul id="purchase-list display-horizontal col-100">
                            @foreach($purchases as $purchase)
                                <li class="col-100">
                                    <ul class="display-horizontal col-100 purchase">
                                        <li class="col-05">
                                            <input type="checkbox"/>
                                        </li>
                                        <li class="col-10 photo">
                                            <div>
                                                <img src="{{env('ASSETS_SERVER')}}/img/users/{{$purchase->photo}}"
                                                     alt="{{ $purchase->employee }}"
                                                     title="{{ $purchase->employee  }}"/>
                                            </div>
                                        </li>
                                        <li class="col-05">
                                            <span class="{{ status($purchase->idstatuspurchase) }}"
                                                  title="{{ $purchase->status }}">{{ $purchase->prefix }}</span>
                                        </li>
                                        <li class="col-10">{{ $purchase->code }}</li>
                                        <li class="col-20 provider">
                                            <div>{{ $purchase->provider }}</div>
                                        </li>
                                        <li class="col-20 budget">
                                            <div>{{ $purchase->budget }}</div>
                                        </li>
                                        <li class="col-05 leadtime">{{ $purchase->leadtime }}</li>
                                        <li class="col-15 total">{{ money(total($purchase->details,$purchase->discount)) }}</li>
                                        <li class="col-10 edit">
                                            <a href="{{ URL::route('resources.purchases.edit',['purchase' => $purchase->idpurchase, 'sort' => $sort, 'order' => $order, 'page' => $purchases->currentPage()]) }}"
                                               id="update">Edit</a>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                    <section class="sige-turbo-pagination col-100">
                        {!! $purchases->appends(['sort' => $sort, 'order' => $order])->render() !!}
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