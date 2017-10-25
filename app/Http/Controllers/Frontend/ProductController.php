<?php

namespace App\Http\Controllers\Frontend;

use App\Eshop\Repositories\Backend\ProductRepository;
use App\Http\Controllers\Controller;

/**
 * Class HomeController
 * @package App\Http\Controllers\User
 */
class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $product;

    /**
     * ProductController constructor.
     * @param ProductRepository $product
     */
    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    /**
     * return to the index page
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() 
    {
        return view('users.index');
    }

    /**
     * get the terms and conditions page.
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terms()
    {
        return view('users.terms');
    }

    /**
     * return to the product detail page.
     * 
     * @param $productId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($productId)
    {
        $product           = $this->product->find($productId);
        $productDetail = $this->product->findWithImages($product);
        
        return view('users.product-detail', compact('productDetail'));
    }

    /**
     * return to the products listing page
     * products are listed by categoried in on category
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function products()
    {
        return view('users.products');
    }

    /**
     * show product order form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function order()
    {
        return view('users.order');
    }
}
