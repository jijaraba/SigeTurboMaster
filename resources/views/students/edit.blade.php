@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Admissions"))
@section("title", Lang::get("sige.Admissions"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include("students.partials.helper")
    @endif
@stop
@section("dashboard")
    <section ng-controller="StudentsUpdateController" ng-init="init({{ $student->iduser }},{{ $item }})">
        <section class="grid-100">
            <div class="sige-contained">
                <a href="{{ URL::route('admissions.students.index',['year' => $year,'search' => $search, 'view' => $view, 'sort' => $sort, 'order' => $order, 'page' => $page])}}"
                   class="btn btn-transparent margin-bottom-20"><i class="fa fa-arrow-left"></i>{{ Lang::get('sige.Back') }}</a>
                <section class="sige-student-info">
                    <h4>{{ Lang::get('sige.StudentInformationData') }}</h4>
                    @if (count($errors) > 0)
                        <section>
                            <ul class="errors">
                                @foreach ($errors->all() as $error)
                                    <li class="">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </section>
                    @endif
                    {!! Form::open(array('route' => array('admissions.students.update', $student->iduser),'method' => 'PUT')) !!}
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-20 photo">
                                <div>
                                    <img src="{{env('ASSETS_SERVER')}}/img/users/{{$student->photo}}"
                                         alt="{{ $student->lastname }}"
                                         title="{{ $student->lastname ." ". $student->firstname }}">
                                </div>
                            </li>
                            <li class="col-80 basic">
                                <ul class="display-horizontal col-100">
                                    <li class="col-20 gutter-5 icon-center">
                                        <i class="fa fa-user"></i>
                                        <input name="iduser" type="text" ng-model="student.user" ng-value="student.user"
                                               ng-init="student.user = '{{$student->iduser}}'" placeholder="Código"
                                               required="true" title="{{ Lang::get('sige.CodeTitle') }}"/>
                                    </li>
                                    <li class="col-40 gutter-5">
                                        <input name="lastname" type="text" value="{{ $student->lastname }}"
                                               placeholder="Apellido" title="{{ Lang::get('sige.LastnameTitle') }}"
                                               required="true"/>
                                    </li>
                                    <li class="col-40 gutter-5">
                                        <input name="firstname" type="text" value="{{ $student->firstname }}"
                                               placeholder="Nombre" title="{{ Lang::get('sige.FirstnameTitle') }}"
                                               required="true"/>
                                    </li>
                                    <li class="col-20 gutter-5">
                                        <label class="select-arrow" for="idcategory">
                                            {!! Form::select('idcategory', $categories, $student->idcategory, ['title' => Lang::get('sige.CategoryTitle')]) !!}
                                        </label>
                                    </li>
                                    <li class="col-20 gutter-5">
                                        <label class="select-arrow" for="idstatus">
                                            {!! Form::select('idstatus', $statuses, $student->idstatus, ['title' => Lang::get('sige.StatusTitle')]) !!}
                                        </label>
                                    </li>
                                    <li class="col-20 gutter-5">
                                        <label class="select-arrow" for="idtown">
                                            {!! Form::select('idtown', $towns, $student->idtwon,['title' => Lang::get('sige.TownTitle')]) !!}
                                        </label>
                                    </li>
                                    <li class="col-40 gutter-5 icon-left">
                                        <i class="fa fa-building" aria-hidden="true"></i>
                                        <input name="address" id="address" type="text" value="{{ $student->address }}"
                                               title="{{ Lang::get('sige.AddressTitle') }}"
                                               placeholder="Dirección"
                                               required="true"/>
                                    </li>
                                    <li class="col-25 gutter-5">
                                        <label class="select-arrow" for="idstratus">
                                            {!! Form::select('idstratus', $stratuses, $student->idstratus, ['title' => Lang::get('sige.StratusTitle')]) !!}
                                        </label>
                                    </li>
                                    <li class="col-25 gutter-5 icon-left">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <input name="phone" id="phone" type="text" value="{{ $student->phone }}"
                                               placeholder="Teléfono"
                                               title="{{ Lang::get('sige.Phone') }}"
                                               required="true"/>
                                    </li>
                                    <li class="col-25 gutter-5 celular">
                                        <sige-turbo-student-verify-celular ng-model="student.celular"
                                                                           confirmed="{{ $student->celular_confirmed }}"
                                                                           user="{{ $student->iduser }}"></sige-turbo-student-verify-celular>
                                        <input name="celular" id="celular" type="hidden" ng-model="student.celular"
                                               ng-value="student.celular" title="{{ Lang::get('sige.CelularTitle') }}"
                                               ng-init="student.celular = '{{$student->celular}}'"/>
                                    </li>
                                    <li class="col-25 gutter-5">
                                        <label class="select-arrow" for="idethnicgroup">
                                            {!! Form::select('idethnicgroup', $ethnicgroups, $student->idethnicgroup, ['title' => Lang::get('sige.EthnicgroupTitle')]) !!}
                                        </label>
                                    </li>
                                    <li class="col-25 gutter-5">
                                        <label class="select-arrow" for="idmaritalstatus">
                                            {!! Form::select('idmaritalstatus', $maritalstatuses, $student->idmaritalstatus, ['title' => Lang::get('sige.MaritalstatusTitle')]) !!}
                                        </label>
                                    </li>
                                    <li class="col-25 gutter-5">
                                        <label class="select-arrow" for="idgender">
                                            {!! Form::select('idgender', $genders, $student->idgender, ['title' => Lang::get('sige.GenderTitle')]) !!}
                                        </label>
                                    </li>
                                    <li class="col-25 gutter-5">
                                        <label class="select-arrow" for="idreligion">
                                            {!! Form::select('idreligion', $religions,  $student->idreligion, ['title' => Lang::get('sige.ReligionTitle')]) !!}
                                        </label>
                                    </li>
                                    <li class="col-25 gutter-5 icon-left">
                                        <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                                        <input name="birth" id="birth" type="text" ng-model="student.birth"
                                               ng-value="student.birth" title="{{ Lang::get('sige.BirthTitle') }}"
                                               ng-init="student.birth = '{{$student->birth}}'"
                                               placeholder="{{ Lang::get('sige.BirthTitle') }}" data-toggle="birth" required="true"/>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-40 gutter-5 email">
                                <sige-turbo-student-verify-email ng-model="student.email"
                                                                 confirmed="{{ $student->email_confirmed }}"
                                                                 user="{{ $student->iduser }}"></sige-turbo-student-verify-email>
                                <input name="email" id="email" type="hidden" ng-model="student.email"
                                       ng-value="student.email" title="{{ Lang::get('sige.Email') }}"
                                       ng-init="student.email = '{{$student->email}}'"/>
                            </li>
                            <li class="col-40 gutter-5">
                                <input name="email_personal" id="email_personal" type="text"
                                       ng-model="student.email_personal"
                                       ng-value="student.email_personal"
                                       title="{{ Lang::get('sige.EmailsecundaryTitle') }}"
                                       ng-init="student.email_personal = '{{$student->email_personal}}'"
                                       placeholder="Email Secundario"/>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="button gutter-5">
                                <button id="search" type="submit"
                                        class="btn btn-aquamarine">{{ Lang::get('sige.Save') }}</button>
                            </li>
                        </ul>
                    </fieldset>
                    {!! Form::close() !!}
                </section>
                <section class="sige-student-items">
                    <ul class="display-horizontal col-95">
                        @if($student->idcategory == \SigeTurbo\Category::STUDENT || $student->idcategory == \SigeTurbo\Category::ALUMNUS)
                            <li style="{{ widthCalc(7) }}" ng-click="changeItem(1)">
                                <img src="https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com/img/modules/student_family_final.svg"
                                     alt="{{ Lang::get('sige.FamilyInfo') }}"
                                     title="{{ Lang::get('sige.FamilyInfo') }}">
                            </li>
                            <li style="{{ widthCalc(7) }}" ng-click="changeItem(2)">
                                <img src="https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com/img/modules/student_identification_final.svg"
                                     alt="{{ Lang::get('sige.StudentIdentificationData') }}"
                                     title="{{ Lang::get('sige.StudentIdentificationData') }}">
                            </li>
                            <li style="{{ widthCalc(7) }}" ng-click="changeItem(3)">
                                <img src="https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com/img/modules/student_health_final.svg"
                                     alt="{{ Lang::get('sige.StudentHealthData') }}"
                                     title="{{ Lang::get('sige.StudentHealthData') }}">
                            </li>
                            <li style="{{ widthCalc(7) }}" ng-click="changeItem(4)">
                                <img src="https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com/img/modules/student_school_final.svg"
                                     alt="{{ Lang::get('sige.StudentSchoolInformation') }}"
                                     title="{{ Lang::get('sige.StudentSchoolInformation') }}">
                            </li>
                            <li style="{{ widthCalc(7) }}" ng-click="changeItem(5)">
                                <img src="https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com/img/modules/student_origen_final.svg"
                                     alt="{{ Lang::get('sige.StudentOriginData') }}"
                                     title="{{ Lang::get('sige.StudentOriginData') }}">
                            </li>
                            <li style="{{ widthCalc(7) }}" ng-click="changeItem(6)">
                                <img src="https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com/img/modules/student_alumnus_final.svg"
                                     alt="{{ Lang::get('sige.StudentAlumnusInformation') }}"
                                     title="{{ Lang::get('sige.StudentAlumnusInformation') }}">
                            </li>
                            <li style="{{ widthCalc(7) }}" ng-click="changeItem(7)">
                                <img src="https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com/img/modules/student_family_final.svg"
                                     alt="{{ Lang::get('sige.StudentResponsibleparent') }}"
                                     title="{{ Lang::get('sige.StudentResponsibleparent') }}">
                            </li>
                        @else
                            <li style="{{ widthCalc(2) }}" ng-click="changeItem(1)">
                                <img src="https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com/img/modules/student_family_final.svg"
                                     alt="{{ Lang::get('sige.FamilyInfo') }}"
                                     title="{{ Lang::get('sige.FamilyInfo') }}">
                            </li>
                            <li style="{{ widthCalc(2) }}" ng-click="changeItem(2)">
                                <img src="https://294347513a062ec6e0b6-8f8f94440e741fa4111c4d620d6f574f.ssl.cf5.rackcdn.com/img/modules/student_identification_final.svg"
                                     alt="{{ Lang::get('sige.StudentIdentificationData') }}"
                                     title="{{ Lang::get('sige.StudentIdentificationData') }}">
                            </li>
                        @endif
                    </ul>
                </section>
                <section class="sige-student-identification" ng-if="items.identificationdata">
                    <h4>{{ Lang::get('sige.StudentIdentificationData') }}</h4>
                    @if($student->identification)

                        @include('students.partials.identifications.edit')
                    @else
                        @include('students.partials.identifications.create')
                    @endif
                </section>
                <section class="sige-student-health" ng-if="items.healthdata">
                    <h4>{{ Lang::get('sige.StudentHealthData') }}</h4>
                    @if($student->healthinformation)
                        @include('students.partials.healthinformation.edit')
                    @else
                        @include('students.partials.healthinformation.create')
                    @endif
                </section>
                <section class="sige-student-origin" ng-if="items.origindata">
                    <h4>{{ Lang::get('sige.StudentOrigenInformation') }}</h4>
                    @if($student->origeninformation)
                        @include('students.partials.origeninformation.edit')
                    @else
                        @include('students.partials.origeninformation.create')
                    @endif
                </section>
                <section class="sige-student-school" ng-if="items.schooldata">
                    <h4>{{ Lang::get('sige.StudentSchoolInformation') }}</h4>
                    @if($student->schoolinformation)
                        @include('students.partials.schoolinformation.edit')
                    @else
                        @include('students.partials.schoolinformation.create')
                    @endif
                </section>
                <section class="sige-student-alumnus" ng-if="items.alumnusdata">
                    <h4>{{ Lang::get('sige.StudentAlumnusData') }}</h4>
                </section>
                <section class="sige-student-responsibleparent" ng-if="items.responsibleparentdata">
                    <h4>{{ Lang::get('sige.StudentResponsibleparent') }}</h4>
                    @if($student->responsibleparent)
                        @include('students.partials.responsibleparent.edit')
                    @else
                        @include('students.partials.responsibleparent.create')
                    @endif
                </section>
                <section class="sige-student-family" ng-if="items.family">
                    <h4>{{ Lang::get('sige.FamilyInfo') }}</h4>
                    <ul class="display-horizontal col-100">
                        <li class="col-100">
                            <section class="sige-members">
                                @if(count($student->userfamily)> 0)
                                    @include('students.partials.members.list')
                                @else
                                    <ul class="display-horizontal col-100">
                                        <li class="col-50">
                                            @include('students.partials.members.new')
                                        </li>
                                        <li class="col-50">
                                            @include('students.partials.members.assign')
                                        </li>
                                    </ul>
                                @endif
                            </section>
                        </li>
                    </ul>
                </section>
            </div>
        </section>
        @if($student->idcategory == 13)
            <section class="grid-100">
                <div class="sige-contained">
                    <h4>{{ Lang::get('sige.Admissions') }}</h4>
                    <section class="sige-student-enrollments">
                        <section>
                            <div>
                                <sige-turbo-enrollment-new user="{{ $student->iduser }}"
                                                           year="{{ $academic->idyear }}"></sige-turbo-enrollment-new>
                            </div>
                        </section>
                        <section class="enrollments-container {{ (count($student->enrollments) > 4)?"big":"small" }}">
                            @foreach($student->enrollments as $enrollment)
                                <div>
                                    <sige-turbo-enrollment
                                            enrollment="{{ json_encode($enrollment,true) }}"></sige-turbo-enrollment>
                                </div>
                            @endforeach
                        </section>
                    </section>
                </div>
            </section>
        @endif
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