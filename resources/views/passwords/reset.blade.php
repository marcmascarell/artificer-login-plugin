@extends('artificer-login::base')

@section('content')
    <div class="header">Reset Password</div>
    
    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.password.reset') }}">

        <div class="body bg-gray">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <input id="email" type="email" placeholder="E-Mail Address" class="form-control" name="email" value="{{ $email or old('email') }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <input id="password" type="password" placeholder="Password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

        </div>
    
        <div class="footer">
            <button type="submit" class="btn bg-light-blue btn-block">Reset Password</button>
        </div>
        
    </form>

@endsection
