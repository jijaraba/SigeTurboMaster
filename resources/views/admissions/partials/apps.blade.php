<div class="sige-app-select">
    <label class="select-arrow" for="apps">
        <select id="apps" name="apps">
            <option value="admissions" {{ setCurrentApp('dashboard','selected') }}>{{ Lang::get('sige.Dashboard') }}</option>
            <option value="admissions/students" {{ setCurrentApp('students','selected') }}>{{ Lang::get('sige.Students') }}</option>
            <option value="admissions/users" {{ setCurrentApp('users','selected') }}>{{ Lang::get('sige.Users') }}</option>
            <option value="admissions/payments" {{ setCurrentApp('payments','selected') }}>{{ Lang::get('sige.Payments') }}</option>
            <option value="admissions/transports" {{ setCurrentApp('transports','selected') }}>{{ Lang::get('sige.Transports') }}</option>
            <option value="admissions/quantitativerecoveryfinalareas" {{ setCurrentApp('quantitativerecoveryfinalareas','selected') }}>{{ Lang::get('sige.Quantitativerecoveryfinalareas') }}</option>
        </select>
    </label>
</div>
<ul class="sige-app-list">
    <li class="{{ setCurrentApp('dashboard','active') }}">
        <a href="{{ URL::route('admissions.dashboard') }}">
            <span>{{ Lang::get('sige.Dashboard') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('students','active') }}">
        <a href="{{ URL::route('admissions.students.index') }}">
            <span>{{ Lang::get('sige.Students') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('users','active') }}">
        <a href="{{ URL::route('admissions.users.index') }}">
            <span>{{ Lang::get('sige.Users') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('transports','active') }}">
        <a href="{{ URL::route('admissions.transports.index') }}">
            <span>{{ Lang::get('sige.Transports') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('quantitativerecoveryfinalareas','active') }}">
        <a href="{{ URL::route('admissions.quantitativerecoveryfinalareas.index') }}">
            <span>{{ Lang::get('sige.Quantitativerecoveryfinalareas') }}</span>
        </a>
    </li>
</ul>