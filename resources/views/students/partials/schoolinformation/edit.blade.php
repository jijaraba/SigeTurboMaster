{!! Form::open(array('route' => array('admissions.schoolinformations.update',$student->schoolinformation->idschoolinformation),'method' => 'PUT', 'autocomplete' => 'off')) !!}
<fieldset>
    <ul class="display-horizontal col-100">
        <li class="col-40 gutter-5 icon-left">
            <i class="fa fa-university" aria-hidden="true"></i>
            <input name="school" id="school" type="text" placeholder="{{ Lang::get('sige.School') }}"
                   value="{{ $student->schoolinformation->school }}" required="true" title="{{ Lang::get('sige.School') }}"/>
        </li>
        <li class="col-20 gutter-5">
            <label class="select-arrow" for="idcalendar">
                {!! Form::select('calendar', $calendars, $student->schoolinformation->idcalendar, ['title' => Lang::get('sige.CalendarTitle')]) !!}
            </label>
        </li>
        <li class="col-20 gutter-5 icon-left">
            <i class="fa fa-globe" aria-hidden="true"></i>
            <input name="ubication" id="ubication" type="text" placeholder="{{ Lang::get('sige.Ubication') }}"
                   value="{{ $student->schoolinformation->ubication }}" required="true" title="{{ Lang::get('sige.Ubication') }}"/>
        </li>
        <li class="col-20 gutter-5 icon-left">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <input name="phone" id="phone" type="text" placeholder="{{ Lang::get('sige.Phone') }}"
                   value="{{ $student->schoolinformation->phone }}" title="{{ Lang::get('sige.Phone') }}"/>
        </li>
        <li class="col-50 gutter-5 grade">
            <div class="approved">
                {{ Form::checkbox('approved',  null, ($student->schoolinformation->approved == 'Y')?true:false, ['id'=>'approved']) }}
                <label class="fa fa-thumbs-up" aria-hidden="true" for="approved"></label>
            </div>
            <label class="select-arrow" for="idgrade">
                {!! Form::select('grade', $grades, $student->schoolinformation->idgrade, ['id'=>'grade']) !!}
            </label>
        </li>
        <li class="col-50 gutter-5">
            <label class="select-arrow" for="idenrollmentreason">
                {!! Form::select('reason', $enrollmentreasons, $student->schoolinformation->idenrollmentreason, ['title' => Lang::get('sige.EnrollmentreasonTitle')]) !!}
            </label>
        </li>
        <li class="col-100 gutter-5">
            <textarea name="observation" id="observation" placeholder="{{ Lang::get('sige.Observation') }}"
            title="{{ Lang::get('sige.Observation') }}" rows="3">{{ $student->schoolinformation->observation }}</textarea>
        </li>
        <li class="col-100 gutter-5">
            <button id="search" type="submit" class="btn btn-aquamarine">{{ lang::get('sige.Save') }}</button>
        </li>
    </ul>
</fieldset>
<input type="hidden" id="schoolinformation_user" name="schoolinformation_user"
       value="{{ $student->schoolinformation->iduser }}">
{!! Form::close() !!}