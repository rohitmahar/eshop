<?php

namespace App\Eshop\Repositories\Backend;

use App\Eshop\Models\Slider;
use App\Http\Requests\SliderRequest;
use Intervention\Image\Facades\Image;

/**
 * Class SliderRepository
 * @package App\Eshop\Repositories\Backend
 */
class SliderRepository 
{
    /**
     * @var Slider
     */
    private $slider;

    /**
     * SliderRepository constructor.
     * @param Slider $slider
     */
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->slider->all();
    }

    /**
     * @param SliderRequest $request
     * @return static
     */
    public function create(SliderRequest $request)
    {
        $input = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . $image->getClientOriginalName();
            Image::make($image)->fit(1400, 400)->save(public_path() . '/uploads/slider/' . $name);
            $input['image'] = '/uploads/slider/' . $name;
        }
        return $this->slider->create($input);
    }

    /**
     * @param $sliderId
     * @return mixed
     */
    public function find($sliderId) 
    {
        return $this->slider->find($sliderId);
    }

    /**
     * @param $request
     * @param Slider $slider
     * @return bool
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        $input = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . $image->getClientOriginalName();
            Image::make($image)->fit(1400, 400)->blur(8)->save(public_path() . '/uploads/slider/' . $name);
            $input['image'] = '/uploads/slider/' . $name;
        }

        return $slider->fill($input)->save();
    }

    /**
     * @param $slider
     * @return mixed
     */
    public function delete($slider)
    {
        return $slider->delete();
    }
    
}