@extends("layouts.default")
@section("ModuleName", Lang::get("sige.Parents"))
@section("title", Lang::get("sige.Parents"))
@section("content")
    @if(getUser()->welcome_container == 0)
        @include('parents.partials.helper')
    @endif
@stop
@section("dashboard")
    <section ng-controller="UpdateinfoController">
        <section class="grid-100">
            <section class="sige-contained">
                <h4>Integrantes de la Familia</h4>
                <section class="sige-student-lists">
                    <section class="student-list">
                        <ul id="student-list">
                            @foreach($users as $user)
                                <li>
                                    <div class="student" id="student" data-student-id="{{ $user["iduser"] }}">
                                        <div class="body" id="student_{{ $user["iduser"] }}"
                                             ng-click="select({{ json_encode($user) }})">
                                            <div class="image normal-background">
                                                <img ng-src="{{  getenv("ASSETS_SERVER") }}/img/users/{{ $user["photo"] }}"
                                                     alt="{{ $user["lastname"] }}"
                                                     title="{{ $user["lastname"] ." ". $user["firstname"] }}"/>
                                            </div>
                                        </div>
                                        <div class="lead">
                                            {{ $user["firstname"] }}
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                </section>
            </section>
        </section>
        <div class="grid-100" ng-show="showMember">
            <div class="sige-contained">
                <h4>@{{ title }}</h4>
                <section class="sige-container-update">
                    <form id="updateForm" ng-submit="save()">
                        <fieldset class="step">
                            <legend>Información Personal</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-20 gutter-5" id="user_container">
                                    <input type="text" name="@{{ virtual.iduser }}" id="iduser"
                                           ng-model="virtual.iduser"
                                           required="yes"/>
                                </li>
                                <li class="col-40 gutter-5" id="firstname_container">
                                    <input type="text" name="@{{ virtual.firstname }}" id="firstname"
                                           ng-model="virtual.firstname" placeholder="Nombre" required="yes"/>
                                </li>
                                <li class="col-40 gutter-5" id="lastname_container">
                                    <input type="text" name="@{{ virtual.lastname }}" id="lastname"
                                           ng-model="virtual.lastname" placeholder="Apellido" required="yes"/>
                                </li>
                                <li class="col-20 gutter-5" id="ididentificationtype_container">
                                    <label class="select-arrow" for="ididentificationtype">
                                        <select id="ididentificationtype" name="ididentificationtype"
                                                ng-model="virtual.ididentificationtype"
                                                ng-options="identificationtype.ididentificationtype as identificationtype.name for identificationtype in identificationtypes"
                                                required="yes">
                                            <option value="">Tipo Identificación</option>
                                        </select>
                                    </label>
                                </li>
                                <li class="col-20 gutter-5" id="identification_container">
                                    <input type="text" name="@{{ virtual.identification }}" id="identification"
                                           ng-model="virtual.identification" placeholder="Identificación"
                                           required="yes"/>
                                </li>
                                <li class="col-20 gutter-5" id="expedition_container">
                                    <input type="text" name="@{{ virtual.expedition }}" id="expedition"
                                           ng-model="virtual.expedition" placeholder="Lugar de Expedición"
                                           required="yes"/>
                                </li>
                                <li class="col-20 gutter-5" id="religion_container">
                                    <label class="select-arrow" for="idreligion">
                                        <select id="idreligion" name="idreligion" ng-model="virtual.idreligion"
                                                ng-options="religion.idreligion as religion.name for religion in religions"
                                                required="yes">
                                            <option value="">Religión</option>
                                        </select>
                                    </label>
                                </li>
                                <li class="col-60 gutter-5" id="address_container">
                                    <input type="text" name="@{{ virtual.address }}" id="address"
                                           ng-model="virtual.address" placeholder="Dirección" required="yes"/>
                                </li>
                                <li class="col-20 gutter-5" id="district_container">
                                    <input type="text" name="@{{ virtual.district }}" id="district"
                                           ng-model="virtual.district" placeholder="Municipio" required="yes"/>
                                </li>
                                <li class="col-20 gutter-5" id="town_container">
                                    <input type="text" name="@{{ virtual.town }}" id="town" ng-model="virtual.town"
                                           placeholder="Barrio" required="yes"/>
                                </li>
                                <li class="col-60 gutter-5" id="email_container">
                                    <input type="email" name="@{{ virtual.email }}" id="eamil" ng-model="virtual.email"
                                           placeholder="Correo Electrónico" required="yes"/>
                                </li>
                                <li class="col-20 gutter-5" id="phone_container">
                                    <input type="text" name="@{{ virtual.phone }}" id="phone" ng-model="virtual.phone"
                                           placeholder="Teléfono" required="yes"/>
                                </li>
                                <li class="col-20 gutter-5" id="celular_container">
                                    <input type="text" name="@{{ virtual.celular }}" id="celular"
                                           ng-model="virtual.celular" placeholder="Celular" required="yes"/>
                                </li>
                            </ul>
                        </fieldset>
                        <hr ng-if="student">
                        <fieldset class="step" ng-if="student">
                            <legend>Información Médica</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-20 gutter-5" id="idbloodtype_container">
                                    <label class="select-arrow" for="idbloodtype">
                                        <select id="idbloodtype" name="idbloodtype" ng-model="virtual.idbloodtype"
                                                ng-options="bloodtype.idbloodtype as bloodtype.name for bloodtype in bloodtypes"
                                                required="yes">
                                            <option value="">Tipo de Sangre</option>
                                        </select>
                                    </label>
                                </li>
                                <li class="col-20 gutter-5" id="eps_container">
                                    <input type="text" name="@{{ virtual.eps }}" id="eps" ng-model="virtual.eps"
                                           title="Ej: Sura,Saludcoop" placeholder="EPS"/>
                                </li>
                                <li class="col-20 gutter-5" id="prepaidmedical_container">
                                    <input type="text" name="@{{ virtual.prepaidmedical }}" id="prepaidmedical"
                                           ng-model="virtual.prepaidmedical" title="Premium,Salud Global"
                                           placeholder="Medicina Prepagada"/>
                                </li>
                                <li class="col-20 gutter-5" id="policynumber_container">
                                    <input type="text" name="@{{ virtual.policynumber }}" id="policynumber"
                                           ng-model="virtual.policynumber"
                                           title="Número de póliza de la medicina prepagada"
                                           placeholder="Número de póliza"/>
                                </li>
                                <li class="col-20 gutter-5" id="medicaltreatment_container">
                                    <label class="select-arrow" for="medicaltreatment">
                                        <select name="medicaltreatment" id="medicaltreatment"
                                                ng-model="virtual.medicaltreatment" required="yes">
                                            <option value="">¿Tratamiento Médico?</option>
                                            <option value="N">No</option>
                                            <option value="Y">Si</option>
                                        </select>
                                    </label>
                                </li>
                                <li class="col-100 gutter-5" id="medicaltreatmentdescription_container">
                                    <textarea rows="3" name="medicaltreatmentdescription"
                                              id="medicaltreatmentdescription"
                                              ng-model="virtual.medicaltreatmentdescription"
                                              placeholder="Descripción del tratamiento médico"></textarea>
                                </li>
                                <li class="col-20 gutter-5" id="equaltreatment_container">
                                    <label class="select-arrow" for="equaltreatment">
                                        <select name="equaltreatment" id="equaltreatment"
                                                ng-model="virtual.equaltreatment" required="yes">
                                            <option value="">¿Continúa Tratamiento?</option>
                                            <option value="N">No</option>
                                            <option value="Y">Si</option>
                                        </select>
                                    </label>
                                </li>
                                <li class="col-20 gutter-5" id="takemedication_container">
                                    <label class="select-arrow" for="takemedication">
                                        <select name="takemedication" id="takemedication"
                                                ng-model="virtual.takemedication" required="yes">
                                            <option value="">¿Toma Medicamento?</option>
                                            <option value="N">No</option>
                                            <option value="Y">Si</option>
                                        </select>
                                    </label>
                                </li>
                                <li class="col-100 gutter-5" id="medicationdescription_container">
                                    <textarea rows="3" name="medicationdescription" id="medicationdescription"
                                              ng-model="virtual.medicationdescription"
                                              placeholder="Descripción del Medicamento"></textarea>
                                </li>
                                <li class="col-100 gutter-5" id="whytakemedication_container">
                                    <textarea rows="3" name="whytakemedication" id="whytakemedication"
                                              ng-model="virtual.whytakemedication"
                                              placeholder="¿Por qué toma el medicamento?"></textarea>
                                </li>
                                <li class="col-100 gutter-5" id="dose_container">
                                    <textarea rows="3" name="dose" id="dose" ng-model="virtual.dose"
                                              placeholder="Dosis del Medicamentos"></textarea>
                                </li>
                                <li class="col-20 gutter-5" id="isallergic_container">
                                    <label class="select-arrow" for="isallergic">
                                        <select name="isallergic" id="isallergic" ng-model="virtual.isallergic"
                                                required="yes">
                                            <option value="">¿Es alérgico?</option>
                                            <option value="N">No</option>
                                            <option value="Y">Si</option>
                                        </select>
                                    </label>
                                </li>
                                <li class="col-80 gutter-5">
                                    <input type="text" name="@{{ virtual.specifyallergic }}" id="specifyallergic"
                                           ng-model="virtual.specifyallergic" title="¿A qué es alérgico?"
                                           placeholder="¿A qué es alérgico?"/>
                                </li>
                                <li class="col-30 gutter-5">
                                    <label class="select-arrow" for="sufferedillness">
                                        <select name="sufferedillness" id="sufferedillness"
                                                ng-model="virtual.sufferedillness" required="yes">
                                            <option value="">¿A sufrido alguna enfermedad?</option>
                                            <option value="N">No</option>
                                            <option value="Y">Si</option>
                                        </select>
                                    </label>
                                </li>
                                <li class="col-80 gutter-5">
                                    <input type="text" name="@{{ virtual.sufferedillnessdescription }}"
                                           id="sufferedillnessdescription" ng-model="virtual.sufferedillnessdescription"
                                           title="Descripción de la Enferemedad que ha sufrido el estudiante"
                                           placeholder="Descripción de la Enferemedad que ha sufrido el estudiante"/>
                                </li>
                                <li class="col-60 gutter-5">
                                    <input type="text" name="@{{ virtual.doctorname }}" id="doctorname"
                                           ng-model="virtual.doctorname" placeholder="Nombre del Pediatra"/>
                                </li>
                                <li class="col-40 gutter-5">
                                    <input type="text" name="@{{ virtual.doctorphone }}" id="doctorphone"
                                           ng-model="virtual.doctorphone" placeholder="Teléfono de Emergencia"/>
                                </li>
                                <li class="col-100 gutter-5">
                                    <label class="select-arrow" for="psychologicalsupport">
                                        <select name="psychologicalsupport" id="psychologicalsupport"
                                                ng-model="virtual.psychologicalsupport" required="yes">
                                            <option value="">¿Tiene Apoyo Psicològico?</option>
                                            <option value="N">No</option>
                                            <option value="Y">Si</option>
                                        </select>
                                    </label>
                                </li>
                            </ul>
                        </fieldset>
                        <hr ng-if="student">
                        <fieldset class="step" ng-if="student">
                            <legend>Información Adicional</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-100 gutter-5">
                                    <textarea rows="3" name="observation" id="observation"
                                              ng-model="virtual.observation"
                                              placeholder="Observación Adicional"></textarea>
                                </li>
                                <li class="col-100 gutter-5">
                                    <label class="select-arrow" for="educationaloutput">
                                        <select name="educationaloutput" id="educationaloutput"
                                                ng-model="virtual.educationaloutput" required="yes">
                                            <option value="">¿Autoriza la realización de Salidas Pedagógicas?</option>
                                            <option value="Y">Si</option>
                                            <option value="N">No</option>
                                        </select>
                                    </label>
                                </li>
                                <li class="col-100 gutter-5">
                                    <input type="text" name="@{{ virtual.responsible }}" id="responsible"
                                           ng-model="virtual.responsible"
                                           placeholder="Nombre Completo del Responsanble Económico del Estudiante"/>
                                </li>
                            </ul>
                        </fieldset>
                        <hr ng-hide="student">
                        <fieldset class="step" ng-hide="student">
                            <legend>Información Padres</legend>
                            <ul class="display-horizontal col-100">
                                <li class="col-25 gutter-5" id="isallergic_profession">
                                    <input type="text" name="@{{ virtual.profession }}" id="profession"
                                           ng-model="virtual.profession" placeholder="Profesión"/>
                                </li>
                                <li class="col-25 gutter-5" id="isallergic_occupation">
                                    <input type="text" name="@{{ virtual.occupation }}" id="occupation"
                                           ng-model="virtual.occupation" placeholder="Ocupación"/>
                                </li>
                                <li class="col-25 gutter-5" id="isallergic_company">
                                    <input type="text" name="@{{ virtual.company }}" id="company"
                                           ng-model="virtual.company" placeholder="Empresa"/>
                                </li>
                                <li class="col-25 gutter-5" id="isallergic_phonecompany">
                                    <input type="text" name="@{{ virtual.phonecompany }}" id="phonecompany"
                                           ng-model="virtual.phonecompany" placeholder="Teléfono Empresa"/>
                                </li>
                            </ul>
                        </fieldset>
                        <ul class="display-horizontal col-100">
                            <li class="col-100 gutter-5">
                                <button class="btn btn-aquamarine" name="save" type="submit">Save</button>
                            </li>
                        </ul>
                        <input type="hidden" name="idfamily" id="idfamily" value="@{{ virtual.idfamily }}"
                               ng-model="virtual.idfamily"/>
                        <input type="hidden" name="idcategory" id="idcategory" value="@{{ virtual.idcategory }}"
                               ng-model="virtual.idcategory"/>
                    </form>
                </section>
            </div>
        </div>
    </section>
@stop
@section("script")
    {!! HTML::script('js/' . getCurrentRoute() . '.js') !!}
@stop
@section("vendor")
    {!! HTML::script('js/vendor/vendor.js') !!}
@stop
@section("sigeturbo")
    {!! HTML::script('js/SigeTurbo.js') !!}
@stop