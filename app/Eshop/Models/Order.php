<?php

namespace App\Eshop\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Eshop\Models
 */
class Order extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'shipping_address',
        'billing_address',
        'total_amount',
        'phone_number',
        'status',
        'quantity',
        'hint_for_address',
        'size'
    ];

    /**
     * @var array
     */
    protected $appends = ['user_name'];

    /**
     * order contains many products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'size')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * get the user name from the which user is ordering the product.
     *
     * @return UserName
     */
    public function getUserNameAttribute()
    {
        return $this->user->name;
    }
}
