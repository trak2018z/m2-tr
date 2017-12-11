<style>
    img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%;
    }

    body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }

    table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%;
    }

    table td {
        font-family: sans-serif;
        font-size: 14px;
        vertical-align: top;
    }

    .body {
        background-color: #f6f6f6;
        width: 100%;
    }

    .container {
        display: block;
        margin: 0 auto !important;
        max-width: 580px;
        padding: 10px;
        width: 580px;
    }

    .content {
        box-sizing: border-box;
        display: block;
        margin: 0 auto;
        max-width: 580px;
        padding: 10px;
    }

    #logo-box {
        display: block;
        margin-bottom: 15px;
        text-align: center;
    }

    .our-logo {
        width: 50%;
        max-width: 180px;
    }

    .our-button {
        display: inline-block;
        padding: 12px 30px;
        color: #fff;
        border-radius: 30px;
        background-color: #8fca29;
        text-transform: uppercase;
        text-decoration: none;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .our-button:hover {
        color: white;
        background-color: #85ac3a;
    }

    .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%;
    }

    .wrapper {
        box-sizing: border-box;
        padding: 20px;
    }

    .content-block {
        padding-bottom: 10px;
        padding-top: 10px;
    }

    .footer {
        clear: both;
        margin-top: 10px;
        text-align: center;
        width: 100%;
    }

    .footer td, .footer p, .footer span, .footer a {
        color: #999999;
        font-size: 12px;
        text-align: center;
    }

    h1, h2, h3, h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        margin-bottom: 10px;
    }

    h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize;
    }

    p, ul, ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        margin-bottom: 15px;
    }

    p li, ul li, ol li {
        list-style-position: inside;
        margin-left: 5px;
    }

    a {
        color: #76a81e;
        text-decoration: underline;
    }

    a:hover {
        color: #8fd416;
    }

    hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        margin: 20px 0;
    }

    @media only screen and (max-width: 620px) {
        table[class=body] h1 {
            font-size: 28px !important;
            margin-bottom: 10px !important;
        }

        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
            font-size: 16px !important;
        }

        table[class=body] .wrapper,
        table[class=body] .article {
            padding: 10px !important;
        }

        table[class=body] .content {
            padding: 0 !important;
        }

        table[class=body] .container {
            padding: 0 !important;
            width: 100% !important;
        }

        table[class=body] .main {
            border-left-width: 0 !important;
            border-radius: 0 !important;
            border-right-width: 0 !important;
        }

        table[class=body] .btn table {
            width: 100% !important;
        }

        table[class=body] .btn a {
            width: 100% !important;
        }

        table[class=body] .img-responsive {
            height: auto !important;
            max-width: 100% !important;
            width: auto !important;
        }
    }
</style>
<table border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td>&nbsp;</td>
        <td class="container">
            <div class="content">
                <table class="main">
                    <tr>
                        <td class="wrapper">
                            <table border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <div id="logo-box" style="text-align:center;">
                                            {{--<a href="{{route('home')}}"><img
                                                        src="{{asset('img/logo-b-shape.png')}}" class="our-logo" style="height:80px; width: auto;"></a>--}}
                                        </div>
                                        <p>Witaj <b>{{ $user->name }}</b>,</p>
                                        <p>serdecznie dziękujemy za założenie konta w serwisie M2.</p>
                                        <p>Dzieli Cię tylko jeden krok, aby zacząć korzystać ze wszystkich funkcjonalności serwisu. Wystarczy, że aktywujesz swoje konto klikając w poniższy link.</p>
                                        <p style="text-align: center">
                                            <a id="pay-btn" href="{{$link}}" style="color: white;display: inline-block;padding: 15px 30px;border: 0;background-color: #8fca29;border-radius: 3px;text-transform: uppercase;text-decoration: none!important;
                                            font-size: 21px;font-weight: 600;color: #fff !important;-webkit-box-sizing: border-box;box-sizing: border-box;cursor: pointer;margin-top: 5px;">AKTYWUJ KONTO</a></p>
                                        <p style="text-align: center;"><small>Jeśli poniższy przycisk nie działa skopiuj i wklej poniższy link w przeglądarce:</small></p>
                                        <p style="text-align: center;">{{$link}}</p>
                                        <p></p>
                                        <p>Pozdrawiamy,<br/>Zespoł M2</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div class="footer">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="content-block">
                                <span class="apple-link"><a href="{{route('home')}}">M2</a> - Znajdź swoje idealne mieszkanie!</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>
