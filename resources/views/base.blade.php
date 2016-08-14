<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Admin | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        {!! \Mascame\Artificer\Artificer::assetManager()->css() !!}
        {!! \Mascame\Artificer\Artificer::assetManager()->js() !!}

        <style>
            body {
                display: flex;
                justify-content: center;
                align-content: center;
            }

            .form-box {
                flex: 0 1 360px;
                margin: 0;
                align-self: center;
            }
        </style>

    </head>
    <body class="bg-black">

        <div class="form-box">
            @yield('content')
        </div>

    </body>
</html>