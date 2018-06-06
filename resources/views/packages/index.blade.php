@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Packages"))
@section("title", Lang::get("sige.Packages"))
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
                    <a class="btn btn-green" href="{{ URL::route('financials.packages.create') }}">
                        <i class="fa fa-plus-circle"></i>
                        <span>{{ Lang::get('sige.New') }}</span>
                    </a>
                </section>
                <section class="sige-payments-lists">
                    <h4>{{ Lang::get('sige.Packages') }}</h4>
                    {!! Form::open(['autocomplete' => 'off']) !!}
                    <section class="search-container">
                        <ul class="display-horizontal col-100">
                            <li class="col-100 gutter-5">
                                <sigeturbo-packages-search search="search" result="result"></sigeturbo-packages-search>
                                <input name="search" ng-model="result" ng-value="result" type="hidden"
                                       value="{{json_encode($search)}}"/>
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
                                        <option value="status" {{ ($sort == 'status')? 'selected' : '' }}>{{ Lang::get('sige.Approved') }}</option>
                                        <option value="created_at" {{ ($sort == 'created_at')? 'selected' : '' }}>{{ Lang::get('sige.CreatedAt') }}</option>
                                    </select>
                                </label>
                            </li>
                            <li id="reverse" class="col-20 gutter-5">
                                <input value="asc" id="asc" name="order" type="radio"
                                       {{ ($order == 'asc')? 'checked' : '' }} onclick="this.form.submit()">
                                <label for="asc">
                                    <i class="fas fa-sort-alpha-up"></i>
                                </label>
                                <input value="desc" id="desc" name="order" type="radio"
                                       {{ ($order == 'desc')? 'checked' : '' }} onclick="this.form.submit()">
                                <label for="desc">
                                    <i class="fas fa-sort-alpha-down"></i>
                                </label>
                            </li>
                        </ul>
                    </section>
                    {!! Form::close() !!}
                    <div class="clearfix"></div>
                    <section class="payment-list">
                        <ul id="payment-list display-horizontal col-100">
                            @foreach($packages as $package)
                            <li></li>
                            @endforeach
                        </ul>
                    </section>
                    <section class="sige-turbo-pagination col-100">
                        {!! $packages->appends(['search' => json_encode($search), 'view' => $view, 'sort' => $sort, 'order' => $order])->render() !!}
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