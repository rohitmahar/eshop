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
                Sliders
                <small>Available Slides</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="active">Sliders</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content" id="sliders">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <a href="{{ route('sliders.create') }}">
                                <button class="btn btn-primary btn-flat">
                                    <i class="fa fa-plus"></i> Add Slider
                                </button>
                            </a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>

                                <tr v-for="slider in sliders">
                                    <td><img :src="slider.image" alt="" width="40px" height="40px"></td>
                                    <td>@{{ slider.title }}</td>
                                    <td>@{{ slider.description }}</td>
                                    <td>
                                        <a :href="'/backend/sliders/'+ slider.id + '/edit'"
                                           class="text-warning">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a :href="'/backend/sliders/' + slider.id"
                                           class="text-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a :href="'/backend/sliders/'+ slider.id +'/confirm'"
                                           class="text-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ webpack('build/sliderApp.js') }}"></script>
@endsection