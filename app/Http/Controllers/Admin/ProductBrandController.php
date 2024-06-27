<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\FileTrait;
use App\Models\User;
use Exception;
use App\Http\Requests\ProductBrandRequest;
use App\Models\ProductBrand;
use Illuminate\Support\Str;

class ProductBrandController extends AdminController
{
    use ApiResponseTrait, FileTrait;
    const PATH = 'brand';

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:settings'])->only('store', 'update', 'destroy', 'show');
    }

    public function index(): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $brands = ProductBrand::withTrashed()->get();
            return $this->apiResponse(200, 'Brands data.', $brands);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function store(ProductBrandRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $imageName = $this->uploadImage($request->image, self::PATH);
            ProductBrand::create([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar,
                ],
                'slug' => Str::slug($request->name_en),
                'image' => $imageName,
                'description' => [
                    'en' => $request->description_en,
                    'ar' => $request->description_ar
                ],
                'status' => $request->status,
                'creator_type' => User::class,
                'creator_id' => auth()->user()->id,
                'editor_type' => User::class,
                'editor_id' => auth()->user()->id,
            ]);
            return $this->apiResponse(200, 'Brand created successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function show(ProductBrand $brand): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            return $this->apiResponse(200, 'Brand data.', $brand);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function destroy(ProductBrand $brand): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $this->deleteImage($brand->image);
            return $this->apiResponse(202, 'Brand deleted successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function update(ProductBrandRequest $request, ProductBrand $brand): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $imageName = ($request->image) ? $this->uploadImage($request->image, self::PATH, $brand->image) : $brand->getRawOriginal('image');
            $brand->update([
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar,
                ],
                'description' => [
                    'en' => $request->description_en,
                    'ar' => $request->description_ar,
                ],
                'image' => $imageName,
                'slug' => Str::slug($request->name_en),
                'status' => $request->status,
                'editor_type' => User::class,
                'editor_id' => auth()->user()->id,
            ]);
            return $this->apiResponse(200, 'Brand updated successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }
}
