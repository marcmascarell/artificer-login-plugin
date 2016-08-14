Click here to reset your password: <a href="{{ $link = route('admin.password.reset.show', ['token' => $token]).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
