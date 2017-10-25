@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @if(Session::has('message'))
            <div class="alert alert-success">
                <strong>Success!</strong> {{ Session::get('message') }}
            </div>
        @endif

        <section class="content-header">
            <h1>
                Product Categories
                <small>Available Categories</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="active">categories</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <ul class="list-group">
                                <li class="list-group-item text-right">
                                    <a href="{{ route('admin.product.category.create') }}">
                                        <button class="btn btn-success">+ Add Categories</button>
                                    </a>
                                </li>
                                @foreach($categories as $category)
                                    <li class="list-group-item">
                                        <h4>{{ $category->title }}</h4>
                                        <div class="pull-right">
                                            <a href="{{ route('admin.product.category.edit', $category->id) }}">
                                                <button class="btn btn-warning"><i class="ion ion-edit"></i></button>
                                            </a>
                                            {!! Form::open(['method' => 'delete', 'route' => ['admin.product.category.delete', $category->id], 'class' => 'pull-right']) !!}
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="ion ion-close"></i>
                                                </button>
                                            {!! Form::close() !!}
                                        </div>
                                        <ul>
                                            @foreach($category->subcategories as $subcategory)
                                                <li>{{ $subcategory->title }}</li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
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