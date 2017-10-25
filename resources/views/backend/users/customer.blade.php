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
                Customers
                <small>Logged in Customers</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li>Users</li>
                <li class="active">Customers</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content" id="customers">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <a href="{{ route('admins.index') }}">
                                <button class="btn btn-primary btn-flat">
                                     Go To Admin
                                </button>
                            </a>
                            <div class="box-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control pull-right"
                                           placeholder="Search" v-model="query" @change="search()">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default" v-cloak v-if="!loading" @click="search()">
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <button class="btn btn-default" type="button" disabled="disabled" v-cloak v-if="loading">
                                            searching
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="alert alert-danger" v-cloak role="alert" v-if="error">
                            @{{ error }}
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Created At</th>
                                </tr>
                                <tr v-for="user in customers">
                                    <td>@{{ user.name }}</td>
                                    <td>@{{ user.email }}</td>
                                    <td>@{{ user.phone }}</td>
                                    <td>@{{ user.created_at }}</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <vue-pagination  v-bind:pagination="pagination"
                  v-on:click.native="getCustomers(pagination.current_page, pagination.per_page)"
                  :offset="4">
            </vue-pagination>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ webpack('build/customerApp.js') }}"></script>
@endsection