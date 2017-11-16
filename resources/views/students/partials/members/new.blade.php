<section class="member-new">
    {!! Form::open(array('route' => array('admissions.families.store'),'autocomplete' => 'off')) !!}
    <h4>Nueva Familia</h4>
    <fieldset>
        <ul class="display-horizontal col-100">
            <li class="col-100 gutter-5">
                <input type="text" name="name" value="{{ $student->lastname }}" placeholder="{{ Lang::get('sige.FamilyNew') }}">
            </li>
        </ul>
    </fieldset>
    <fieldset>
        <ul class="display-horizontal col-100">
            <li class="button gutter-5">
                <button id="search" type="submit" class="btn btn-aquamarine">{{ Lang::get('sige.New') }}</button>
            </li>
        </ul>
    </fieldset>
    <input type="hidden" value="{{ $student->iduser }}" name="student" id="student">
    {!! Form::close() !!}
</section>