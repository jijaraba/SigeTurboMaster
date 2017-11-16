<!DOCTYPE html>
<html ng-app="">
<head>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield("title")</title>
    <link rel="stylesheet" href="/css/roles.css">
</head>
<body>
<div>
    <div class="sigeSecurityRoles" id="sigeSecurityRoles">
        @yield("roles")
    </div>
</div>
{!! HTML::script('/js/vendor/jquery.js') !!}
{!! HTML::script('/js/Roles.js') !!}
</body>
</html>