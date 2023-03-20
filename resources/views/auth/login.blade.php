@extends('layouts.login')

@section('login')
<form method="POST" action="{{ route('login') }}" class="auth-form login-form">
    @csrf
    <div class="email mb-3">
        <label class="sr-only" for="signin-email">Email</label>
        <input id="signin-email"type="email" class="form-control signin-email @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email address" required="required">
        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
    </div><!--//form-group-->
    <div class="password mb-3">
        <label class="sr-only" for="signin-password">Password</label>
        <input id="signin-password" type="password" class="form-control signin-password @error('password') is-invalid @enderror" name="password" required="required">
        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        <div class="extra mt-3 row justify-content-between">
            <div class="col-6">
                {{-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="RememberPassword">
                    Remember me
                    </label>
                </div> --}}
            </div><!--//col-6-->
            <div class="col-6">
               {{--  <div class="forgot-password text-end">
                    @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
                </div> --}}
            </div><!--//col-6-->
        </div><!--//extra-->
    </div><!--//form-group-->
    <div class="text-center text-white">
        <button type="submit" class="btn btn-primary text-white btn-block">
            {{ __('Connexion') }}
        </button>


    </div>
</form>
@endsection
