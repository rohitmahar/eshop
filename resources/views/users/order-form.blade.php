@extends('users.layouts.master')

@section('title', 'Submit Your Order!')

@section('content')
    <div class="men">
        <div class="container">
            @if(Session::has('message'))
                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
            @endif
            <div class="row">
                @if(Auth::check())
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                You are almost there ! Please fill this form,
                                    This is last step for order we promise.
                            </div>
                            <div class="panel-body">
                                {!! Form::open(['method' => 'post', 'route' => 'product.order', 'class' => 'form']) !!}

                                <div class="form-group {{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                    {!!  Form::label('phone_number') !!}
                                    {!!  Form::text('phone_number', null, ['class' => 'form-control']) !!}

                                    @if ($errors->has('phone_number'))
                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group {{ $errors->has('shipping_address') ? ' has-error' : '' }}">
                                    {!!  Form::label('shipping_address') !!}
                                    {!!  Form::text('shipping_address', null, ['class' => 'form-control']) !!}

                                    @if ($errors->has('shipping_address'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('shipping_address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <br>
                                <div class="form-group">
                                    {!!  Form::label('hint_for_address') !!}
                                    {!!  Form::textarea('hint_for_address', null, ['class' => 'form-control', 'rows' => 4]) !!}
                                    <small>Hint e.g: Before Star Hospital.</small>
                                </div>
                                <div class="form-group text-right {{ $errors->has('agreed') ? ' has-error' : '' }}">
                                    <label for="agreed">
                                        {!!  Form::checkbox('agreed', 'agreed') !!}
                                        I agree <a href="{{ route('terms') }}">Terms</a>
                                    </label>

                                    @if ($errors->has('agreed'))
                                        <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('agreed') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="order-button pull-right">
                                    <button class="order-btn">
                                        Order Now <i class="ion ion-chevron-right icon-right"></i>
                                    </button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
