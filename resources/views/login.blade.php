@extends('artificer-login::base')

@section('content')
    <div class="header">Sign In</div>

    <form action="{{ route('admin.login') }}" method="POST">
        {{ csrf_field() }}

        <div class="body bg-gray">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div>
                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" autofocus placeholder="Username or email">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="footer">
            <button type="submit" class="btn bg-light-blue btn-block">Sign me in</button>

            <div class="row">
                <div class="col-sm-6">
                    <input type="checkbox" name="remember"> Remember Me
                </div>

                <div class="col-sm-6 text-right">
                    <a class="" href="{{ route('admin.password.reset.show') }}">Forgot Your Password?</a>
                </div>

            </div>
        </div>
    </form>
@endsection