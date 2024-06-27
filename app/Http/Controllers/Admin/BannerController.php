<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BannerRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\FileTrait;
use App\Models\Banner;
use App\Models\User;
use Exception;

class BannerController extends AdminController
{
    use ApiResponseTrait, FileTrait;
    const PATH = 'banner';

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:settings'])->only('show', 'store', 'destroy', 'update');
    }

    public function index(): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $banners = Banner::withTrashed()->get();
            return $this->apiResponse(200, 'Banners data.', $banners);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function store(BannerRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            if ($request->position != 1 && $request->image_en && $request->image_ar) {
                $englishImage = $this->uploadImage($request->image_en, self::PATH, null, 'en');
                $arabicImage = $this->uploadImage($request->image_ar, self::PATH, null, 'ar');
            } elseif ($request->position != 1 && $request->video) {
                $video = $this->uploadImage($request->video, self::PATH);
            }

            $banner = Banner::create([
                'image' => [
                    'en' => (!isset($video) && $request->position != 1) ? $englishImage : null,
                    'ar' => (!isset($video) && $request->position != 1) ? $arabicImage : null,
                ],
                'text' => [
                    'en' => ($request->position == 1) ? $request->text_en : null,
                    'ar' => ($request->position == 1) ? $request->text_ar : null,
                ],
                'video' => (!isset($englishImage) && $request->position != 1) ? $video : null,
                'position' => $request->position,
                'z_index' => $request->z_index ?? null,
                'type' => ($request->position == 1) ? null : $request->type,
                'status' => $request->status,
                'creator_type' => User::class,
                'creator_id' => auth()->user()->id,
                'editor_type' => User::class,
                'editor_id' => auth()->user()->id,
            ]);
            return $this->apiResponse(200, 'Banner created successfully.', $banner);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function show(Banner $banner): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            return $this->apiResponse(200, 'Banner data.', $banner);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function destroy(Banner $banner): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            if ($banner->image != null) {
                $this->deleteImage($banner->getTranslation('image', 'en'));
                $this->deleteImage($banner->getTranslation('image', 'ar'));
            } elseif ($banner->video != null) {
                $this->deleteImage($banner->video);
            }
            $banner->delete();
            return $this->apiResponse(202, 'Banner deleted successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function update(Banner $banner, BannerRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            if ($banner->image != null) {
                $englishImage = $this->uploadImage($request->image_en, self::PATH, $banner->getTranslation('image', 'en'), 'en');
                $arabicImage = $this->uploadImage($request->image_ar, self::PATH, $banner->getTranslation('image', 'ar'), 'ar');
            } elseif ($banner->video != null) {
                $video = $this->uploadImage($request->video, self::PATH, $banner->video);
            }

            $banner->update([
                'image' => [
                    'en' => $englishImage ?? $banner->getRawOriginal($banner->getTranslation('image', 'en')),
                    'ar' => $arabicImage ?? $banner->getRawOriginal($banner->getTranslation('image', 'ar')),
                ],
                'text' => [
                    'en' => ($request->position == 1) ? $request->text_en: $banner->getTranslation('text', 'en'),
                    'ar' => ($request->position == 1) ? $request->text_ar: $banner->getTranslation('text', 'ar'),
                ],
                'video' => $video ?? $banner->getRawOriginal('video'),
                'position' => $request->position,
                'z_index' => $request->z_index ?? $banner->z_index,
                'type' => ($request->position == 1) ? $banner->type : $request->type,
                'status' => $request->status,
                'editor_type' => User::class,
                'editor_id' => auth()->user()->id,
            ]);
            return $this->apiResponse(200, 'Banner updated successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }
}
