@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Settings
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="active">Settings</li>
                <li class="active">Update</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                @include('errors.form-error')
                    @if(Session::has('message'))
                        <div class="alert alert-success">
                            <strong>Success!</strong> {{ Session::get('message') }}
                        </div>
                @endif
                <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Setting</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        {!! Form::model($setting, ['method' => 'put', 'route' => ['settings.update', $setting->id]]) !!}
                        <div class="box-body">
                            <div class="form-group">
                                {!! Form::label('sitename') !!}
                                {!! Form::text('sitename', null, ['class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('phone') !!}
                                {!! Form::text('phone', null, ['class' => 'form-control', 'rows' => 4, 'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email','Email') !!}
                                {!! Form::text('email', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('address','Site Address') !!}
                                {!! Form::text('address', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-right">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}
                    </div>
                    <!-- /.box -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection