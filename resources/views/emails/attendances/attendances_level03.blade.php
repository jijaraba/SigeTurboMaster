<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The New School | {{ Lang::get('sige.AttendancesLevel03') }}</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <style type="text/css">
        /*////// RESET STYLES //////*/
        body {
            height: 100% !important;
            margin: 0;
            padding: 0;
            width: 100% !important;
            font-family: "Montserrat", Helvetica Neue , Helvetica, Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
        }

        img, a img {
            border: 0;
            outline: none;
            text-decoration: none;
        }

        h1, h2, h3, h4, h5, h6 {
            margin: 0;
            padding: 0;
        }

        p {
            margin: 1em 0;
            font-family: "Montserrat", Helvetica Neue , Helvetica, Arial, sans-serif;
        }

        span {
            font-family: "Montserrat", Helvetica Neue , Helvetica, Arial, sans-serif;
        }

        ul, li {
            list-style: none;
        }

        /*////// CLIENT-SPECIFIC STYLES //////*/

        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        #outlook a {
            padding: 0;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        body, table, td, p, a, li, blockquote {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /*////// GENERAL STYLES //////*/
        h1, h2, h3 {
            font-family: "Montserrat", Helvetica Neue , Helvetica, Arial, sans-serif;
        }

        h1, h1 a {
            color: #D83826;
            font-size: 44px;
            font-weight: 100;
            line-height: 115%;
            text-align: left;
        }

        h2, h2 a {
            color: #606060;
            font-size: 36px;
            font-weight: 100;
            line-height: 100%;
            text-align: left;
        }

        h3, h3 a {
            color: #D83826;
            font-size: 30px;
            font-weight: 100;
            line-height: 115%;
            text-align: left;
        }

        a {
            text-decoration: none;
            color: #fff;
        }

        body {
            background-color: #F0F0F0;
        }

        .flexible {
            width: 600px;
        }

        /*////// Payments //////*/

        /*////// MOBILE STYLES //////*/
        @media only screen and (max-width: 480px) {
            img[id="full"] {
                width: 100% !important;
                max-width: 600px !important;
            }

            .responsive {
                width: 100% !important;
                max-width: 480px !important;
                margin-left: 0px !important;
                margin-right: 0px !important;
                border-top-left-radius: 0px !important;
                border-top-right-radius: 0px !important;
                border-bottom-left-radius: 0px !important;
                border-bottom-right-radius: 0px !important;
            }

            table[id="wrapper"] {
                width: 100% !important;
                max-width: 480px !important;
                margin-left: 0px !important;
                margin-right: 0px !important;
            }

            table[id="header"] {
                border-top-left-radius: 0px !important;
                border-top-right-radius: 0px !important;
            }

            table[id="content"] {
                width: 100% !important;
                max-width: 480px !important;
                margin-left: 0px !important;
                margin-right: 0px !important;
                border-bottom-left-radius: 0px !important;
                border-bottom-right-radius: 0px !important;
            }

            img[id="logo"] {
                padding-left: 12% !important;
                width: 80px !important;
                height: 80px !important;
            }

            img[id="full"] {
                max-width: 480px !important;
                width: 100% !important;
                height: auto !important;
            }

            h1 {
                font-size: 21px !important;
            }

            h2 {
                font-size: 17px !important;
            }

            h3 {
                font-size: 17px !important;
            }

            h4 {
                font-size: 14px !important;
            }

            p {
                font-size: 14px !important;
            }

            .contact-info p {
                font-size: 12px !important;
            }

            .flexible {
                width: 100%;
            }
        }
    </style>
</head>
<body style="margin: 0;padding: 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color:#F0F0F0;height: 100%;width: 100%;">
<center>
    <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%"
           style="background:#edeff0;font-family:Helvetica,sans-serif;height:100% !important;margin:0;padding:0;width:100% !important;font-size:14px;color:#9ba6b0;">
        <tr>
            <td align="center" valign="top"
                style="mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 0;padding: 0;height: 100%;width: 100%;">
                <!-- // BEGIN EMAIL -->
                <table id="wrapper" class="responsive" border="0" cellpadding="0" cellspacing="0"
                       style="width:90%;max-width:600px;margin-right:5%;margin-left:5%;display:block;">
                    <tr>
                        <td align="center" valign="top"
                            style="padding-top:20px;border-top-left-radius:5px;border-top-right-radius: 5px;">
                            <!-- // BEGIN LOGO -->
                            <table id="header" class="flexible" border="0" cellpadding="0" cellspacing="0"
                                   style="background-color:#FFF;border-top-left-radius:5px;border-top-right-radius: 5px;">
                                <tr>
                                    <td align="center">
                                        <img id="full"
                                             style="width:100%;max-width:600px;border-top-left-radius:5px;border-top-right-radius: 5px;"
                                             src="{{ env("ASSETS_SERVER") }}/assets/email/SigeTurboHeaderGuardNotification.png"
                                             alt="Nuevas Funcionalidades"
                                             style="width:100%;max-width:600px;height:auto;border:0;line-height:100%;text-decoration:none;text-align:center;padding:0;"/>
                                    </td>
                                </tr>
                            </table>
                            <!-- END LOGO \\ -->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <!-- // BEGIN PREHEADER -->
                            <table id="content" class="flexible" border="0" cellpadding="0" cellspacing="0"
                                   style="background-color:#FFF;border-top-left-radius:5px;border-top-right-radius: 5px;">
                                <tr>
                                    <td align="center"
                                        style="vertical-align:top;border-collapse:collapse;padding-top:3%;padding-right:7%;padding-left:7%;">
                                        <!-- // BEGIN INFO -->
                                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%">
                                            <tr>
                                                <td style="vertical-align:top;color:#8d9aa5;font-size:14px;line-height:150%;text-align:left;border-top: 1px solid #e2e5e8;padding-top:20px;padding-bottom:10px;border-collapse:collapse;">
                                                    <section class="sige-payments-checkout">
                                                        <section
                                                                style="position: relative;background: #f9fafa;padding: 5px;border-radius: 5px; box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);height: auto;">
                                                            <article style="width: 100%;margin: 0px auto;">
                                                                <header style="z-index: 1; text-align: center">
                                                                    <h2 style="padding-top: 20px;border-bottom: none;text-align: center;">
                                                                        CONTROL DE ASISTENCIA</h2>
                                                                    <img style="text-align:center;margin:0px auto;width: 180px;"
                                                                         src="{{env('ASSETS_SERVER')}}/img/modules/attendance_control.svg"/>
                                                                </header>
                                                                <section>
                                                                    <h2 style="padding-top: 10px;border-bottom: none;text-align: center;color: #8d9aa5;font-size: 2.1em;">
                                                                        Nivel Bachillerato
                                                                    </h2>
                                                                    @if(count($attendances)> 0)
                                                                        @foreach ($attendances as $attendance)
                                                                            <ul style="width: 95%;display: flex;flex-direction: row;justify-content: flex-start;flex-flow: row wrap;">
                                                                                <li style="width:20%;flex: auto;float: left;">
                                                                                    <div style="width: 48px;height: 48px;border-radius: 50%;padding: 3px;background-color:#45AFA8;">
                                                                                        <img style="border-radius: 50%;max-width: 100%" src="{{env('ASSETS_SERVER')}}/img/users/{{ $attendance->photo }}" alt="{{ $attendance->student }}">
                                                                                    </div>
                                                                                </li>
                                                                                <li style="width: 80%;flex: auto;float: left;">
                                                                                    <p style="padding: 0px;text-align: left;font-size: 0.85em;margin: 0px 25px 25px 25px;color: #657380;">
                                                                                        <span style="color:#8d9aa5;">{{ $attendance->student }}</span><br>
                                                                                        <span style="color:#8d9aa5;">{{ $attendance->group }}</span><br>
                                                                                        <span style="color:#8d9aa5;">{{ $attendance->subject }}</span><br/>
                                                                                    </p>
                                                                                </li>
                                                                            </ul>
                                                                        @endforeach
                                                                    @else
                                                                        <p style="padding: 0px;text-align: center;font-size: 0.85em;margin: 25px;color: #657380;">
                                                                            <span style="color:#8d9aa5;">No se reportaron faltas de asistencia</span>
                                                                        </p>
                                                                    @endif
                                                                </section>
                                                                <footer style="position: relative;bottom: 5px;min-height: inherit;top: inherit;width: 100%;">
                                                                    <div style="height: 40px;margin: 10px 20px;padding-top: 15px;border-top: 1px solid #eee;color: #8d9aa5;text-align: center;font-size: 0.8em;">
                                                                        THE NEW SCHOOL
                                                                    </div>
                                                                </footer>
                                                            </article>
                                                        </section>
                                                    </section>
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- END INFO \\ -->
                                    </td>
                                </tr>
                            </table>
                            <!-- END PREHEADER \\ -->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">
                            <!-- // BEGIN BODY -->
                            <table id="content" class="flexible" border="0" cellpadding="0" cellspacing="0"
                                   style="background-color:#FFF;border-bottom-left-radius:5px;border-bottom-right-radius:5px;">
                                <!-- GENERIC TEXT BLOCK -->
                                <tr>
                                    <td align="center"
                                        style="vertical-align:top;border-collapse:collapse;padding-top:3%;;padding-right:7%;padding-left:7%;">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="vertical-align:top;color:#8d9aa5;font-size:14px;line-height:150%;text-align:left;border-top: 1px solid #e2e5e8;padding-top:20px;padding-bottom:10px;border-collapse:collapse;">
                                                    <h4 style="font-family:'Open Sans',Helvetica,sans-serif;color:#384047;display:block;font-size:16px;font-weight:bold;line-height:130%;letter-spacing:normal;margin-right:0;margin-left:0;margin-top:15px;margin-bottom:15px;text-align:left;">
                                                        ¿Alguna Pregunta?</h4>
                                                    <p style="font-family:'Open Sans',Helvetica,sans-serif;line-height:130%;margin-top:15px;margin-bottom:15px;">
                                                        Por favor no dude en comunicarse con nuestra área de sistemas en
                                                        caso de presentarse cualquier inquietud respecto al
                                                        funcionamiento de la plataforma <strong>SigeTurbo</strong> (054)
                                                        5207270 Ext 207
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <!-- END BODY \\ -->
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- // BEGIN FOOTER -->
                            <table class="footer" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                <tr>
                                    <td class="contact-info"
                                        style="text-align:center;vertical-align:top;padding-top:25px;border-collapse:collapse;">
                                        <p style="font-family:Helvetica,sans-serif;line-height:160%;font-family:Helvetica,sans-serif;color:#b7c0c7;font-size:12px;margin-top:0;margin-bottom:0;">
                                            &copy; The New School
                                        </p>
                                        <p style="font-family:Helvetica,sans-serif;line-height:160%;color:#b7c0c7;font-size:12px;margin-top:0;margin-bottom:0;">
                                            <a href="mailto:hello@thenewschool.edu.co"
                                               style="font-weight:bold;text-decoration:none;color:#9ba6b0;">hello@thenewschool
                                                .edu.co</a>&nbsp;&nbsp;<span style="color:#b7c0c7;">|</span>&nbsp;&nbsp;
                                            <span style="color:#b7c0c7;font-weight:bold">(054)5207270</span>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <table class="footer" border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                <tr>
                                    <td style="vertical-align:top;text-align:center;padding-top:30px;padding-bottom:5px;border-collapse:collapse;">
                                        <a href="http://www.twitter.com/thenewschool95" style="text-decoration:none;">
                                            <img width="39" height="42"
                                                 style="width:39px;height:42px;border:0;height:auto;line-height:100%;outline:none;text-decoration:none;"
                                                 src="{{ getenv("ASSETS_SERVER") }}/assets/email/footer-twitter2x.png">
                                        </a>
                                        <a href="http://www.youtube.com/user/thenewschool1995"
                                           style="text-decoration:none;">
                                            <img width="39" height="42"
                                                 style="bwidth:39px;height:42px;order:0;height:auto;line-height:100%;outline:none;text-decoration:none;"
                                                 src="{{ getenv("ASSETS_SERVER") }}/assets/email/footer-youtube2x.png">
                                        </a>
                                        <a href="http://www.facebook.com/thenewschool95" style="text-decoration:none;">
                                            <img width="39" height="42"
                                                 style="width:39px;height:42px;border:0;height:auto;line-height:100%;outline:none;text-decoration:none;"
                                                 src="{{ getenv("ASSETS_SERVER") }}/assets/email/footer-facebook2x.png">
                                        </a>
                                        <a href="http://http://plus.google.com/111830565448742272689"
                                           style="text-decoration:none;">
                                            <img width="39" height="42"
                                                 style="width:39px;height:42px;border:0;height:auto;line-height:100%;outline:none;text-decoration:none;"
                                                 src="{{ getenv("ASSETS_SERVER") }}/assets/email/footer-google2x.png">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            <!-- END FOOTER \\ -->
                        </td>
                    </tr>
                </table>
                <!-- END EMAIL // -->
            </td>
        </tr>
    </table>
</center>
</body>
</html>