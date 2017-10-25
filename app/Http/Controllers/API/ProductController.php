<?php

namespace App\Http\Controllers\API;

use App\Eshop\Repositories\Backend\ProductCategoryRepository;
use App\Eshop\Repositories\Backend\ProductRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * ProductController for Product API
 *
 * Class ProductController
 * @package App\Http\Controllers\API
 */
class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $product;
    /**
     * @var ProductCategoryRepository
     */
    private $category;

    /**
     * ProductController constructor.
     * @param ProductRepository $product
     * @param ProductCategoryRepository $category
     */
    public function __construct(ProductRepository $product, ProductCategoryRepository $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    /**
     * get all the products.
     * 
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->product->all();
    }

    public function getPaginatedProductsByCategory($categoryId, Request $request)
    {
        $category = $this->category->find($categoryId);

        $paginationLimit =  $request->get('per_page');

        return new JsonResponse(
            $this->product->getPaginatedProductsByCategory($request, $category, $paginationLimit)
        );
    }
    /**
     * get the paginated result of products.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getPaginatedProducts(Request $request)
    {
        $paginationLimit =  $request->get('per_page');

        return new JsonResponse(
           $this->product->getPaginatedProducts($paginationLimit, $request)
        );
    }
}
