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
        <section></section>
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
</body>
</html>