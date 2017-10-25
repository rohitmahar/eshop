<?php

namespace app\Eshop\Repositories\Backend;

use App\Eshop\Models\Category;
use Illuminate\Database\DatabaseManager;
use Psr\Log\LoggerInterface;

/**
 * Class ProductCategoryRepository
 * @package app\Eshop\Repositories\Backend
 */
class ProductCategoryRepository
{
    /**
     * @var Category
     */
    protected $productCategory;
    /**
     * @var DatabaseManager
     */
    private $db;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * ProductCategoryRepository constructor.
     * @param Category $productCategory
     * @param DatabaseManager $db
     * @param LoggerInterface $logger
     */
    public function __construct(Category $productCategory,DatabaseManager $db,LoggerInterface $logger)
    {
        $this->productCategory = $productCategory;
        $this->db = $db;
        $this->logger = $logger;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        $categories = $this->productCategory->where('parent_id',0)->get();
        foreach ($categories as $category){
            $category->subcategories = $this->productCategory->where('parent_id',$category->id)->get();
        }

        return $categories;
    }

    /**
     * @param $input
     * @return array
     */
    public function store($input)
    {
        try {
            $this->db->beginTransaction();

            $category = [
                'title' => $input['category'],
                'parent_id' => 0,
                'description' => "Category"
            ];
            $category = $this->productCategory->create($category);

            $subCategories = $input['subcategories'];

            foreach ($subCategories as $subCategory){
                $subCat = [
                    'title' => $subCategory,
                    'parent_id' => $category->id,
                    'description' => "Sub-Category"
                ];

                $this->productCategory->create($subCat);
            }

            $this->db->commit();

            return [
                'status'  => true,
                'message' => "Product category created successfully.",
            ];
        } catch (\Exception $e) {
            $this->db->rollback();
            $this->logger->error((string) $e);dd($e);

            return [
                'status'  => false,
                'message' => "Failed to create product category. Because of".$e->getMessage(),
            ];
        }
    }

    /**
     * @param $categoryId
     * @return mixed
     */
    public function findById($categoryId)
    {
        $category = $this->find($categoryId);

        $category->subcategories = $this->productCategory->where('parent_id',$category->id)->get();

        return $category;
    }

    /**
     * @param $categoryId
     * @return mixed
     */
    public function find($categoryId)
    {
        return $this->productCategory->findOrFail($categoryId);
    }

    /**
     * @param Category $productCategory
     * @param $input
     * @return array
     */
    public function update(Category $productCategory, $input)
    {
        try {
            $this->db->beginTransaction();

            $category = [
                'title' => $input['category'],
                'parent_id' => 0,
                'description' => "Category"
            ];
            $productCategory->fill($category)->save();

            $subCategoriesTitle = $input['subcategories'];
            $subCategoriesId = $input['subcategoryid'];
            $subCategories = array_combine($subCategoriesId, $subCategoriesTitle);

            $this->productCategory
                ->whereNotIn('id', $subCategoriesId)
                ->whereNotIn('parent_id', [0])
                ->where('parent_id', $productCategory->id)
                ->delete();

            foreach($subCategories as $key => $category) {
                if($key == 0) {
                    $this->productCategory->create(
                        [
                            'title' => $category, 
                            'parent_id' => $productCategory->id,
                            'description' => 'Subcategory'
                        ]);
                } else {
                    $this->productCategory->where('id',$key)->update(['title' => $category]);
                }
            }

            $this->db->commit();

            return [
                'status'  => true,
                'message' => "Product category created successfully.",
            ];
        } catch (\Exception $e) {
            $this->db->rollback();
            $this->logger->error((string) $e);dd($e);

            return [
                'status'  => false,
                'message' => "Failed to create product category. Because of".$e->getMessage(),
            ];
        }
    }

    /**
     * delete the productCategory.
     *
     * @param Category $productCategory
     * @return array
     */
    public function delete(Category $productCategory)
    {
        try {
            $this->db->beginTransaction();
            
            $this->productCategory->where('parent_id',$productCategory->id)->delete();
            $productCategory->delete();

            $this->db->commit();

            return [
                'status'  => true,
                'message' => "Product category deleted successfully.",
            ];
        } catch (\Exception $e) {
            $this->db->rollback();
            $this->logger->error((string) $e);dd($e);

            return [
                'status'  => false,
                'message' => "Failed to delete product category. Because of".$e->getMessage(),
            ];
        }
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->productCategory
            ->where('parent_id', 0)
            ->get();
    }

    /**
     * @param Category $category
     * @return mixed
     */
    public function getSubCategory(Category $category)
    {
        return $this->productCategory
            ->where('parent_id', $category->id)
            ->get();
    }


    /**
     * return all the categories with sub categories
     * that helps for the navigation items preety awesome things is here.
     * 
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllCategory()
    {
        return $this->productCategory
            ->with('children')->
            where('parent_id', 0)
            ->orderBy('id', 'asc')
            ->get();
    }
}