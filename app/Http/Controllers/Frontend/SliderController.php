<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Slider;
use Exception;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    use ApiResponseTrait;
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $sliders = Slider::get();
            return $this->apiResponse(200, 'sliders data.', $sliders);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }
}
