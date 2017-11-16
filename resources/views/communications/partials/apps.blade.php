<div class="sige-app-select">
    <label class="select-arrow" for="apps">
        <select id="apps" name="apps">
            <option value="dashboard" {{ setCurrentApp('dashboard','selected') }}>{{ Lang::get('sige.Dashboard') }}</option>
            <option value="communications/weeklyevaluations" {{ setCurrentApp('weeklyevaluations','selected') }}>{{ Lang::get('sige.Weeklyevaluations') }}</option>
        </select>
    </label>
</div>
<ul class="sige-app-list">
    <li class="{{ setCurrentApp('dashboard','active') }}">
        <a href="{{ URL::route('communications.dashboard') }}">
            <span>{{ Lang::get('sige.Dashboard') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('weeklyevaluations','active') }}">
        <a href="{{ URL::route('communications.weeklyevaluations.index') }}">
            <span>{{ Lang::get('sige.Weeklyevaluations') }}</span>
        </a>
    </li>
</ul>