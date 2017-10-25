<?php

namespace App\Eshop\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * @package App\Eshop\Models
 */
class Setting extends Model
{
    /**
     * fillable columns for the setting table
     * 
     * @var array
     */
    protected $fillable = [
        'sitename',
        'phone',
        'email',
        'address'
    ];
}
