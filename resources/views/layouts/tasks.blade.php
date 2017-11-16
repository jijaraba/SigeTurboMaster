<!doctype html>
    <html lang="en" ng-app="{{ ucfirst(getCurrentRoute()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>@yield("title")</title>
        {!! HTML::style('css/default.css') !!}
        {!! HTML::style('css/tasks.css') !!}
        {!! HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css') !!}
        {!! HTML::style('css/vendor/vendor.css') !!}
        <base href="/{{ getCurrentRoute() }}"/>
    </head>
    <body>
        <header class="sige-task-header">
            <section class="header-container">
                <nav class="nav-container">
                    <ul class="display-horizontal col-100 menu">
                        <li class="col-20 logo">
                            {!! HTML::image('img/sigeturbo.png','Home') !!}
                        </li>
                        <li class="col-60 title">
                            <h4>Tareas, Planes de Apoyo y Exámenes</h4>
                        </li>
                        <li class="col-20 login">
                            <a href="{{ URL::route('login') }}" class="btn btn-green" data-intro="Ingresar a SigeTurbo" data-step="10">
                                {{ Lang::get('sige.SignIn') }}
                            </a>
                        </li>
                    </ul>
                </nav>
            </section>
        </header>
        <section class="sige-main-container-guest" id="sige-main-container">
            <div class="sige-content-guest" id="sige-content">
                @yield("content")
            </div>
        </section>
        <footer class="clearfix">
            <div class="sige-footer-content">
                <div>{{ Lang::get('sige.' . ucfirst(getCurrentRoute())) }}: v<span app-version></span></div>
            </div>
        </footer>
        <section id="sige_help" class="sige-help-intro fa fa-question-circle"><span>{{ Lang::get('sige.Help') }}</span></section>
        {!! HTML::script('/js/vendor/jquery.js') !!}
        @yield("vendor")
        @yield("angular")
        @yield("core")
        @yield("script")
        @yield("sigeturbo")
        <div style="display: none" id="serverName" data-server="{{ env("SERVER") }}">{{ env("SERVER") }}</div>
        <div style="display: none" id="sigeturboToken" data-token=""></div>
    </body>
</html>