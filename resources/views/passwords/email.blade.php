@extends('artificer-login::base')

@section('content')
    
    <div class="header">Reset Password</div>

    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.password.reset.email') }}">

        <div class="body bg-gray">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
    
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="col-md-12">
                        <input id="email" type="email" placeholder="E-Mail Address" class="form-control" name="email" value="{{ old('email') }}">
    
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

        </div>
    
        <div class="footer">
            <button type="submit" class="btn bg-light-blue btn-block">Send Password Reset Link</button>
        </div>
    
    </form>

@endsection
