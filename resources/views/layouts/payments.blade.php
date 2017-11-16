<!doctype html>
<html lang="en" ng-app="{{ ucfirst(getCurrentRoute()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Payments</title>
        {!! HTML::style('css/default.css') !!}
        {!! HTML::style('css/payments.css') !!}
        {!! HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css') !!}
        {!! HTML::style('css/vendor/vendor.css') !!}
        <link href='https://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>
        <base href="/{{ getCurrentRoute() }}"/>
    </head>
    <body>
        @yield("content")
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