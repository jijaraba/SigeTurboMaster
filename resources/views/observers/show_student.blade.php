@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Observator"))
@section("title", Lang::get("sige.Observator"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("formation.partials.helper")
    @endif
@stop
@section("dashboard")
    <section ng-controller="ObservatorListController">
        <section class="sige-secondary-heading clearfix">
            <h4>Observador</h4>
        </section>
        <section class="grid-100">
            <div class="sige-contained">
                <a href="{{ URL::route('formation.observators.index')}}" class="btn btn-transparent margin-bottom-20"><i
                            class="fa fa-arrow-left"></i>Volver</a>
                <section class="sige-observer-lists">
                    <h4>Observador {{ $student->firstname }}</h4>
                    <div class="search-container">
                        <ul class="display-horizontal col-100">
                            <li class="col-40 gutter-5">
                                <label for="search">Buscar: </label>
                                <input id="search" type="text" ng-model="searchObserver"/>
                            </li>
                            <li class="col-40 gutter-5">
                                <label for="order">Ordenar: </label>
                                <select name="order" id="order" ng-init="order.item='date'" ng-model="order.item">
                                    <option value="teacher">Docente</option>
                                    <option value="type">Tipo</option>
                                    <option value="date">Fecha</option>
                                    <option value="observers">Observación</option>
                                </select>
                            </li>
                            <li id="reverse" class="col-20 gutter-5">
                                <input ng-value="false" ng-model="order.reverse" id="asc" name="type" type="radio">
                                <label for="asc">
                                    <div class="fa fa-sort-asc"></div>
                                </label>
                                <input ng-value="true" ng-model="order.reverse" id="desc" name="type" type="radio">
                                <label for="desc">
                                    <div class="fa fa-sort-desc"></div>
                                </label>
                            </li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <div class="observer-list">
                        <ul id="observer-list" class="display-horizontal col-100">
                            @foreach($observers as $observer)
                                <li class="col-100">
                                    <div class="observer" id="observer" data-observer-id="{{ $observer->idobserver }}">
                                        <ul class="display-horizontal col-100">
                                            <li class="header col-100">
                                                <div class="teacher-info col-100">
                                                    <ul class="display-horizontal col-100">
                                                        <li class="photo col-10">
                                                            <div>
                                                                <img src="{{ env('ASSETS_SERVER') . "/img/users/" . $observer->teacher_photo}}"
                                                                     alt="{{ $observer->teacher }}"
                                                                     title="{{ $observer->teacher }}"/>
                                                            </div>
                                                        </li>
                                                        <li class="teacher col-90">
                                                            <div>{{ $observer->teacher }}</div>
                                                            <div>{{ $observer->teacher_email }}</div>
                                                            <div>{{ $observer->observed_at }}</div>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="body col-100">
                                                <div class="type">{{ $observer->type }}</div>
                                                <p class="observer">{{ $observer->observer }}</p>
                                                @foreach(explode(',',$observer->tags) as $tag)
                                                    <span class="tags">{{ $tag }}</span>
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
        </section>
    </section>
@stop
@section("vendor")
    {!! HTML::script(mix('js/vendor/vendor.js')) !!}
@stop
@section("script")
    {!! HTML::script(mix('js/angular/' . getCurrentRoute() . '.js')) !!}
@stop
@section("socket")
    {!! HTML::script(mix('js/vendor/socket.io.js')) !!}
@stop
@section("sigeturbo")
    {!! HTML::script(mix('js/SigeTurbo.js')) !!}
    {!! HTML::script(mix('js/Stream.js')) !!}
@stop