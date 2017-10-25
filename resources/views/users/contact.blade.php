@extends('users.layouts.master')

@section('title', 'Contact Us')

@section('meta-tag')
    <meta name="description=" content="Estylesta is situated at Kathmandu Nepal, Provides the better clothes
     to maintain your style. Our contact number is 980-8476037">
    <meta name="keywords" content="shopping, discount, offer, nepali, clothes"/>
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="3 month">
@endsection

@section('content')
    <!-- contact-page -->
    <div class="contact men">
        <div class="container">
            @if(Session::has('message'))
                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
            @endif
            <div class="row">
                <div class="contact-form">
                    <div class="contact-info">
                        <h3><span>Feel Free to Contact Us</span></h3>
                    </div>
                    {!! Form::open(['method' => 'post' , 'route' => 'contact.email' ]) !!}
                    <div class="contact-left">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::text('name', null, ['required', 'placeholder' => 'Full Name (Required)']) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::text('email', null, ['required', 'placeholder' => 'Email (Required)']) !!}
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            {!! Form::text('phone', null, ['placeholder' => 'Phone']) !!}
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="contact-right">
                        <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
                            {!! Form::textarea('message', null, ['required', 'placeholder' => 'Message (Required)']) !!}

                            @if ($errors->has('message'))
                                <span class="help-block">
                                    <strong class="text-danger">{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {!! Form::submit('Send', ['class' => 'pull-right']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="row">
                <h3 class="text-center"><span></span></h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th class="text-left"><i class="ion ion-paper-airplane"></i> {{ $setting->email }}</th>
                            <th class="text-center"><i class="ion ion-android-call"></i> {{ $setting->phone }}</th>
                            <th class="text-right"><i class="ion ion-ios-location"></i> {{ $setting->address }}</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.240913396827!2d85.29916831452404!3d27.678947982803678!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjfCsDQwJzQ0LjIiTiA4NcKwMTgnMDQuOSJF!5e0!3m2!1sen!2snp!4v1495965303099"
                    width="100%"
                    height="400"
                    frameborder="0"
                    style="border:0" allowfullscreen
            >
            </iframe>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <!-- //contact-page -->
@endsection