<!doctype html>
<html lang="en" ng-app="{{ isset($ngmodule) ? ucfirst($ngmodule) : ucfirst(getCurrentRoute()) }}">
<head>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield("title")</title>
    @yield("sweetCSS")
    @yield("dialogCSS")
    {!! HTML::style(mix('css/default.css')) !!}
    {!! HTML::style(mix('css/'. (isset($cssprefered) ? $cssprefered : getCurrentRoute()) . '.css')) !!}
    {!! HTML::style(mix('css/vendor/vendor.css')) !!}
    {!! HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') !!}
    <base href="/{{ getCurrentRoute() }}"/>
</head>
<body>
<header>
    <ul id="account-info" class="account-info">
        <li id="notifications">
            <a href="{{ URL::route('notificationsbyuser',getUser()->username) }}"
               title="{{ Lang::get('sige.Notifications') }}">
                <div class="bell {{ (Alert::count(getUser()->iduser) > 0 )?" show":"" }}"></div>
                <em id="notifications_count">{{ Alert::count(getUser()->iduser) }}</em>
            </a>
        </li>
        <li id="profile">
            <a id="profile-view" href="{{ URL::route('profile',getUser()->username) }}">
                <figure>
                    <div id="photo">
                        <img src="{{ getenv("ASSETS_SERVER") }}/img/users/{{ getUser()->photo }}"
                             title="{{ getUser()->firstname }}" alt="{{ getUser()->firstname }}">
                    </div>
                    <figcaption>
                        <h4>{{ getUser()->firstname }}</h4>
                        <em id="points_counter">{{ getUser()->points }}</em>
                    </figcaption>
                </figure>
            </a>
            <div id="profile-dropdown" class="dropdown right">
                <h4 class="title">
                    <a class="link" href="{{ URL::route('profile',getUser()->username) }}">
                        <strong>{{ getUser()->firstname }}</strong>
                        <span>{{ Lang::get('sige.ViewProfile') }}</span>
                    </a>
                </h4>
                <ul>
                    <li>{!! link_to_route('settings',Lang::get('sige.Settings')) !!} </li>
                    @if(count(explode(',',getUser()->role))>1)
                        <li>{!! link_to_route('roles',Lang::get('sige.Role'). " " . "(". rolName(getUser()->role_selected) . ")") !!}</li>
                    @endif
                    <li>{!! link_to_route('settings.points',Lang::get('sige.Points')) !!}</li>
                </ul>
                {!! link_to_route('logout',Lang::get('sige.SignOut'),null,array('class' => 'dropdown-secondary', 'id' => 'logout')) !!}
            </div>
        </li>
    </ul>
    <ul id="breadcrumb" class="display-horizontal">
        <li class="col-10 mobile-logo">
            <a href="{{ URL::route('dashboard') }}">
                {!! HTML::image('images/sigeturbo.png','Home') !!}
            </a>
        </li>
        <li class="col-80 title">
            <h3>@yield("ModuleName")</h3>
        </li>
        <li class="col-10 mobile-toggle" id="mobile-toggle">
            <a href="#">
                <span class="hamburger"></span>
                <em>{{ Alert::count(getUser()->iduser) }}</em>
            </a>
        </li>
    </ul>
    <nav id="navigation">
        <ul id="sige-main-nav">
            <li id="home" class="sige-nav-module {{ setCurrentModule('dashboard') }}">
                <a href="{{ URL::route('dashboard') }}" title="{{ Lang::get('sige.Home') }}"
                   data-title="{{ Lang::get('sige.Home') }}">
                    {!! HTML::image('images/sigeturbo.png','Home') !!}
                </a>
            </li>
            <li id="admissions" class="sige-nav-module {{ setCurrentModule('admissions') }}">
                <a href="{{ URL::route('admissions.dashboard') }}" title="{{ Lang::get('sige.Admissions') }}"
                   data-title="{{ Lang::get('sige.Admissions') }}">
                    @if(setCurrentModule('admissions') == 'current')
                        {!! HTML::image('images/modules/admissions_active.svg',Lang::get('sige.Admissions')) !!}
                    @else
                        {!! HTML::image('images/modules/admissions.svg',Lang::get('sige.Admissions')) !!}
                    @endif
                    <span>{{ Lang::get('sige.Admissions') }}</span>
                </a>
            </li>
            <li id="financials" class="sige-nav-module {{ setCurrentModule('financials') }}">
                <a href="{{ URL::route('financials.dashboard') }}" title="{{ Lang::get('sige.Financials') }}"
                   data-title="{{ Lang::get('sige.Financials') }}">
                    @if(setCurrentModule('financials') == 'current')
                        {!! HTML::image('images/modules/financials_active.svg',Lang::get('sige.Financials')) !!}
                    @else
                        {!! HTML::image('images/modules/financials.svg',Lang::get('sige.financials')) !!}
                    @endif
                    <span>{{ Lang::get('sige.Financials') }}</span>
                </a>
                <em>New</em>
            </li>
            <li id="formation" class="sige-nav-module {{ setCurrentModule('formation') }}"
                title="{{ Lang::get('sige.Formation') }}" data-title="{{ Lang::get('sige.Formation') }}">
                <a href="{{ URL::route('formation.dashboard') }}">
                    @if(setCurrentModule('formation') == 'current')
                        {!! HTML::image('images/modules/formation_active.svg',Lang::get('sige.Formation')) !!}
                    @else
                        {!! HTML::image('images/modules/formation.svg',Lang::get('sige.Formation')) !!}
                    @endif
                    <span>{{ Lang::get('sige.Formation') }}</span>
                </a>
            </li>
            <li id="resources" class="sige-nav-module {{ setCurrentModule('resources') }}"
                title="{{ Lang::get('sige.Resources') }}" data-title="{{ Lang::get('sige.Resources') }}">
                <a href="{{ URL::route('resources.dashboard') }}">
                    @if(setCurrentModule('resources') == 'current')
                        {!! HTML::image('images/modules/resources_active.svg',Lang::get('sige.Resources')) !!}
                    @else
                        {!! HTML::image('images/modules/resources.svg',Lang::get('sige.Resources')) !!}
                    @endif
                    <span>{{ Lang::get('sige.Resources') }}</span>
                </a>
            </li>
            <li id="communications" class="sige-nav-module {{ setCurrentModule('communications') }}"
                title="{{ Lang::get('sige.Communications') }}" data-title="{{ Lang::get('sige.Communications') }}">
                <a href="{{ URL::route('communications.dashboard') }}">
                    @if(setCurrentModule('communications') == 'current')
                        {!! HTML::image('images/modules/communications_active.svg',Lang::get('sige.Communications')) !!}
                    @else
                        {!! HTML::image('images/modules/communications.svg',Lang::get('sige.Communications')) !!}
                    @endif
                    <span>{{ Lang::get('sige.Communications') }}</span>
                </a>
            </li>
            <li id="parents" class="sige-nav-module {{ setCurrentModule('parents') }}"
                title="{{ Lang::get('sige.Parents') }}" data-title="{{ Lang::get('sige.Parents') }}">
                <a href="{{ URL::route('parents.dashboard') }}">
                    @if(setCurrentModule('parents') == 'current')
                        {!! HTML::image('images/modules/parents_active.svg',Lang::get('sige.Parents')) !!}
                    @else
                        {!! HTML::image('images/modules/parents.svg',Lang::get('sige.Parents')) !!}
                    @endif
                    <span>{{ Lang::get('sige.Parents') }}</span>
                </a>
            </li>
            <li id="roles" class="sige-nav-module {{ setCurrentModule('roles') }}" title="{{ Lang::get('sige.Role') }}"
                data-title="{{ Lang::get('sige.Role') }}">
                <a href="{{ URL::route('roles') }}">
                    <span>{{ Lang::get('sige.Role') }}</span>
                </a>
            </li>
            <li id="settings" class="sige-nav-module {{ setCurrentModule('settings') }}"
                title="{{ Lang::get('sige.Settings') }}" data-title="{{ Lang::get('sige.Settings') }}">
                <a href="{{ URL::route('settings') }}">
                    <span>{{ Lang::get('sige.Settings') }}</span>
                </a>
            </li>
            <li id="logout" class="sige-nav-module {{ setCurrentModule('logout') }}"
                title="{{ Lang::get('sige.SignOut') }}" data-title="{{ Lang::get('sige.SignOut') }}">
                <a href="{{ URL::route('logout') }}">
                    <span>{{ Lang::get('sige.SignOut') }}</span>
                </a>
            </li>
        </ul>
    </nav>
</header>
<section class="sige-main-container" id="sige-main-container">
    <aside data-layout-element="sidebar" style="top:0px">
        @if (View::exists(getCurrentRoute() . ".partials.apps"))
            @include(getCurrentRoute() . ".partials.apps")
        @endif
    </aside>
    <div class="sige-content" id="sige-content">
    @include("layouts.partials.flashmessage")
    @yield("content")
    <!-- ToDo -->
        <div ui-view="viewDashboard"></div>
        @yield("dashboard")
    </div>
    <section class="sige-stream-content" id="sigeturbo_stream">
        <div class="stream">Hello World</div>
    </section>
</section>
<footer class="clearfix">
    <div class="sige-footer-content">
        <div>{{ Lang::get('sige.' . ucfirst(getCurrentRoute())) }}: v<span app-version></span></div>
    </div>
</footer>
@yield("payments")
@yield("vendor")
@yield("angular")
@yield("core")
@yield("script")
@yield("socket")
@yield("sigeturbo")
<div style="display: none" id="serverName" data-server="{{ env("SERVER") }}">{{ env("SERVER") }}</div>
<div style="display: none" id="sigeturboToken" data-token="{{ getUser()->api_token }}"></div>
</body>
</html>