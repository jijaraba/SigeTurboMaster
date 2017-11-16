<div class="sige-app-select">
    <label class="select-arrow" for="apps">
        <select id="apps" name="apps">
            <option value="resources/" {{ setCurrentApp('dashboard','selected') }}>{{ Lang::get('sige.Dashboard') }}</option>
            <option value="resources/purchases" {{ setCurrentApp('purchases','selected') }}>{{ Lang::get('sige.Purchases') }}</option>
            <option value="resources/providers" {{ setCurrentApp('providers','selected') }}>{{ Lang::get('sige.Providers') }}</option>
            <option value="resources/visitors" {{ setCurrentApp('visitors','selected') }}>{{ Lang::get('sige.Visitors') }}</option>
            <option value="resources/assets" {{ setCurrentApp('assets','selected') }}>{{ Lang::get('sige.Assets') }}</option>
            <option value="resources/inventories" {{ setCurrentApp('inventories','selected') }}>{{ Lang::get('sige.Inventories') }}</option>
        </select>
    </label>
</div>
<ul class="sige-app-list">
    <li class="{{ setCurrentApp('dashboard','active') }}">
        <a href="{{ URL::route('resources.dashboard') }}">
            <span>{{ Lang::get('sige.Dashboard') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('purchases','active') }}">
        <a href="{{ URL::route('resources.purchases.index') }}">
            <span>{{ Lang::get('sige.Purchases') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('providers','active') }}">
        <a href="{{ URL::route('resources.providers.index') }}">
            <span>{{ Lang::get('sige.Providers') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('visitors','active') }}">
        <a href="{{ URL::route('resources.visitors.index') }}">
            <span>{{ Lang::get('sige.Visitors') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('assets','active') }}">
        <a href="{{ URL::route('resources.assets.index') }}">
            <span>{{ Lang::get('sige.Assets') }}</span>
        </a>
    </li>
    <li class="{{ setCurrentApp('inventories','active') }}">
        <a href="{{ URL::route('resources.inventories.index') }}">
            <span>{{ Lang::get('sige.Inventories') }}</span>
        </a>
    </li>
</ul>