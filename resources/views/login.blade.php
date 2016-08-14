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

                    {{--<div class="form-group">--}}
                        {{--<input type="checkbox" name="remember_me"/> Remember me--}}
                    {{--</div>--}}
                </div>

                <div class="footer">                                                               
                    <button type="submit" class="btn bg-light-blue btn-block">Sign me in</button>
                    
                    {{--<p><a href="#">I forgot my password</a></p>--}}
                    {{----}}
                    {{--<a href="register.html" class="text-center">Register a new membership</a>--}}
                </div>

            {!! Form::close() !!}

            {{--<div class="margin text-center">--}}
                {{--<span>Sign in using social networks</span>--}}
                {{--<br/>--}}
                {{--<button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>--}}
                {{--<button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>--}}
                {{--<button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>--}}

            {{--</div>--}}
        </div>


        <!-- jQuery 2.0.2 -->
        {{--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>--}}
        {{--<!-- Bootstrap -->--}}
        {{--<script src="../../js/bootstrap.min.js" type="text/javascript"></script>        --}}

    </body>
</html>