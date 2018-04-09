@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Visitors"))
@section("title", Lang::get("sige.Visitors"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('resources.partials.helper')
    @endif
@stop
@section("dashboard")
    <section ng-controller="VisitorController">
        <section class="grid-100">
            <div class="sige-contained">
                <section class="sige-resources-visitor-register">
                    <a class="btn btn-green" href="{{ URL::route('resources.visitors.create') }}">
                        <i class="fa fa-plus-circle"></i>
                        <span>{{ Lang::get('sige.New') }}</span>
                    </a>
                </section>
                <section class="sige-visitors-lists">
                    <h4>Control de Ingreso</h4>
                    <div class="search-container">
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
                                    <select name="order" id="order" ng-init="order.item='code'" ng-model="order.item">
                                        <option value="code">Código</option>
                                        <option value="status">Estado</option>
                                        <option value="idprovider">Proveedor</option>
                                        <option value="iduser">Empleado</option>
                                    </select>
                                </label>
                            </li>
                            <li id="reverse" class="col-20 gutter-5">
                                <input ng-value="false" ng-model="order.reverse" id="asc" name="type" type="radio">
                                <label for="asc">
                                    <div class="fa fa-sort-alpha-asc"></div>
                                </label>
                                <input ng-value="true" ng-model="order.reverse" id="desc" name="type" type="radio">
                                <label for="desc">
                                    <div class="fa fa-sort-alpha-desc"></div>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <section class="visitor-list">
                        <ul id="visitor-list display-horizontal col-100">
                            <?php
                            $dateOld = '';
                            $dateNew = '';
                            ?>
                            <?php $first = true; ?>
                            @foreach($visitors as $visitor)
                                <?php
                                $dateOld = $dateNew;
                                $dateNew = $visitor->date;
                                ?>
                                <li class="col-100">
                                    @if(!$first && $dateOld != $dateNew )
                                        <h4>{{  \Carbon\Carbon::createFromTimeStamp(strtotime($visitor->date))->formatLocalized('%A, %d %B %Y') }}</h4>
                                    @elseif($first)
                                        <h4>{{  \Carbon\Carbon::createFromTimeStamp(strtotime($visitor->date))->formatLocalized('%A, %d %B %Y') }}</h4>
                                        <?php $first = false; ?>
                                    @endif
                                    <ul class="display-horizontal col-100 visitor">
                                        <li class="col-05">
                                            <input type="checkbox"/>
                                        </li>
                                        <li class="col-05 type">
                                        <span class="{{ status($visitor->idvisitortype) }}"
                                              title="{{ $visitor->type }}">{{ substr($visitor->type,0,1) }}</span>
                                        </li>
                                        <li class="col-10">{{ $visitor->date }}</li>
                                        <li class="col-10 photo">
                                            <div>
                                                <img src="{{env('ASSETS_SERVER')}}/img/users/{{$visitor->photo}}"
                                                     alt="{{ $visitor->lastname }}"
                                                     title="{{ $visitor->lastname ." ". $visitor->firstname }}"/>
                                            </div>
                                        </li>
                                        <li class="col-20 name">
                                            <div>{{ $visitor->name }}</div>
                                        </li>
                                        <li class="col-20 employee">
                                            <div>{{ $visitor->destination }}</div>
                                        </li>
                                        <li class="col-10 checkin">
                                            <sige-turbo-visitor-checkin vhour="{{ $visitor->time }}"
                                                                        visitor="{{$visitor->idvisitor}}"
                                                                        checkin="{{$visitor->checkin}}"
                                                                        checkout="{{$visitor->checkout}}"></sige-turbo-visitor-checkin>
                                        </li>
                                        <li class="col-10 edit">
                                            <a href="{{ URL::route('resources.visitors.edit',['visitor' => $visitor->idvisitor]) }}"
                                               id="update">{{ Lang::get('sige.Edit') }}</a>
                                        </li>
                                        <li class="col-10 delete">
                                            {!! Form::open(['route' => ['resources.visitors.destroy', $visitor->idvisitor], 'method' => 'delete']) !!}
                                            <button type="submit">{{ Lang::get('sige.Delete') }}</button>
                                            {!! Form::close() !!}
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                    <section class="sige-turbo-pagination col-40">
                        {!! $visitors->appends(['sort' => 'code'])->render() !!}
                    </section>
                </section>
            </div>
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