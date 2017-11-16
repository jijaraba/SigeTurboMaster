<!DOCTYPE html>
<html ng-app="">
    <head>
        <meta charset="utf-8">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>@yield("title")</title>
        <link rel="stylesheet" href="/css/login.css">
    </head>
    <body>
        <div>
            <div class="sigeSecurityLogin" id="sigeSecurityLogin">
                @yield("login")
            </div>
            <section class="sigeturbo-app-store">
                <ul class="display-horizontal col-100">
                    <li class="col-50">
                        <img id="sigeturbo_apple" src="{{ getenv("ASSETS_SERVER") . "/assets/fa540875c89b.png" }}" alt="SigeTurbo - Apple">
                    </li>
                    <li class="col-50">
                        <img id="sigeturbo_google" src="{{ getenv("ASSETS_SERVER") . "/assets/1a68ac7935d3.png" }}" alt="SigeTurbo - Google">
                    </li>
                </ul>
            </section>
        </div>
        <div style="display: none">{{ env("SERVER") }}</div>
        <section class="sigeturbo-certificates">
            <table width="135" border="0" cellpadding="2" cellspacing="0" title="Click to Verify - This site chose Symantec SSL for secure e-commerce and confidential communications.">
                <tr>
                    <td width="135" align="center" valign="top">
                        <script type="text/javascript" src="https://seal.websecurity.norton.com/getseal?host_name=sigeturbo.thenewschool.edu.co&amp;size=L&amp;use_flash=NO&amp;use_transparent=YES&amp;lang=es"></script><br />
                    </td>
                </tr>
            </table>
        </section>
        {!! HTML::script('/js/vendor/jquery.js') !!}
        {!! HTML::script('/js/Login.js') !!}
    </body>
</html>