{!! Form::open(array('route' => array('admissions.identifications.update',$student->identification->ididentification),'method' => 'PUT')) !!}
<fieldset>
    <ul class="display-horizontal col-100">
        <li class="col-25 gutter-5">
            <label class="select-arrow" for="ididentificationtype">
                {!! Form::select('type', $identificationtypes, $student->identification->ididentificationtype, ['title' => Lang::get('sige.IdentificationtypeTitle')]) !!}
            </label>
        </li>
        <li class="col-20 gutter-5 icon-left">
            <input name="identification" id="identification" value="{{ $student->identification->identification }}"
                   type="text" title="{{ Lang::get('sige.IdentificationTitle') }}" 
                   placeholder="{{ Lang::get('sige.Number') }}" required="true"/>
        </li>
        <li class="col-20 gutter-5 icon-left">
            <i class="fa fa-calendar" aria-hidden="true"></i>
            <input name="date" id="date" type="text" placeholder="{{ Lang::get('sige.Date') }}"
                   value="{{ $student->identification->date }}" data-toggle="date" title="{{ Lang::get('sige.DateExpeditionTitle') }}" />
        </li>
        <li class="col-20 gutter-5 icon-left">
            <i class="fa fa-globe" aria-hidden="true"></i>
            <input name="expedition" id="expedition" type="text" placeholder="{{ Lang::get('sige.Expedition') }}"  title="{{ Lang::get('sige.ExpeditionPlaceTitle') }}"c
                   value="{{ $student->identification->expedition }}" required="true"/>
        </li>
        <li class="col-15 gutter-5">
            <button id="search" type="submit" class="btn btn-aquamarine">Save</button>
        </li>
    </ul>
</fieldset>
<input type="hidden" id="identification_user" name="identification_user" value="{{ $student->identification->iduser }}">
{!! Form::close() !!}