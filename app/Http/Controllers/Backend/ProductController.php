<?php

namespace App\Http\Controllers\Backend;

use App\Eshop\Models\Product;
use App\Eshop\Repositories\Backend\ProductRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Http\Request;

/**
 * Class ProductController
 * @package App\Http\Controllers\Backend
 */
class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $product;

    /**
     * ProductController constructor.
     *
     * @param $product
     */
    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('backend.products.form',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductCreateRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        $result = $this->product->store($request);

        if($result['status']){
            return redirect(route('admin.product.index'))->with('message',$result['message']);
        }

        return redirect()->route('admin.product.create')->withInput()->with('error',$result['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->find($id);

        return view('backend.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->find($id);
    
        return view('backend.products.form', compact('product'));
    }


    /** update the product from database.
     * 
     * @param ProductUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $result = $this->product->update($request,$id);

        if($result['status']){
            return redirect(route('admin.product.index'))->with('message',$result['message']);
        }

        return redirect()->route('admin.product.edit',$id)->withInput()->with('error',$result['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->product->delete($id);

        if($result['status']){
            return redirect(route('admin.product.index'))->with('message',$result['message']);
        }

        return redirect()->route('admin.product.index')->withInput()->with('error',$result['message']);
    }
}
