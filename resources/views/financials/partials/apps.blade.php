<div class="sige-app-select">
    <label class="select-arrow" for="apps">
        <select id="apps" name="apps">
            <option value="financials" {{ setCurrentApp('dashboard','selected') }}>{{ Lang::get('sige.Dashboard') }}</option>
            <option value="financials/payments" {{ setCurrentApp('payments','selected') }}>{{ Lang::get('sige.Payments') }}</option>
        </select>
    </label>
</div>
<ul class="sige-app-list">
    <li class="{{ setCurrentApp('dashboard','active') }}">
        <a href="{{ URL::route('financials.dashboard') }}">
            <span>{{ Lang::get('sige.Dashboard') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('payments','active') }}">
        <a href="{{ URL::route('financials.payments.index') }}">
            <span>{{ Lang::get('sige.Payments') }}</span>
        </a>
    </li>
</ul>