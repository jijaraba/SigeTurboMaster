{!! Form::open(array('route' => array('admissions.healthinformations.store'))) !!}
<fieldset>
    <ul class="display-horizontal col-100">
        <li class="col-15 gutter-5">
            <label class="select-arrow" for="idbloodtype">
               {!! Form::select('idbloodtype', $bloodtypes, old("idbloodtype"), ['title' => Lang::get('sige.StudentBloodtype')]) !!}
            </label>
        </li>
        <li class="col-25 gutter-5">
            <label class="select-arrow" for="idprepaidmedical">
               {!! Form::select('idprepaidmedical', $prepaidmedicals, old("idprepaidmedical"), ['title' => Lang::get('sige.StudentPrepaidmedical')]) !!}
            </label>
        </li>
        <li class="col-15 gutter-5">
          <select name="insurance" id="insurance"  title="{{ Lang::get('sige.StudentIsInsurance') }}">
              <option value="Y" <?php if (old('insurance') == 'Y') echo "selected"; ?> >SI</option>
              <option value="N" <?php if (old('insurance') == 'N') echo "selected"; ?> >NO</option>
          </select>
        </li>
        <li class="col-25 gutter-5">
            <label class="select-arrow" for="idmedicalinsurance">
               {!! Form::select('idmedicalinsurance', $medicalinsurances, old("idmedicalinsurance"), ['title' => Lang::get('sige.StudentInsurance')]) !!}
            </label>
        </li>
        <li class="col-20 gutter-5 icon-left">
          <i class="fa fa-newspaper-o" aria-hidden="true"></i>
            <input name="policy_number" id="policy_number" value="{{ old('policy_number') }}" type="text"
                   placeholder="{{ Lang::get('sige.StudentPolicyNumber') }}" required="true"/>
        </li>
        <li class="col-30 gutter-5 ">
            <input name="diseases" id="diseases" value="{{ old("diseases") }}" type="text"
                   placeholder="{{ Lang::get('sige.StudentDiseases') }}" required="true" />
        </li>
        <li class="col-40 gutter-5 icon-left">
          <i class="fa fa-medkit" aria-hidden="true"></i>
            <input name="medical_treatment" id="medical_treatment" value="{{ old('medical_treatment') }}" type="text"
                   placeholder="{{ Lang::get('sige.StudentMedicalTreatment') }}" required="true" />
        </li>
        <li class="col-30 gutter-5">
            <input name="medication" id="medication" value="{{ old('medication') }}"  type="text"
                   placeholder="{{ Lang::get('sige.StudentMedication') }}" required="true"/>
        </li>
        <li class="col-50 gutter-5">
            <input name="dose" id="dose" type="text" value="{{ old('dose') }}"
                   placeholder="{{ Lang::get('sige.StudentDose') }}" required="true" />
        </li>
        <li class="col-50 gutter-5">
            <input name="allergies" id="allergies" value="{{ old('allergies') }}" type="text"
                   placeholder="{{ Lang::get('sige.StudentAllergies') }}" required="true"/>
        </li>
        <li class="col-40 gutter-5 icon-left">
            <i class="fa fa-user-md" aria-hidden="true"></i>
            <input name="doctor_name" id="doctor_name" value="{{ old('doctor_name') }}" type="text"
                   placeholder="{{ Lang::get('sige.StudentDoctor_Name') }}"/>
        </li>
        <li class="col-40 gutter-5 icon-left">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <input name="doctor_phone" id="doctor_phone" value="{{ old('doctor_phone') }}" type="text"
                   placeholder="{{ Lang::get('sige.StudentDoctor_Phone') }}"/>
        </li>
        <li class="col-20 gutter-5">
          <select name="psychological_treatment" id="psychological_treatment" value="{{ old('psychological_treatment') }}"  title="{{ Lang::get('sige.StudentPsychological_Treatment') }}">
              <option value="Y" <?php if (old('psychological_treatment') == 'Y') echo "selected"; ?> >SI</option>
              <option value="N" <?php if (old('psychological_treatment') == 'N') echo "selected"; ?> >NO</option>
          </select>
        </li>
        <li class="col-40 gutter-5">
            <input name="emergency_contact" id="emergency_contact" value="{{ old('emergency_contact') }}" type="text" 
                   placeholder="{{ Lang::get('sige.StudentEmergency_Contact') }}" required="true"/>
        </li>
        <li class="col-40 gutter-5 icon-left">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <input name="emergency_phone" id="emergency_phone" value="{{ old('emergency_phone') }}" type="text" 
                   placeholder="{{ Lang::get('sige.StudentEmergency_Phone') }}" />
        </li>
        <li class="col-20 gutter-5">
          <select name="vaccination_card" id="vaccination_card"  title="{{ Lang::get('sige.StudentVaccination_Card') }}">
              <option value="Y" <?php if (old('vaccination_card') == 'Y') echo "selected"; ?> >SI</option>
              <option value="N" <?php if (old('vaccination_card') == 'N') echo "selected"; ?> >NO</option>
          </select>
        </li>
        <li class="col-100 gutter-5">
            <textarea name="observation" id="observation" placeholder="{{ Lang::get('sige.Observation') }}" rows="3">{{ old('observation') }}</textarea>
        </li>
        <li class="col-15 gutter-5">
            <button id="search" type="submit" class="btn btn-aquamarine">{{ Lang::get('sige.Save') }}</button>
        </li>
    </ul>
</fieldset>
<input type="hidden" id="healthinformation_user" name="healthinformation_user" value="{{ $student->iduser }}">
{!! Form::close() !!}