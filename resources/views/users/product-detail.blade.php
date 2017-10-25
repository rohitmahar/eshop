@extends('users.layouts.master')

@section('title', 'Product Detail')

@section('content')
    <div class="single">
        <!-- container -->
        <div class="container">
            <div class="single-grids">
                <div class="col-md-4">
                    <section>
                        <div class="container gal-container">
                            @foreach($productDetail->images as $index => $image)
                                <div class="col-md-{{ ($index == 0) ? 12 : 6 }} col-sm-12 co-xs-12 gal-item">
                                    <div class="box">
                                        <a href="#" data-toggle="modal" data-target="#gallery-{{ $index }}">
                                            <img src="{{ $image->image }}">
                                        </a>
                                        <div class="modal fade" id="gallery-{{ $index }}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <div class="modal-body">
                                                        <img src="{{ $image->image }}" alt="{{ $productDetail->title }}">
                                                    </div>
                                                    <div class="col-md-12 description text-center">
                                                        <h4>{{ $productDetail->title }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-5">
                    <div class="single-product-info">
                        <h3 class="name-price">{{ $productDetail->title }}
                            <span class="text-center pull-right price-info">
                                <small>NRs</small> {{ $productDetail->price }}
                            </span>
                        </h3>
                        <p class="product-description">{{ $productDetail->description }}
                        </p>
                        <form  action="{{ route('addto.cart', $productDetail->id) }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group single-form">
                                <label for="size">Please Choose Size</label><br>
                                <select name="size">
                                    <option value="XL">XL</option>
                                    <option value="L">L</option>
                                    <option value="M">M</option>
                                    <option value="SM">SM</option>
                                </select>
                            </div>
                            <div class="form-group single-form">
                                <label for="quantity">Please Choose Quantity</label><br>
                                <select name="quantity">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="7">8</option>
                                    <option value="7">9</option>
                                    <option value="7">10</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="send-to-cart">
                                    <i class="ion ion-android-cart"></i>
                                    Add To Cart
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="col-md-3 category-bar text-center">
                    <h4 class="page-title text-center">Categories</h4>
                    <hr>
                    <div class="category-bar-item" v-for="category in categories">
                        <h4>@{{ category.title }}'s</h4>
                        <a v-for="subCategory in category.children"
                           v-bind:href="'/category/' + subCategory.id + '/products'"
                        >
                            <button class="cat-button">
                                @{{ subCategory.title }}
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection