@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sliders
                <small>Delete Confirmation</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li>Sliders</li>
                <li>Confirm</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        Are you sure to delete this slider ?
                        {!! Form::model($slider, ['method' => 'delete' , 'route' => ['sliders.destroy',$slider->id] ]) !!}
                        <button class="btn btn-danger pull-left">Yes Delete This Slider</button>
                        {!! Form::close() !!}
                        <a href="{{ route('sliders.index') }}"><button class="btn btn-default">Back To Return</button></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection