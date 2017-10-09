<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Admin | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        {!! \Mascame\Artificer\Artificer::assetManager()->css() !!}

        <style>
            .header {
                border-radius: 4px 4px 0 0;
                background: #3c8dbc;
                box-shadow: inset 0 -3px 0 rgba(0,0,0,.2);
                padding: 20px 10px;
                text-align: center;
                font-size: 26px;
                font-weight: 300;
                color: #fff;
            }

            body {
                display: flex;
                height: 100vh;
                justify-content: center;
                align-content: center;
                background: #222!important;
            }

            .form-box {
                flex: 0 1 360px;
                margin: 0;
                align-self: center;
                color: #444444;
            }

            .form-box .body {
                padding: 10px 20px;
                background: #fff;
                color: #444;
            }

            .form-box input {
                border: #fff;
            }

            .form-group {
                margin-top: 20px;
                margin-bottom: 15px;
            }

            .bg-gray {
                background-color: #eaeaec!important;
            }

            .footer {
                padding: 10px 20px;
                background: #fff;
                color: #444;
                border-radius: 0 0 4px 4px;
            }

            .footer .row {
                margin-top: 5px;
            }
        </style>

    </head>
    <body>

        <div class="form-box">
            @yield('content')
        </div>

    </body>
</html>