<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Admin | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        {!! \Mascame\Artificer\Artificer::assetManager()->css() !!}
        {!! \Mascame\Artificer\Artificer::assetManager()->js() !!}

    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>

            {!! Form::open(array('route' => 'admin.login')) !!}
                <div class="body bg-gray">

                    @if($errors->has())
                       @foreach ($errors->all() as $error)
                          <div>{{ $error }}</div>
                      @endforeach
                    @endif

                    <div class="form-group">
                        {!! Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username or email')) !!}

                    </div>
                    <div class="form-group">
                        {!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) !!}
                    </div>

                </div>

                <div class="footer">
                    <button type="submit" class="btn bg-light-blue btn-block">Sign me in</button>

                    <div class="row">
                        <div class="col-sm-6">
                            <input type="checkbox" name="remember"> Remember Me
                        </div>

                        <div class="col-sm-6">
                            <a class="" href="{{ route('admin.password.reset.show') }}">Forgot Your Password?</a>
                        </div>

                    </div>
                </div>

            {!! Form::close() !!}
        </div>
    </body>
</html>