@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Admissions"))
@section("title", Lang::get("sige.Admissions"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('admissions.partials.helper')
    @endif
@stop
@section("dashboard")
    <div class="grid-100" ng-controller="StudentsController" ng-init="init({{ json_encode($search) }})">
        <div class="grid-100">
            <div class="sige-contained">
                <section class="sige-student-register">
                    <a class="btn btn-green" href="{{ URL::route('admissions.students.create') }}">
                        <i class="fa fa-plus-circle"></i>
                        <span>{{ Lang::get('sige.New') }}</span>
                    </a>
                </section>
                <section class="sige-student-lists" style="margin-top: 40px">
                    <h4>{{ Lang::get('sige.Students') }}</h4>
                    {!! Form::open(array('autocomplete' => 'off')) !!}
                    <section class="search-container">
                        <ul class="display-horizontal col-100">
                            <li class="col-100 gutter-5">
                                <sige-turbo-admission-search search="search"
                                                             result="result"></sige-turbo-admission-search>
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
                                <label for="order">Ordenar: </label>
                                <select name="sort" id="order" onchange="this.form.submit()">
                                    <option value="group" {{ ($sort == 'group')? 'selected' : '' }}>Grupo</option>
                                    <option value="status" {{ ($sort == 'status')? 'selected' : '' }}>Estado</option>
                                    <option value="created_at" {{ ($sort == 'created_at')? 'selected' : '' }}>Ingreso
                                    </option>
                                    <option value="register" {{ ($sort == 'register')? 'selected' : '' }}>Matrícula
                                    </option>
                                </select>
                            </li>
                            <li id="reverse" class="col-20 gutter-5">
                                <label for="order"></label>
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
                        <sige-turbo-admission-export year="{{$search['year']}}"></sige-turbo-admission-export>
                    </section>
                    {!! Form::close() !!}
                    <div class="clearfix"></div>
                    <section class="sige-turbo-pagination-total">
                        <div>{{ Lang::get("sige.Total") . ": " . $students->total() }}</div>
                    </section>
                    <div class="clearfix"></div>
                    <section class="student-list">
                        @if($view == 'list')
                            @include('students.partials.list')
                        @elseif($view == 'photo')
                            @include('students.partials.photo')
                        @endif
                    </section>
                    <section class="sige-turbo-pagination-total">
                        <div>{{ Lang::get("sige.Total") . ": " . $students->total() }}</div>
                    </section>
                    <div class="clearfix"></div>
                    <section class="sige-turbo-pagination col-100">
                        {!! $students->appends(['year' => $year, 'search' => json_encode($search), 'view' => $view, 'sort' => $sort, 'order' => $order])->render() !!}
                    </section>
                    <div class="clearfix"></div>
                </section>
            </div>
        </div>
    </div>
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