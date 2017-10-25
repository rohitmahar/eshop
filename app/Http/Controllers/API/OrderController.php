<?php

namespace App\Http\Controllers\API;

use App\Eshop\Repositories\OrderRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class OrderController
 * @package App\Http\Controllers\API
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
        $this->middleware('ajax');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getDeliveredPaginatedOrders(Request $request)
    {
        $paginationLimit =  $request->get('per_page');

        return new JsonResponse(
            $this->order->getDeliveredPaginatedOrders($paginationLimit)
        );
    }

    /**
     * get the paginated orders by the request
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getPaginatedPurchasedOrders(Request $request)
    {
        $paginationLimit =  $request->get('per_page');

        return new JsonResponse(
            $this->order->getPaginatedPurchasedOrders($paginationLimit, $request->user_id)
        );
    }
    /**
     * get paginated order pages.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getPaginatedOrders(Request $request)
    {
        $paginationLimit =  $request->get('per_page');

        return new JsonResponse(
            $this->order->getPaginatedOrders($paginationLimit)
        );
    }
}
