<div class="sige-app-select">
    <label class="select-arrow" for="apps">

        <select id="apps" name="apps">
            <option value="formation/" {{ setCurrentApp('dashboard','selected') }}>{{ Lang::get('sige.Dashboard') }}</option>
            <option value="formation/indicators" {{ setCurrentApp('indicators','selected') }}>{{ Lang::get('sige.Indicators') }}</option>
            <option value="formation/monitoringtypes" {{ setCurrentApp('monitoringtypes','selected') }}>{{ Lang::get('sige.MonitoringType') }}</option>
            <option value="formation/monitorings" {{ setCurrentApp('monitorings','selected') }}>{{ Lang::get('sige.Monitoring') }}</option>
            <option value="formation/attendances" {{ setCurrentApp('attendances','selected') }}>{{ Lang::get('sige.Attendance') }}</option>
            <option value="formation/observator" {{ setCurrentApp('observators','selected') }}>{{ Lang::get('sige.Observator') }}</option>
            <option value="formation/partials" {{ setCurrentApp('partials','selected') }}>{{ Lang::get('sige.Partial') }}</option>
            <option value="formation/descriptivereports" {{ setCurrentApp('descriptivereports','selected') }}>{{ Lang::get('sige.Descriptivereport') }}</option>
            <option value="formation/tasks" {{ setCurrentApp('tasks','selected') }}>{{ Lang::get('sige.Task') }}</option>
            <option value="formation/statistics" {{ setCurrentApp('statistics','selected') }}>{{ Lang::get('sige.Statistics') }}</option>
            <option value="formation/contracts" {{ setCurrentApp('contracts','selected') }}>{{ Lang::get('sige.Academicmanagement') }}</option>
        </select>
    </label>
</div>
<ul class="sige-app-list">
    <li class="{{ setCurrentApp('dashboard','active') }}">
        <a href="{{ URL::route('formation.dashboard') }}">
            <span>{{ Lang::get('sige.Dashboard') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('indicators','active') }}">
        <a href="{{ URL::route('formation.indicators.index') }}">
            <span>{{ Lang::get('sige.Indicators') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('monitoringtypes','active') }}">
        <a href="{{ URL::route('formation.monitoringtypes.index') }}">
            <span>{{ Lang::get('sige.MonitoringType') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('monitorings','active') }}">
        <a href="{{ URL::route('formation.monitorings.index') }}">
            <span>{{ Lang::get('sige.Monitoring') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('attendances','active') }}">
        <a href="{{ URL::route('formation.attendances.index') }}">
            <span>{{ Lang::get('sige.Attendance') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('observators','active') }}">
        <a href="{{ URL::route('formation.observators.index') }}">
            <span>{{ Lang::get('sige.Observator') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('partials','active') }}">
        <a href="{{ URL::route('formation.partials.index') }}">
            <span>{{ Lang::get('sige.Partial') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('descriptivereports','active') }}">
        <a href="{{ URL::route('formation.descriptivereports.index') }}">
            <span>{{ Lang::get('sige.Descriptivereport') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('tasks','active') }}">
        <a href="{{ URL::route('formation.tasks.index') }}">
            <span>{{ Lang::get('sige.Task') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('statistics','active') }}">
        <a href="{{ URL::route('formation.statistics.index') }}">
            <span>{{ Lang::get('sige.Statistics') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('contracts','active') }}">
        <a href="{{ URL::route('formation.contracts.init') }}">
            <span>{{ Lang::get('sige.Academicmanagement') }}</span>
        </a>
    </li>
</ul>