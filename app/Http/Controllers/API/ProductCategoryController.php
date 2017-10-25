<?php

namespace App\Http\Controllers\API;

use App\Eshop\Repositories\Backend\ProductCategoryRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

/**
 * Class ProductCategoryController
 * @package App\Http\Controllers\API
 */
class ProductCategoryController extends Controller
{
    /**
     * @var ProductCategoryRepository
     */
    protected $productCategory;

    /**
     * ProductCategoryController constructor.
     * @param ProductCategoryRepository $productCategory
     */
    public function __construct(ProductCategoryRepository $productCategory)
    {
        $this->productCategory = $productCategory;
    }

    /**
     * @param $categoryId
     * @return
     * @internal param $category
     */
    public function getCategory($categoryId)
    {
        return Response::Json($this->productCategory->findById($categoryId));
    }
}
