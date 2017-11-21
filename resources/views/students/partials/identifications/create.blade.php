{!! Form::open(array('route' => array('admissions.identifications.store'))) !!}
<fieldset>
    <ul class="display-horizontal col-100">
        <li class="col-25 gutter-5">
            <label class="select-arrow" for="ididentificationtype">
                {!! Form::select('type', $identificationtypes, old("type"), ['title' => Lang::get('sige.IdentificationtypeTitle')]) !!}
            </label>
        </li>
        <li class="col-20 gutter-5 icon-left">
            <input name="identification" id="identification" value="{{old('identification', $student->iduser)}}" type="text"
                   placeholder="{{ Lang::get('sige.Number') }}" required="true" title="{{ Lang::get('sige.IdentificationTitle') }}"/>
        </li>
        <li class="col-20 gutter-5  icon-left">
            <i class="fa fa-calendar" aria-hidden="true"></i>
            <input name="date" id="date" type="text" value="{{ old('date') }}" title="{{ Lang::get('sige.DateExpeditionTitle') }}"
                   placeholder="{{ Lang::get('sige.Date') }}" data-toggle="date"/>
        </li>
        <li class="col-20 gutter-5 icon-left">
            <i class="fa fa-globe" aria-hidden="true"></i>
            <input name="expedition"  value="{{ old('expedition') }}" id="expedition" type="text" placeholder="{{ Lang::get('sige.Expedition') }}" title="{{ Lang::get('sige.ExpeditionPlaceTitle') }}" required="true"/>
        </li>
        <li class="col-15 gutter-5">
            <button id="search" type="submit" class="btn btn-aquamarine">{{ Lang::get('sige.Save') }}</button>
        </li>
    </ul>
</fieldset>
<input type="hidden" id="identification_user" name="identification_user" value="{{ $student->iduser }}">
{!! Form::close() !!}