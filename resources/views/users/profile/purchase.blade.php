@extends('users.layouts.master')

@section('title', 'Home Page')

@section('content')
    <div class="men">
        <div class="container">
            <h3 class="text-center cart-title"><span>My Purchases</span></h3>
            <div class="row">
                <input type="hidden" id="authUserId" value="{{ auth()->user()->id }}">
                <div class="col-md-12 order-form">
                    <table class="table table-bordered">
                        <thead>
                            <th>S. N.</th>
                            <th>Products Detail</th>
                            <th>Total Amount</th>
                            <th>Purchase Date</th>
                        </thead>
                        <tbody v-if="purchases.length">
                            <tr v-for="(purchase, index) in purchases">
                                <td>@{{ index+1 }}.</td>
                                <td>
                                    <table class="table">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>T. Price</th>
                                        </tr>
                                        <tr v-for="product in purchase.products">
                                            <td>@{{ product.title }}</td>
                                            <td>@{{ product.price }}</td>
                                            <td>@{{ product.pivot.quantity }}</td>
                                            <td>@{{ product.price * product.pivot.quantity }}</td>
                                        </tr>
                                    </table>
                                </td>
                                <td>@{{ purchase.total_amount }}</td>
                                <td>@{{ purchase.updated_at }}</td>
                            </tr>
                        </tbody>
                        <tbody v-else class="text-center">
                            <tr>
                                <td colspan="4">No Purchases Yet !</td>
                            </tr>
                        </tbody>
                    </table>
                    <vue-pagination
                            v-bind:pagination="pagination"
                            v-on:click.native="getPaginatedPurchasedOrders()"
                    >
                    </vue-pagination>
                </div>
            </div>
        </div>
    </div>
@endsection