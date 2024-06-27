<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductStoryRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\FileTrait;
use App\Models\ProductStory;
use App\Models\User;
use Exception;

class ProductStoryController extends AdminController
{
    use ApiResponseTrait, FileTrait;
    const PATH = 'story';

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:settings'])->only('store', 'update', 'destroy', 'show');
    }

    public function index(): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $products = ProductStory::withTrashed()->with('product')->get();
            return $this->apiResponse(200, 'Product stories data.', $products);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function show(ProductStory $product): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            return $this->apiResponse(200, 'Product story data.', $product);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function store(ProductStoryRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $image = $this->uploadImage($request->image, self::PATH);
            ProductStory::create([
                'image' => $image,
                'product_id' => $request->product_id,
                'status' => $request->status,
                'creator_type' => User::class,
                'creator_id' => auth()->user()->id,
                'editor_type' => User::class,
                'editor_id' => auth()->user()->id,
            ]);
            return $this->apiResponse(200, 'Product story created successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function destroy(ProductStory $product): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $this->deleteImage($product->image);
            $product->delete();
            return $this->apiResponse(200, 'Product story deleted successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function update(ProductStory $product, ProductStoryRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            if ($request->image) {
                $image = $this->uploadImage($request->image, self::PATH, $product->image);
            }
            $product->update([
                'image' => $image ?? $product->getRawOriginal('image'),
                'product_id' => $request->product_id,
                'status' => $request->status,
                'editor_type' => User::class,
                'editor_id' => auth()->user()->id,
            ]);
            return $this->apiResponse(200, 'Product story updated successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }
}
