<?php

namespace App\Http\Controllers\Backend;

use App\Eshop\Repositories\OrderRepository;
use App\Http\Controllers\Controller;

/**
 * Class OrderController
 * @package App\Http\Controllers\Backend
 */
class OrderController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $order;

    /**
     * OrderController constructor.
     * @param OrderRepository $order
     */
    public function __construct(OrderRepository $order)
    {
        $this->order = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.orders.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delivered()
    {
        return view('backend.orders.delivered');
    }
    /**
     * @param $orderId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm($orderId)
    {
        $order = $this->order->find($orderId);

        return view('backend.orders.confirm', compact('order'));
    }

    /**
     * @param $orderId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($orderId)
    {
        $order = $this->order->find($orderId);
        $this->order->delete($order);

        return redirect(route('admin.product.orders'))->with('message', 'Order Deleted Successfully');
    }

    /**
     * @param $orderId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function moveToDelivered($orderId)
    {
        $order = $this->order->find($orderId);
        $this->order->moveToDelivered($order);

        return redirect(route('product.order.delivered'))->with('message', 'Order is delivered Successfully');
    }

    /**
     * send to the orders from the purchased products.
     *
     * @param $orderId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function moveToOrdered($orderId)
    {
        $order = $this->order->find($orderId);
        $this->order->moveToOrdered($order);

        return redirect(route('admin.product.orders'))->with('message', 'Order is move to the orders Successfully');
    }
}
