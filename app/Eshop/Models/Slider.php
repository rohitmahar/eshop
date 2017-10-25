<?php

namespace App\Eshop\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Slider
 * @package App
 */
class Slider extends Model
{
    /**
     * @var string
     */
    protected $table = 'sliders';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'image'
    ];
}
