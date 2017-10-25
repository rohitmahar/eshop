@extends('users.layouts.master')

@section('title', 'Carts')

@section('content')
	<div class="men">
		<h3 class="text-center cart-title">My Shopping Cart</h3>
		<div class="container">
			@if(Session::has('message'))
				<div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
			@endif
			@if(Session::has('error'))
				<div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
			@endif
			<div class="row">
				<div class="col-md-8 col-md-offset-2 table-responsive">
					<table class="table table-hover">
						<tr>
							<th>Product Image</th>
							<th>Name</th>
							<th>Price</th>
							<th class="text-center">Quantity</th>
							<th class="text-center">Total</th>
							<th class="text-center"></th>
						</tr>
						@if(! (count($carts) > 0))
							<tr>
								<td colspan="8" class="text-center">
									No carts found Add some From <a href="{{ route('homepage') }}">Here</a>
								</td>
							</tr>
						@else
							@foreach($carts as $cart)
								<tr>
									<td class="text-center">
										<img src="{{ asset($cart->options['image']) }}"
											 height="90px"
											 width="120px">
									</td>
									<td>{{ $cart->name }} <br>
										<span class="text-small text-danger">Size: {{ $cart->options['size'] }}</span>
									</td>
									<td>NRs {{ $cart->price }}</td>
									<td class="text-center">
										<a class="cart_quantity_up" href="{{ url('update/'.$cart->rowId .'/cart?increment=1') }}">
											<button class="btn btn-primary btn-small">
												<i class="ion ion-plus"></i>
											</button>
										</a>
										<input type="text" class="text-center" value="{{ $cart->qty }}" style="width:50px;">
										<a class="cart_quantity_down" href="{{ url('update/'.$cart->rowId .'/cart?decrease=1') }}">
											<button class="btn btn-warning btn-small">
												<i class="ion ion-minus"></i>
											</button>
										</a>
									</td>
									<td>NRs {{  ($cart->price * $cart->qty)  }}</td>
									<td>
										{!! Form::open(array('route' => array('delete.cart', $cart->rowId),
                                                   'method' => 'delete')) !!}
										<button class="btn btn-danger btn-small cart-remove-btn" type="submit" title="Delete Item">
											<i class="ion ion-close"></i>
										</button>
										{!! Form::close() !!}
									</td>
								</tr>
							@endforeach
						@endif
					</table>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-8 col-md-offset-2">
					@if((count($carts) > 0))
						<div class="total-count text-right">
							<h4>Grand Total :
								<span style="background: #ffffff;padding:5px;">
								NRs {{ \Gloudemans\Shoppingcart\Facades\Cart::total() }}
							</span></h4>
						</div>
					@endif
				</div>
				<div class="clearfix"></div>
				<div class="col-md-8 col-md-offset-2">
					@if(Auth::check())
						@if((count($carts) > 0))
							<div class="order-button pull-right">
								<a href="{{ route('orders.order-form') }}">
									<button class="order-btn">
										Order Now
									</button>
								</a>
							</div>
						@endif
					@else
						<br>
						<div class="row">
							<div class="col-md-12 text-center">
								<h4>Please Login to Order</h4>
								<small>
									(It's easy to Login here ! You can login using social media.)
								</small>
							</div>
							<div class="col-md-12">
								<div class="flex-social">
									<div class="social-icons">
										<a href="{{ route('oauth.facebook') }}" class="social-icon social-icon--facebook">
											<i class="ion ion-social-facebook"></i>
											<div class="tooltip">Facebook</div>
										</a>
										<a href="{{ route('oauth.twitter') }}" class="social-icon social-icon--twitter">
											<i class="ion ion-social-twitter-outline"></i>
											<div class="tooltip">Twitter</div>
										</a>
										<a href="{{ route('oauth.google') }}" class="social-icon social-icon--github">
											<i class="ion ion-social-googleplus"></i>
											<div class="tooltip">Google</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection
