<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield("title")</title>
    {!! HTML::style(mix('css/sigeturbo.css')) !!}
</head>
<body>
<div>
    <div class="sige-error-container" id="sigeErrorContainer">
        @yield("error")
    </div>
</div>
{{ HTML::script('/js/vendor/jquery/jquery.js') }}
{{ HTML::script('/js/vendor/modernizr/modernizr.js') }}
{{ HTML::script('/js/vendor/jquery-easing/jquery.easing.js') }}
</body>
</html>