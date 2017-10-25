<?php

namespace App\Http\Controllers\API;

use App\Eshop\Repositories\Backend\SliderRepository;
use App\Http\Controllers\Controller;

/**
 * Class SliderController
 * @package App\Http\Controllers\API
 */
class SliderController extends Controller
{
    /**
     * @var SliderRepository
     */
    private $slider;

    /**
     * SliderController constructor.
     * @param SliderRepository $slider
     */
    public function __construct(SliderRepository $slider)
    {
        $this->slider = $slider;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllSliders()
    {
        return $this->slider->all();
    }
}
