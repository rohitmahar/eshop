@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Product
                <small>Show</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="active">Product</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <img src="{{ $product->image }}" alt="" class="img-responsive">
                        </li>
                        <li class="list-group-item">
                            Title : {{  $product->title }}
                        </li>
                        <li class="list-group-item">
                            Description : {{ $product->description }}
                        </li>
                        <li class="list-group-item">
                            Code : {{ $product->code }}
                        </li>
                        <li class="list-group-item">
                            Price : {{ $product->price }}
                        </li>
                        <li class="list-group-item">
                            Published : {{ $product->published?"Yes":"No" }}
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection