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
                Orders
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="active">Order</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" id="orders">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding ">
                            <table class="table table-bordered">
                                <tr>
                                    <th>S. N.</th>
                                    <th>User Name</th>
                                    <th>Address</th>
                                    <th>Products Details</th>
                                    <th>T.Amount</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                                <tr v-for="(order, index) in orders" v-cloak>
                                    <td>@{{ index+1 }}</td>
                                    <td>@{{ order.user_name }}</td>
                                    <td>@{{ order.shipping_address || '-'}}</td>
                                    <td>
                                        <table class="table">
                                            <tr>
                                                <td>Title(Q)</td>
                                                <td>Code</td>
                                                <td>Price</td>
                                                <td>Size</td>
                                            </tr>
                                            <tr v-for="product in order.products">
                                                <td>@{{  product.title }} (@{{ product.pivot.quantity }})</td>
                                                <td>@{{  product.code }}</td>
                                                <td>@{{  product.price }}</td>
                                                <td>@{{  product.pivot.size }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td> NRs. @{{ order.total_amount }}</td>
                                    <td>@{{ order.billing_address }}</td>
                                    <td>@{{ order.phone_number || '-' }}</td>
                                    <td>
                                        <a style="padding-right:10px;"
                                           :href="'/orders/' + order.id + '/delivered'"
                                           title="Move To Delivered">
                                            <i class="fa fa-check-circle"></i>
                                        </a>
                                        <a class="text-danger" :href="'/orders/' + order.id + '/confirm'" >
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>

                    <vue-pagination v-bind:pagination="pagination"
                                    v-on:click.native="getPaginatedOrders()"
                                    :offset="4">
                    </vue-pagination>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


@section('scripts')
    <script type="text/javascript" src="{{ webpack('build/orderApp.js') }}"></script>
@endsection