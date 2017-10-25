<?php

namespace App\Eshop\Repositories;

use App\Eshop\Models\Order;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Psr\Log\LoggerInterface;

/**
 * Class OrderRepository
 * @package App\Eshop\Repositories
 */
class OrderRepository
{
    /**
     * @var Order
     */
    private $order;

    /**
     * @var Cart
     */
    private $cart;

    /**
     * @var DatabaseManager
     */
    private $db;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * OrderRepository constructor.
     * @param Order $order
     * @param Cart $cart
     * @param DatabaseManager $db
     * @param LoggerInterface $logger
     */
    public function __construct(Order $order, Cart $cart, DatabaseManager $db, LoggerInterface $logger)
    {
        $this->order = $order;
        $this->cart = $cart;
        $this->db = $db;
        $this->logger = $logger;
    }

    /**
     * return all the orders for the order view
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllOrders()
    {
        return $this->order->all();
    }

    /**
     * store the order to the order table
     * which is came form the order cart list of the particular user
     *
     * @param $input
     * @return bool
     */
    public function store($input)
    {
        try {
            $this->db->beginTransaction();
            $order = $this->order->create($input);

            $productIds = [];
            $productWithQuantity = [];
            foreach($this->cart->content() as $cart) {
                array_push($productIds,
                    [$cart->id => ['quantity' => $cart->qty, 'size' => $cart->options['size']]]
                );
                $this->cart->remove($cart->rowId);
            }
            foreach($productIds as $key => $ids) {
                $productWithQuantity += $ids;
            }
            $order->products()->sync($productWithQuantity);
            $this->db->commit();

            return [
                'status'  => true,
                'message' => "Order sent successfully. We will contact soon",
            ];
        } catch (\Exception $e) {
            $this->db->rollback();
            $this->logger->error((string) $e);

            return [
                'status'  => false,
                'message' => "Failed to send Order. Because ".$e->getMessage(),
            ];
        }
    }

    /**
     * find the order object from the OrderId.
     *
     * @param $orderId
     */
    public function find($orderId)
    {
        return $this->order->find($orderId);
    }

    /**
     * get the paginated order listing of the order table.
     *
     * @param $paginationLimit
     * @return mixed
     */
    public function getPaginatedOrders($paginationLimit)
    {
        $query = $this->order
            ->with('products')
            ->where('status', 0)
            ->orderBy('created_at', 'desc');

        return $query->paginate($paginationLimit);
    }

    /**
     * get the paginated orders list which are delivered orders of the products.
     *
     * @param $paginationLimit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getDeliveredPaginatedOrders($paginationLimit)
    {
        $query = $this->order
            ->with('products')
            ->where('status', 1)
            ->orderBy('created_at', 'desc');

        return $query->paginate($paginationLimit);
    }

    /**
     * delete the order.
     *
     * @param Order $order
     * @return bool|null
     */
    public function delete(Order $order)
    {
        $order->products()->detach();

        return $order->delete();
    }

    /**
     * move to the delivered products field.
     *
     * @param Order $order
     * @return bool
     */
    public function moveToDelivered(Order $order)
    {
        return $order->fill(['status' => 1])->save();
    }

    /**
     * move to the order table from the delivered table.
     *
     * @param Order $order
     * @return bool
     */
    public function moveToOrdered(Order $order)
    {
        return $order->fill(['status' => 0])->save();
    }

    /**
     * get the paginated purchased products in paginated format. :)
     *
     * @param $paginationLimit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedPurchasedOrders($paginationLimit, $userId)
    {
        $query = $this->order
            ->with('products')
            ->where('status', 1)
            ->where('user_id', $userId)
            ->orderBy('created_at', 'asc');

        return $query->paginate($paginationLimit);
    }
}