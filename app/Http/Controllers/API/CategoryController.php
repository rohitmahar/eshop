<?php

namespace App\Http\Controllers\API;

use App\Eshop\Repositories\Backend\ProductCategoryRepository;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class CategoryController
 * @package App\Http\Controllers\API
 */
class CategoryController extends Controller
{
    /**
     * @var ProductCategoryRepository
     */
    protected $category;

    /**
     * CategoryController constructor.
     * @param ProductCategoryRepository $category
     */
    public function __construct(ProductCategoryRepository $category)
    {
        $this->category = $category;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategory()
    {
        return response()->json(
            $this->category->getCategory()
        );
    }

    /**
     * @param $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubCategory($categoryId)
    {
        $category = $this->category->find($categoryId);
        
        return new JsonResponse(
            $this->category->getSubCategory($category)  
        );
    }
    
    public function getAllCategory()
    {
        return new JsonResponse(
            $this->category->getAllCategory()
        );
    }
}
