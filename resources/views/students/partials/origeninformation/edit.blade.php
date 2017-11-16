{!! Form::open(array('route' => array('admissions.origeninformations.update',$student->origeninformation->idorigeninformation),'method' => 'PUT')) !!}
<fieldset>
    <ul class="display-horizontal col-100">
        <li class="col-25 gutter-5">
            <label class="select-arrow" for="idlanguage">
                {!! Form::select('idlanguage', $languages, $student->origeninformation->idlanguage, ['title' => Lang::get('sige.LanguageTitle')]) !!}
            </label>
        </li>
        <li class="col-25 gutter-5">
            <label class="select-arrow" for="idcountry">
                {!! Form::select('idcountry', $countries, $student->origeninformation->idcountry, ['title' => Lang::get('sige.CountryTitle')]) !!}
            </label>
        </li>
        <li class="col-15 gutter-5">
            <button id="search" type="submit" class="btn btn-aquamarine">{{ Lang::get('sige.Save') }}</button>
        </li>
    </ul>
</fieldset>
<input type="hidden" id="origeninformation_user" name="origeninformation_user" value="{{ $student->iduser }}">
{!! Form::close() !!}