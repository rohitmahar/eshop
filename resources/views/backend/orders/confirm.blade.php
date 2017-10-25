@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Order
                <small>Delete Confirmation</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li>Orders</li>
                <li>Confirm</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        Are you sure to delete this Order ?
                        {!! Form::model($order, ['method' => 'delete' , 'route' => ['admin.orders.destroy',$order->id] ]) !!}
                            <button class="btn btn-danger pull-left">Yes Delete This Order</button>
                        {!! Form::close() !!}
                        <a href="{{ route('admin.product.orders') }}"><button class="btn btn-default">Back</button></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection