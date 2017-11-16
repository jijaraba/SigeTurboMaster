{!! Form::open(array('route' => array('admissions.schoolinformations.store'),'autocomplete' => 'off')) !!}
<fieldset>
    <ul class="display-horizontal col-100">
        <li class="col-40 gutter-5 icon-left">
            <i class="fa fa-university" aria-hidden="true"></i>
            <input name="school" id="school" type="text" placeholder="{{ Lang::get('sige.School') }}" required="true" title="{{ Lang::get('sige.School') }}" value="{{ old('school') }}"/>
        </li>
        <li class="col-20 gutter-5">
            <label class="select-arrow" for="idcalendar">
                {!! Form::select('calendar', $calendars, old("calendar",2) , ['title' => Lang::get('sige.CalendarTitle')]) !!}
            </label>
        </li>
        <li class="col-20 gutter-5 icon-left">
            <i class="fa fa-globe" aria-hidden="true"></i>
            <input name="ubication" id="ubication" type="text" value="{{ old("ubication") }}" required="true" placeholder="{{ Lang::get('sige.Ubication') }}" title="{{ Lang::get('sige.Ubication') }}"/>
        </li>
        <li class="col-20 gutter-5 icon-left">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <input name="phone" id="phone" type="text" placeholder="{{ Lang::get('sige.Phone') }}"  value="{{ old("phone") }}" title="{{ Lang::get('sige.Phone') }}"/>
        </li>
        <li class="col-50 gutter-5 grade">
            <div class="approved">
                <input id="approved" name="approved" type="checkbox" value="{{ old("approved") }}" checked>
                <label class="fa fa-thumbs-up" aria-hidden="true" for="approved"></label>
            </div>
            <label class="select-arrow" for="idgrade">
                {!! Form::select('grade', $grades, old("grade") , ['id'=>'grade']) !!}
            </label>
        </li>
        <li class="col-50 gutter-5">
            <label class="select-arrow" for="idenrollmentreason">
                {!! Form::select('reason', $enrollmentreasons, old("reason") , ['title' => Lang::get('sige.EnrollmentreasonTitle')]) !!}
            </label>
        </li>
        <li class="col-100 gutter-5">
            <textarea name="observation" id="observation"  placeholder="{{ Lang::get('sige.Observation') }}" title="{{ Lang::get('sige.Observation') }}" rows="3">{{ old('observation') }}</textarea>
        </li>
        <li class="col-100 gutter-5">
            <button id="search" type="submit" class="btn btn-aquamarine">{{ Lang::get('sige.Save') }}</button>
        </li>
    </ul>
</fieldset>
<input type="hidden" id="schoolinformation_user" name="schoolinformation_user" value="{{ $student->iduser }}">
{!! Form::close() !!}