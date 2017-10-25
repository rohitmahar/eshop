<?php

namespace App\Http\Controllers\Frontend;

use App\Eshop\Repositories\OrderRepository;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Support\Facades\Auth;

/**
 * Class OrderController
 * @package App\Http\Controllers\Frontend
 */
class OrderController extends Controller
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var OrderRepository
     */
    private $order;

    /**
     * OrderController constructor.
     *
     * @param Cart $cart
     * @param OrderRepository $order
     */
    public function __construct(Cart $cart, OrderRepository $order)
    {
        $this->cart = $cart;
        $this->order = $order;
        $this->middleware('auth');
    }


    /**
     * store a newly ordered products.
     *
     * @param OrderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OrderRequest $request)
    {
        $request['user_id']           = auth()->id();
        $request['billing_address']   = auth()->user()->email ? auth()->user()->email : '';
        $request['total_amount']      = str_replace(',', '', $this->cart->total());
        $request['status']            = 0;
        $result = $this->order->store($request->all());
        if($result['status']){
            return redirect(route('show.carts'))->with('message',$result['message']);
        }

        return redirect()->route('show.carts')->withInput()->with('error',$result['message']);

    }
}
