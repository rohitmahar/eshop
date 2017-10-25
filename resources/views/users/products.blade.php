@extends('users.layouts.master')

@section('title', 'Stylish Clothes')

@section('meta-tag')
    <meta name="description=" content="Estylesta is situated at Kathmandu Nepal, Provides the better clothes
     to maintain your style. Our contact number is 980-8476037">
    <meta name="keywords" content="shopping, products, discount, order, nepali, clothes"/>
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="3 month">
@endsection

@section('content')
    <category-products
        :category-title="productCategoryTitle"
        :products="categoryProducts"
        :paginate-handler="getPaginatedProductsByCategory"
        :loading="loading"
        :error="error"
    >
    </category-products>
@endsection