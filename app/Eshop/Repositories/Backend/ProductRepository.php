<?php

namespace App\Eshop\Repositories\Backend;

use App\Eshop\Models\Category;
use App\Eshop\Models\Product;
use App\Eshop\Models\ProductImage;
use App\Http\Requests\ProductRequest;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Psr\Log\LoggerInterface;

/**
 * Class ProductRepository
 * @package App\Eshop\Repositories\Backend
 */
class ProductRepository
{
    /**
     * @var Product
     */
    protected $product;
    /**
     * @var ProductImage
     */
    protected $productImage;
    /**
     * @var DatabaseManager
     */
    protected $db;
    /**
     * @var LoggerInterface
     */
    protected $logger;
    /**
     * @var Category
     */
    private $category;

    /**
     * ProductRepository constructor.
     *
     * @param Product $product
     * @param Category $category
     * @param ProductImage $productImage
     * @param DatabaseManager $db
     * @param LoggerInterface $logger
     */
    public function __construct(
        Product $product,
        Category $category,
        ProductImage $productImage,
        DatabaseManager $db,
        LoggerInterface $logger
    )
    {
        $this->product      = $product;
        $this->productImage = $productImage;
        $this->db           = $db;
        $this->logger = $logger;
        $this->category = $category;
    }

    /**
     * Get all products
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->product->all();
    }

    /**
     * z
     *
     * @param $paginationLimit
     * @param Request $request
     * @return Collection
     */
    public function getPaginatedProducts($paginationLimit, Request $request)
    {
        if (request()->has('sort')) {
            $query = $this->product->orderBy($request->sort, 'asc');
        } else {
            $query = $this->product->orderBy('id', 'asc');
        }

        if ($request->exists('filter')) {
            $query->where(function($q) use($request) {
                $value = "%{$request->filter}%";
                $q->where('title', 'like', $value)
                    ->orWhere('description', 'like', $value)
                    ->orWhere('code', 'like', $value)
                    ->orWhere('price', 'like', $value);
            });
        }

        return $query->paginate($paginationLimit);
    }

    /**
     * return the paginated products by product category wise.
     *
     * @param Request $request
     * @param $category
     * @param $paginationLimit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedProductsByCategory(Request $request, $category, $paginationLimit)
    {
        if (request()->has('sort')) {
            $query = $category->products()->orderBy($request->sort, 'asc');
            if($category->parent_id == 0) {
                $query = $this->productListingWithImage($category)
                    ->orderBy($request->sort, 'asc');
            }
        } else {
            $query = $category->products()->orderBy('id', 'asc');
            if($category->parent_id == 0) {
                $query = $this->productListingWithImage($category)
                    ->orderBy('products.id', 'asc');
            }
        }
        if ($request->exists('filter')) {
            $query->where(function($q) use($request) {
                $value = "%{$request->filter}%";
                $q->where('products.title', 'like', $value)
                    ->orWhere('products.description', 'like', $value)
                    ->orWhere('products.code', 'like', $value)
                    ->orWhere('products.price', 'like', $value);
            });
        }

        return $query->paginate($paginationLimit);
    }

    /**
     * Store product
     *
     * @param ProductRequest $input
     *
     * @return array
     */
    public function store($input)
    {
        try {
            $this->db->beginTransaction();
            $product = $this->product->create($this->organizeInput($input));
            $this->saveImage($input, $product->id);
            $product->categories()->sync($input->input('category'));
            $this->db->commit();

            return [
                'status'  => true,
                'message' => "Product added successfully.",
            ];
        } catch (\Exception $e) {
            $this->db->rollback();
            $this->logger->error((string) $e);

            return [
                'status'  => false,
                'message' => "Failed to add product. Because ".$e->getMessage(),
            ];
        }
    }

    /**
     * Find product by id
     *
     * @param $id
     * @return Product|null
     */
    public function find($id)
    {
        return $this->product->find($id);
    }

    /**
     * get all product detail with all the images of that product.
     *
     * @param Product $product
     * @return mixed
     */
    public function findWithImages(Product $product)
    {
        return $product->with('images')->where('id', $product->id)->first();
    }

    /**
     * Update product
     *
     * @param $input
     * @param $id
     * @return array
     */
    public function update($input,$id)
    {
        try {
            $this->db->beginTransaction();
            $this->product->find($id)->update($this->organizeInput($input));
            if ($input->hasFile('images')) {
                $this->deleteImage($id);
                $this->saveImage($input, $id);
            }
            if($input->category) {
                $this->product->find($id)->categories()->sync($input->input('category'));
            }
            $this->db->commit();

            return [
                'status'  => true,
                'message' => "Product added successfully.",
            ];
        } catch (\Exception $e) {
            $this->db->rollback();
            $this->logger->error((string) $e);dd($e);

            return [
                'status'  => false,
                'message' => "Failed to add product. Because ".$e->getMessage(),
            ];
        }
    }

    /**
     * Delete product
     *
     * @param $id
     *
     * @return array
     */
    public function delete($id)
    {
        try {
            $this->db->beginTransaction();

            $this->productImage->where('product_id', $id)->delete();
            $this->product->destroy($id);

            $this->db->commit();

            return ['status' => true, 'message' => "Product deleted successfully."];

        } catch (\Exception $e) {
            $this->db->rollback();
            $this->logger->error((string) $e);

            return ['status' => false, 'message' => "Product deletion failed."];
        }
    }

    /**
     * Organize input
     *
     * @param $input
     * @return static
     */
    private function organizeInput($input)
    {
        return $input->only(
            'title',
            'description',
            'published',
            'code',
            'price',
            'discount_percentage'
        );
    }

    /**
     * Save product image
     *
     * @param $input
     * @param $product_id
     * @return null|string
     */
    private function saveImage($input, $product_id)
    {
        $files = $input['images'];
        $image = null;
        $title = $input->get('title');

        if ($input->hasFile('images')) {
            foreach($files as $file) {
                $image = $file;
                $name  = $title."-".time().$file->getClientOriginalName();
                Image::make($image)->fit(400, 300)->save(public_path().'/uploads/products/'.$name);
                $image = '/uploads/products/'.$name;

                $this->productImage->create(
                    [
                        'product_id' => $product_id,
                        'image'      => $image,
                    ]
                );
            }
        }

        return true;
    }

    /**
     * Delete product image
     *
     * @param $id
     * @return bool
     */
    private function deleteImage($id)
    {
        return $this->productImage->where('product_id',$id)->delete();
    }

    /**
     * provide the query for product with image.
     *
     * @param $category
     * @return mixed
     */
    private function productListingWithImage($category)
    {
        return $this->product
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->join('category_product', 'products.id', '=', 'category_product.product_id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->where('categories.parent_id', $category->id)
            ->select(DB::raw('products.*', 'product_images.image'))
            ->groupBy('products.id');
    }
}