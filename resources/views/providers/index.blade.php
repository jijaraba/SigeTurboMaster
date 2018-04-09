@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Providers"))
@section("title", Lang::get("sige.Providers"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('resources.partials.helper')
    @endif
@stop
@section("dashboard")
    <section ng-controller="ProviderController">
        <section class="grid-100">
            <section class="sige-contained">
                <section class="sige-resources-purchase-register">
                    <a class="btn btn-green" href="{{ URL::route('resources.providers.create') }}">
                        <i class="fa fa-plus-circle"></i>
                        <span>{{ Lang::get('sige.New') }}</span>
                    </a>
                </section>
                <section class="sige-providers-lists">
                    <h4>{{ Lang::get('sige.Providers') }}</h4>
                    <section class="info">
                        <a class="icon icon-info" href="#"></a>
                        <p>{{ getUser()->firstname }}, recuerde que los proveedores con evaluaciones inferiores a
                            <strong>75%</strong> no son aptos gestionar transacciones comerciales, salvo que los
                            productos o servicios ofrecidos sean exclusivos o de difícil acceso por parte de la
                            institución.</p>
                    </section>
                    {!! Form::open() !!}
                    <section class="search-container">
                        <ul class="display-horizontal col-100">
                            <li class="col-100 gutter-5">
                                <sige-turbo-resource-search ng-model="search"></sige-turbo-resource-search>
                                <input name="search" ng-model="search" ng-value="search" type="hidden" value="{{$search}}"/>
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
                            <li class="col-45 gutter-5">
                                <label class="select-arrow" for="order">
                                    <select name="sort" id="order" onchange="this.form.submit()">
                                        <option value="name" {{ ($sort == 'name')? 'selected' : '' }}>{{ Lang::get('sige.Provider') }}</option>
                                        <option value="date" {{ ($sort == 'date')? 'selected' : '' }}>{{ Lang::get('sige.DateAt') }}</option>
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
                    <section class="provider-list">
                        <ul id="provider-list display-horizontal col-100">
                            @foreach($providers as $provider)
                                <li class="col-100">
                                    <ul class="display-horizontal col-100 provider">
                                        <li class="col-05">
                                            <input type="checkbox"/>
                                        </li>
                                        <li class="col-10 evaluation">
                                            <div title="{{ Lang::get('sige.Evaluation') }}">
                                                <span class="{{ providerStatus($provider->evaluation) }}">{{ percentage($provider->evaluation,'normal') }}</span>
                                            </div>
                                        </li>
                                        <li class="col-30 provider">
                                            <div title="{{ Lang::get('sige.Provider') }}">{{ $provider->name }} <strong>({{ $provider->services }}
                                                    )</strong></div>
                                        </li>
                                        <li class="col-15 contact">
                                            <div title="{{ Lang::get('sige.Contact') }}">{{ $provider->contact }}</div>
                                        </li>
                                        <li class="col-10 evaluation">
                                            <div title="{{ Lang::get('sige.Reevaluation') }}">
                                                <span class="{{ providerStatus(purchaseEvaluations($provider->evaluations)) }}">{{ percentage(purchaseEvaluations($provider->evaluations),'normal',2) }}</span>
                                            </div>
                                        </li>
                                        <li class="col-05 leadtime">
                                            <div title="{{ Lang::get('sige.Leadtime') }}">
                                                {{ days($provider->leadtime) }}
                                            </div>
                                        </li>
                                        <li class="col-05 warranty">
                                            <div title="{{ Lang::get('sige.Warranty') }}">{{ $provider->warranty }}</div>
                                        </li>
                                        <li class="col-10 date">
                                            <div title="{{ Lang::get('sige.DateAt') }}">{{ $provider->date }}</div>
                                        </li>
                                        <li class="col-10 edit">
                                            <a href="{{ URL::route('resources.providers.edit',['purchase' => $provider->idprovider, 'sort' => $sort, 'order' => $order, 'page' => $providers->currentPage()]) }}"
                                               id="update">{{ Lang::get('sige.Edit') }}</a>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                    <section class="sige-turbo-pagination col-100">
                        {!! $providers->appends(['sort' => $sort, 'order' => $order])->render() !!}
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