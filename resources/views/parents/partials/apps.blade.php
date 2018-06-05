<div class="sige-app-select">
    <label class="select-arrow" for="apps">
        <select id="apps" name="apps">
            <option value="parents/" {{ setCurrentApp('dashboard','selected') }}>{{ Lang::get('sige.Dashboard') }}</option>
            <option value="parents/homeworks" {{ setCurrentApp('homeworks','selected') }}>{{ Lang::get('sige.Homeworks') }}</option>
            <option value="parents/monitorings" {{ setCurrentApp('monitoring','selected') }}>{{ Lang::get('sige.Monitoring') }}</option>
            <option value="parents/reports" {{ setCurrentApp('reports','selected') }}>{{ Lang::get('sige.Reports') }}</option>
            <option value="parents/members" {{ setCurrentApp('members','selected') }}>{{ Lang::get('sige.Updateinfo') }}</option>
            <option value="parents/payments" {{ setCurrentApp('payments','selected') }}>{{ Lang::get('sige.Payments') }}</option>
        </select>
    </label>
</div>
<ul class="sige-app-list">
    <li class="{{ setCurrentApp('dashboard','active') }}">
        <a href="{{ URL::route('parents.dashboard') }}">
            <span>{{ Lang::get('sige.Dashboard') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('homeworks','active') }}">
        <a href="{{ URL::route('parents.homeworks.index') }}">
            <span>{{ Lang::get('sige.Homeworks') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('monitoring','active') }}">
        <a href="{{ URL::route('parents.monitoring.index') }}">
            <span>{{ Lang::get('sige.Monitoring') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('reports','active') }}">
        <a href="{{ URL::route('parents.reports.index') }}">
            <span>{{ Lang::get('sige.Reports') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('members','active') }}">
        <a href="{{ URL::route('parents.members.index') }}">
            <span>{{ Lang::get('sige.Updateinfo') }}</span>
        </a>
        <em>New</em>
    </li>
    <li class="{{ setCurrentApp('payments','active') }}">
        <a href="{{ URL::route('parents.payments.index') }}">
            <span>{{ Lang::get('sige.Payments') }}</span>
        </a>
    </li>
</ul>