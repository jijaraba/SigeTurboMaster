<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }} - {{ Lang::get('sige.Unauthorized') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    {!! HTML::style(mix('css/sigeturbo.css')) !!}
    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            background-color: white;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }

        .payment {
            color: #53BBB4;
            font-size: 1.1em;
            font-family: 'Montserrat Regular';
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content" style="margin: 0px auto">
        <img src="/images/sigeturbo.svg" alt="">
        <div class="title">{{ Lang::get('sige.Unauthorized') }}</div>
        @if($exception->getMessage() == "payments_pending")
            @include('../layouts/partials/flashmessage')
            <a href="{{route('parents.payments.index')}}" class="payment">Ir Módulo Pagos</a>
        @endif
        @if($exception->getMessage() == "enrollment_error")
            @include('../layouts/partials/flashmessage')
            <a href="{{URL::previous()}}" class="payment">{{ Lang::get('sige.Back') }}</a>
        @endif
    </div>
</div>
</body>
</html>
