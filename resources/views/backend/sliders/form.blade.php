@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Create Slider
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="active">Slider</li>
                <li class="active">Create</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    @include('errors.form-error')
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Slider</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        {!! Form::model($slider, [
                            'method'=> $slider->exists ? 'put' : 'post',
                            'route' => $slider->exists ? ['sliders.update',$slider->id] : ['sliders.store'],
                            'files' => true
                            ])
                        !!}
                            <div class="box-body">
                                <div class="form-group">
                                    {!! Form::label('title') !!}
                                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('description') !!}
                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('image','Choose Image') !!}
                                    {!! Form::file('image', ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer text-right">
                                {!! Form::submit($slider->exists ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
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