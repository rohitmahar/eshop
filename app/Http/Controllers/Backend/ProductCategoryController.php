<?php

namespace App\Http\Controllers\Backend;

use App\Eshop\Models\Category;
use App\Eshop\Repositories\Backend\ProductCategoryRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use Illuminate\Http\Request;

/**
 * Class ProductCategoryController
 * @package App\Http\Controllers\Backend
 */
class ProductCategoryController extends Controller
{
    /**
     * @var ProductCategoryRepository
     */
    private $categoryRepository;

    /**
     * ProductCategoryController constructor.
     * @param ProductCategoryRepository $categoryRepository
     */
    public function __construct(ProductCategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->categoryRepository->all();

        return view('backend.products.categories.index',compact('categories'));
    }

    /**
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Category $category)
    {
        return view('backend.products.categories.form',compact('category'));
    }

    /**
     * @param ProductCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductCategoryRequest $request)
    {
        $result = $this->categoryRepository->store($request->all());

        if($result['status']){
            return redirect(route('admin.product.category.index'))->with('message',$result['message']);
        }

        return redirect()->route('admin.product.category.create')->with('error',$result['message']);
    }

    /**
     * @param $categoryId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($categoryId) 
    {
        $category = $this->categoryRepository->findById($categoryId);

        return view('backend.products.categories.edit', compact('category'));
    }


    /**
     * update the product category
     *
     * @param $categoryId
     * @param ProductCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($categoryId, ProductCategoryRequest $request)
    {
        $category = $this->categoryRepository->find($categoryId);
        
        $result = $this->categoryRepository->update($category, $request->all());
        if($result['status']){
            return redirect(route('admin.product.category.index'))->with('message',$result['message']);
        }

        return redirect()->route('admin.product.category.edit')->with('error',$result['message']);
    }

    /**
     * delete the productCategory.
     * 
     * @param $categoryId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($categoryId)
    {
        $category = $this->categoryRepository->find($categoryId);

        $result = $this->categoryRepository->delete($category);

        if($result['status']) {
            return redirect(route('admin.product.category.index'))->with('message',$result['message']);
        }
    }
}
