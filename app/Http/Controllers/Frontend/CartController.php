<?php

namespace App\Http\Controllers\Frontend;

use App\Eshop\Repositories\Backend\ProductRepository;
use App\Http\Requests\CartRequest;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;

/**
 * Class CartController
 * @package App\Http\Controllers\Frontend
 */
class CartController extends Controller
{
    /**
     * @var Cart
     */
    private $cart;
    
    /**
     * @var ProductRepository
     */
    private $product;

    /**
     * CartController constructor.
     *
     * @param Cart              $cart
     * @param ProductRepository $product
     */
    public function __construct(Cart $cart, ProductRepository $product)
    {
        $this->cart    = $cart;
        $this->product = $product;
    }

    /**
     * Show all the cart items
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function carts()
    {
        $carts = $this->cart->content();

        return view('users.carts', compact('carts'));
    }

    /**
     * Add product into the cart
     *
     * @param             $id
     * @param CartRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($id, Request $request)
    {
        $input   = $request->all();
        $product = $this->product->find($id);

        $this->cart->add(
            [
                'id'      => $id,
                'name'    => $product->title,
                'qty'     => $input['quantity'],
                'price'   => $product->price,
                'options' => ['size' => $input['size'], 'image' => $product->image],
            ]
        );

        return redirect()->route('show.carts');
    }

    public function update($cart, Request $request)
    {
        // Increment The Quantity
        if ($request->increment == 1) {
            $item = $this->cart->get($cart);
            $this->cart->update($cart, $item->qty + 1);
        }

        // Decrease the quantity
        if ($request->decrease == 1) {
            $item = $this->cart->get($cart);
            $this->cart->update($cart, $item->qty - 1);
        }

        return redirect()->route('show.carts');
    }

    /**
     * oderform is the form for the order of products.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderForm()
    {
        return view('users.order-form');
    }

    /**
     * Delete cart item
     *
     * @param $rowId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($rowId)
    {
        $this->cart->remove($rowId);

        return redirect()->route('show.carts');
    }
}
