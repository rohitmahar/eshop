<?php

namespace App\Eshop\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Eshop\Models
 */
class Product extends Model
{
    /**
     * fillable fields for products table.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'code',
        'published',
        'quantity',
        'discount_percentage'
    ];

    /**
     * image append on products table.
     *
     * @var array
     */
    protected $appends = ['image'];

    /**
     * product has one image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * get the product image.
     *
     * @return Object.
     */
    public function getImageAttribute()
    {
        return $this->images()->first()->image;
    }

    /**
     * one product has many orders from the customers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

}
