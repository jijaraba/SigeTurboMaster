<!doctype html>
<html lang="{{ app()->getLocale() }}" ng-app="{{ isset($ngmodule) ? ucfirst($ngmodule) : ucfirst(getCurrentRoute()) }}">
<head>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title")</title>
    @yield("sweetCSS")
    @yield("dialogCSS")
    {!! HTML::style(mix('css/default.css')) !!}
    {!! HTML::style(mix('css/'. (isset($cssprefered) ? $cssprefered : getCurrentRoute()) . '.css')) !!}
    {!! HTML::style(mix('css/vendor/vendor.css')) !!}
    <base href="/{{ getCurrentRoute() }}"/>
</head>
<body>
<section id="{{ getCurrentRoute() . '-' . getCurrentApp() }}">
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
                    <a href="{{ route('logout') }}" class="dropdown-secondary" id="logout"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ Lang::get('sige.SignOut') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        </ul>
        <ul id="breadcrumb" class="display-horizontal">
            <li class="col-10 mobile-logo">
                <a href="{{ URL::route('dashboard') }}">
                    {!! HTML::image('images/sigeturbo.svg','Home') !!}
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
                        {!! HTML::image('images/sigeturbo.svg','Home',['id'=>'sigeturbo_logo']) !!}
                    </a>
                </li>
                @can('view',\SigeTurbo\Admission::class)
                    <li id="admissions" class="sige-nav-module {{ setCurrentModule('admissions') }}">
                        <a class="tooltip" href="{{ URL::route('admissions.dashboard') }}"
                           data-title="{{ Lang::get('sige.Admissions') }}">
                            @if(setCurrentModule('admissions') == 'current')
                                {!! HTML::image('images/modules/admissions_active.svg',Lang::get('sige.Admissions'),['class' => 'tooltip','title'=>Lang::get('sige.Admissions')]) !!}
                            @else
                                {!! HTML::image('images/modules/admissions.svg',Lang::get('sige.Admissions'),['class' => 'tooltip','title'=>Lang::get('sige.Admissions')]) !!}
                            @endif
                            <span>{{ Lang::get('sige.Admissions') }}</span>
                        </a>
                    </li>
                @endcan
                @can('view',\SigeTurbo\Financial::class)
                    <li id="financials" class="sige-nav-module {{ setCurrentModule('financials') }}">
                        <a class="tooltip" href="{{ URL::route('financials.dashboard') }}"
                           data-title="{{ Lang::get('sige.Financials') }}">
                            @if(setCurrentModule('financials') == 'current')
                                {!! HTML::image('images/modules/financials_active.svg',Lang::get('sige.Financials'),['class' => 'tooltip','title'=>Lang::get('sige.Financials')]) !!}
                            @else
                                {!! HTML::image('images/modules/financials.svg',Lang::get('sige.financials'),['class' => 'tooltip','title'=>Lang::get('sige.Financials')]) !!}
                            @endif
                            <span>{{ Lang::get('sige.Financials') }}</span>
                        </a>
                    </li>
                @endcan
                @can('view',\SigeTurbo\Formation::class)
                    <li id="formation" class="sige-nav-module {{ setCurrentModule('formation') }}"
                        data-title="{{ Lang::get('sige.Formation') }}">
                        <a class="tooltip" href="{{ URL::route('formation.dashboard') }}">
                            @if(setCurrentModule('formation') == 'current')
                                {!! HTML::image('images/modules/formation_active.svg',Lang::get('sige.Formation'),['class' => 'tooltip','title'=>Lang::get('sige.Formation')]) !!}
                            @else
                                {!! HTML::image('images/modules/formation.svg',Lang::get('sige.Formation'),['class' => 'tooltip','title'=>Lang::get('sige.Formation')]) !!}
                            @endif
                            <span>{{ Lang::get('sige.Formation') }}</span>
                        </a>
                    </li>
                @endcan
                @can('view',\SigeTurbo\Communication::class)
                    <li id="communications" class="sige-nav-module {{ setCurrentModule('communications') }}"
                        data-title="{{ Lang::get('sige.Communications') }}">
                        <a href="{{ URL::route('communications.dashboard') }}">
                            @if(setCurrentModule('communications') == 'current')
                                {!! HTML::image('images/modules/communications_active.svg',Lang::get('sige.Communications'),['class' => 'tooltip','title'=>Lang::get('sige.Communications')]) !!}
                            @else
                                {!! HTML::image('images/modules/communications.svg',Lang::get('sige.Communications'),['class' => 'tooltip','title'=>Lang::get('sige.Communications')]) !!}
                            @endif
                            <span>{{ Lang::get('sige.Communications') }}</span>
                        </a>
                        <em>New</em>
                    </li>
                @endcan
                @can('view',\SigeTurbo\Parents::class)
                    <li id="parents" class="sige-nav-module {{ setCurrentModule('parents') }}"
                        data-title="{{ Lang::get('sige.Parents') }}">
                        <a href="{{ URL::route('parents.dashboard') }}"
                           title="{{ Lang::get('sige.Parents') }}">
                            @if(setCurrentModule('parents') == 'current')
                                {!! HTML::image('images/modules/parents_active.svg',Lang::get('sige.Parents'),['class' => 'tooltip','title'=>Lang::get('sige.Parents')]) !!}
                            @else
                                {!! HTML::image('images/modules/parents.svg',Lang::get('sige.Parents'),['class' => 'tooltip','title'=>Lang::get('sige.Parents')]) !!}
                            @endif
                            <span>{{ Lang::get('sige.Parents') }}</span>
                        </a>
                    </li>
                @endcan
                <li id="roles" class="sige-nav-module {{ setCurrentModule('roles') }}"
                    title="{{ Lang::get('sige.Role') }}"
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
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ Lang::get('sige.SignOut') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
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
            @yield("dashboard")
        </div>
        <section class="sige-stream-content" id="sigeturbo_stream">
            <div class="stream">Hello World</div>
        </section>
    </section>
    <footer class="clearfix">
        <div class="sige-footer-content">
            <div>{{ Lang::get('sige.' . ucfirst(getCurrentRoute())) }}:
                <sigeturbo-version :version="version"></sigeturbo-version>
            </div>
        </div>
    </footer>
    <div style="display: none" id="serverName" data-server="{{ env("SERVER") }}">{{ env("SERVER") }}</div>
    <div style="display: none" id="sigeturboToken" data-token="{{ getUser()->api_token }}"></div>
</section>
@if (getCurrentRoute() == 'communications')
    {!! HTML::script(mix('/js/vendor/vendor.js')) !!}
    {!! HTML::script(mix('/js/Utils.js')) !!}
    {!! HTML::script(mix('js/' . getCurrentRoute() . '/' . getCurrentApp() .  '.js')) !!}
    @yield("socket")
    @yield("sigeturbo")
@else
    @yield("payments")
    @yield("vendor")
    @yield("angular")
    @yield("core")
    @yield("script")
    @yield("socket")
    @yield("sigeturbo")
@endif
</body>
</html>