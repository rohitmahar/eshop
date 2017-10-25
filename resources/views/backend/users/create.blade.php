@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        @if(Session::has('message'))
            <div class="alert alert-success">
                <strong>Success!</strong> {{ Session::get('message') }}
            </div>
        @endif
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Admin
                <small>Create Admin</small>
            </h1>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    @include('errors.form-error')
                    <div class="box box-primary">
                        <form role="form" method="POST" action="{{ url('/admin/register') }}">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="control-label">Name</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                 <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                    @endif
                                </div>
                                <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="control-label">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                    @endif
                                </div>
                                <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                 <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                    @endif
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="password-confirm" class="control-label">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
