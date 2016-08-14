@extends('artificer-login::base')

@section('content')
    <div class="header">Reset Password</div>
    
    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.password.reset') }}">

        <div class="body bg-gray">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-12 ">E-Mail Address art</label>

                <div class="col-md-12">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-12 ">Password</label>

                <div class="col-md-12">
                    <input id="password" type="password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="col-md-12 ">Confirm Password</label>
                <div class="col-md-12">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-btn fa-refresh"></i> Reset Password
                    </button>
                </div>
            </div>
        </div>
    
        <div class="footer">
            <button type="submit" class="btn bg-light-blue btn-block">Reset Password</button>
        </div>
        
    </form>

@endsection
