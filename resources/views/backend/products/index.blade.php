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
                Products
                <small>Available Products</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="active">products</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" id="productApp">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <a href="{{ route('admin.product.create') }}">
                                <button class="btn btn-primary btn-flat">
                                    <i class="fa fa-plus"></i> Add Product
                                </button>
                            </a>
                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control pull-right"
                                           placeholder="Search" v-model="query" @change="search()">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default" v-cloak v-if="!loading" @click="
                                        search()">
                                        <i class="fa fa-search"></i>
                                        </button>
                                        <button class="btn btn-default" type="button" disabled="disabled" v-cloak
                                                v-if="loading">
                                            searching...
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-danger" v-cloak role="alert" v-if="error">
                            @{{ error }}
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Published</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody v-if="products.length">
                                    <tr v-for="product in products" v-cloak>
                                        <td><img :src="product.image" alt="" width="50px" height="50px">
                                        </td>
                                        <td>@{{ product.title }}</td>
                                        <td>@{{ product.price }}</td>
                                        <td>@{{ product.description }}</td>
                                        <td>@{{ product.published ? "Yes":"No" }}</td>
                                        <td>
                                            <a :href="`/admin/products/edit/${product.id}`">
                                                <i class="fa fa-edit text-warning"></i>
                                            </a>
                                            <a :href="`/admin/products/show/${product.id}`">
                                                <i class="fa fa-eye "></i>
                                            </a>
                                            <form :action="`/admin/products/delete/${product.id}`" method="post">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{ csrf_field() }}
                                                <button type="submit"
                                                        onclick="return confirm('Are you sure?')">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <vue-pagination v-bind:pagination="pagination"
                                    v-on:click.native="getProducts()"
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
    <script type="text/javascript" src="{{ webpack('build/productApp.js') }}"></script>
@endsection