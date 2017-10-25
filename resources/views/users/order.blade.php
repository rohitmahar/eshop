@extends('users.layouts.master')

@section('title', 'Order ')

@section('content')
    <div class="men">
        <div class="container">
            <h3 class="text-center cart-title">Please Fill this Form To Make Order</h3>
            <p class="text-center">-OR- <br> <a href="{{ url('register') }}">Signup</a> </p>
            <br>
            <div class="row">
                <div class="col-md-6 col-md-offset-3 order-form">
                    <form action="">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" class="form-control order-control">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" class="form-control order-control">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control order-control">
                        </div>

                        <div class="form-group">
                            <label for="address">Shipping Address</label>
                            <input type="text" name="address" class="form-control order-control">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary pull-right">Send Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection