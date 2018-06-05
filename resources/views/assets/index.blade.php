@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Assets"))
@section("title", Lang::get("sige.Assets"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('resources.partials.helper')
    @endif
@stop
@section("dashboard")
    <section ng-controller="AssetController" ng-init="init({{ json_encode($search) }})">
        <section class="grid-100">
            <div class="sige-contained">
                <section class="sige-resources-asset-register">
                    <a class="btn btn-green" href="{{ URL::route('resources.assets.create') }}">
                        <i class="fa fa-plus-circle"></i>
                        <span>{{ Lang::get('sige.New') }}</span>
                    </a>
                </section>
                <section class="sige-assets-lists">
                    <h4>{{ Lang::get('sige.AssetsManagement') }}</h4>
                    {!! Form::open() !!}
                    <section class="search-container">
                        <ul class="display-horizontal col-100">
                            <li class="col-100 gutter-5">
                                <sige-turbo-assets-search search="search" result="result"></sige-turbo-assets-search>
                                <input name="search" ng-model="result" ng-value="result" type="hidden"
                                       value="{{json_encode($search)}}"/>
                            </li>
                            <li id="views" class="col-35 gutter-5">
                                <label for="view">Vista: </label>
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
                                <label for="order">{{ Lang::get('sige.View') }}: </label>
                                <select name="sort" id="order" onchange="this.form.submit()">
                                    <option value="code" {{ ($sort == 'code')? 'selected' : '' }}>{{ Lang::get('sige.Code') }}</option>
                                    <option value="status" {{ ($sort == 'status')? 'selected' : '' }}>Estado</option>
                                </select>
                            </li>
                            <li id="reverse" class="col-20 gutter-5">
                                <label for="order"></label>
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
                    <section class="sige-turbo-pagination-total">
                        <div>{{ Lang::get("sige.Total") . ": " . $assets->total() }}</div>
                    </section>
                    <div class="clearfix"></div>
                    <section class="asset-list">
                        <ul id="asset-list display-horizontal col-100">
                            @foreach($assets as $asset)
                                <li class="col-100">
                                    <ul class="display-horizontal col-100 asset {{ verifiedAssetClass($asset->inventories) }}">
                                        <li class="col-05">
                                            <input type="checkbox"/>
                                        </li>
                                        <li class="col-05 verified">
                                            <span class="{{ verifiedAssetClass($asset->inventories) }}"></span>
                                        </li>
                                        <li class="col-10 photo">
                                            <div>
                                                <img src="{{env('ASSETS_SERVER') . "/img/users/" . $asset->photo}}"
                                                     alt="{{ $asset->responsible }}" title="{{ $asset->responsible }}"/>
                                            </div>
                                        </li>
                                        <li class="col-10 code">
                                            <div>{{ $asset->code }}</div>
                                        </li>
                                        <li class="col-20 name">
                                            <div>{{ $asset->name }}</div>
                                        </li>
                                        <li class="col-15 ubication">
                                            <div>{{ $asset->provider }}</div>
                                        </li>
                                        <li class="col-10 serial">
                                            <div>{{ $asset->serial }}</div>
                                        </li>
                                        <li class="col-15 cost">
                                            <div>{{ money($asset->cost) }}</div>
                                        </li>
                                        <li class="col-05 edit">
                                            <a href="{{ URL::route('resources.assets.edit',['asset' => $asset->idasset, 'search' => json_encode($search), 'sort' => $sort, 'order' => $order, 'page' => $assets->currentPage()]) }}"
                                               id="update">
                                                <i class="fa fa-pencil-square"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                    <section class="sige-turbo-pagination-total">
                        <div>{{ Lang::get("sige.Total") . ": " . $assets->total() }}</div>
                    </section>
                    <div class="clearfix"></div>
                    <section class="sige-turbo-pagination col-40">
                        {!! $assets->appends(['search' => json_encode($search), 'sort' => $sort, 'order' => $order])->render() !!}
                    </section>
                </section>
            </div>
        </section>
    </section>
@stop
@section("vendor")
    {!! HTML::script('js/vendor/vendor.js') !!}
@stop
@section("script")
    {!! HTML::script('js/angular/' . getCurrentRoute() . '.js') !!}
@stop
@section("socket")
    {!! HTML::script('js/vendor/socket.io.js') !!}
@stop
@section("sigeturbo")
    {!! HTML::script('js/SigeTurbo.js') !!}
    {!! HTML::script('js/Stream.js') !!}
@stop