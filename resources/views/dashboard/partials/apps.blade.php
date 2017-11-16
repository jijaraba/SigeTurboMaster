<div class="sige-app-select">
    <label class="select-arrow" for="apps">
        <select id="apps" name="apps">
            <option value="dashboard" {{ setCurrentApp('dashboard','selected') }}>{{ Lang::get('sige.Dashboard') }}</option>
            @if(getUser()->role_selected == 'Admin' )
                <option value="users/consent" {{ (getCurrentRoute() == 'dashboard') ? '' : setCurrentApp('consent','selected') }}>{{ Lang::get('sige.Consents') }}</option>
            @endif
        </select>
    </label>
</div>
<ul class="sige-app-list">
    <li class="{{ setCurrentApp('dashboard','active') }}">
        <a href="{{ URL::route('dashboard') }}">
            <span>{{ Lang::get('sige.Dashboard') }}</span>
        </a>
    </li>
    @if(getUser()->role_selected == 'Admin' )
        <li class="{{ (getCurrentRoute() == 'dashboard') ? '' : setCurrentApp('consent','active') }}">
            <a href="{{ URL::route('users.consent.index') }}">
                <span>{{ Lang::get('sige.Consents') }}</span>
            </a>
        </li>
    @endif
</ul>