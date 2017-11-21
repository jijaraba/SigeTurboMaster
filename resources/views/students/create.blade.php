@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Admissions"))
@section("title", Lang::get("sige.Admissions"))
@section("content")
    @if(getUser()->welcome_container == 0)
        <section class="grid-100" id="contained">
            <section class="sige-contained-welcome">
                <button class="sige-welcome-close fa fa-times fa-lg" id="sige-welcome-close"></button>
                <h4>{{  ((getUser()->idgender == 1)? Lang::get('sige.Welcome'): Lang::get('sige.Welcome2')). ", " . getUser()->firstname }}</h4>
                <p><span class="sige-turbo-title-app">SigeTurbo</span> es el Sistema de Información y Gestión Educativa
                    diseñado para soportar el flujo de información de todos los procesos de El Nuevo Colegio. En el
                    módulo
                    <span class="sige-turbo-title-app">{!! Lang::get("sige.Admissions") !!}</span> se encuentra diseñado
                    para soportar todos los procesos de apoyo de la institución.</p>
            </section>
        </section>
    @endif
@stop
@section("dashboard")
    <section class="grid-100" ng-controller="StudentsCreateController">
        <div class="sige-contained">
            <a href="{{ URL::route('admissions.students.index')}}" class="btn btn-transparent"><i
                        class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
            <h4>Información Personal</h4>
            @if($errors->any())
                <h4>{{$errors->first()}}</h4>
            @endif
            <section class="sige-student-info">
                {!! Form::open(array('route' => array('admissions.students.store'),'method' => 'POST', 'autocomplete' => 'off')) !!}
                <fieldset>
                    <ul class="display-horizontal col-100">
                        <li class="col-20 photo">
                            <div>
                                <img src="{{env('ASSETS_SERVER')}}/img/users/sigeturbo.png"
                                     alt="{{ Lang::get('sige.UserNew') }}"
                                     title="{{ Lang::get('sige.UserNew') }}">
                            </div>
                        </li>
                        <li class="col-80 basic">
                            <ul class="display-horizontal col-100">
                                <li class="col-20 gutter-5 icon-center">
                                    <i class="fa fa-user"></i>
                                    <input name="iduser" type="text" ng-model="student.user" ng-value="student.user"
                                           placeholder="Código"
                                           required="true" value="{{ old("iduser") }}" title="{{ Lang::get('sige.CodeTitle') }}"/>
                                </li>
                                <li class="col-40 gutter-5">
                                    <input name="lastname" type="text"
                                           placeholder="Apellido"
                                           required="true" value="{{ old("lastname") }}" title="{{ Lang::get('sige.LastnameTitle') }}"/>
                                </li>
                                <li class="col-40 gutter-5">
                                    <input name="firstname" type="text"
                                           placeholder="Nombre" title="{{ Lang::get('sige.FirstnameTitle') }}"
                                           required="true" value="{{ old("firstname") }}"/>
                                </li>
                                <li class="col-20 gutter-5">
                                    <label class="select-arrow" for="idcategory">
                                        {!! Form::select('idcategory', $categories, old("idcategory"), ['title' => Lang::get('sige.CategoryTitle')]) !!}
                                    </label>
                                </li>
                                <li class="col-20 gutter-5">
                                    <label class="select-arrow" for="idstatus">
                                        {!! Form::select('idstatus', $statuses, old("idstatus"), ['title' => Lang::get('sige.StatusTitle')]) !!}
                                    </label>
                                </li>
                                <li class="col-20 gutter-5">
                                    <label class="select-arrow" for="idtown">
                                        {!! Form::select('idtown', $towns, old('idtown'),['title' => Lang::get('sige.TownTitle')]) !!}
                                    </label>
                                </li>
                                <li class="col-40 gutter-5 icon-left">
                                    <i class="fa fa-building" aria-hidden="true"></i>
                                    <input name="address" id="address" type="text" title="{{ Lang::get('sige.AddressTitle') }}"
                                           placeholder="Dirección" value="{{ old('address') }}"
                                           required="true"/>
                                </li>
                                <li class="col-25 gutter-5">
                                    <label class="select-arrow" for="idstratus">
                                        {!! Form::select('idstratus', $stratuses, old('idstratus'), ['title' => Lang::get('sige.StratusTitle')]) !!}
                                    </label>
                                </li>
                                <li class="col-25 gutter-5 icon-left">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <input name="phone" id="phone" type="text"
                                           placeholder="Teléfono"
                                           title="{{ Lang::get('sige.Phone') }}"
                                           required="true" value="{{ old('phone') }}"/>
                                </li>
                                <li class="col-25 gutter-5 celular">
                                    <sige-turbo-student-verify-celular ng-model="student.celular" confirmed="0"></sige-turbo-student-verify-celular>
                                    <input name="celular" id="celular" type="hidden" ng-model="student.celular"
                                           ng-value="student.celular" title="{{ Lang::get('sige.CelularTitle') }}"
                                           ng-init="student.celular='{{ $credential["celular"] }}'"/>
                                </li>
                                <li class="col-25 gutter-5">
                                    <label class="select-arrow" for="idethnicgroup">
                                        {!! Form::select('idethnicgroup', $ethnicgroups, old('idethnicgroup'), ['title' => Lang::get('sige.EthnicgroupTitle')]) !!}
                                    </label>
                                </li>
                                <li class="col-25 gutter-5">
                                    <label class="select-arrow" for="idmaritalstatus">
                                        {!! Form::select('idmaritalstatus', $maritalstatuses, old('idmaritalstatus'), ['title' => Lang::get('sige.MaritalstatusTitle')]) !!}
                                    </label>
                                </li>
                                <li class="col-25 gutter-5">
                                    <label class="select-arrow" for="idgender">
                                        {!! Form::select('idgender', $genders, old('idgender'), ['title' => Lang::get('sige.GenderTitle')]) !!}
                                    </label>
                                </li>
                                <li class="col-25 gutter-5">
                                    <label class="select-arrow" for="idreligion">
                                        {!! Form::select('idreligion', $religions, old('idreligion'), ['title' => Lang::get('sige.ReligionTitle')]) !!}
                                    </label>
                                </li>
                                <li class="col-25 gutter-5  icon-left">
                                    <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                                    <input name="birth" id="birth" type="text" title="{{ Lang::get('sige.BirthTitle') }}"
                                           placeholder="{{ Lang::get('sige.BirthTitle') }}" data-toggle="birth" value="{{ old("birth") }}" required="true"/>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </fieldset>
                <fieldset>
                    <ul class="display-horizontal col-100">
                        <li class="col-40 gutter-5">
                            <input name="email" id="email" type="text" ng-model="student.email"
                                   ng-value="student.email" title="{{ Lang::get('sige.Email') }}"
                                   ng-init="student.email='{{ $credential["email"] }}'"
                                   placeholder="Email Principal" required="true"/>
                        </li>
                        <li class="col-40 gutter-5">
                            <input name="email_personal" id="email_personal" type="text"
                                   ng-model="student.email_personal" title="{{ Lang::get('sige.EmailsecundaryTitle') }}"
                                   ng-value="student.email_personal"
                                   placeholder="Email Secundario"/>
                        </li>
                    </ul>
                </fieldset>
                <fieldset>
                    <ul class="display-horizontal col-100">
                        <li class="button gutter-5">
                            <button id="search" type="submit" class="btn btn-aquamarine">Save</button>
                        </li>
                    </ul>
                </fieldset>
                <input type="hidden" value="{{ $credential["password"] }}" id="password" name="password">
                <input type="hidden" value="{{ $credential["username"] }}" id="username" name="username">
                {!! Form::close() !!}
            </section>
        </div>
    </section>
    <section class="grid-100" ng-if="showFamilyForm">
        <div class="sige-contained">
            <h4>Información Familiar</h4>
            <section class="sige-student-family">
                <ul class="display-horizontal col-50">
                    <li class="col-100">
                        <sige-turbo-family user="student.iduser"></sige-turbo-family>
                    </li>
                </ul>
            </section>
        </div>
    </section>
    <sige-turbo-enrollments ng-if="showEnrollmentForm"></sige-turbo-enrollments>
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