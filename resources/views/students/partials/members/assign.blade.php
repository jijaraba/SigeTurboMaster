<section class="member-assign" ng-controller="FamiliesAssignController" ng-init="init('{{ $student->lastname }}')">
    {!! Form::open(array('route' => array('admissions.families.assign'),'autocomplete' => 'off')) !!}
    <h4>{{ Lang::get('sige.FamilyAssign') }}</h4>
    <fieldset>
        <ul class="display-horizontal col-100">
            <li class="col-100 gutter-5">
                <sige-turbo-admissions-family-assign family="family" family_name="family_name"></sige-turbo-admissions-family-assign>
                <input name="family" id="family" type="hidden" value="@{{ family.idfamily }}" ng-model="family.idfamily">
            </li>
        </ul>
    </fieldset>
    <fieldset>
        <ul class="display-horizontal col-100">
            <li class="button gutter-5">
                <button id="search" type="submit" class="btn btn-aquamarine">{{ Lang::get('sige.Assign') }}</button>
            </li>
        </ul>
    </fieldset>
    <input type="hidden" value="{{ $student->iduser }}" name="user" id="user">
    {!! Form::close() !!}
</section>