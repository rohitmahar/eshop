<?php

namespace App\Eshop\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App\Eshop\Models
 */
class Category extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title','parent_id','description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parent()
    {
        return $this->hasOne(static::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(static::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
