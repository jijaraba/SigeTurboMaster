<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield("title")</title>
    <link rel="stylesheet" href="/css/inventories.css">
</head>
<body>
    <section>
        <div class="sigeResourcesInventory">
            @yield("inventory")
        </div>
    </section>
    <section class="sigeturbo-certificates">
        <table width="135" border="0" cellpadding="2" cellspacing="0" title="Click to Verify - This site chose Symantec SSL for secure e-commerce and confidential communications.">
            <tr>
                <td width="135" align="center" valign="top">
                    <script type="text/javascript" src="https://seal.websecurity.norton.com/getseal?host_name=sigeturbo.thenewschool.edu.co&amp;size=L&amp;use_flash=NO&amp;use_transparent=YES&amp;lang=es"></script><br />
                </td>
            </tr>
        </table>
    </section>
    <div style="display: none">{{ env("SERVER") }}</div>
    {!! HTML::script('/js/vendor/jquery.js') !!}
</body>
</html>