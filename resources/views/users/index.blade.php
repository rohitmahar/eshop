@extends('users.layouts.master')

@section('title', 'Your Style Partner')

@section('meta-tag')
    <meta name="description=" content="Estylesta is your style partner situated at Kathmandu Nepal, Provides the better clothes
     to maintain your style. We are also providing tips to maintain your style in a best way.">
    <meta name="keywords" content="shopping, e-commerce, nepali, art, clothes, style"/>
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="3 month">
@endsection

@section('content')
    <home-page
        :sliders="sliders"
        :setting="{{ $setting }}"
        :products="products"
        :paginate-handler="getProducts"
        :loading="loading"
        :error="error"
        :pagination="pagination"
    >
    </home-page>
@endsection