<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title")</title>
    {!! HTML::style(mix('css/sigeturbo.css')) !!}
    {!! HTML::style(mix('css/view/groupdirector.css')) !!}
    {!! HTML::style(mix('css/vendor/vendor.css')) !!}
    {!! HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') !!}
    <base href="/view/groupdirector"/>
</head>
<body>
<section>
    <header class="main-header bkg-dark-blue">
        <section class="sige-main-container-header">
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
            <ul id="title">
                <li>
                    {{ Lang::get('sige.HomeroomTeacher') }}
                </li>
            </ul>
            <ul id="logo">
                <li>
                    <img src="/images/sigeturbo.svg" alt="SigeTurbo">
                </li>
            </ul>
        </section>
    </header>
    <section class="sige-main-container">
        @yield('content')
    </section>
    <footer></footer>
</section>
<div style="display: none" id="serverName" data-server="{{ env("SERVER") }}">{{ env("SERVER") }}</div>
<div style="display: none" id="sigeturboToken" data-token="{{ getUser()->api_token }}"></div>
@yield('vendor')
@yield('module')
{!! HTML::script(mix('js/vendor/socket.io.js')) !!}
{!! HTML::script(mix('/js/SigeTurbo.js')) !!}
{!! HTML::script(mix('/js/Stream.js')) !!}
</body>
</html>