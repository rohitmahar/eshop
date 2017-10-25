@extends('layouts.app')

@section('content')
    <body class="hold-transition login-page text-center">
        <div class="login-box">
            <div class="login-logo">
                <a href="{{ url('/') }}"><b>Estylesta Login</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body text-center">
                <h4>Sign in to start your session</h4>
                <br>
                <p class="login-box-msg">
                    We’ll never post to Twitter or Facebook without your permission.
                </p>
                {{--<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="email">Email Or Phone</label>
                        <input  type="email"
                                class="form-control"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                        >
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-feedback form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Password</label>
                        <input
                                type="password"
                                class="form-control"
                                name="password"
                                required
                        >
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>--}}
                <div class="social-auth-links text-center">
                    {{--<p>- OR -</p>--}}
                    <a href="{{ route('oauth.facebook') }}" class="btn btn-block btn-social btn-facebook btn-flat">
                        <i class="fa fa-facebook"></i> Continue With Facebook
                    </a>
                    <a href="{{ route('oauth.google') }}" class="btn btn-block btn-social btn-google btn-flat">
                        <i class="fa fa-google-plus text-left"></i> Continue With Google
                    </a>
                    <a href="{{ route('oauth.twitter') }}" class="btn btn-block btn-social btn-twitter btn-flat">
                        <i class="fa fa-twitter"></i> Continue With Twitter
                    </a>
                </div>
                <!-- /.social-auth-links -->{{--
                <a href="{{ url('/password/reset') }}">I forgot my password</a><br>
                <a href="{{ url('/register') }}" class="text-center">Register a new membership</a>--}}
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
        <a href="{{ route('homepage') }}">Go To HomePage !</a>
    </body>
@endsection
