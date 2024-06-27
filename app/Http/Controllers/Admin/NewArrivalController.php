<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewArrivalRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\FileTrait;
use App\Models\NewArrival;
use App\Models\User;
use Exception;

class NewArrivalController extends AdminController
{
    use ApiResponseTrait, FileTrait;
    const PATH = 'new-arrival';

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['permission:settings'])->only('store', 'update', 'destroy', 'show');
    }

    public function index(): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $products = NewArrival::withTrashed()->with('product')->get();
            return $this->apiResponse(200, 'New products data.', $products);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function show(NewArrival $product): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            return $this->apiResponse(200, 'New product data.', $product);
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function store(NewArrivalRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $image = $this->uploadImage($request->image, self::PATH);
            NewArrival::create([
                'image' => $image,
                'product_id' => $request->product_id,
                'status' => $request->status,
                'creator_type' => User::class,
                'creator_id' => auth()->user()->id,
                'editor_type' => User::class,
                'editor_id' => auth()->user()->id,
            ]);
            return $this->apiResponse(200, 'New product created successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function destroy(NewArrival $product): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $this->deleteImage($product->image);
            $product->delete();
            return $this->apiResponse(200, 'New product deleted successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }

    public function update(NewArrival $product, NewArrivalRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
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
            return $this->apiResponse(200, 'New product updated successfully.');
        } catch (Exception $exception) {
            return $this->apiResponse(422, $exception->getMessage());
        }
    }
}
