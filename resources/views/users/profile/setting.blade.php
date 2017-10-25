@extends('users.layouts.master')

@section('title', 'Home Page')

@section('content')
    <div class="men">
        <div class="container">
            <h3 class="text-center cart-title"><span>My Profile Setting</span></h3>
            @if(Session::has('message'))
                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-6 col-md-offset-3 order-form">
                    {!! Form::model(auth()->user(), ['method' => 'put', 'route' => ['profile.update', auth()->id()]]) !!}
                    <h4 class="text-center bottom-30"><span>Basic Information</span></h4>
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control order-control']) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email') !!}
                            {!! Form::email('email', null, ['class' => 'form-control order-control']) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            {!! Form::label('phone') !!}
                            {!! Form::text('phone', null, ['class' => 'form-control order-control']) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Update Profile', ['class' => 'btn btn-primary pull-right']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
                {{--<div class="col-md-4 col-md-offset-1 order-form">
                    <form role="form" method="POST" action="{{ route('password.update') }}">
                        {!!  csrf_field() !!}
                        <h4 class="text-center bottom-30"><span>Change Password</span></h4>
                        <div class="form-group {{ $errors->has('old_password') ? ' has-error' : '' }}">
                            <label for="old_password" class="control-label">Current Password</label>
                            <input id="old_password" type="password" class="form-control order-control" name="old_password" required>
                            @if ($errors->has('old_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('old_password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">Password</label>
                            <input id="password" type="password" class="form-control order-control" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="control-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control order-control" name="password_confirmation" required>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>--}}
            </div>
        </div>
    </div>
@endsection