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
                Admin
                <small>Admin Section</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li>Users</li>
                <li class="active">Admin</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content" id="admins">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <a href="{{ route('admins.create')}}">
                                <button class="btn btn-primary btn-flat">
                                    Create Admin
                                </button>
                            </a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Created At</th>
                                </tr>
                                <tr v-for="user in admins">
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
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


@section('scripts')
    <script type="text/javascript" src="{{ webpack('build/adminApp.js') }}"></script>
@endsection