<?php

namespace App\Http\Controllers\Backend;

use App\Eshop\Models\Slider;
use App\Eshop\Repositories\Backend\SliderRepository;
use App\Http\Requests\SliderRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class SliderController
 * @package App\Http\Controllers\Backend
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = $this->slider->all();
        
        return view('backend.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Slider $slider
     * @return \Illuminate\Http\Response
     */
    public function create(Slider $slider)
    {
        return view('backend.sliders.form', compact('slider'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SliderRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $this->slider->create($request);

        return redirect(route('sliders.index'))->with('message','Slider Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slider = $this->slider->find($id);
        
        return view('backend.sliders.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = $this->slider->find($id);
        
        return view('backend.sliders.form', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SliderRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, $id)
    {
        $slider = $this->slider->find($id);
        $this->slider->update($request, $slider);
        
        return redirect(route('sliders.index'))->with('message', 'Slider Updated Successfully');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm($id)
    {
        $slider = $this->slider->find($id);
        
        return view('backend.sliders.confirm', compact('slider'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = $this->slider->find($id);
        $this->slider->delete($slider);

        return redirect(route('sliders.index'))->with('message', 'Slider Deleted Successfully');
    }
}
