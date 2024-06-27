<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SocialMediaRequest;
use App\Http\Resources\SocialMediaResource;
use App\Http\Traits\ApiResponseTrait;
use Exception;
use Smartisan\Settings\Facades\Settings;

class SocialMediaController extends AdminController
{
    use ApiResponseTrait;
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:settings'])->only('update');
    }

    public function index(): \Illuminate\Http\Response|SocialMediaResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $social_media = Settings::group('social_media')->all();
            return $this->apiResponse(200, 'Social media data.', $social_media);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function update(SocialMediaRequest $request): \Illuminate\Http\Response|SocialMediaResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            Settings::group('social_media')->set($request->validated());
            return $this->apiResponse(200, 'Social media updated successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }
}
