<?php

namespace App\Eshop\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductImage
 * @package App\Eshop\Models
 */
class ProductImage extends Model
{
    /**
     * @var string
     */
    protected $table = 'product_images';

    /**
     * @var array
     */
    protected $fillable = ['product_id','image'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
