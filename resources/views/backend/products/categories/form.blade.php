@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Create Product Category
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="active">Product</li>
                <li class="active">Category</li>
                <li class="active">Create</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" id="productApp">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                @include('errors.form-error')
                <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Category</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">

                                <div class="box-body">
                                    {!! Form::model($category, [
                                        'route' => $category->exists ? ['admin.product.category.update', $category->id]:['admin.product.category.store'],
                                        'method' => $category->exists? 'put':'post',
                                        'files' => true
                                        ])
                                    !!}
                                    <div class="form-group">
                                        {!! Form::label('category') !!}
                                        {!! Form::text('category', null, ['class' => 'form-control', 'required']) !!}
                                    </div>
                                    <div>
                                        <button class="btn btn-primary pull-right" @click="addFind"> + </button>
                                        <div class="clearfix"></div>
                                    </div>
                                    <h4>Sub Categories</h4>
                                    <div class="form-group padding-left-40">
                                        {!! Form::text('subcategories[]', null, ['class' => 'form-control', 'required']) !!}
                                    </div>
                                    <div v-for="(find, index) in finds" class="form-group">
                                        <div class="input-group">
                                            {!! Form::text('subcategories[]', null, ['class' => 'form-control', 'v-model' => 'find.value', 'required']) !!}
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" @click="removeInput(index)"><i class="ion ion-close text-danger"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="box-footer text-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
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


@section('scripts')
    <script type="text/javascript" src="{{ webpack('build/productApp.js') }}"></script>
@endsection