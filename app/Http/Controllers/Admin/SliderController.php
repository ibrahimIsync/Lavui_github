<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\FileTrait;
use App\Models\User;
use Exception;
use App\Models\Slider;
use App\Http\Requests\SliderRequest;

class SliderController extends AdminController
{
    use FileTrait, ApiResponseTrait;
    const PATH = 'slider';

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:settings'])->only('store', 'update', 'destroy', 'show');
    }

    public function index(): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $sliders = Slider::withTrashed()->get();
            return $this->apiResponse(200, 'Sliders data.', $sliders);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function store(SliderRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $englishImageName = $this->uploadImage($request->image_en, self::PATH, null, 'en');
            $arabicImageName = $this->uploadImage($request->image_ar, self::PATH, null, 'ar');
            if ($request->mean_slider == 1) {
                Slider::query()->update(['mean_slider' => 0]);
            }
            Slider::create([
                'image' => [
                    'en' => $englishImageName,
                    'ar' => $arabicImageName
                ],
                'mean_slider' => $request->mean_slider,
                'status' => $request->status,
                'creator_type' => User::class,
                'creator_id' => auth()->user()->id,
                'editor_type' => User::class,
                'editor_id' => auth()->user()->id,
            ]);
            return $this->apiResponse(200, 'Slider created successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function show(Slider $slider): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            return $this->apiResponse(200, 'Slider data.', $slider);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function destroy(Slider $slider): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $this->deleteImage($slider->getTranslation('image', 'en'));
            $this->deleteImage($slider->getTranslation('image', 'ar'));
            $slider->delete();
            return $this->apiResponse(200, 'Slider deleted successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function update(SliderRequest $request, Slider $slider): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $arabicImageName = ($request->image_ar) ? $this->uploadImage($request->image_ar, self::PATH, $slider->getTranslation('image', 'ar'), 'ar') : $slider->getRawOriginal($slider->getTranslation('image', 'ar'));
            $englishImageName = ($request->image_en) ? $this->uploadImage($request->image_en, self::PATH, $slider->getTranslation('image', 'en'), 'en') : $slider->getRawOriginal($slider->getTranslation('image', 'en'));
            if ($request->mean_slider == 1) {
                Slider::query()->where('id' , '<>', $slider->id)->update(['mean_slider' => 0]);
            }
            $slider->update([
                'image' => [
                    'en' => $englishImageName,
                    'ar' => $arabicImageName
                ],
                'mean_slider' => $request->mean_slider ?? $slider->mean_slider,
                'status' => $request->status,
                'editor_type' => User::class,
                'editor_id' => auth()->user()->id,
            ]);
            return $this->apiResponse(200, 'Slider updated successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }
}
