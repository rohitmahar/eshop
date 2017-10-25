@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Slider
                <small>Individual Slider Info</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="active">Sliders</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <img src="{{ $slider->image }}" alt="" class="img-responsive">
                        </li>
                        <li class="list-group-item">
                            Slider Title : {{  $slider->title }}
                        </li>
                        <li class="list-group-item">
                            Slider Description : {{ $slider->description }}
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection